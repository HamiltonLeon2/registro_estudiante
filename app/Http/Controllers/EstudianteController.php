<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Ente;
use App\Models\Postulante;
use App\Models\Archivo;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{

    //Buscar al postulado   
    public function searching(Request $request)
    {
        return view('estudiantes.buscador');
    }
    public function buscar(Request $request)
    {
        $termino = $request->input('termino');
        // Realiza la búsqueda en tu modelo
        $resultados = Estudiante::where('nombre', 'ILIKE', "%$termino%")
            ->orWhere('apellido', 'ILIKE', "%$termino%")
            ->orWhere('cedula', 'LIKE', "%$termino%")
            ->paginate(100);



        return view('estudiantes.resultados', ['resultados' => $resultados]);
    }
    // public function buscar(Request $request)
    // {
    //     $termino = $request->input('termino');
    //     // Realiza la búsqueda en tu modelo
    //     $resultados = Estudiante::where('nombre', 'ILIKE', "%$termino%")
    //     ->orWhere('apellido', 'ILIKE', "%$termino%")
    //     ->orWhere('cedula', 'LIKE', "%$termino%")
    //     ->paginate(100);



    //     return view('estudiantes.resultados', ['resultados' => $resultados]);
    // }

    //Creacion del postulado
    //recuperar a los entes para la seleccion 
    public function create()
    {
        $entes = Ente::all();
        return view('estudiantes.create', ['entes' => $entes]);
    }
    //creacion del postulado
    public function store(Request $request)
    {
        // Validación de datos ingresados en los inputs
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'unique:estudiantes,cedula',
            'mail' => 'required|email',
            'num1' => 'required|string|max:11',
            'num2' => 'required|string|max:11',
            'num3' => 'nullable|string|max:11',
            'tipp' => 'required|string|max:255',
            'notas' => 'nullable|string',
            'nombreapellido' => 'nullable|string|max:100',
            'ente' => 'required|string|max:255',
            'depa' => 'nullable|string|max:255',
            'cargo' => 'nullable|string|max:255',
            'CartaP' => 'required|file|max:5000',
            'CertOPSU' => 'nullable|file|max:5000',
            'TituloB' => 'nullable|file|max:5000',
            'CedulaIdentidad' => 'nullable|file|max:5000',
        ]);
        //crear al postulado en la base de datos
        $estudiante = Estudiante::create([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'cedula' => $request->input('cedula'),
            'mail' => $request->input('mail'),
            'num1' => $request->input('num1'),
            'num2' => $request->input('num2'),
            'num3' => $request->input('num3'),
            'tipp' => $request->input('tipp'),
            'notas' => $request->input('notas')
        ]);
        // Crear el postulante asociado al estudiante
        $postulante = new Postulante([
            'nombreapellido' => $request->input('nombreapellido'),
            'depa' => $request->input('depa'),
            'ente' => $request->input('ente'),
            'cargo' => $request->input('cargo'),

        ]);
        $estudiante->postulante()->save($postulante);

        // Guardar los archivos 
        $archivos = [
            'CartaP' => 'Carta de postulacion',
            'CartaP1' => 'Carta de postulacion 2',
            'CartaP2' => 'Carta de postulacion 3',
            'CartaP3' => 'Carta de postulacion 4',
            'CartaP4' => 'Carta de postulacion 5',
            'CedulaIdentidad' => 'cedula de identidad',
            'TituloB' => 'Titulo de bachillerato',
            'CertOPSU' => 'Certificado OPSU',
        ];
        //Guardar el archivo  
        foreach ($archivos as $campo => $descripcion) {
            if ($request->hasFile($campo)) {
                $archivo = $request->file($campo);
                //Se le asigna el nombre al archivo para guardarlo en la storage (descripcion_cedula del postulado_nombre del postuado.pdf)
                $nombreArchivo = $descripcion . '_' . $estudiante->cedula . '_' . $estudiante->nombre . '.' . $archivo->getClientOriginalExtension();
                $archivo->storeAs('archivos', $nombreArchivo);

                // Crear el registro del archivo en la base de datos
                $archivoModel = new Archivo([
                    'nombre' => $descripcion,
                    'tipo' => $archivo->getClientOriginalExtension(),
                    'size' => $archivo->getSize(),
                    'ruta' => $nombreArchivo,
                    'estudiante_id' => $estudiante->id,
                ]);
                $archivoModel->save();
            }
        }
        // Redireccionar o mostrar un mensaje de éxito
        return redirect('/registro-estudiante')->with('success', 'Estudiante registrado exitosamente');
    }

    //Recuperar la informacion de los estudiantes para mostrarlos en la datatable del día
    public function showDatatable(Request $request)
    {
        $fecha = Carbon::now()->format('d/m/Y');

        $today = date('Y-m-d');

        if ($request->ajax()) {
            $datosnecesarios = ['id', 'cedula', 'nombre', 'apellido', 'mail', 'num1',];
            $data = Estudiante::with('postulante.ente')->select($datosnecesarios)->whereDate('created_at', $today)->paginate(10);
            return DataTables::of($data)->make(true);
        }

        $data = Estudiante::whereDate('created_at', $today)->latest()->get();
        $entes = Ente::all(); // Recuperar todos los entes

        return view('estudiantes.datatable', compact('data', 'entes', 'fecha'));
    }
    //Recuperar a todos los postulados para mostrarlos en la datatable global
    public function showtodos(Request $request)
    {
        if ($request->ajax()) {
            $datosnecesarios = ['id', 'cedula', 'nombre', 'apellido', 'mail', 'num1',];
            $data = Estudiante::with('postulante.ente')->select($datosnecesarios)->paginate(100);
            return DataTables::of($data)->make(true);
        }

        $data = Estudiante::latest()->get();
        $entes = Ente::all(); // Recuperar todos los entes
        return view('estudiantes.todos', compact('data', 'entes'));
    }

    //Controlador de la funcion editar 
    
    //recuperar el id que se quiere editar
    public function edit($id)
    {
        $estudiante = Estudiante::with('archivo')->find($id);
        $postulante = $estudiante->postulante;
        $entes = Ente::all(); // Asegúrate de tener la clase Ente en tu modelo.

        return view('estudiantes.editar', compact('estudiante', 'postulante', 'entes'));
    }
    //guardar los cambios
    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'unique:estudiantes,cedula,' . $id,
            'mail' => 'required:estudiantes,mail,' . $id,
            'num1' => 'required|string|max:11',
            'num2' => 'required|string|max:11',
            'num3' => 'nullable|string|max:11',
            'tipp' => 'required|string|max:255',
            'notas' => 'nullable|string',
            'nombreapellido' => 'nullable|string|max:100',
            'ente' => 'required|string|max:255',
            'depa' => 'nullable|string|max:255',
            'cargo' => 'nullable|string|max:255',
            'CartaP' => 'nullable|file|max:5000',
            'CertOPSU' => 'nullable|file|max:5000',
            'TituloB' => 'nullable|file|max:5000',
            'CedulaIdentidad' => 'nullable|file|max:5000',

        ]);

        // Obtener el estudiante a actualizar
        $estudiante = Estudiante::find($id);

        // Actualizar los datos del estudiante
        $estudiante->update([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'cedula' => $request->input('cedula'),
            'mail' => $request->input('mail'),
            'num1' => $request->input('num1'),
            'num2' => $request->input('num2'),
            'num3' => $request->input('num3'),
            'tipp' => $request->input('tipp'),
            'notas' => $request->input('notas'),
        ]);

        // Actualizar los datos del postulante asociado
        $estudiante->postulante()->update([
            'nombreapellido' => $request->input('nombreapellido'),
            'depa' => $request->input('depa'),
            'ente' => $request->input('ente'),
            'cargo' => $request->input('cargo'),
        ]);

        //Crea un arreglo, recuperando los archivos cargados en el formulario y asignandole nombre  
        $archivos = [
            'CartaP' => 'Carta de postulacion',
            'CartaP1' => 'Carta de postulacion 2',
            'CartaP2' => 'Carta de postulacion 3',
            'CartaP3' => 'Carta de postulacion 4',
            'CartaP4' => 'Carta de postulacion 5',
            'CedulaIdentidad' => 'cedula de identidad',
            'TituloB' => 'Titulo de bachillerato',
            'CertOPSU' => 'Certificado OPSU',
        ];

        //Bucle para nombrar el archivo y hacer la verificacion si ya existe algun archivo cargado
        foreach ($archivos as $campo => $descripcion) {
            if ($request->hasFile($campo)) {
                $archivo = $request->file($campo);
                $nombreArchivo = $descripcion . '_' . $estudiante->cedula . '_' . $estudiante->nombre . '.' . $archivo->getClientOriginalExtension();
                $archivo->storeAs('archivos', $nombreArchivo);

                // Eliminar archivo existente si lo hay
                $archivoExistente = $estudiante->archivo()->where('nombre', $descripcion)->first();
                if ($archivoExistente) {
                    Storage::delete($archivoExistente->ruta);
                    $archivoExistente->delete();
                }

                // Crear el registro del nuevo archivo en la base de datos
                $archivoModel = new Archivo([
                    'nombre' => $descripcion,
                    'tipo' => $archivo->getClientOriginalExtension(),
                    'size' => $archivo->getSize(),
                    'ruta' => $nombreArchivo,
                    'estudiante_id' => $estudiante->id,
                ]);
                //guarda el archivo en la base de dato
                $archivoModel->save();
            }
        }

        // Redireccionar o mostrar un mensaje de éxito
        return redirect()->route('estudiantes.search', $id)->with('success', 'Estudiante actualizado exitosamente');
    }

    // Controlador para recuperar y mostrar los datos del postulado
    public function mostrarPerfil($id)
    {
        $estudiante = Estudiante::with('archivo')->find($id);
        $postulante = $estudiante->postulante;
        $entes = Ente::all();


        return view('estudiantes.perfil', compact('estudiante', 'postulante', 'entes'));
    }
    //Descargar los archivos cargados del postulado
    public function descargarArchivo($nombreArchivo)
    {
        $rutaArchivo = storage_path('app/archivos/' . $nombreArchivo);

        if (Storage::exists('archivos/' . $nombreArchivo)) {
            return response()->file($rutaArchivo);
        } else {
            return redirect()->route('error.archivos_no_encontrados');
        }
    }
    // Controlador para mostrar los postulados totales registrados en cada ente
    public function mostrarTotales()
    {
        $entes = Ente::withCount('postulantes')->get();

        return view('estudiantes.totales', compact('entes'));
    }
    //Controlador para realizar la suma de los registrados en el año
    public function totalYear()
    {
        $estudiantesPorAño = DB::table('estudiantes')
            ->selectRaw('EXTRACT(YEAR FROM created_at) AS año, COUNT(*) AS total_estudiantes')
            ->groupBy('año')
            ->orderBy('año')
            ->get();

        return view('estudiantes.totalesYear', compact('estudiantesPorAño'));
    }
    //Controlador para realizar la suma de los registrados en el año
    public function totaltipp()
    {
        $estudiantesPorpostulacion = DB::table('estudiantes')
            ->selectRaw('tipp, COUNT(*) AS total_estudiantes')
            ->groupBy('tipp')
            ->get();

        return view('estudiantes.totalestipp', compact('estudiantesPorpostulacion'));
    }

    //Controlador para el apartado de auditorias
    public function mostrarHistorial()
    {
        $estudiantes = Estudiante::all();
        $historialAgrupado = [];

        foreach ($estudiantes as $estudiante) {
            $historial = $estudiante->revisionHistory;

            if ($historial->isNotEmpty()) {
                foreach ($historial as $revision) {
                    $cedula = $estudiante->cedula;

                    // Agrupar por cédula
                    if (!isset($historialAgrupado[$cedula])) {
                        $historialAgrupado[$cedula] = [
                            'nombre' => $estudiante->nombre,
                            'id' => $estudiante->id,
                            'historial' => [],
                        ];
                    }

                    // Desglosar los cambios
                    $cambiosDesglosados = $this->desglosarCambios($revision->old_value, $revision->new_value);

                    $historialAgrupado[$cedula]['historial'][] = [
                        'version' => $revision->version,
                        'usuario' => $revision->userResponsible()->name,
                        'cambios' => $cambiosDesglosados,
                        'fecha' => $revision->created_at,
                    ];
                }
            }
        }
        //retornar a la vista
        return view('estudiantes.auditoria', compact('historialAgrupado'));
    }

    // Método para desglosar los cambios
    private function desglosarCambios($oldValue, $newValue)
    {
        $cambios = [];

        // Convertir cadenas JSON a arrays si es necesario
        $oldValueArray = is_string($oldValue) ? json_decode($oldValue, true) : $oldValue;
        $newValueArray = is_string($newValue) ? json_decode($newValue, true) : $newValue;

        // Verificar si los valores son arrays u objetos
        if (is_array($oldValueArray) && is_array($newValueArray)) {
            $campos = array_merge(array_keys($oldValueArray), array_keys($newValueArray));

            foreach ($campos as $campo) {
                $antiguoValor = $oldValueArray[$campo] ?? null;
                $nuevoValor = $newValueArray[$campo] ?? null;

                // Comparar directamente los valores
                if ($antiguoValor !== $nuevoValor || ($antiguoValor === null && $nuevoValor !== null) || ($antiguoValor !== null && $nuevoValor === null)) {
                    // Agregar el nombre del campo al mensaje de cambio
                    $mensaje = "Cambio el $campo de " . ($antiguoValor !== null ? "($antiguoValor)" : "nulo") . " a " . ($nuevoValor !== null ? "($nuevoValor)" : "nulo");
                    $cambios[] = $mensaje;
                }
            }
        } elseif (is_string($oldValue) && is_string($newValue)) {
            // En caso de cadenas, comparar directamente
            if ($oldValue !== $newValue || ($oldValue === null && $newValue !== null) || ($oldValue !== null && $newValue === null)) {
                $cambios[] = "Cambio de " . ($oldValue !== null ? "($oldValue)" : "nulo") . " a " . ($newValue !== null ? "($newValue)" : "nulo");
            }
        }

        return $cambios;
    }
    //Revision de archivos 
    public function RevArchivos()
    {
        // Recupera la informacion de los estudiantes y archivos
        $estudiantes = Estudiante::all();
        $archivos = Archivo::all();
        //Crea un arreglo, con los nombres de los archivos que deberia tener cargado cada postulado
        $archivosRequeridos = [
            'Certificado OPSU',
            'Titulo de bachillerato',
            'Cedula de identidad',
            'Carta de postulacion',
        ];
        //se declara un arreglo vacio, en donde se almacenara los archivos de cada postulado
        $archivosPorEstudiante = [];

        // Llenar el arreglo $archivosPorEstudiante con los archivos de cada estudiante
        foreach ($estudiantes as $estudiante) {
            $archivosEstudiante = [];
            foreach ($archivos as $archivo) {
                if ($archivo->estudiante_id === $estudiante->id) {
                    $archivosEstudiante[] = $archivo->nombre;
                }
            }
            $archivosPorEstudiante[$estudiante->id] = $archivosEstudiante;
        }

        // Comparar los archivos de cada estudiante con los archivos requeridos
        foreach ($archivosPorEstudiante as $estudianteId => $archivosEstudiante) {

            $archivosFaltantes = array_diff($archivosRequeridos, $archivosEstudiante);

            if (empty($archivosFaltantes)) {
            } else {
                foreach ($archivosFaltantes as $archivoFaltante) {
                }
            }
        }
        //envia a la vista la informacion de los
        return view('estudiantes.RevArchivos', compact('estudiantes', 'archivosRequeridos', 'archivosPorEstudiante'));
    }
}
