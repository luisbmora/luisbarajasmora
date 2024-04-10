@extends('layouts.app')

@section('template_title')
DETALLES DEL EMPLEADO
@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('content')
<section class="container">

    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('empleados.index') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Empleado {{ $empleado->codigo }}</li>
            </ol>
        </nav>

        <div class="card card-default">
            <div class="card-header">
                <span class="card-title">DETALLES DEL EMPLEADO</span>
            </div>
            <div class="card-body">
                <div class="form-group row g-3">
                    <div class="col-md-6">
                        <label for="codigo" class="form-label">Código</label>
                        <input type="text" id="codigo" name="codigo" value="{{ $empleado->codigo }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="{{ $empleado->nombre }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="salarioDolares" class="form-label">Salario en dólares</label>
                        <input type="text" id="salarioDolares" name="salarioDolares" value="{{ $empleado->salarioDolares }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="salarioPesos" class="form-label">Salario en pesos</label>
                        <input type="text" id="salarioPesos" name="salarioPesos" value="{{ $empleado->salarioPesos }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" id="direccion" name="direccion" value="{{ $empleado->direccion }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" id="estado" name="estado" value="{{ $empleado->estado }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="ciudad" class="form-label">Ciudad</label>
                        <input type="text" id="ciudad" name="ciudad" value="{{ $empleado->ciudad }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" id="celular" name="celular" value="{{ $empleado->celular }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="text" id="correo" name="correo" value="{{ $empleado->correo }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="activo" class="form-label">Activo</label>
                        <input type="text" id="activo" name="activo" value="{{ $empleado->activo ? 'Sí' : 'No' }}" class="form-control" readonly>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <h2 class="text-center">Proyección salarial a 6 meses</h2>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Salarios en Dólares</b></div>
                            <div class="panel-body">
                                <!-- Grafica de salarios en dólares -->
                                <canvas id="canvasDolares" height="200" width="400"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Salarios en Pesos</b></div>
                            <div class="panel-body">
                                <!-- Grafica de salarios en pesos -->
                                <canvas id="canvasPesos" height="200" width="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="empleadoData" data-salario-dolares="{{ $empleado->salarioDolares ?? 0 }}" data-salario-pesos="{{ $empleado->salarioPesos ?? 0 }}">
    </div>

</section>
@endsection


<script type="module">
    // Calcular proyección salarial en dólares
    var empleadoData = document.getElementById("empleadoData");
    var salarioDolaresInicial = parseFloat(empleadoData.getAttribute("data-salario-dolares"));
    var salarioPesosInicial = parseFloat(empleadoData.getAttribute("data-salario-pesos"));
    var incrementoMensual = 0.02;
    var meses = [];
    var salarioDolares = [];
    var salarioPesos = [];

    for (var i = 0; i < 6; i++) {
        // Calcular incremento salarial
        var incremento = salarioDolaresInicial * incrementoMensual;
        salarioDolaresInicial += incremento;
        salarioPesosInicial *= (1 + incrementoMensual);

        // Agregar valores al arreglo
        meses.push('Mes ' + (i + 1));
        salarioDolares.push((salarioDolaresInicial).toFixed(2));
        salarioPesos.push((salarioPesosInicial).toFixed(2));

        // Incrementar porcentaje de incremento mensual
        incrementoMensual += 0.02;
    }

    // Graficar la información en dólares
    var ctxDolares = document.getElementById("canvasDolares").getContext('2d');
    var chartDolares = new Chart(ctxDolares, {
        type: 'bar',
        data: {
            labels: meses,
            datasets: [{
                label: 'Salario en dólares',
                data: salarioDolares,
                borderColor: 'blue',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Graficar la información en pesos
    var ctxPesos = document.getElementById("canvasPesos").getContext('2d');
    var chartPesos = new Chart(ctxPesos, {
        type: 'bar',
        data: {
            labels: meses,
            datasets: [{
                label: 'Salario en pesos',
                data: salarioPesos,
                borderColor: 'red',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>