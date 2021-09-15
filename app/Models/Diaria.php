<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diaria extends Model
{
    use HasFactory;

    /**
     * Campos bloqueados na definação de dados em massa
     */
    protected $guarded = ['motivo_cancelamento', 'created_at', 'updated_at'];

    /**
     * Define a relação com serviço
     *
     * @return BelongsTo
     */
    public function servico(): BelongsTo
    {
        return $this->belongsTo(Servico::class);
    }

    /**
     * Define a relação com cliente
     *
     * @return BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    /**
     * Define o status da diária como pago
     *
     * @return boolean
     */
    public function pagar(): bool
    {
        $this->status = 2;
        return $this->save();
    }

    /**
     * Retornar as diárias do usuário
     *
     * @param User $usuario
     * @return Collection
     */
    static public function todasDoUsuario(User $usuario): Collection
    {
        return self::
            when($usuario->tipo_usuario === 1, function($q) use($usuario) {
                $q->where('cliente_id', $usuario->id);
            })
            ->when($usuario->tipo_usuario === 2, function($q) use ($usuario){
                $q->where('diarista_id', $usuario->id);
            })
            ->get();
    }
}
