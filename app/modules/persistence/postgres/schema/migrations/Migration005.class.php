<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Estrutura o banco de dados utilizando a migration 001
*/
require_once("modules/persistence/postgres/ConnectionPostgres.class.php");

class Migration005 {

    public function migrate() {
        $db = new ConnectionPostgres();
        $pdo = $db->getConnection();

        try {
            $sql = "DROP TABLE IF EXISTS groups";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute()) {
                echo "Tabela 'groups' apagada com sucesso.\n";
            } else {
                echo "Falha ao tentar apagar a tabela 'groups'.\n";
            }
        } catch (PDOException $e) {
            echo "Erro ao executar a operação: " . $e->getMessage();
        }

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
            $sql = "DROP TABLE IF EXISTS entities";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute()) {
                echo "Tabela 'entities' apagada com sucesso.\n";
            } else {
                echo "Falha ao tentar apagar a tabela 'entities'.\n";
            }
        } catch (PDOException $e) {
            echo "Erro ao executar a operação: " . $e->getMessage();
        }

        try {
            $sql = "CREATE TABLE entities (
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
                echo "Tabela 'entities' criada com sucesso.\n";
            } else {
                echo "Falha ao tentar criar a tabela 'entities'.\n";
            }
        } catch (PDOException $e) {
            echo "Erro ao executar a operação: " . $e->getMessage();
        }

        try {
            $sql = "CREATE TABLE users (
                    uuid_entity UUID PRIMARY KEY REFERENCES entities(uuid),
                    password VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL);";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute()) {
                echo "Tabela 'users' criada com sucesso.\n";
            } else {
                echo "Falha ao tentar criar a tabela 'users'.\n";
            }
        } catch (PDOException $e) {
            echo "Erro ao executar a operação: " . $e->getMessage();
        }

        try {
            $sql = "CREATE TABLE groups (
                    uuid_entity_group UUID REFERENCES entities(uuid),
                    uuid_entity_item UUID REFERENCES entities(uuid));";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute()) {
                echo "Tabela 'groups' criada com sucesso.\n";
            } else {
                echo "Falha ao tentar criar a tabela 'groups'.\n";
            }
        } catch (PDOException $e) {
            echo "Erro ao executar a operação: " . $e->getMessage();
        }
        
    }
}