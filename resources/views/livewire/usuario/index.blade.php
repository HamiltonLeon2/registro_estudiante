<div>
    <div class="header">
        <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
       <div class="container-fluid mt-6">
          <!-- Body -->
          <div class="header-body">
             <div class="row align-items-end">
                <div class="col">
                   <!-- Title -->
                   <h1 class="header-title">
                      Todos los usuarios
                   </h1>
                </div>
                <div class="col-auto">
                   @if(\Auth::user()->can('crear usuarios'))
                   <a href="{{ route('usuarios.nuevo') }}" class="btn btn-primary lift"><i class="fe fe-plus"></i> Crear usuario</a>
                   @endif
                </div>
             </div>
             <!-- / .row -->
          </div>
          <!-- / .header-body -->
       </div>
    </div>
    <div class="container-fluid">
       <div class="row">
          <div class="col-12">
             <!-- Goals -->
             <div class="card">
                <div class="card-header">
                   <div class="row align-items-center">
                      <div class="col">
                         <!-- Form -->
                         <form>
                            <div class="input-group input-group-flush">
                               <div class="input-group-prepend">
                                  <span class="input-group-text">
                                  <i class="fe fe-search"></i>
                                  </span>
                               </div>
                               <input class="list-search form-control" type="search" placeholder="Buscar" wire:model="search">
                            </div>
                         </form>
                      </div>
                      <div class="col-auto mr-n3">
                         <!-- Select -->
                         <form>
                            <select
                               class="custom-select custom-select-sm form-control-flush"
                               tabindex="-1" wire:model="resultsPerPage">
                               <option value="10">10 por página</option>
                               <option value="20">20 por página</option>
                               <option value="40">40 por página</option>
                            </select>
                         </form>
                      </div>
                   </div>
                   <!-- / .row -->
                </div>
                <div class="table-responsive mb-0"
                   data-list="{&quot;valueNames&quot;: [&quot;goal-project&quot;, &quot;goal-status&quot;, &quot;goal-progress&quot;, &quot;goal-date&quot;]}">
                   <table class="table table-sm table-nowrap card-table">
                      <thead>
                         <tr>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th class="text-right">Acción</th>
                            <th></th>
                         </tr>
                      </thead>
                      <tbody class="list">
                         @foreach ($usuarios as $usuario)
                         <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>
                               <span class="badge badge-pill badge-primary text-uppercase">{{ $usuario->getRoleNames()->first() }}</span>
                            </td>
                            <td class="text-right">
                               @if(\Auth::user()->can('editar usuarios'))
                                   <a href="{{ route('usuarios.editar', $usuario->id) }}" class="mr-2">
                                       <i class="fe fe-edit-3 fs-5"></i>
                                   </a>
                               @endif
                               @if(\Auth::user()->can('eliminar usuarios'))
                                   @if(\Auth::user()->id != $usuario->id)
                                       @if(\Auth::user()->id == 1)
                                           <a wire:click="confirmDelete('{{ base64_encode($usuario->id) }}')" class="mr-2" style="cursor:pointer">
                                               <i class="fe fe-trash fs-5"></i>
                                           </a>
                                       @endif
                                   @endif
                               @endif
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
             {{ $usuarios->links() }}
          </div>
       </div>
    </div>
 </div>