@extends('layouts.app') @section('content')

<!--Date table-->
<link rel="stylesheet" href="{{ asset('css/datatables.css')}}" />
<link rel="stylesheet" href="{{ asset('css/datatables.min.css')}}" />

<!--css-->
<link rel="stylesheet" href="{{ asset('css/tabla.css')}}" />

<section class="cuerpo">
  <div class="tarjeta">
    <h1>Todos los postulados registrados</h1>
    <div class="tabla">
      <table id="postuladostable" class="display" style="width: 100%;">
        <thead class="azul">
          <tr>
            <th>Cedula</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Nro telefono</th>
            <th>Ente</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $estudiante)
          <tr>
            <td class="azul">{{ $estudiante->cedula }}</td>
            <td>{{ $estudiante->nombre }}</td>
            <td>{{ $estudiante->apellido }}</td>
            <td>{{ $estudiante->mail }}</td>
            <td>{{ $estudiante->num1 }}</td>
            <td>{{ $entes->firstWhere('id', optional($estudiante->postulante)->ente)->ente }}</td>

            <td class="botonera">
              <div class="dropdown">
                <button class="dropbtn"><img src="{{asset('img/tuerca.png')}}" alt="" class="tuerca" /></button>
                <div class="dropdown-content">
                  <a href="{{ route('estudiantes.edit', $estudiante->id) }}"><img src="{{asset('img/editar.png')}}" alt="" class="tuerca" /></a>
                  <a href="{{ route('perfil.show', $estudiante->id) }}"><img src="{{asset('img/visualizar.png')}}" alt="" class="tuerca" /></a>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot class="azul">
          <tr>
            <th>Cedula</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Nro telefono</th>
            <th>Ente</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</section>

<!-- Incluir archivos JS de DataTables y jQuery -->
<script src="{{asset('assets/libs/jQuery-3.7.0/jquery-3.7.0.min.js')}}"></script>
<script src="{{asset('js/datatables.min.js')}}"></script>
<script>
  $(document).ready(function () {
    // Inicializar la tabla con DataTables
    $("#postuladostable").DataTable();
  });
</script>

@endsection
