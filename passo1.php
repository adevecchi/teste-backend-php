<?php

use Utilitarios\Ordenar\Ordenar;
use Utilitarios\Csv\CriarCsv;

require 'Utilitarios/autoload.php';

$lista_de_compras = Ordenar::listaDeCompras(require 'lista-de-compras.php');

$csv = new CriarCsv('compras-do-ano.csv');

$csv->escrever($lista_de_compras);
