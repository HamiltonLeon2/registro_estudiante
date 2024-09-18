@extends('layouts.app')

@section('content')

<style>
    .custom-color {
        color: #4B74B8;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11 col-xl-10">
            <div class="header">
                <div class="container-fluid">
                    <!-- Body -->
                    <div class="header-body">
                        <div class="row align-items-end">
                            <div class="col-lg-9">
                                <!-- Title -->
                                <h1 class="custom-color header-title">Módulos registrados</h1>
                            </div>
                            <div class="col-lg-3 text-lg-right">
                                <a href="{{ route('modulos.nuevo') }}" class="btn btn-primary lift">
                                    <i class="fe fe-plus"></i> Registrar módulo
                                </a>
                            </div>
                        </div> <!-- / .row -->
                    </div> <!-- / .header-body -->
                </div>
            </div>

            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        @if ($modulos->count() > 0)
                        <div class="card">
                            <div class="table-responsive mb-0">
                                <table class="table table-sm table-nowrap card-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Modelo</th>
                                            <th class="text-right">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($modulos as $modulo)
                                        <tr>
                                            <td>{{ $modulo->id }}</td>
                                            <td>{{ $modulo->nombre }}</td>
                                            <td>{{ $modulo->modelo }}</td>
                                            <td class="text-right">
                                                <a href="{{ route('modulos.editar', $modulo->id) }}" class="mr-2">
                                                    <i class="fe fe-edit-3"></i>
                                                </a>
                                                <a wire:click="confirmDelete('{{ base64_encode($modulo->id) }}')"
                                                    class="mr-2" style="cursor:pointer">
                                                    <i class="fe fe-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @else
                        <p class="text-muted text-center mt-5">
                            <i class="fe fe-info"></i> No hay módulos registrados. Comienza registrando uno para
                            administrar los permisos.
                        </p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {{-- {{ $roles->links() }} --}}
                    </div>
                </div>

            </div>
        </div> <!-- / .row -->
    </div>
</div>
@endsection
