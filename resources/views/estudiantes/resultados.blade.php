<!-- resources/views/estudiantes/resultados.blade.php -->
<!--resources\views\estudiantes\buscador.blade.php-->
@extends('layouts.app')

<link rel="stylesheet" href="{{asset('css/resultados.css')}}" />

@section('content')

<div class="carta">
  <div class="cabezal">
    <h1>Resultados</h1>

    <div class="busqueda">
      <form action="{{ route('buscar') }}" method="GET" class="buscador">
        <div class="entrada">
          <input type="text" name="termino" placeholder="Buscar postulado" />
          <button type="submit" class="boton"><img src="{{asset('img/busqueda.png')}}" alt="busqueda" class="lupa" /></button>
        </div>
      </form>
    </div>
  </div>

  <div class="tarjeta">
    <div class="resultado">
      @if ($resultados->count() > 0) @foreach ($resultados as $resultado)

      <h5><a href="{{ route('perfil.show', $resultado->id) }}" style="color: #19407b;">{{ $resultado->nombre }} {{ $resultado->apellido }}</a></h5>
      <p>Cedula:{{ $resultado->cedula }}</p>
      <p>correo:{{ $resultado->mail }}</p>
      <p>n principal:{{ $resultado->num1 }}</p>

      @endforeach @else @if (empty($resultado))

      <h5>No se han encontrado coincidencias</h5>
      <br />
      <p>¿Desea registrar a un postulado? <a href="{{ route('estudiantes.create') }}" class="click-aqui">click aquí</a></p>

      @else @endif @endif
    </div>
  </div>
</div>

@endsection
