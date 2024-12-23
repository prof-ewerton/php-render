<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: 
*/
require_once("modules/persistence/postgres/ConnectionPostgres.class.php");
require_once("modules/persistence/entities/CodyEntity.class.php");

class CodyEntityDAO {

    private PDO $pdo;

    public function __construct() {
        $pg = new ConnectionPostgres();
        $this->pdo = $pg->getConnection();
    }

    public function create(CodyEntity $entity) {

        $sql = "INSERT INTO entities (subtype, access_id, entity_name) 
                VALUES (:subtype, :accessid, :entityname) 
                RETURNING uuid, created_at";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(":subtype", $entity->getSubtype());
        $stmt->bindValue(":accessid", ($entity->getAccessId())->value);
        $stmt->bindValue(":entityname", $entity->getName());

        if ($stmt->execute()) {
            $results = $stmt->fetchAll();
            $entity->setUUID($results[0]['uuid']);
            $entity->setCreatedAt(new DateTime($results[0]['created_at']));
        }
    }

    public function update(CodyEntity $entity): string {
        $uuid = 0;

        $sql = "UPDATE entities
                SET owner_uuid = :owneruuid,
                    subtype = :subtype,
                    access_id = :accessid,
                    entity_name = :entityname
                WHERE uuid = :uuid
                RETURNING uuid, created_at";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(":owneruuid", $entity->getOwnerUUID());
        $stmt->bindValue(":subtype", $entity->getSubtype());
        $stmt->bindValue(":accessid", ($entity->getAccessId())->value);
        $stmt->bindValue(":entityname", $entity->getName());
        $stmt->bindValue(":uuid", $entity->getUUID());

        if ($stmt->execute()) {
            $uuid = $stmt->fetchColumn(0);
            $created_at = new DateTime($stmt->fetchColumn(1));
        }

        return $uuid;
    }

    public function exists(string $uuid): bool {
        $sql = "SELECT EXISTS ( SELECT 1 FROM entities WHERE uuid = :uuid )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':uuid', $uuid, PDO::PARAM_STR);
        $stmt->execute();
        
        $exists = $stmt->fetchColumn();
        
        return $exists;
    }

    public function getEntity(string $uuid): CodyEntity {
        $e = new CodyEntity();

        return $e;
    }

}