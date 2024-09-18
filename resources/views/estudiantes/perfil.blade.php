@extends('layouts.app') @section('content')
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}" />

    <title>Perfil - {{$estudiante->nombre}}</title>
  </head>
  <style>
    p {
      text-transform: lowercase;
    }
  </style>
  <body>
    <div class="contenido">
      <div class="cabezado">
        <h1>Datos del Postulado: {{$estudiante -> nombre}}</h1>

        <!-- <button type="submit" class="btn btn-primary boton" data-toggle="modal" data-target="#exportModal" style="width: auto; height:10%;"> 
                        Exportar a PDF
    </button>

    </div> -->

        <div class="datosPersonales">
          <div class="columnas">
            <div class="izquierda">
              <div class="campos">
                <p class="p1">Cedula de identidad:</p>

                <div class="casilla"><p>{{ $estudiante->cedula }}</p></div>
              </div>

              <div class="datos">
                <div class="campos">
                  <p class="p1">Nombres:</p>

                  <div class="casilla"><p>{{ $estudiante->nombre }}</p></div>
                </div>
              </div>

              <div class="datos">
                <div class="campos">
                  <p class="p1">Correo electronico:</p>

                  <div class="casilla"><p>{{ $estudiante->mail }}</p></div>
                </div>
              </div>

              <div class="datos">
                <div class="campos">
                  <p class="p1">Registrado:</p>

                  <div class="casilla"><p>{{ $estudiante->created_at->format('d/m/Y') }}</p></div>
                </div>
              </div>
            </div>

            <div class="derecha">
              <div class="datos">
                <div class="campos">
                  <p class="p1">Tipo de Postulacion:</p>

                  <div class="casilla"><p>{{ $estudiante->tipp }}</p></div>
                </div>
              </div>

              <div class="datos">
                <div class="campos">
                  <p class="p1">Apellidos:</p>

                  <div class="casilla"><p>{{ $estudiante->apellido }}</p></div>
                </div>
              </div>

              <div class="datos">
                <div class="campos">
                  <p class="p1">Números de contactos:</p>

                  <div class="casilla"><p>1: {{ $estudiante->num1 }}</p></div>

                  <div class="casilla num"><p>2: {{ $estudiante->num2 }}</p></div>

                  <div class="casilla num"><p>3: {{ $estudiante->num3 ? $estudiante->num3 : 'El Postulado no posee numero adicional' }}</p></div>
                </div>
              </div>
            </div>
          </div>

          <div class="campos notas">
            <p class="p1">Observaciones del postulado:</p>

            <div class="casillanotas"><p>{{ $estudiante->notas ? $estudiante->notas : 'El postulado no posee observaciones'}}</p></div>
          </div>

          <br />

          <h2>Datos del postulante</h2>

          <div class="datosPersonales">
            <div class="columnas">
              <div class="izquierda">
                <div class="campos">
                  <p class="p1">Nombre y apellido:</p>

                  <div class="casilla"><p>{{ $estudiante->postulante->nombreapellido ? $estudiante->postulante->nombreapellido : "No aplica, postulacion $estudiante->tipp" }}</p></div>
                </div>

                <div class="datos">
                  <div class="campos">
                    <p class="p1">Ente asociado:</p>

                    <div class="casilla"><p>{{$entes->firstWhere('id', $postulante->ente)->ente}}</p></div>
                  </div>
                </div>
              </div>

              <div class="derecha">
                <div class="datos">
                  <div class="campos">
                    <p class="p1">Departamento:</p>

                    <div class="casilla"><p>{{ $estudiante->postulante->depa ? $estudiante->postulante->depa : "No aplica, postulacion $estudiante->tipp" }}</p></div>
                  </div>
                </div>

                <div class="datos">
                  <div class="campos">
                    <p class="p1">Cargo:</p>

                    <div class="casilla"><p>{{ $estudiante->postulante->cargo ? $estudiante->postulante->cargo : "No aplica, postulacion $estudiante->tipp" }}</p></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <h2>Archivos del postulado</h2>

          <div class="datosPersonales">
            <div class="row">
              <div class="col-md-6">
                <div class="campos archivos">
                  @foreach ($estudiante->archivo->chunk(2) as $archivosChunk)
                  <div class="row">
                    @foreach ($archivosChunk as $archivo)
                    <div class="col-md-6">
                      <p class="p1">{{ $archivo->nombre }} {{ round($archivo->size / (1024 * 1024), 2) }} MB</p>
                      <div class="casilla">
                        <p><a href="{{ route('descargar.archivo', ['nombreArchivo' => $archivo->ruta]) }}" target="__blank">Ver/Descargar Archivo</a></p>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="botonera">
          <a href="{{ route('estudiantes.edit', $estudiante->id) }}">
            <div class="cancelarB"><p>Editar</p></div>
          </a>
          <a href="{{ route('estudiantes.search') }}">
            <div class="cancelarB"><p>Cancelar</p></div>
          </a>
        </div>

        @endsection
      </div>
    </div>
  </body>
</html>
