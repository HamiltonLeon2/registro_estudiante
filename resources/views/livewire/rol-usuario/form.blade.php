<div class="container-fluid">
    <form class="mb-4 needs-validation" wire:submit.prevent="{{ $formMode == 'create' ? 'createRole' : 'updateRole' }}">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6">
                <!-- Label -->
                <label class="mb-1">Nombre del rol</label>
                <small class="form-text text-muted">Este nombre será utilizado para asociar nuevos usuarios</small>
            </div>
            <div class="col-12 col-md-8 col-lg-6">
                <div class="form-group">
                    <!-- Input -->
                    <label>Nombre rol</label>
                    <input type="text" wire:model="name" class="form-control mb-3 @error('name')is-invalid @enderror" placeholder="">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div> <!-- / .row -->

        <div class="row mt-3">
            <div class="col-sm-12 mb-5">
                <label class="mb-1">Asocia los permisos</label>
                <small class="form-text text-muted">
                    Vincula los permisos de cada módulo que quieres asociar a este rol de usuario.
                </small>
            </div>
            @foreach ($modules as $module)
                <div class="col-sm-12 col-md-8 col-lg-6 pl-5">
                    <div class="form-group">
                        <p class="mb-3">{{ $loop->iteration . '. ' . $module->nombre }}</p>
                        @if ($module->permisos->count() > 0)
                            @foreach ($module->permisos as $permiso)
                                <div class="row mb-2">
                                    <div class="col-auto">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="permiso-id-{{ $permiso->permiso->id }}" wire:change="handlePermission({{ $permiso->permiso }})" @if(in_array($permiso->permiso->toArray(), $permissions)) checked @endif>
                                            <label class="custom-control-label" for="permiso-id-{{ $permiso->permiso->id }}">{{ $permiso->permiso->name }}</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col-auto">
                                    <small class="text-muted">Este módulo no tiene permisos asociados</small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Divider -->
        <hr class="mt-5 mb-5">

        <!-- Buttons -->
        <button type="submit" class="btn btn-block btn-primary">
            {{ $formMode == 'create' ? 'Guardar' : 'Actualizar' }} rol
        </button>
        <a href="{{ route('roles.index') }}" class="btn btn-block btn-link text-muted">
            Cancelar
        </a>
    </form>
</div>
