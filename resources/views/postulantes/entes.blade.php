@extends('layouts.app')
<!--Date table-->
<link rel="stylesheet" href="{{ asset('css/datatables.css')}}" />
<link rel="stylesheet" href="{{ asset('css/datatables.min.css')}}" />

<!--css-->
<link rel="stylesheet" href="{{ asset('css/tabla.css')}}" />
@section('content')

<div class="tarjeta">
  <div class="cabecera">
    <h1>Todos los entes</h1>

    <div class="tabla">
      <table id="entes" class="tabla estudiantes">
        <thead class="azul">
          <tr>
            <th>id</th>
            <th>Ente</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $ente)
          <tr>
            <td class="azul centro">{{$ente->id}}</td>
            <td>{{ $ente->ente }}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot class="azul">
          <tr>
            <th>id</th>
            <th>Ente</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
<!-- Incluir archivos JS de DataTables y jQuery -->
<script src="{{asset('assets/libs/jQuery-3.7.0/jquery-3.7.0.min.js')}}"></script>
<script src="{{asset('js/datatables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
    $("#entes").DataTable();
  });
</script>
@endsection
