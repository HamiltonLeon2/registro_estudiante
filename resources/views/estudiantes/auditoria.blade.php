@extends('layouts.app')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="{{ asset('css/datatable.css') }}" />

@section('content')
<div class="tarjeta AU">
    <h1>Historial General de Estudiantes con Cambios Desglosados</h1>
    <div>
        <table id="cambios" class="table auditoria">
            <thead>
                <tr>
                    <th class="c-i">ID</th>
                    <th>Estudiante</th>
                    <th>Usuario que realizó el cambio</th>
                    <th>Cambios realizados</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historialAgrupado as $estudiante) @foreach($estudiante['historial'] as $historia)
                <tr>
                    <td class="c-i">{{ $estudiante['id'] }}</td>
                    <td>{{ $estudiante['nombre'] }}</td>
                    <td>{{ $historia['usuario'] }}</td>
                    <td>
                        @foreach($historia['cambios'] as $cambios) {{ $cambios }}<br />
                        @endforeach
                    </td>
                    <td>{{ $historia['fecha'] }}</td>
                </tr>
                @endforeach @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#cambios").DataTable();
        });
    </script>
    @endsection
</div>
