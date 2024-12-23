<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: DAO para o usuário do Cody.
*/
require_once('modules/persistence/entities/CodyUser.class.php');

class CodyUserDAO {

    private PDO $pdo;

    public function __construct() {
        $pg = new ConnectionPostgres();
        $this->pdo = $pg->getConnection();
    }

    public function exists(string $UUID): bool {
        $sql = "SELECT EXISTS ( SELECT 1 FROM users WHERE uuid_entity = :uuid )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':uuid', $UUID);
        $stmt->execute();
        
        $exists = $stmt->fetchColumn();
        
        return $exists;
    }

    public function register(CodyUser $user) {
        try {
            $sql = "INSERT INTO 
                    users (uuid_entity, email, password) 
                    VALUES (:uuid_entity, :email, :password)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':uuid_entity', $user->getUUID());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error registering user: " . $e->getMessage());
        }
    }

    public function update(CodyUser $user) {
        /*
        try {
            $sql = "UPDATE cody_user SET name = :name, email = :email, password = :password WHERE uuid = :uuid";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':uuid', $user->getUUID());
            $stmt->execute();
        }
        catch (PDOException $e) {
            throw new Exception("Error updating user: " . $e->getMessage());
        }
        return $user;
        */
    }

    public function searchUser(string $email, string $password): CodyUser {
        try {
            $sql = "SELECT users.*, entities.* 
                    FROM users 
                    JOIN entities ON users.uuid_entity = entities.uuid 
                    WHERE users.email = :email AND users.password = :password";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $user = new CodyUser();
                $user->setUUID($result['uuid']);
                $user->setName($result['entity_name']);
                $user->setEmail($result['email']);
                $user->setPassword($result['password']);
                
                return $user;
            }
            throw new Exception("User not registered");
        } catch (PDOException $e) {
            throw new Exception("Error registering user: " . $e->getMessage());
        }
    }

    public function searchUserByEmail(string $email): bool {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return True;
            }
            return false;
        } catch (PDOException $e) {
            throw new Exception("Error registering user: " . $e->getMessage());
        }
        return False;
    }

    public function getEntity(string $UUID): CodyUser {
        try {
            $sql = "SELECT users.*, entities.*
                    FROM users
                    JOIN entities ON users.uuid_entity = entities.uuid
                    WHERE users.uuid_entity = :uuid";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':uuid', $UUID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $user = new CodyUser();
                $user->setUUID($result['uuid']);
                $user->setCreatedAt($result['created_at']);
                $user->setType($result['type']);
                $user->setName($result['entity_name']);
                $user->setEmail($result['email']);
                $user->setPassword($result['password']);

                return $user;
            }
            throw new Exception("User not registered");
        } catch (PDOException $e) {
            throw new Exception("Error registering user: " . $e->getMessage());
        }
    }
}