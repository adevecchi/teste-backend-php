<?php

namespace Utilitarios\Ordenar;

final class Ordenar
{
    private static $meses = [
        'janeiro' => 1,
        'fevereiro' => 2,
        'marco' => 3,
        'abril' => 4,
        'maio' => 5,
        'junho' => 6,
        'julho' => 7,
        'agosto' => 8,
        'setembro' => 9,
        'outubro' => 10,
        'novenbro' => 11,
        'dezembro' => 12
    ];

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
    public static function listaDeCompras(array $compras) : array
    {
        return self::quantidadeDecrescente(self::categorias(self::meses($compras)));
    }

    /**
     * 
     */
    private static function meses(array $compras) : array
    {
        $meses = array_keys($compras);

        for ($i = 0, $size = count($meses) - 1; $i < $size; $i++) {
            if (self::$meses[$meses[$i]] > self::$meses[$meses[$i+1]]) {
                $temp = $meses[$i+1];
                $meses[$i+1] = $meses[$i];
                $meses[$i] = $temp;
                $i = -1;
            }
        }

        foreach ($meses as $mes) {
            $meses_ordenados[$mes] = $compras[$mes];
        }
    
        return $meses_ordenados;
    }

    /**
     * 
     */
    private static function categorias(array $compras) : array
    {
        $meses = array_keys($compras);
        
        for ($i = 0, $size = count($meses); $i < $size; $i++) {
            $categorias = array_keys($compras[$meses[$i]]);
            sort($categorias);
            for ($j = 0, $len = count($categorias); $j < $len; $j++) {
                $temp[$categorias[$j]] = $compras[$meses[$i]][$categorias[$j]];
            }
            $compras[$meses[$i]] = $temp;
        }

        return $compras;
    }

    /**
     * 
     */
    private static function quantidadeDecrescente(array $compras) : array
    {
        $meses = array_keys($compras);

        for ($i = 0, $size = count($meses); $i < $size; $i++) {
            $categorias = array_keys($compras[$meses[$i]]);
            for ($j = 0, $len = count($categorias); $j < $len; $j++) {
                if (count($compras[$meses[$i]][$categorias[$j]])) {
                    arsort($compras[$meses[$i]][$categorias[$j]]);
                }
            }
        }

        return $compras;
    }
}
