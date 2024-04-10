@extends('layouts.app')

@section('template_title')
EDITAR EMPLEADO
@endsection

@section('content')
<section class="container">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('empleados.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Editar empleado {{ $empleado->codigo }}</li>
                </ol>
            </nav>
            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">EDITAR EMPLEADO</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('empleados.update', $empleado->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf
                        <input type="hidden" name="id" value="{{ $empleado->id }}">
                        @include('empleados.form')

                    </form>
                </div>
            </div>
        </div>
</section>
@endsection