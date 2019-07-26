<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $tipo_documento_id
 * @property int $tipo_usuario_id
 * @property int $categoria_golfista_id
 * @property int $estado_users_id
 * @property string $documento
 * @property string $email
 * @property string $nombres
 * @property string $apellidos
 * @property string $fecha_naci
 * @property string $telefono
 * @property string $direccion
 * @property string $genero
 * @property string $codigo_afiliado
 * @property string $codigo_golfista
 * @property string $email_verified_at
 * @property CategoriaGolfista $categoriaGolfistum
 * @property EstadosUsers $estadoUser
 * @property TipoDocumento $tipoDocumento
 * @property TipoUsuario $tipoUsuario
 */
class Users extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'tipo_documento_id',
        'tipo_usuario_id',
        'categoria_golfista_id',
        'estado_users_id',
        'documento',
        'email',
        'nombres',
        'apellidos',
        'fecha_naci',
        'telefono',
        'direccion',
        'genero',
        'codigo_afiliado',
        'codigo_golfista',
        'email_verified_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoriaGolfistum()
    {
        return $this->belongsTo('App\Model\CategoriaGolfista', 'categoria_golfista_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estadoUser()
    {
        return $this->belongsTo('App\Model\EstadosUsers', 'estado_users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoDocumento()
    {
        return $this->belongsTo('App\Model\TipoDocumento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoUsuario()
    {
        return $this->belongsTo('App\Model\TipoUsuario');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
