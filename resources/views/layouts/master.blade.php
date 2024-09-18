<!doctype html>
<html lang="es">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Libs CSS -->
      <link rel="stylesheet" href="{{ asset('assets/fonts/feather/feather.css') }}" />
      <!--
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}">
      -->
      <!-- Map -->
      <link href="https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css" rel="stylesheet" />
      <!-- Theme CSS -->
      <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
      <!-- Title -->
      <title>Inicio</title>

      @livewireStyles
   </head>
   <body>
      <!-- NAVIGATION
         ================================================== -->

      @include('layouts.navbar')
      <!-- MAIN CONTENT
         ================================================== -->
      <div class="main-content">
         {{ $slot ?? '' }}
         @yield('content')
      </div>
      <!-- / .main-content -->
      <!-- JAVASCRIPT
         ================================================== -->
      <!-- Libs JS -->
      @livewireScripts
      <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
      <!-- Map -->
      <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
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
      @yield('js')
      @stack('scripts')
   </body>
</html>