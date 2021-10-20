<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatasDiaria extends Model
{
    use HasFactory;

    /**
     * Define o nome da tabela do model
     *
     * @var string
     */
    protected $table = 'cadidatas_diaria';

    /**
     * Define a relação com o candidato para realizar a diária
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function candidata()
    {
        return $this->belongsTo(User::class, 'diarista_id');
    }
}
