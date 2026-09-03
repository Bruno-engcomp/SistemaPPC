<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sigla',
        'email_contato',
    ];

    public function propostas(): HasMany
    {
        return $this->hasMany(Proposta::class);
    }
}
