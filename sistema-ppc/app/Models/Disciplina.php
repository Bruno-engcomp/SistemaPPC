<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disciplina extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposta_id',
        'nome',
        'codigo',
        'carga_horaria',
        'periodo',
        'ementa',
    ];

    public function proposta(): BelongsTo
    {
        return $this->belongsTo(Proposta::class);
    }
}
