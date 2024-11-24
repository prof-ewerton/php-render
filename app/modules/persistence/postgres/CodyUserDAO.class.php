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

    public function exists(CodyUser $user): bool {
        $sql = "SELECT EXISTS ( SELECT 1 FROM users WHERE uuid = :uuid )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':uuid', $user->getUUID(), PDO::PARAM_STR);
        $stmt->execute();
        
        $exists = $stmt->fetchColumn();
        
        return $exists;
    }

    public function register(CodyUser $user): CodyUser {
        try {
            $sql = "INSERT INTO 
                    cody_user (name, email, password) 
                    VALUES (:name, :email, :password)
                    RETURNING uuid";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $uuid = $stmt->execute();

            $user->setUUID($uuid);
            return $user;
        } catch (PDOException $e) {
            throw new Exception("Error registering user: " . $e->getMessage());
        }
    }

    public function update(CodyUser $user): CodyUser {
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
        return null;
    }

    public function searchUser(string $email, string $password): CodyUser {
        try {
            $sql = "SELECT * FROM cody_user WHERE email = :email AND password = :password";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $user = new CodyUser();
                $user->setUUID($result['uuid']);
                $user->setName($result['name']);
                $user->setEmail($result['email']);
                $user->setPassword($result['password']);
                
                return $user;
            }
            throw new Exception("User not found");
        } catch (PDOException $e) {
            throw new Exception("Error registering user: " . $e->getMessage());
        }
    }
}