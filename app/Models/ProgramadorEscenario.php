<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramadorEscenario extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'programador_escenario';

    /**
     * @var array
     */
    protected $fillable = ['id', 'disciplina_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'disciplina_id');
    }
}
