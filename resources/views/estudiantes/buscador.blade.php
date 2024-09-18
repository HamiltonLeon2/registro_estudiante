<!--resources\views\estudiantes\buscador.blade.php-->
@extends('layouts.app')

<link rel="stylesheet" href="{{asset('css/busqueda.css')}}" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

<div class="tarjeta">
    <div class="buscador">
        <h1>Buscar Postulado</h1>

        <form action="{{ route('buscar') }}" method="GET" class="buscador">
            <div class="entrada">
                <input type="text" name="termino" placeholder="Buscar postulado" />
                <button type="submit" class="boton"><img src="{{asset('img/busqueda.png')}}" alt="busqueda" class="lupa" /></button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelector(".buscador").addEventListener("submit", function (e) {
        var termino = document.querySelector('input[name="termino"]').value;
        if (!termino) {
            e.preventDefault();
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Debes ingresar un valor para buscar",
            });
        }
    });
</script>

@endsection
