<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property Instalacion[] $instalacions
 */
class Disciplina extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'disciplina';

    /**
     * @var array
     */
    protected $fillable = ['id', 'nombre'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instalacions()
    {
        return $this->hasMany('App\Model\Instalacion');
    }
}
