<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Entidade de usuário do Cody.
*/
require_once('modules/persistence/entities/CodyEntity.class.php');
require_once('modules/persistence/postgres/CodyUserDAO.class.php');

class CodyUser extends CodyEntity {
    private string $email;
    private string $password;

    public function __construct() {
        parent::setType('user');
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function save() {
        parent::save();
        
        $dao = new CodyUserDAO();

        if ($dao->exists($this->getUUID())) {
            $dao->update($this);
        } else {
            $dao->register($this);
        }
    }


    
    public function json() {
        $vars = get_object_vars($this);
        return parent::json() . json_encode($vars);
    }
}