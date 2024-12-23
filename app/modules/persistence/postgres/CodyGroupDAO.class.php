<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: DAO para grupos de entidades.
*/
require_once('modules/persistence/entities/CodyGroup.class.php');
require_once('modules/persistence/postgres/CodyEntityDAO.class.php');
require_once('modules/persistence/postgres/CodyUserDAO.class.php');
require_once('modules/persistence/entities/CodyEntity.class.php');
require_once('modules/persistence/entities/CodyUser.class.php');
require_once('modules/persistence/entities/CodyGroup.class.php');

class CodyGroupDAO {

    private PDO $pdo;

    public function __construct() {
        $pg = new ConnectionPostgres();
        $this->pdo = $pg->getConnection();
    }

    // TODO: Precisa verificar esta função
    public function exists(string $UUID): bool {
        $sql = "SELECT EXISTS ( SELECT 1 FROM groups WHERE uuid_entity_group = :uuid )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':uuid', $UUID);
        $stmt->execute();

        $exists = $stmt->fetchColumn();

        return $exists;
    }

    public function add(CodyEntity $group, CodyEntity $item) {
        try {
            $sql = "INSERT INTO groups (uuid_entity_group, uuid_entity_item) 
                    VALUES (:uuid, :uuid_item)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':uuid', $group->getUUID());
            $stmt->bindValue(':uuid_item', $item->getUUID());
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao executar a operação add group: " . $e->getMessage();
        }
    }

    public function remove(CodyEntity $group, CodyEntity $item) {
        try {
            $sql = "DELETE FROM groups WHERE uuid_entity_group = :uuid and uuid_entity_item = :uuid_entity_item";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':uuid', $group->getUUID());
            $stmt->bindValue(':uuid_entity_item', $item->getUUID());
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao executar a operação remove group: " . $e->getMessage();
        }
    }

    public function getEntity(CodyGroup $group, string $UUID): CodyEntity {
        try {
            $sql = "SELECT 
                    g.uuid_entity_group AS group_uuid, 
                    g.uuid_entity_item AS item_uuid,
                    e.uuid AS item_uuid,
                    e.created_at, 
                    e.type_name, 
                    e.subtype, 
                    e.owner_uuid, 
                    e.access_id, 
                    e.entity_name
                FROM 
                    groups g
                JOIN 
                    entities e ON g.uuid_entity_item = e.uuid
                WHERE 
                    g.uuid_entity_item = :uuid;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':uuid', $UUID);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $item) {
                $object = null;
                if ($item['type_name'] == 'object') {
                    $dao = new CodyEntityDAO();
                }
                if ($item['type_name'] == 'user') {
                    $dao = new CodyUserDAO();
                }
                if ($item['type_name'] == 'group') {
                    $dao = new CodyGroupDAO();
                }
                $object = $dao->getEntity($item['item_uuid']);

                return $object;
            }
            throw new Exception("Item não encontrado no grupo");
        } catch (PDOException $e) {
            echo "Erro ao executar a operação get entity group: " . $e->getMessage();
        }
    }

    public function getEntities(CodyGroup $group): array {
        try {
            $sql = "SELECT 
                g.uuid_entity_group AS group_uuid, 
                e.uuid AS item_uuid,
                e.created_at, 
                e.type_name, 
                e.subtype, 
                e.owner_uuid, 
                e.access_id, 
                e.entity_name
            FROM 
                groups g
            JOIN 
                entities e ON g.uuid_entity_item = e.uuid
            WHERE 
                g.uuid_entity_group = :uuid;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':uuid', $group->getUUID());
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $group = [];
            foreach ($results as $item) {
                $object = null;
                if ($item['type_name'] == 'object') {
                    $dao = new CodyEntityDAO();
                }
                if ($item['type_name'] == 'user') {
                    $dao = new CodyUserDAO();
                }
                if ($item['type_name'] == 'group') {
                    $dao = new CodyGroupDAO();
                }
                $object = $dao->getEntity($item['item_uuid']);

                $group[] = $object;
            }
            return $group;
        
        } catch (PDOException $e) {
            echo "Erro ao executar a operação get entities group: " . $e->getMessage();
        }
    }
}