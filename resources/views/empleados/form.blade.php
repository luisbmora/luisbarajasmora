<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
<script>
    $(function() {
        // Obtener el valor inicial del dato y la fecha desde la API
        var dato;
        var fecha;

        $.ajax({
            url: 'https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43785/datos/oportuno?token=aa1d9238d2571ac43287ed09a73465963513198768a671ac4308953b3833fdba',
            jsonp: 'callback',
            dataType: 'jsonp',
            success: function(response) {
                // Obtener el dato y la fecha de la respuesta
                dato = response.bmx.series[0].datos[0].dato;
                fecha = response.bmx.series[0].datos[0].fecha;


                // Mostrar el mensaje con la fecha
                mostrarMensaje(fecha, dato);

                // Manejar cambios en salarioDolares
                $('#salarioDolares').on('input', function() {
                    var salarioDolares = parseFloat($(this).val());
                    var salarioPesos = salarioDolares * dato;
                    $('#salarioPesos').val(salarioPesos.toFixed(2));
                    mostrarMensajeFecha(fecha);
                });

                // Manejar cambios en salarioPesos
                $('#salarioPesos').on('input', function() {
                    var salarioPesos = parseFloat($(this).val());
                    var salarioDolares = salarioPesos / dato;
                    $('#salarioDolares').val(salarioDolares.toFixed(2));
                    mostrarMensajeFecha(fecha);
                });
            }
        });

        // Función para mostrar un mensaje con la fecha y el dato
        function mostrarMensaje(fecha, dato) {
            var mensaje = 'El cambio de moneda fue actualizado el ' + fecha + ' y es de ' + dato + ' MXN por cada USD, obtenido desde Banxico (Banco de México) actualizado cada 48 horas como máximo.';
            $('.mensaje-fecha').text(mensaje);
            $('.alert').fadeIn(); // Mostrar alert durante 3 segundos
        }
    });
</script>



<div class="box box-info padding-1">
    <div class="box-body row g-3">
        <div class="alert alert-info" style="display: none;">
            <span class="mensaje-fecha"></span>
        </div>
        <div class="form-group  row g-3">
            <div class="col-md-6">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" id="codigo" name="codigo" value="{{ old('codigo',$empleado->codigo ?? '') }}" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" >
            </div>
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $empleado->nombre ?? '') }}" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" >
            </div>
            <div class="col-md-3">
                <label for="salarioDolares" class="form-label">Salario en dolares</label>
                <div class="input-group">
                    <input type="text" id="salarioDolares" name="salarioDolares" value="{{ old('salarioDolares',$empleado->salarioDolares ?? '') }}" class="form-control{{ $errors->has('salarioDolares') ? ' is-invalid' : '' }}"  oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                    <div class="input-group-text">USD</div>

                </div>
            </div>

            <div class="col-md-3">
                <label for="salarioPesos" class="form-label">Salarioen pesos</label>
                <div class="input-group">
                    <input type="text" id="salarioPesos" name="salarioPesos" value="{{ old('salarioPesos',$empleado->salarioPesos ?? '') }}" class="form-control{{ $errors->has('salarioPesos') ? ' is-invalid' : '' }}"  oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                    <div class="input-group-text">MXN</div>

                </div>
            </div>

            <div class="col-md-6">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion',$empleado->direccion ?? '') }}" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" >
            </div>
            <div class="col-md-4">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" id="estado" name="estado" value="{{ old('estado',$empleado->estado ?? '') }}" class="form-control{{ $errors->has('estado') ? ' is-invalid' : '' }}" >
            </div>
            <div class="col-md-4">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad',$empleado->ciudad ?? '') }}" class="form-control{{ $errors->has('ciudad') ? ' is-invalid' : '' }}" >
            </div>
            <div class="col-md-4">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" id="celular" name="celular" value="{{ old('celular',$empleado->celular ?? '') }}" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}"  oninput="this.value = this.value.replace(/\D/g,'').slice(0, 10);">
            </div>
            <div class="col-md-6">
                <label for="correo" class="form-label">Correo</label>
                <input type="text" id="correo" name="correo" value="{{ old('correo',$empleado->correo ?? '') }}" class="form-control{{ $errors->has('correo') ? ' is-invalid' : '' }}" >
            </div>
            <div class="col-md-6">
                <label for="activo" class="form-label">Activo</label>
                <select id="activo" name="activo" class="form-control{{ $errors->has('activo') ? ' is-invalid' : '' }}">
                    <option value="1" {{ old('activo', $empleado->activo ?? '') == '1' ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ old('activo', $empleado->activo ?? '') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>

        </div>


        <div class="box-footer mt20 col-12">
            <button type="submit" class="btn btn-primary">Aceptar</button>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger col-12 mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>