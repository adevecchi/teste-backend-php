<?php

namespace Utilitarios\Corrige;

final class Corrige
{
    /**
     * 
     */
    private function __construct() {}

    /**
     * 
     */
    private function __clone() {}

    /**
     * 
     */
    private function __wakeup() {}

    /**
     * 
     */
    public static function mes(string $mes) : string
    {
        $meses = [
            'janeiro' => 'Janeiro',
            'fevereiro' => 'Fevereiro',
            'marco' => 'Março',
            'abril' => 'Abril',
            'maio' => 'Maio',
            'junho' => 'Junho',
            'julho' => 'Julho',
            'agosto' => 'Agosto',
            'setembro' => 'Setembro',
            'outubro' => 'Outubro',
            'novenbro' => 'Novembro',
            'dezembro' => 'Dezembro'
        ];

        return $meses[$mes];
    }

    /**
     * 
     */
    public static function categoria(string $categoria) : string
    {
        $categorias = [
            'alimentos' => 'Alimentos',
            'higiene_pessoal' => 'Higiene Pessoal',
            'limpeza' => 'Limpeza'
        ];

        return $categorias[$categoria];
    }

    /**
     * 
     */
    public static function palavras(string $produto) : string
    {
        $palavras = [
            'Papel Hignico' => 'Papel Higiênico',
            'Brocolis' => 'Brócolis',
            'Chocolate ao leit' => 'Chocolate ao leite',
            'Sabao em po' => 'Sabão em pó'
        ];

        if (array_key_exists($produto, $palavras))
            return $palavras[$produto];

        return $produto;
    }
}
