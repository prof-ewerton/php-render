<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição:
*/

class ConnectionPostgres {
/*
    public function getConnection() {
        $host        = $_ENV["DATABASE_HOST"];
        $port        = $_ENV["DATABASE_PORT"];
        $dbname      = $_ENV["DATABASE_NAME"];
        $user        = $_ENV["DATABASE_USER"];
        $password    = $_ENV["DATABASE_PASS"];

        $conn = pg_connect("host = $host port = $port dbname = $dbname user = $user password = $password");
        if(!$conn) {
            echo "Error : Unable to open database\n";
        } else {
            echo "Opened database successfully\n";
        }
    }
*/
    public function getConnection(): PDO {
        $host        = $_ENV["DATABASE_HOST"];
        $port        = $_ENV["DATABASE_PORT"];
        $dbname      = $_ENV["DATABASE_NAME"];
        $user        = $_ENV["DATABASE_USER"];
        $password    = $_ENV["DATABASE_PASS"];

        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
        $pdo = new PDO($dsn, $user, $password);
/*
        if(!$pdo) {
            echo "Error : Unable to open database\n";
        } else {
            echo "Opened database successfully\n";
        }
*/
        return $pdo;
    }
}