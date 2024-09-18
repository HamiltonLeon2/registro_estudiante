<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light d-none d-sm-none d-md-block" id="sidebar">
    <div class="container-fluid">
       <!-- Toggler -->
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
       </button>
       <!-- Brand -->
       <a class="navbar-brand" href="{{ url('/dashboard') }}">
       <!-- User (xs) -->
       <div class="navbar-user d-md-none">
          <!-- Dropdown -->
             <!-- Toggle -->
             <a id="sidebarIconCopy">
                <div class="avatar avatar-sm btn btn-outline-dark rounded-circle d-flex align-items-center justify-content-center">
                   <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                         this.closest('form').submit();"><i class="fe fe-log-out avatar-img"></i></a>
                   </form>
                </div>
            </a>
       </div>
       <!-- Collapse -->
       <div class="collapse navbar-collapse" id="sidebarCollapse">
          <!-- Navigation -->
          <ul class="navbar-nav">
             <li class="nav-item">
                <a class="nav-link  {{ (request()->routeIs('dashboard')) ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                   <i class="fe fe-home"></i> Inicio
                </a>
             </li>
             @if(\Auth::user()->can('ver usuarios'))
             <li class="nav-item">
                <a a href="{{ route('usuarios.index') }}" class="nav-link {{ (request()->routeIs('usuarios.*')) ? 'active' : '' }}">
                   <i class="fe fe-users"></i> Usuarios
                </a>
             </li>
             @endif
             @if(\Auth::user()->can('ver roles'))
             <li class="nav-item">
                <a a href="{{ route('roles.index') }}" class="nav-link {{ (request()->routeIs('roles.index')) ? 'active' : '' }}">
                   <i class="fe fe-book"></i> Roles y privilegios
                </a>
             </li>
             @endif
          
            @if (\Auth::user()->can('ver modulos'))
            <li class="nav-item">
               <a a href="{{ route('modulos.index') }}" class="nav-link {{ (request()->routeIs('modulos.index')) ? 'active' : '' }}">
                  <i class="fe fe-book"></i> Módulo
               </a>
            </li>
            @endif
            @if (\Auth::user()->can('ver permisos'))
             <li class="nav-item">
                <a href="{{ route('permisos.index') }}" class="nav-link {{ (request()->routeIs('permisos.nuevo')) ? 'active' : '' }}">
                   <i class="fe fe-book"></i> Permisos
                </a>
             </li>
           @endif
          </ul>
          <!-- Divider -->
          <hr class="navbar-divider my-3">
          <div class="mt-auto"></div>
          <!-- User (md) -->
          <div class="navbar-user d-none d-md-flex" id="sidebarUser">
             <!-- Dropup -->
             <div class="dropup">
                <a id="sidebarIconCopy">
                   <div class="avatar avatar-sm btn btn-outline-dark rounded-circle d-flex align-items-center justify-content-center">
                      <form method="POST" action="{{ route('logout') }}">
                         @csrf
                         <a href="{{ route('logout') }}" class="dropdown-item" title="Cerrar Sesión" onclick="event.preventDefault();
                            this.closest('form').submit();"><i class="fe fe-log-out avatar-img"></i></a>
                      </form>
                   </div>
               </a>
             </div>
         </div>
         
       </div>
       <!-- / .navbar-collapse -->
    </div>
 </nav>
 {{-- Nav Bar mobile --}}
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light d-block d-sm-block d-md-none">
    @livewire('navbar.nav-bar-mobile')
</nav>