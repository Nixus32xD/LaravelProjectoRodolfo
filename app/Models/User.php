<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
/**
 * Clase Usuario
 *
 * Esta clase representa el modelo Usuario en Laravel.
 * Contiene las relaciones y métodos para interactuar con la tabla 'usuarios' en la base de datos.
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Nombre de la tabla en la base de datos.
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'email_verified_at',
        'token',
        'admin' => 0,
        'created_at',
        'updated_at'
    ];

    /**
     * La llave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indica si las horas de fecha y hora deben ser ajustadas automáticamente.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Los atributos que deben ser ocultos para las matriz asociativas.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'password2',
        'token',
        'created_at',
        'updated_at'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación de uno a muchos con la tabla categorias.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    /**
     * Relación de uno a muchos con la tabla trabajos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trabajos()
    {
        return $this->hasMany(Trabajo::class);
    }
}
