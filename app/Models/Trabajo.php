<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    use HasFactory;

    protected $table = 'trabajos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'categoria_id',
        'descripcion',
        'url',
        'imagen',
        'usuario_id',
        'fecha'
    ];


    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
