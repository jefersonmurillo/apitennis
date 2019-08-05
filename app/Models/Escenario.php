<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escenario extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'escenario';

    /**
     * @var array
     */
    protected $fillable = ['id', 'escenario_id', 'grupo_jugadores_golf', 'fecha', 'hora', 'estado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function escenario()
    {
        return $this->belongsTo(Escenario::class, 'escenario_id');
    }

    public function grupoJugadoresGolf()
    {
        return $this->belongsTo(GrupoJugadoresGolf::class, 'grupo_jugadores_golf');
    }
}
