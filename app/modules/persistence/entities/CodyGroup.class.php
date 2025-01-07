<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Entidade de grupo do Cody.
*/
require_once('modules/persistence/entities/CodyEntity.class.php');
require_once('modules/persistence/postgres/CodyGroupDAO.class.php');

class CodyGroup extends CodyEntity {

    public function __construct(string $subtype, string $ownerUUID) {
        parent::__construct();
        parent::setType('group');
        parent::setOwnerUUID($ownerUUID);
        parent::setSubtype($subtype);

        parent::save();
    }

    public function add(CodyEntity $entity) {
        $dao = new CodyGroupDAO();
        $dao->add($this, $entity);
    }

    public function remove(CodyEntity $entity) {
        $dao = new CodyGroupDAO();
        $dao->remove($this, $entity);
    }

    public function getEntity(string $UUID): CodyEntity {
        try {
            $dao = new CodyGroupDAO();
            return $dao->getEntity($this, $UUID);
        } catch (Exception $e) {
            throw new Exception("Grupo não encontrado");
        }
    }

    public function getEntities(): array {
        try {
            $dao = new CodyGroupDAO();
            return $dao->getEntities($this);
        } catch (Exception $e) {
            throw new Exception("Grupo não encontrado");
        }
    }


    
    public function json() {
        $vars = get_object_vars($this);
        return parent::json() . json_encode($vars);
    }
}