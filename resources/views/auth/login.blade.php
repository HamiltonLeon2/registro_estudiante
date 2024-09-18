
<!doctype html>
<html lang="es">
  @if(Auth::check())
  <!-- Si el usuario ya está autenticado, redirigirlo a otra página -->
  <script>window.location = "{{ route('estudiantes.search') }}";</script>
@endif
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />

  <!-- Libs CSS -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/feather/feather.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/dist/flatpickr.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/libs/quill/dist/quill.core.css') }}" />
  <link rel="stylesheet" href=".{{ asset('assets/libs/highlightjs/styles/vs2015.css') }}" />
  <!--
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}">
 -->
  <!-- Map -->
  <link href="https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css" rel="stylesheet" />

  <!-- Theme CSS -->
  
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
  
  <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">

  <!--propio-->
<style>
  .img-banner{
    width: 100%;
    height: auto;
  }
</style>


  <!-- Title -->
  <title>Iniciar sesión</title>

</head>
<nav>
<div class="banner">

        <img src="{{ asset('img/cintillo.png') }}" alt="Cintillo institucion" class="img-banner">

  </div>
</nav>

<body class="body">

    <!-- CONTENT ================================================== -->

    <div class="enahp col-12 col-lg-2 col-xl">
        <h1 class="enahptext text-center">Bienvenido a la ENAHP</h1>
    </div>

    <div class="container-fluid">

      <div class="row justify-content-center border-5" style="height: 100vh; background-color: white;">
          <div class="col-12 col-md-5 col-xl-3 my-1 mb-1" style="height: 1vh">

 
            <!-- Heading -->
            <h1 class="display-4 text-center mb-4 my-5">
              Iniciar sesión
            </h1>
            
            <!-- Subheading -->
            <p class="text-muted text-center mb-4">
              
            </p>
            <x-jet-validation-errors class="mb-4" />
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
              @csrf
  
              <!-- Email address -->
              <div class="form-group">
  
                <!-- Label -->
                <label>Usuario</label>
  
                <!-- Input -->
                <input id="name" class="form-control form-control-appended" type="text" name="name" :value="old('name')" required autofocus class="form-control" placeholder="ingrese su usuario">

  
              </div>
  
              <!-- Password -->
              <div class="form-group">
  
                <div class="row">
                  <div class="col">
                        
                    <!-- Label -->
                    <label>Contraseña</label>
  
                  </div>
                  <div class="col-auto">
                  </div>
                </div> <!-- / .row -->
  
                <!-- Input group -->
                <div class="input-group input-group-merge">
  
                  <!-- Input -->
                  <input  class="form-control form-control-appended" placeholder="Ingresa tu contraseña" id="password" type="password" name="password" required autocomplete="current-password">
  
                  <!-- Icon -->
                  <div class="input-group-append">
                    <span class="input-group-text">
                      
                    </span>
                  </div>
  
                </div>
              </div>
  
              <!-- Submit -->
              <x-jet-button class="btn btn-sm  justify-content-center btn-primary mb-3 my-2">
                      {{ __('Ingresar') }}
              </x-jet-button>
              
            </form>
        </div> <!-- / .row -->

    </div> <!-- / .container -->

    <!-- JAVASCRIPT
    ================================================== -->
    <!-- Libs JS -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/@shopify/draggable/lib/es5/draggable.bundle.legacy.js') }}"></script>
    <script src="{{ asset('assets/libs/autosize/dist/autosize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/highlightjs/highlight.pack.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('assets/libs/list.js/dist/list.min.js') }}"></script>
    <script src="{{ asset('assets/libs/quill/dist/quill.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chart.js/Chart.extension.js') }}"></script>

    <!-- Map -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>

    <!-- Theme JS -->
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashkit.min.js') }}"></script>

</body>

</html>
