@extends('layouts.app')

@section('content')
<div class="container-fluid display-flex">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11 col-xl-10">
            <div class="header">
                <div class="container-fluid">
                    <!-- Body -->
                    <div class="header-body">
                        <div class="row align-items-end">
                            <div class="col-lg-9">
                                <!-- Title -->
                                <h1 class="custom-color header-title">Todos los permisos</h1>
                            </div>
                            <div class="col-lg-3 text-lg-right">
                                <a href="{{ route('permisos.nuevo') }}" class="btn btn-primary lift">
                                    <i class="fe fe-plus"></i> Nuevo permiso
                                </a>
                            </div>
                        </div> <!-- / .row -->
                    </div> <!-- / .header-body -->
                </div>
            </div>

            <div class="container-fluid">

                @if ($permissions->count() > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- / .row -->
                            </div>
                            <div class="table-responsive mb-0">
                                <table class="table table-sm table-nowrap card-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Permiso</th>
                                            <th>Módulo</th>
                                            <th class="text-right">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($permissions as $relation)
                                        <tr>
                                            <td>{{ $relation->permiso->id }}</td>
                                            <td>{{ $relation->permiso->name }}</td>
                                            <td>{{ $relation->modulo->nombre }}</td>
                                            <td class="text-right">
                                                <button wire:click="confirmDelete('{{ base64_encode($relation->id) }}')" class="dropdown-item">
                                                    <i class="fe fe-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        {{-- {{ $roles->links() }} --}}
                    </div>
                </div>
                @else
                <p class="text-muted text-center mt-5">
                    <i class="fe fe-info"></i> No se han creado permisos. Crea uno nuevo para comenzar a utilizar esta función.
                </p>
                @endif
            </div> <!-- / .container-fluid -->
        </div> <!-- / .col-12 col-lg-11 col-xl-10 -->
    </div> <!-- / .row justify-content-center -->
</div> <!-- / .container-fluid -->
@endsection
