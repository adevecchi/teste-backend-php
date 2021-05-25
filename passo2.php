<?php

use Utilitarios\Ordenar\Ordenar;
use Utilitarios\Repositorio\MySQL;

require 'Utilitarios/autoload.php';

$lista_de_compras = Ordenar::listaDeCompras(require 'lista-de-compras.php');

MySQL::createSchema('script.sql');

MySQL::migration($lista_de_compras);
