<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    /**
     * define o nome da tabela no banco de dados
     *
     * @var string
     */
    protected $table = 'avaliacoes';

    /**
     * Define os campos liberados
     *
     * @var array
     */
    protected $fillable = [
        'visibilidade',
        'nota',
        'descricao',
        'avaliador_id',
        'avaliado_id',
        'diaria_id'
    ];
}
