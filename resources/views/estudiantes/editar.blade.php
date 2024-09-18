<!-- resources/views/estudiantes/editar.blade.php -->

@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/perfil.css') }}" />
<link rel="stylesheet" href="{{ asset('css/registro.css') }}" />
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts') @section('content')

<div class="container">
  <div class="tarjeta">
    <h1>Editar Datos de Postulado</h1>
    <form method="post" action="{{ route('estudiantes.update', $estudiante->id) }}" enctype="multipart/form-data">
      @csrf @method('put')

      <div class="apartadoD">
        <p class="daas">Datos Aspirante</p>
        <div class="DatosAspirante">
          <div class="parte1">
            <div class="columna1">
              <div class="datos">
                <label for="cedula">Cédula de identidad:</label><br />
                <input type="number" name="cedula" value="{{ $estudiante->cedula }}" required />
              </div>
              <div class="datos">
                <label for="apellido">Apellidos:</label><br />
                <input type="text" name="apellido" value="{{ $estudiante->apellido }}" required />
              </div>
              <div class="datos">
                <label for="mail">correo electronico:</label><br />
                <input type="text" name="mail" value="{{ $estudiante->mail }}" required />
              </div>
            </div>
            <div class="columna2">
              <div class="datos">
                <label for="nombre">Nombres:</label><br />
                <input type="text" name="nombre" value="{{ $estudiante->nombre }}" required />
              </div>
              <div class="datos">
                <label for="contact">Nro de contacto:</label><br />
                <input class="numerosT" type="number" name="num1" value="{{ $estudiante->num1 }}" required placeholder="Número de teléfono" /><br />
                <input class="numerosT" type="number" name="num2" value="{{ $estudiante->num2 }}" required placeholder="Número de casa" /><br />
                <input class="numerosT" type="number" name="num3" value="{{ $estudiante->num3 }}" placeholder="Número opcional" />
              </div>
            </div>
          </div>
          <div class="parte2">
            <div class="datos">
              <label for="tipp">Tipo de postulacion:</label><br />
              <input type="text" name="tipp" value="{{ $estudiante->tipp }}" />
            </div>
          </div>
        </div>
      </div>
      <div class="apartadoD">
        <div class="DatosPostulante">
          <p class="daas">Datos del postulante</p>
          <div class="parte2" id="parte2Postulado">
            <div class="datos nombreapellido">
              <label for="nombreapellido">Nombre y apellido:</label>
              <input type="text" name="nombreapellido" value="{{ $postulante->nombreapellido }}" />
            </div>
            <div class="datos">
              <label for="ente">Ente:</label><br />
              <select name="ente" required>
                @foreach ($entes as $ente)
                <option value="{{ $ente->id }}" class="selectent" {{ $postulante->ente == $ente->id ? 'selected' : '' }}> {{ $ente->ente }} </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="parte1">
            <div class="datos" id="Wdatos">
              <label for="depa">Departamento:</label>
              <input type="text" name="depa" value="{{ $postulante->depa }}" />
            </div>
            <div class="datos" id="Wdatos">
              <label for="cargo">Cargo:</label>
              <input id="cargoI" type="text" name="cargo" value="{{ $postulante->cargo }}" />
            </div>
          </div>
        </div>
      </div>

      <div class="NotasP">
        <p class="daas">Observaciones</p>
        <div class="datos nombreapellido"><input type="text" name="notas" value="{{ $estudiante->notas }}" /><br /></div>
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
        <div class="apartadoD">
          <p class="daas">Cargar otros archivos</p>

          <div class="parte1">
            <div id="datos" class="cartas">
              <div class="cabeza-cartas">
                <div class="boton-mas">
                  <a href="#" id="addFile">+</a>
                </div>
                <label for="CartaP">Carta de postulacion</label>
              </div>
              <div class="datos">
                <!-- Nuevo div para el input original -->
                <input type="file" name="CartaP" accept=".pdf, .doc, .docx" class="archivo-input" />
              </div>
              <script>
                document.getElementById("addFile").addEventListener("click", function (e) {
                  e.preventDefault();
                  var numInputs = document.querySelectorAll("#datos .datos").length;
                  if (numInputs < 5) {
                    var div = document.createElement("div");
                    div.className = "datos"; // Añadir la clase datos al nuevo div
                    var input = document.createElement("input");
                    input.type = "file";
                    input.name = "CartaP" + numInputs;
                    input.accept = ".pdf, .doc, .docx";
                    input.className = "archivo-input"; // Añadir la clase archivo-input al nuevo input
                    div.appendChild(input);
                    document.getElementById("datos").appendChild(div);
                  } else {
                    // Mostrar mensaje de SweetAlert
                    Swal.fire({
                      icon: "warning",
                      title: "Oops...",
                      text: "Solo se pueden añadir 5 cartas de postulacion",
                    });
                  }
                });
              </script>
            </div>
            <div class="datos">
              <label for="cedula_identidad">Cedula de identidad</label>
              <input type="file" name="CedulaIdentidad" accept=".pdf, .doc, .docx, .png, .jpeg" />
            </div>
          </div>
          <div class="parte1">
            <div class="datos">
              <label for="TituloB">Titulo</label>
              <input type="file" name="TituloB" accept=".pdf, .doc, .docx" />
            </div>
            <div class="datos">
              <label for="CertOPSU">Certificado OPSU</label>
              <input type="file" name="CertOPSU" accept=".pdf, .doc, .docx" />
            </div>
          </div>
        </div>
      </div>
      <div class="botonera">
        <button type="submit">Guardar</button>
        <a href="{{ route('estudiantes.search') }}">
          <div class="cancelarB"><p>Cancelar</p></div>
        </a>
      </div>
    </form>
  </div>
</div>

@if(session('success'))
<script>
  Swal.fire("¡Éxito!", "{{ session('success') }}", "success");
</script>
@endif @if ($errors->any())
<script>
  let errorList = '<ul>';
  @foreach ($errors->keys() as $field)
      errorList += '<li>Error en el campo "{{ $field }}": {{ $errors->first($field) }}</li>';
  @endforeach
  errorList += '</ul>';

  Swal.fire({
      icon: 'error',
      title: 'Error de validación en los siguientes campos:',
      html: errorList,
  });
</script>
@endif @endsection
