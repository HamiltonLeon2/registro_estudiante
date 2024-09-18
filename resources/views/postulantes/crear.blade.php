@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/registro.css') }}" />
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts') @section('content')

<style>
  #crearente {
    display: flex;
    justify-content: flex-start;
    flex-direction: column;
    align-items: center;
  }
  .datos {
    width: 90%;
  }
  .botonera {
    width: 90%;
  }
  .cabecera {
    display: flex;
    justify-content: space-between;
    margin: 2% 2%;
  }
  #btnSubirCSV:hover::after {
    content: attr(title);
    display: block;
    position: absolute;
    background-color: rgba(0, 0, 0, 0.7);
    color: #fff;
    padding: 5px;
    border-radius: 5px;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    z-index: 999;
    white-space: nowrap;
  }
</style>
<div class="tarjeta">
  <div class="cabecera">
    <h1>Crear Ente</h1>
    <!-- Botón para abrir el modal -->
    @if(\Auth::user()->hasRole('administrador'))
    <button type="button" class="cancelarB" data-toggle="modal" id="btnSubirCSV " data-target="#modalCSV" title="Carga un archivo CSV con muchos entes, para crearlos masivamente">
      Subir CSV
    </button>
    @endif
  </div>

  <!-- Formulario para crear el ente -->
  <form action="{{ url('/postulantes/CrearEnte') }}" method="post" id="crearente">
    @csrf

    <div class="datos">
      <label for="nombre">Nombre del ente<span class="asterisco">*</span>:</label><br />
      <input type="text" name="nombre" required />
    </div>
    <div class="botonera">
      <button type="submit" id="registrarButton" class="cancelarB">Registrar</button>

      <a href="{{ route('estudiantes.search') }}" class="cancelarB">
        <div><p>Cancelar</p></div>
      </a>
    </div>
  </form>

  <!-- Modal -->
  <div class="modal fade" id="modalCSV" tabindex="-1" role="dialog" aria-labelledby="modalCSVLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCSVLabel">Cargar archivo CSV</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('upload.csv') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="csv_file">Seleccionar archivo CSV:</label>
              <input type="file" class="form-control-file" id="csv_file" name="csv_file" required />
            </div>
            <button type="submit" class="cancelarB">Subir</button>
          </form>
        </div>
      </div>
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
</div>
