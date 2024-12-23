<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Entidade de grupo do Cody.
*/
require_once('modules/persistence/entities/CodyEntity.class.php');
require_once('modules/persistence/postgres/CodyGroupDAO.class.php');

class CodyGroup extends CodyEntity {

    private CodyGroupDAO $dao;

    public function __construct(string $subtype, string $ownerUUID) {
        parent::__construct();
        parent::setType('group');
        parent::setOwnerUUID($ownerUUID);
        parent::setSubtype($subtype);

        parent::save();

        $this->dao = new CodyGroupDAO();
    }

    public function add(CodyEntity $entity) {
        $this->dao->add($this, $entity);
    }

    public function remove(CodyEntity $entity) {
        $this->dao->remove($this, $entity);
    }

    public function getEntity(string $UUID): CodyEntity {
        try {
            return $this->dao->getEntity($this, $UUID);
        } catch (Exception $e) {
            throw new Exception("Grupo não encontrado");
        }
    }

    public function getEntities(): array {
        try {
            return $this->dao->getEntities($this);
        } catch (Exception $e) {
            throw new Exception("Grupo não encontrado");
        }
    }


    
    public function json() {
        $vars = get_object_vars($this);
        return parent::json() . json_encode($vars);
    }
}