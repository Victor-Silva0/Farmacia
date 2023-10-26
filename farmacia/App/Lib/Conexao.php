<?php

namespace App\Lib;

use PDO;
use PDOException;
use Exception;

class Conexao
{
    private static $conn;

    private function __construct() {}

    public static function getConnection() {

        $pdoConfig  = DB_DRIVER . ":". "host=" . DB_HOST . ";";
        $pdoConfig .= "dbname=".DB_NAME.";";

        try { 
            if(!isset($conn)){
                $conn =  new PDO($pdoConfig, DB_USER, DB_PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $conn;
        } catch (PDOException $e) {
            throw new Exception("Erro de conexão com o banco de dados. ($e)",500);
        }
    }
}