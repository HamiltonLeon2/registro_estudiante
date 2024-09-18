<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
        display: flex ;
    }
    h1{
        text-align: center;
    }
    .centro{
        text-align: center;
    }
    .azul{
    background: #04478c;
    color: white;
    }
    table{
        outline: 2px solid #d8d7d7;
        background: #f0ecec;
        width: 100%
    }
    th td{
        outline: 2px solid #d8d7d7;
        background: #f0ecec;
    }
    img{
        width: 100%;
        height: auto;
    }

</style>
<img src="../resources/views/exports/cintillo.jpg" class="img-banner">
<p>Caracas, {{$fecha}} </p>
<h1>Total de postulados registrados por entes</h1>

<table>
    <thead class="azul">
        <tr>
            <th class="azul centro">id</th>
            <th>Ente</th>
            <th>Postulados registrados</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($selectedEntes as $ente)
        <tr>
            <td class="azul centro">{{ $ente->id}}</td>
            <td>{{ $ente->ente }}</td>
            <td class="centro">{{ $ente->postulantes_count }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot class="azul">
        <th class="azul centro">id</th>
        <th>Ente</th>
        <th>Postulados registrados</th>
    </tfoot>
</table>

<h2>Observaciones:</h2>
<p>{{ $observaciones }}</p>



