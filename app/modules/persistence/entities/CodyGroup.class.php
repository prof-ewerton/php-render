<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Entidade de grupo do Cody.
*/
require_once('modules/persistence/entities/CodyEntity.class.php');
require_once('modules/persistence/postgres/CodyGroupDAO.class.php');

class CodyGroup extends CodyEntity {

    private array $group;

    public function __construct(string $name) {
        parent::__construct();
        $this->type = 'group';
        parent::setName($name);
        
        $this->group = [];
    }

    public function add(CodyEntity $entity) {
        $group[] = $entity;
        $this->save();
    }

    public function remove(string $UUID) {
        foreach ($this->group as $key => $value) {
            if ($value->getUUID() == $UUID) {
                unset($this->group[$key]);
            }
        }
        $this->save();
    }

    public function getEntity(string $UUID): CodyEntity {
        foreach ($this->group as $key => $value) {
            if ($value->getUUID() == $UUID) {
                return $this->group[$key];
            }
        }
        return throw new Exception("Entity not found.");
    }


    public function save() {
        parent::save();
        
        $dao = new CodyGroupDAO();

        /*
        if ($dao->exists($this)) {
            $dao->update($this);
        } else {
            $dao->register($this);
        }
        */
    }


    
    public function json() {
        $vars = get_object_vars($this);
        return parent::json() . json_encode($vars);
    }
}