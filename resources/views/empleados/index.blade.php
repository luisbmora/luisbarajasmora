@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-between align-items-center mb-4">
    <h1>Lista de Empleados</h1>

  </div>
  <div class="text-end mb-2">
    <a href="{{ route('empleados.create') }}" class="btn btn-primary btn-sm">Crear Empleado</a>
  </div>


  @if (Session::has('alert-success'))
  <div class="alert alert-success">
    {{ Session::get('alert-success') }}
  </div>
  @endif
  @if (count($empleados) > 0)
  <table class="table align-middle mb-0 bg-white table-responsive">
    <thead class="bg-light table-dark">
      <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Salario en dolares</th>
        <th>Salario en pesos</th>
        <th>Correo</th>
        <th>Activo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($empleados as $empleado)
      <tr>
        <td>{{ $empleado->codigo }}</td>
        <td>{{ $empleado->nombre }}</td>
        <td>{{ number_format($empleado->salarioDolares, 2, '.', ',') }} USD</td>
        <td>{{ number_format($empleado->salarioPesos, 2, '.', ',') }} MXN</td>

        <td>{{ $empleado->correo }}</td>
        <td>
          @if ($empleado->activo)
          <span class="badge bg-success">Si</span>
          @else
          <span class="badge bg-danger">No</span>
          @endif
        </td>
        <td>
          <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-primary btn-sm">Editar</a>
          <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-info btn-sm">Detalles</a>
          <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este empleado?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
          </form>
          @if($empleado->activo)
          <form action="{{ route('empleados.activarInactivar', $empleado->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-warning btn-sm">
              Inactivar
            </button>
          </form>
          @else
          <form action="{{ route('empleados.activarInactivar', $empleado->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success btn-sm">
              Activar
            </button>
          </form>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  @else
  <p>No hay empleados para mostrar.</p>
  @endif
</div>
@endsection