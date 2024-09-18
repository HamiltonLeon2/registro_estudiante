@extends('layouts.app')

<!--Date table-->
<link rel="stylesheet" href="{{ asset('css/datatables.css')}}" />
<link rel="stylesheet" href="{{ asset('css/datatables.min.css')}}" />

<!--css-->
<link rel="stylesheet" href="{{ asset('css/tabla.css')}}" />

<style>
  .tabla {
    width: 80%;
    margin-left: 10%;
  }
  th {
    width: 50%;
  }
  h2 {
    font-size: 110%;
    color: #004d93;
  }
</style>

@section('content')

<div class="tarjeta">
<div class="cabezal">
    <h1>Total de postulados registrados anualmente</h1>
    {{-- <form action="{{ route('exportaranio.pdf') }}" method="post">
      @csrf
      <input type="submit" value="Exportar a PDF" class="btn btn-primary boton">
    </form> --}}
</div>
  <div>
    <table id="totales" class="tabla estudiantes">
      <thead class="azul">
        <tr>
          <th>Año</th>
          <th>Estudiantes registrados</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($estudiantesPorAño as $yearData)
        <tr>
          <th>{{ htmlspecialchars($yearData->año) }}</th>
          <th>{{ htmlspecialchars($yearData->total_estudiantes) }}</th>
        </tr>
        @endforeach
      </tbody>
      <tfoot class="azul">
        <th>Año</th>
        <th>Estudiantes registrados</th>
      </tfoot>
    </table>
  </div>

  {{-- contenedor del grafico --}}
  <h2>Grafico comparativo</h2>
  <canvas id="estudinatesPorAnioChart" style="width: 90%; margin-left: 5%;"></canvas>
</div>
<!-- Incluir archivos JS de DataTables y jQuery -->
<script src="{{asset('assets/libs/jQuery-3.7.0/jquery-3.7.0.min.js')}}"></script>
<script src="{{asset('js/datatables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  $(document).ready(function() {
      // Inicializar la tabla con DataTables
      $('#totales').DataTable();

      //creacion de grafica

      const ctx = document.getElementById('estudinatesPorAnioChart').getContext('2d');
      const data = {
          labels: [@foreach ($estudiantesPorAño as $yearData) '{{ $yearData->año }}', @endforeach],
          datasets: [{
              label: 'Estudiantes Registrados',
              data: [@foreach ($estudiantesPorAño as $yearData) '{{ $yearData->total_estudiantes }}', @endforeach],
              backgroundColor: 'rgba(54, 162, 235, 0.5)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1
          }]
      };

      const config = {
          type: 'bar',
          data: data,
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      };

      new Chart(ctx, config);
  });
</script>
@endsection