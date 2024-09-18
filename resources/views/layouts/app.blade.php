  <!-- resources/views/layouts/app.blade.php -->
  
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{{ asset('assets/libs/Bootstrap4/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/global.css') }}" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="{{ asset('js/submenu.js') }}" defer></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @stack('scripts')
        <link rel="stylesheet" href="{{ asset('assets/fonts/feather/feather.css') }}" />

        @livewireStyles
    </head>
    <body>
        {{-- <header>
            <div class="banner">
                <img src="{{ asset('img/cintillo.png')}}" class="img-banner" alt="Cintillo institucional" />
            </div>
        </header> --}}
        <section>
            <div class="menu" id="menu">
                <div class="menu-trigger" id="menuTrigger"></div>
                <div class="user">
                    <img src="{{ asset('img/iconousuario.png') }}" alt="" class="iconU" />
                    <a href="{{ route('usuarios.editar', auth()->user()->id) }}" class="mr-2"><p class="userT">{{ auth()->user()->name}}</p></a>
                </div>
                <div class="info">
                    @auth
                    <p>
                        Última conexión: <br />
                        {{ auth()->user()->previous_login_at ? auth()->user()->previous_login_at : "Es primera vez que ingresa al sistema!" }}
                    </p>
                    @endauth
                </div>
                <ul class="lista menu-options">
                    <a href="{{ route('estudiantes.search') }}">
                        <div class="options"><li>Inicio</li></div>
                    </a>
                    <div class="options" id="postulados"><li>Postulados</li></div>
                    <ul class="ocu">
                        <a href="{{ route('estudiantes.create') }}">
                            <div class="options secu"><li>Registrar</li></div>
                        </a>
                        <a href="{{ route('datatable.show') }}">
                            <div class="options secu"><li>Registrados hoy</li></div>
                        </a>
                        <a href="{{ route('estudiantes.todos') }}">
                            <div class="options secu"><li>Todos los postulados</li></div>
                        </a>
                    </ul>
                    <div class="options" id="postulantes"><li>Postulantes</li></div>
                    <ul class="ocu">
                        <a href="{{ route('postulantes.crear') }}">
                            <div class="options secu"><li>Registrar ente</li></div>
                        </a>
                        <a href="{{ route('entes.view') }}">
                            <div class="options secu"><li>Visualizar entes</li></div>
                        </a>
                    </ul>
                    @if(\Auth::user()->hasRole('administrador'))
                    <a href="{{ route('usuarios.index') }}">
                        <div class="options"><li>Usuarios</li></div>
                    </a>
                    @endif

                    <div class="options" id="reportes"><li>Reportes</li></div>
                    <ul class="ocu">
                        <a href="{{ route('totales.show') }}">
                            <div class="options secu"><li>Totales por entes</li></div>
                        </a>
                        <a href="{{ route('totalesYear.show') }}">
                            <div class="options secu"><li>Totales por años</li></div>
                        </a>
                        <a href="{{ route('totalestipp.show') }}">
                            <div class="options secu"><li>Totales por postulacion</li></div>
                        </a>
                    </ul>
                    @if(\Auth::user()->hasRole('administrador'))
                    <a href="{{ route('auditoria') }}">
                        <div class="options"><li>Revisión</li></div>
                    </a>
                    @endif
                    <div class="">
                        <form method="POST" action="{{ route('logout') }}" class="options">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <li>Salir</li>
                            </a>
                        </form>
                    </div>
                </ul>
            </div>
        </section>
        <section>
            <div class="content">
                {{$slot ?? '' }} @yield('content')
            </div>
        </section>
        <footer class="piepagina">
            <center>
                <p>Sistema de registro de estudiantes version inicial</p>
            </center>
        </footer>

        <!-- JAVASCRIPT
         ================================================== -->
        <!-- Libs JS -->
        @livewireScripts
        <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Map -->
        <script src="https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- Theme JS -->
        <script src="{{ asset('assets/js/theme.min.js') }}"></script>
        <script src="{{ asset('assets/js/dashkit.min.js') }}"></script>
        <script>
            const Toast = Swal.mixin({
               toast: true,
               position: 'top-end',
               showConfirmButton: false,
               timer: 3000,
               timerProgressBar: true,
               didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
               }
            });
            // Disparados cuando se utiliza el $this->emit('toast')
            Livewire.on('toast', data => {
               Toast.fire({
                  icon: data[0],
                  title: data[1]
               })
            });
            Livewire.on('toast_aux', data => {
               Toast.fire({
                  icon: data[0],
                  title: data[1]
               })
               setTimeout(function() {
                       location.href = data[2];
                   }, 3000);
            });
            // Disparado por el evento de una sesión (redirect desde otra pÃ¡gina a esta)
            @if(session()->has('toast'))
               Toast.fire({
               icon: "{{ session('toast')[0] }}",
               title: "{{ session('toast')[1] }}"
            })
            @endif

            // Modal para confirmar acción de eliminar registro
            Livewire.on('confirmDelete', () => {
               Swal.fire({
                  title: 'Confirmar acción',
                  text: "Eliminarás este registro",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#c2c2c2',
                  confirmButtonText: 'Eliminar',
                  cancelButtonText: 'Cancelar'
               }).then((result) => {
                  if (result.isConfirmed) {
                     window.livewire.emit('deleteConfirmed');
                  }
               })
            });
        </script>
        @yield('js') @stack('scripts')
    </body>
</html>
