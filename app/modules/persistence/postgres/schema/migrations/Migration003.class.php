<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Estrutura o banco de dados utilizando a migration 001
*/
require_once("modules/persistence/postgres/ConnectionPostgres.class.php");

class Migration003 {

    public function migrate() {
        $db = new ConnectionPostgres();
        $pdo = $db->getConnection();

        try {
            $sql = "DROP TABLE IF EXISTS users";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute()) {
                echo "Tabela 'users' apagada com sucesso.\n";
            } else {
                echo "Falha ao tentar apagar a tabela 'users'.\n";
            }
        } catch (PDOException $e) {
            echo "Erro ao executar a operação: " . $e->getMessage();
        }
        
        try {
            $sql = "DROP TABLE IF EXISTS entity";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute()) {
                echo "Tabela 'entity' apagada com sucesso.\n";
            } else {
                echo "Falha ao tentar apagar a tabela 'entity'.\n";
            }
        } catch (PDOException $e) {
            echo "Erro ao executar a operação: " . $e->getMessage();
        }

        try {
            $sql = "CREATE TABLE entity (
                uuid UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                type_name VARCHAR(255) NOT NULL DEFAULT 'object',
                subtype VARCHAR(255) NOT NULL,
                owner_uuid UUID,
                access_id INTEGER NOT NULL DEFAULT 0,
                entity_name VARCHAR(255)
            )";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute()) {
                echo "Tabela 'entity' criada com sucesso.\n";
            } else {
                echo "Falha ao tentar criar a tabela 'entity'.\n";
            }
        } catch (PDOException $e) {
            echo "Erro ao executar a operação: " . $e->getMessage();
        }

        try {
            $sql = "CREATE TABLE users (
                uuid_entity UUID PRIMARY KEY  REFERENCES entities(uuid),
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL
            );

            )";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute()) {
                echo "Tabela 'users' criada com sucesso.\n";
            } else {
                echo "Falha ao tentar criar a tabela 'users'.\n";
            }
        } catch (PDOException $e) {
            echo "Erro ao executar a operação: " . $e->getMessage();
        }
        
    }
}