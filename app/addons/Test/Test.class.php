<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Addon que cria uma página inicial (padrão do sistema) e a página de erro 404.
*/
require_once('addons/Addon.class.php');

require_once('modules/persistence/entities/CodyEntity.class.php');
require_once('modules/persistence/entities/CodyUser.class.php');
require_once('modules/persistence/entities/CodyGroup.class.php');
require_once('modules/persistence/AccessId.enum.php');
require_once('modules/persistence/postgres/ConnectionPostgres.class.php');

require_once('modules/persistence/postgres/schema/migrations/Migration005.class.php');

class Test extends Addon {

    private CodyEntity $e;
    private CodyUser $u;
    
    public function __construct($router) {
        $router->addRoute('/test', array($this, "index"));
    }

    public function index() {
        $this->testConnection();
        $this->install();
        $this->testSaveNewEntity();
        $this->testeEntityExists();
        $this->testeUpdateEntity();
        $this->testeRegisterUser();
    }



    public function testeRegisterUser() {
        $this->u = new CodyUser();
        $this->u->setName("Fulano de Tal");
        $this->u->setEmail("fulano@email.com");
        $this->u->setPassword("111");
        $this->u->save();
        
        $this->message("Test register user OK!");
    }

    public function testeUpdateEntity() {
        $this->e->setOwnerUUID("e47a409c-1d9d-4867-9f77-6d35f73d2b2f");
        $this->e->setSubtype('testtest');
        $this->e->setAccessId(AccessId::ACCESS_PRIVATE);
        $this->e->setName('Entidade Teste ALTERADO');

        $this->e->save();

        $this->message("Test entity update OK!");
    }

    public function testeEntityExists() {
        $resp = $this->e->exists();
        if ($resp) 
            $this->message("Test entity exists OK!");
        else
            $this->message("Test entity exists fail!!!!!");
    }

    public function testSaveNewEntity() {
        $this->e = new CodyEntity();
        $this->e->setOwnerUUID("987e6543-e21b-32d3-b456-426614174999");
        $this->e->setSubtype('test');
        $this->e->setAccessId(AccessId::ACCESS_PUBLIC);
        $this->e->setName('Entidade Teste');

        $this->e->save();

        $this->message("Test save new entity OK! UUID = " . $this->e->getUUID());
    }

    public function install() {
        $m = new Migration005();
        $m->migrate();
    }

    public function testConnection() {
        $pg = new ConnectionPostgres();
        $pg->getConnection();

        $this->message("Teste connection postgres ok!");
    }

    public function message(string $msg) {
        echo "<p>" . $msg . "</p>";
    }
}