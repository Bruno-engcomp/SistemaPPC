<?php

namespace App\Models;

use App\Enums\StatusProposta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proposta extends Model
{
    use HasFactory;

    protected $fillable = [
        'unidade_id',
        'nome_curso',
        'modalidade',
        'carga_horaria_total',
        'justificativa',
        'perfil_egresso',
        'status',
    ];

    protected $casts = [
        'status' => StatusProposta::class,
    ];

    public function unidade(): BelongsTo
    {
        return $this->belongsTo(Unidade::class);
    }

    public function disciplinas(): HasMany
    {
        return $this->hasMany(Disciplina::class);
    }

    public function avaliacoes(): HasMany
    {
        return $this->hasMany(Avaliacao::class);
    }
}
