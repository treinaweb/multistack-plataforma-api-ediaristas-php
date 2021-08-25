<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diaria extends Model
{
    use HasFactory;

    /**
     * Campos bloqueados na definação de dados em massa
     */
    protected $guarded = ['motivo_cancelamento', 'created_at', 'updated_at'];
}
