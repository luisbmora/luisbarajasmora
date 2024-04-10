<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class empleados extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    static $rules = [
        'codigo' => 'required',
        'nombre' => 'required',
        'salarioDolares' => 'required',
        'salarioPesos' => 'required',
        'direccion' => 'required',
        'estado' => 'required',
        'ciudad' => 'required',
        'celular' => 'required',
        'correo' => 'required',
        'activo' => 'required',
    ];

    protected $perPage = 10;


    protected $fillable = [
        'codigo',
        'nombre',
        'salarioDolares',
        'salarioPesos',
        'direccion',
        'estado',
        'ciudad',
        'celular',
        'correo',
        'activo',
    ];
}
