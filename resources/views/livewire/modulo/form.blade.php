<div class="container-fluid">
    <form class="mb-4 needs-validation" wire:submit.prevent="{{ $formMode == 'create' ? 'createModule' : 'updateModule' }}">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6">
                <!-- Start date -->
                <div class="form-group">
                    <!-- Label -->
                    <label>
                        Nombre
                    </label>
                    <!-- Input -->
                    <input type="text" wire:model="nombre" class="form-control mb-3 @error('nombre')is-invalid @enderror" placeholder="Ej: Usuarios">

                    @error('nombre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-6">
                <div class="form-group">
                    <!-- Label -->
                    <label>
                        Modelo Laravel
                    </label>
                    <!-- Input -->
                    <input type="text" wire:model="modelo" class="form-control mb-3 @error('modelo')is-invalid @enderror" placeholder="Ej: App\Models\Base\User">

                    @error('modelo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Divider -->
        <hr class="mt-5 mb-5">

        <!-- Buttons -->
        <button type="submit" class="btn btn-block btn-primary">
            {{ $formMode == 'create' ? 'Registrar' : 'Actualizar' }} modulo
        </button>
        <a href="{{ route('modulos.index') }}" class="btn btn-block btn-link text-muted">
            Cancelar
        </a>
    </form>
</div>
