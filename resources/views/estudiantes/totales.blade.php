@extends('layouts.app')

@section('content')

<!--Date table-->
<link rel="stylesheet" href="{{ asset('css/datatables.css')}}" />
<link rel="stylesheet" href="{{ asset('css/datatables.min.css')}}" />

<!--css-->
<link rel="stylesheet" href="{{ asset('css/totales.css')}}" />

<section class="cuerpo">
  <div class="tarjeta">
    <!--Mensaje de error cuando no se selecciona entes-->
    @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
    @endif
    <!--contenido de la tabla-->
    <h1>Total de postulados por ente</h1>
    <div class="tabla">
      <div class="cabezal">
        <!-- Formulario para exportar a PDF -->
        <form id="exportarPdfForm" action="{{ route('exportar.pdf') }}" method="post" style="display:inline-block;">
          @csrf
          <button type="submit" class="btn btn-primary boton">
            Exportar a PDF
          </button>
          <!-- Campo oculto para observaciones -->
          <input type="hidden" name="observaciones" id="observacionesPdf">
        </form>

        <!-- Formulario para exportar a Excel -->
        <form id="exportarExcelForm" action="{{ route('exportar.excel') }}" method="post" style="display:inline-block;">
          @csrf
          <button type="submit" class="btn btn-success boton">
            Exportar a Excel
          </button>
          <!-- Campo oculto para observaciones -->
          <input type="hidden" name="observaciones" id="observacionesExcel">
        </form>
      </div>
      <br />
      <div class="incluir">
        <div class="observa">
          <label for="observaciones">Observaciones:</label><br />
          <input type="text" id="observaciones" class="observaciones" />
        </div>
        <br />
      </div>
      <br />
      <table id="entes" class="tabla estudiantes">
        <thead class="azul">
          <tr>
            <th>id</th>
            <th>Ente</th>
            <th>Postulados registrados</th>
            <th>Seleccionar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($entes as $ente)
          @if ($ente->postulantes_count > 0)
          <tr>
            <td class="azul centro">{{$ente->id}}</td>
            <td>{{ $ente->ente }}</td>
            <td class="centro">{{ $ente->postulantes_count }}</td>
            <td class="centro">
              <!-- Checkbox asociado a ambos formularios -->
              <input type="checkbox" name="selectedEntes[]" value="{{ $ente->id }}" form="exportarPdfForm" />
              <input type="checkbox" name="selectedEntes[]" value="{{ $ente->id }}" form="exportarExcelForm" />
            </td>
          </tr>
          @endif
          @endforeach
        </tbody>
        <tfoot class="azul">
          <tr>
            <th>id</th>
            <th>Ente</th>
            <th>Postulados registrados</th>
            <th>Seleccionar</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</section>

<!-- Incluir archivos JS de DataTables y jQuery -->
<script src="{{asset('assets/libs/jQuery-3.7.0/jquery-3.7.0.min.js')}}"></script>
<script src="{{asset('js/datatables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
    // Inicializar la tabla con DataTables
    $("#entes").DataTable();

    // Sincronizar observaciones entre los formularios
    $("#exportarPdfForm").on("submit", function () {
      $("#observacionesPdf").val($("#observaciones").val());
    });

    $("#exportarExcelForm").on("submit", function () {
      $("#observacionesExcel").val($("#observaciones").val());
    });
  });
</script>

@endsection
