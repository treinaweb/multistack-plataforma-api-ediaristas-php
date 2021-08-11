<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome_completo',
        'cpf',
        'nascimento',
        'foto_documento',
        'telefone',
        'tipo_usuario',
        'chave_pix',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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

    /**
     * Define a relação com as cidades atendidas pelo(a) diarista
     *
     * @return BelongsToMany
     */
    public function cidadesAtendidas(): BelongsToMany
    {
        return $this->belongsToMany(Cidade::class, 'cidade_diarista');
    }

    /**
     * Escopo que filtra os(as) diaristas
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeDiarista(Builder $query): Builder
    {
        return $query->where('tipo_usuario', 2);
    }

    /**
     * Escopo que filtra diaristas por código do IBGE
     *
     * @param Builder $query
     * @param integer $codigoIbge
     * @return Builder
     */
    public function scopeDiaristasAtendeCidade(Builder $query, int $codigoIbge): Builder
    {
        return $query->diarista()
                    ->whereHas('cidadesAtendidas', function($q) use ($codigoIbge) {
                        $q->where('codigo_ibge', $codigoIbge);
                    });
    }

    /**
     * Busca 6 diaristas por código do ibge
     *
     * @param integer $codigoIbge
     * @return Collection
     */
    static public function diaristasDisponivelCidade(int $codigoIbge): Collection
    {
        return User::diaristasAtendeCidade($codigoIbge)->limit(6)->get();
    }

    /**
     * Returna a quantidade de diaristas por código do ibge
     *
     * @param integer $codigoIbge
     * @return void
     */
    static public function diaristasDisponivelCidadeTotal(int $codigoIbge): int
    {
        return User::diaristasAtendeCidade($codigoIbge)->count();
    }
}
