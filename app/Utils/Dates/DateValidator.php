<?php

namespace App\Utils\Dates;

use DateTime;

class DateValidator
{

    /**
     * Verifica se uma string é uma data válida para um formato específico.
     *
     * @param string $string A string para verificar.
     * @param string $format O formato da data esperado (ex: 'Y-m-d').
     * @return bool Retorna true se a string for uma data válida, false caso contrário.
     */
    public static function isValidDate($string, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $string);
        // A verificação $d->format($format) === $string é importante
        // para evitar que datas inválidas como '2023-02-30' sejam aceitas.
        return $d && $d->format($format) === $string;
    }
}
