<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: DAO para grupos de entidades.
*/
require_once('modules/persistence/entities/CodyGroup.class.php');

class CodyGroupDAO {

    private PDO $pdo;

    public function __construct() {
        $pg = new ConnectionPostgres();
        $this->pdo = $pg->getConnection();
    }

    // TODO: Precisa verificar este código
    public function exists(string $UUID): bool {
        $sql = "SELECT EXISTS ( SELECT 1 FROM groups WHERE uuid_entity = :uuid )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':uuid', $UUID);
        $stmt->execute();

        $exists = $stmt->fetchColumn();

        return $exists;
    }

}