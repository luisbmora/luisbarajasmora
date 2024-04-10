<?php

use App\Models\empleados;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return view('welcome');
})->name('not.found');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'index']);


Route::middleware(
    'auth'
)->group(function () {

    Route::resource('/empleados', App\Http\Controllers\EmpleadosController::class, ['names' => 'empleados']);
    Route::put('/empleados/{empleado}/activarInactivar', function ($empleado) {
        $empleado = empleados::findOrFail($empleado);
        $empleado->activo = !$empleado->activo;
        $empleado->save();

        return redirect()->route('empleados.index')->with('success', 'Empleado ' . ($empleado->activo ? 'activado' : 'inactivado') . ' correctamente.');
    })->name('empleados.activarInactivar');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect(url('/login'));
    });
});
