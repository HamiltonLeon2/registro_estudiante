<?php

namespace App\Http\Controllers;

use App\Models\Ente;
use Illuminate\Http\Request;


class Entescontroller extends Controller
{
    //ruta a la vista
    public function index()
    {
        return view('postulantes.crear');
    }

    public function store(Request $request)
    {
        //validacion de los datos ingresados en el input
        $request->validate([
            'nombre' => 'required|unique:ente,ente|string|max:50'
        ]);
        //almacenar lo obtenido en la base de datos
        $ente = Ente::create([
            'ente' => $request->input('nombre'),
        ]);
        //Devolver el resultado a la vista
        return redirect('/postulantes/CrearEnte')->with('success', 'Ente registrado exitosamente');
    }
    public function uploadCSV(Request $request)
    {
        //se valida el archivo csv cargado
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048'
        ]);

        $file = $request->file('csv_file');
        $csvData = array_map('str_getcsv', file($file));

        $existingEntes = Ente::pluck('ente')->map(function ($ente) {
            return strtolower($ente);
        })->toArray();

        $newEntes = [];

        foreach ($csvData as $row) {
            $enteName = trim($row[0]);

            // Convertir el nombre del ente a minúsculas para la comparación
            $enteNameLower = strtolower($enteName);

            // Verificar si el nombre del ente ya existe en la base de datos
            if (!in_array($enteNameLower, $existingEntes)) {
                // Agregar el nombre del ente a los existentes para evitar duplicados
                $existingEntes[] = $enteNameLower;

                // Agregar el nombre del ente al arreglo de nuevos entes
                $newEntes[] = [
                    'ente' => $enteName,
                ];
            }
        }

        // Crear los nuevos entes en la base de datos
        Ente::insert($newEntes);

        return redirect()->back()->with('success', 'Datos CSV cargados exitosamente');
    }
    public function view(Request $request)
    {
        if ($request->ajax()) {
            $data = Ente::select(['id', 'ente'])->paginate(500);
            return DataTables::of($data)->make(true);
        }

        $data = Ente::latest()->get();
        return view('postulantes.entes', compact('data'));
    }
}
