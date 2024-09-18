@extends('layouts.app')

@section('content')
<style>
    .custom-color {
color: #4B74B8;
}

</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="header">
                <div class="container-fluid">
                    <!-- Body -->
                    <div class="header-body">
                        <div class="row align-items-end">
                            <div class="col">
                                <!-- Title -->
                                <h1 class="custom-color header-title">
                                Nuevo Permiso                             
                               </h1>
                            </div>
                        </div> <!-- / .row -->
                    </div> <!-- / .header-body -->
                </div>
            </div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <livewire:permiso-rol.form />
        </div>
    </div>
</div>
@endsection
