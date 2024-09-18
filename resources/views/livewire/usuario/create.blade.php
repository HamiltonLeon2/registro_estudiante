<style>
    .custom-color {
        color: #4B74B8;
    }
</style>
<div class="container-fluid mt-6">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="header">
                <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
                <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
                <div class="container-fluid">
                    <!-- Body -->
                    <div class="header-body">
                        <div class="row align-items-end">
                            <div class="col">
                                <!-- Title -->
                                <h1 class="custom-color header-title">
                                    Añadir nuevo usuario
                                </h1>
                            </div>
                            <div class="col-auto">
                                <!-- Button 
                                <a href="anadir-producto.html" class="btn btn-primary lift">
                                    Añadir nuevo
                                </a>-->
                            </div>
                        </div> <!-- / .row -->
                    </div> <!-- / .header-body -->
                </div>
            </div>
            <livewire:usuario.form />
        </div>
    </div> <!-- / .row -->
</div>
