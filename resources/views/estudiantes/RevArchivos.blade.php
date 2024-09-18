@foreach ($archivosPorEstudiante as $estudianteId => $archivosEstudiante)

<?php $estudiante = App\Models\Estudiante::find($estudianteId); ?>
<h2>Postulado: {{ $estudiante->nombre }} - Cédula: {{ $estudiante->cedula }}</h2>

<h3>Archivos Cargados:</h3>
<ul>
  @foreach ($archivosEstudiante as $archivo)
  <li>{{ $archivo }}</li>
  @endforeach
</ul>

<h3>Archivos Faltantes:</h3>
<ul>
  @foreach ($archivosRequeridos as $archivoRequerido) @if (!in_array($archivoRequerido, $archivosEstudiante))
  <li>{{ $archivoRequerido }}</li>
  @endif @endforeach
</ul>
@endforeach
