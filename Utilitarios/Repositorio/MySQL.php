<?php

namespace Utilitarios\Repositorio;

final class MySQL extends Settings
{
    private $conn;

    private static $instance = null;

    /**
     * 
     */
    private function __construct()
    {
        try {
            $this->conn = new \PDO('mysql:host='.self::HOST.';dbname='.self::NAME.';charset=utf8', self::USER, self::PASS);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

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
    private static function instance() : MySQL
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * 
     */
    public static function getConnection() : \PDO
    {
        return self::instance()->conn;
    }

    /**
     * 
     */
    public static function createSchema(string $filename) : void
    {
        try {
            $conn = new \PDO('mysql:host='.self::HOST.';charset=utf8', self::USER, self::PASS);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            $conn->exec(file_get_contents($filename));
        }
        catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * 
     */
    public static function migration(array $compras) : void
    {
        $db = self::getConnection();
        $pstmt = $db->prepare("insert into categorias (nome) values (:nome)");

        foreach ($compras as $mes => $categorias) {
            foreach ($categorias as $categoria => $produtos) {
                $pstmt->execute([
                    ':nome' => \Utilitarios\Corrige\Corrige::categoria($categoria)
                ]);
            }
            break;
        }
        
        $pstmtProdutos = $db->prepare("insert into produtos (nome, quantidade, categoriaid) values (:nome, :quantidade, :categoriaid)");
        $pstmtCompras = $db->prepare("insert into compras (mes, produtoid) values (:mes, :produtoid)");

        foreach ($compras as $mes => $categorias) {
            $categoriaId = 0;
            foreach ($categorias as $categoria => $produtos) {
                ++$categoriaId;
                foreach ($produtos as $produto => $quantidade) {
                    $pstmtProdutos->execute([
                        ':nome' => \Utilitarios\Corrige\Corrige::palavras($produto),
                        ':quantidade' => $quantidade,
                        ':categoriaid' => $categoriaId
                    ]);
                    
                    $pstmtCompras->execute([
                        ':mes' => \Utilitarios\Corrige\Corrige::mes($mes),
                        ':produtoid' => $db->lastInsertId()
                    ]);
                }
            }
        }
    }
}
