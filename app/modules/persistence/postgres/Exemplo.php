<?php

class Database {
    private $pdo;

    // Construtor para inicializar a conexão com o banco de dados
    public function __construct($host, $port, $dbname, $user, $pass) {
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
        $this->pdo = new PDO($dsn, $user, $pass);
    }

    // Método para salvar ou atualizar um objeto
    public function saveOrUpdate($table, $data, $uniqueKey) {
        $columns = array_keys($data);
        $placeholders = ':' . implode(', :', $columns);

        $updateStr = '';
        foreach ($columns as $column) {
            if ($column !== $uniqueKey) {
                $updateStr .= "$column = EXCLUDED.$column, ";
            }
        }
        $updateStr = rtrim($updateStr, ', ');

        $sql = "INSERT INTO $table (" . implode(', ', $columns) . ") VALUES ($placeholders) 
                ON CONFLICT ($uniqueKey) DO UPDATE SET $updateStr";
        $stmt = $this->pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
    }
}

// Exemplo de uso
$db = new Database('localhost', '5432', 'seu_banco', 'seu_usuario', 'sua_senha');

// Objeto a ser salvo ou atualizado
$data = [
    'id' => 1, // Unique key
    'nome' => 'João',
    'idade' => 30
];

$db->saveOrUpdate('tabela_exemplo', $data, 'id');

?>
