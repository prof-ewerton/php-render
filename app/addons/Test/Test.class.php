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
    private CodyUser $u1, $u2, $u3;
    private CodyGroup $g1, $g2, $g3;
    
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
        $this->testeCreateGroupUser();
    }

    public function testeCreateGroupUser() {
        $this->g1 = new CodyGroup("players");
        $this->g1->add($this->u1);
        $this->g1->add($this->u2);
        $this->g1->add($this->u3);

        $this->message("Test group OK!");
    }

    public function testeRegisterUser() {
        $this->u1 = new CodyUser();
        $this->u1->setName("Fulano de Tal");
        $this->u1->setEmail("fulano@email.com");
        $this->u1->setPassword("111");
        $this->u1->save();
        
        $this->message("Test register user OK! <code>" . $this->u1->json() . "</code>");
        
        $this->u2 = new CodyUser();
        $this->u2->setName("Beltrano de Tal");
        $this->u2->setEmail("beltrano@email.com");
        $this->u2->setPassword("222");
        $this->u2->save();
        
        $this->message("Test register user OK! <code>" . $this->u2->json() . "</code>");

        $this->u3 = new CodyUser();
        $this->u3->setName("Cicrano de Tal");
        $this->u3->setEmail("cicrano@email.com");
        $this->u3->setPassword("333");
        $this->u3->save();
        
        $this->message("Test register user OK! <code>" . $this->u3->json() . "</code>");
    }

    public function testeUpdateEntity() {
        $this->e->setOwnerUUID("e47a409c-1d9d-4867-9f77-6d35f73d2b2f");
        $this->e->setSubtype('updateok!');
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

        $this->message("Migrate ok!");
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