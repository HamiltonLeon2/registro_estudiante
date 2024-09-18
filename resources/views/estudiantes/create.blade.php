@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/registro.css') }}" />
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stack('scripts') @section('content')

<div class="cotenedor">
 <div class="tarjeta">
  <h1>Registro de Postulado</h1>

  <form method="post" action="{{ url('/registro-estudiante') }}" enctype="multipart/form-data">
   @csrf
   <div class="apartadoD">
    <p class="descrip">Los campos que posean * son obligatorios.</p>
    <p class="daas">Datos Aspirante</p>
    <div class="DatosAspirante">
     <div class="parte1">
      <div class="columna1">
       <div class="datos">
        <label for="cedula">Cédula de identidad<span class="asterisco">*</span></label><br />
        <input type="number" name="cedula" required />
       </div>
       <div class="datos">
        <label for="apellido">Apellidos<span class="asterisco">*</span>:</label><br />
        <input type="text" name="apellido" required />
       </div>
       <div class="datos">
        <label for="mail">correo electronico<span class="asterisco">*</span>:</label><br />
        <input type="email" name="mail" required />
       </div>
      </div>
      <div class="columna2">
       <div class="datos">
        <label for="nombre">Nombres<span class="asterisco">*</span>:</label><br />
        <input type="text" name="nombre" required />
       </div>
       <div class="datos">
        <label for="contact">Nro de contacto:</label><br />
        <input class="numerosT" type="number" name="num1" required placeholder="Número de teléfono *" /><br />
        <input class="numerosT" type="number" name="num2" required placeholder="Número de casa *" /><br />
        <input class="numerosT" type="number" name="num3" placeholder="Número opcional" />
       </div>
      </div>
     </div>
     <div class="parte2">
      <div class="datos">
       <label for="tipp">Tipo de postulacion<span class="asterisco">*</span>:</label><br />
       <input type="text" name="tipp" />
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
       <input type="text" name="nombreapellido" />
      </div>
      <div class="datos">
       <label for="ente">Ente<span class="asterisco">*</span>:</label><br />
       <select class="js-ente-basic-single" name="ente" required>
        <option value="" hidden>Seleccionar Ente</option>
        @foreach ($entes as $ente)
        <option value="{{ $ente->id }}" class="selectent">
         {{ $ente->ente }}
         <hr />
        </option>
        @endforeach
       </select>
      </div>
     </div>
     <div class="parte1">
      <div class="datos" id="Wdatos">
       <label for="depa">Departamento:</label>
       <input type="text" name="depa" />
      </div>
      <div class="datos" id="Wdatos">
       <label for="cargo">Cargo:</label>
       <input id="cargoI" type="text" name="cargo" />
      </div>
     </div>
    </div>
   </div>

   <div class="apartadoD">
    <p class="daas">Carga de archivos</p>

    <div class="parte1">
     <div id="datos" class="cartas">
      <div class="cabeza-cartas">
       <div class="boton-mas">
        <a href="#" id="addFile">+</a>
       </div>
       <label for="CartaP">Carta de postulacion<span class="asterisco">*</span></label>
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
      <label for="cedula_identidad">Cedula de identidad<span class="asterisco">*</span></label>
      <input type="file" name="CedulaIdentidad" accept=".pdf, .doc, .docx, .png, .jpeg" />
     </div>
    </div>
    <div class="parte1">
     <div class="datos">
      <label for="TituloB">Titulo</label>
      <input type="file" name="TituloB" accept=".pdf, .doc, .docx" />
     </div>
     <div class="datos">
      <label for="CertOPSU">Certificado OPSU<span class="asterisco">*</span></label>
      <input type="file" name="CertOPSU" accept=".pdf, .doc, .docx" />
     </div>
    </div>

    <div class="NotasP">
     <p class="daas">Observaciones</p>
     <div class="nombreapellido"><input type="text" name="notas" /><br /></div>
    </div>
   </div>
   <div class="botonera">
    <button type="submit" id="registrarButton" class="cancelarB">Registrar</button>

    <a href="{{ route('estudiantes.search') }}" class="cancelarB">
     <div><p>Cancelar</p></div>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
 $(document).ready(function () {
  $(".js-ente-basic-single").select2();
 });
</script>
