@extends('layouts.app')

@section('template_title')
CREAR UBICACIÓN
@endsection

@section('content')
<section class="container">
    <div class="row">
        <div class="col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('empleados.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Crear empleado</li>
                </ol>
            </nav>
            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">CREAR EMPLEADO</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('empleados.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        @include('empleados.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection