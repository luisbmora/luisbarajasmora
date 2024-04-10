<?php

namespace App\Http\Controllers;

use App\Models\empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = empleados::all();
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:10|unique:empleados',
            'nombre' => ['required', 'string', 'max:150', 'regex:/^[a-zA-Z\s]+$/'],
            'salarioDolares' => 'required|numeric',
            'salarioPesos' => 'required|numeric',
            'direccion' => ['required', 'string', 'max:150', 'regex:/^[a-zA-Z0-9\s,.#]+$/'],
            'estado' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'ciudad' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'celular' => 'required|digits:10',
            'correo' => 'required|email|max:150',
            'activo' => 'required|boolean',
        ], [
            'codigo.required' => 'El campo código es obligatorio.',
            'codigo.string' => 'El campo código debe ser una cadena de caracteres.',
            'codigo.max' => 'El campo código no puede tener más de :max caracteres.',
            'codigo.unique' => 'El código ingresado ya existe en la base de datos.',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El campo nombre no puede tener más de :max caracteres.',
            'nombre.regex' => 'El campo nombre no puede contener acentos ni la letra ñ.',
            'salarioDolares.required' => 'El campo salario en dólares es obligatorio.',
            'salarioDolares.numeric' => 'El campo salario en dólares debe ser un valor numérico.',
            'salarioPesos.required' => 'El campo salario en pesos es obligatorio.',
            'salarioPesos.numeric' => 'El campo salario en pesos debe ser un valor numérico.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.string' => 'El campo dirección debe ser una cadena de caracteres.',
            'direccion.max' => 'El campo dirección no puede tener más de :max caracteres.',
            'direccion.regex' => 'El campo dirección solo puede contener letras, números, espacios y los caracteres , . #',
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.string' => 'El campo estado debe ser una cadena de caracteres.',
            'estado.max' => 'El campo estado no puede tener más de :max caracteres.',
            'estado.regex' => 'El campo estado no puede contener acentos ni la letra ñ.',
            'ciudad.required' => 'El campo ciudad es obligatorio.',
            'ciudad.string' => 'El campo ciudad debe ser una cadena de caracteres.',
            'ciudad.max' => 'El campo ciudad no puede tener más de :max caracteres.',
            'ciudad.regex' => 'El campo ciudad no puede contener acentos ni la letra ñ.',
            'celular.required' => 'El campo celular es obligatorio.',
            'celular.digits' => 'El campo celular debe tener exactamente :digits dígitos.',
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email' => 'El campo correo debe ser una dirección de correo electrónico válida.',
            'correo.max' => 'El campo correo no puede tener más de :max caracteres.',
            'activo.required' => 'El campo activo es obligatorio.',
            'activo.boolean' => 'El campo activo debe ser verdadero o falso.',
        ]);

        empleados::create($request->all());

        Session::flash('alert-success', 'Empleado creado exitosamente.');

        return redirect()->route('empleados.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(empleados $empleado)
    {
        return view('empleados.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(empleados $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, empleados $empleados)
    {

        $request->validate([
            'codigo' => 'required|string|max:10|unique:empleados,codigo,' . $request->id,
            'nombre' => ['required', 'string', 'max:150', 'regex:/^[a-zA-Z\s]+$/'],
            'salarioDolares' => 'required|numeric',
            'salarioPesos' => 'required|numeric',
            'direccion' => ['required', 'string', 'max:150', 'regex:/^[a-zA-Z0-9\s,.#]+$/'],
            'estado' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'ciudad' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'celular' => 'required|digits:10',
            'correo' => 'required|email|max:150',
            'activo' => 'required|boolean',
        ], [
            'codigo.required' => 'El campo código es obligatorio.',
            'codigo.string' => 'El campo código debe ser una cadena de caracteres.',
            'codigo.max' => 'El campo código no puede tener más de :max caracteres.',
            'codigo.unique' => 'El código ingresado ya existe en la base de datos.',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El campo nombre no puede tener más de :max caracteres.',
            'nombre.regex' => 'El campo nombre solo puede contener letras y espacios.',
            'salarioDolares.required' => 'El campo salario en dólares es obligatorio.',
            'salarioDolares.numeric' => 'El campo salario en dólares debe ser un valor numérico.',
            'salarioPesos.required' => 'El campo salario en pesos es obligatorio.',
            'salarioPesos.numeric' => 'El campo salario en pesos debe ser un valor numérico.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.string' => 'El campo dirección debe ser una cadena de caracteres.',
            'direccion.max' => 'El campo dirección no puede tener más de :max caracteres.',
            'direccion.regex' => 'El campo dirección solo puede contener letras, números, espacios y los caracteres , . #',
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.string' => 'El campo estado debe ser una cadena de caracteres.',
            'estado.max' => 'El campo estado no puede tener más de :max caracteres.',
            'estado.regex' => 'El campo estado solo puede contener letras y espacios.',
            'ciudad.required' => 'El campo ciudad es obligatorio.',
            'ciudad.string' => 'El campo ciudad debe ser una cadena de caracteres.',
            'ciudad.max' => 'El campo ciudad no puede tener más de :max caracteres.',
            'ciudad.regex' => 'El campo ciudad solo puede contener letras y espacios.',
            'celular.required' => 'El campo celular es obligatorio.',
            'celular.digits' => 'El campo celular debe tener exactamente :digits dígitos.',
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email' => 'El campo correo debe ser una dirección de correo electrónico válida.',
            'correo.max' => 'El campo correo no puede tener más de :max caracteres.',
            'activo.required' => 'El campo activo es obligatorio.',
            'activo.boolean' => 'El campo activo debe ser verdadero o falso.',
        ]);

        $empleado = empleados::find($request->id);
        if ($empleado) {
            $empleado->update($request->all());
            // Resto del código
        } else {
            Session::flash('alert-danger', 'Empleado no encontrado.');
            return redirect()->back()->withInput();
        }

        Session::flash('alert-success', 'Empleado actualizado exitosamente.');

        return redirect()->route('empleados.index');
    }


    public function destroy(Empleados $empleado)
    {
        // Verificar si el empleado existe
        if ($empleado) {
            // Realizar el borrado lógico
            $empleado->delete();

            // Redireccionar con un mensaje de éxito
            return redirect()->route('empleados.index')
                ->with('success', 'Empleado eliminado exitosamente');
        } else {
            // Si el empleado no existe, redireccionar con un mensaje de error
            return redirect()->route('empleados.index')
                ->with('error', 'Empleado no encontrado');
        }
    }
}
