<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Entidade de usuário do Cody.
*/
require_once('modules/persistence/entities/CodyEntity.class.php');

class CodyUser extends CodyEntity {
    private string $email;
    private string $password;

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
        $this->save($this);
        
        $dao = new CodyUserDAO();

        if ($dao->exists($this)) {
            $dao->update($this);
        } else {
            $dao->register($this);
        }
        
        $dao->register($this);
    }
}