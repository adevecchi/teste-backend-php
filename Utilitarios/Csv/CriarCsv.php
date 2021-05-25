<?php

namespace Utilitarios\Csv;

use Utilitarios\Corrige\Corrige;

class CriarCsv
{
    private $arquivo;
    private $cabecalho = ['Mês', 'Categoria', 'Produto', 'Quantidade'];

    /**
     * 
     */
    public function __construct(string $arquivo)
    {
        $this->arquivo = $arquivo;
    }

    /**
     * 
     */
    public function escrever(array $compras) : void
    {
        $fHandler = fopen($this->arquivo, 'w');

        fputcsv($fHandler, $this->cabecalho);

        foreach ($compras as $mes => $categorias) {
            foreach ($categorias as $categoria => $produtos) {
                foreach ($produtos as $produto => $quantidade) {
                    fputcsv(
                        $fHandler,
                        [
                            Corrige::mes($mes),
                            Corrige::categoria($categoria),
                            Corrige::palavras($produto),
                            $quantidade
                        ]
                    );
                }
            }
        }

        fclose($fHandler);
    }
}
