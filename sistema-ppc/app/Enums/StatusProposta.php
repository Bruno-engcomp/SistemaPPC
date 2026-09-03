<?php

namespace App\Enums;

enum StatusProposta: string
{
    case RASCUNHO = 'RASCUNHO';
    case SUBMETIDO = 'SUBMETIDO';
    case EM_AVALIACAO = 'EM_AVALIACAO';
    case RETORNADO = 'RETORNADO';
    case APROVADO_CAMARA = 'APROVADO_CAMARA';
    case REPROVADO = 'REPROVADO';
    case APROVADO = 'APROVADO';

    public function label(): string
    {
        return match($this) {
            self::RASCUNHO => 'Rascunho',
            self::SUBMETIDO => 'Submetido',
            self::EM_AVALIACAO => 'Em Avaliação',
            self::RETORNADO => 'Retornado para Ajustes',
            self::APROVADO_CAMARA => 'Aprovado na Câmara',
            self::REPROVADO => 'Reprovado',
            self::APROVADO => 'Aprovado Final',
        };
    }
}
