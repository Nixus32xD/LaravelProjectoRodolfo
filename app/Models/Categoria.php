<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';  // Nombre correcto de la tabla

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function trabajos()
    {
        return $this->hasMany(Trabajo::class);
    }
}
