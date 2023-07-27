<?php

namespace Core;

use PDO;

class Database
{
    public $connection;
    protected $statement;

    public function __construct($config, $username = 'root', $password = 'secret')
    {
        // one way to do it lets make it small and refactored i don't like putting dynamic value in string too stringy
        // $dsn = "mysql:host=localhost;port=3306;dbname=core_blog;user=root;charset=utf8mb4"; 

        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $param = [])
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($param);

        return $this;
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findAll()
    {
        return $this->statement->fetchAll();
    }

    public function findOrFail()
    {
        $result = $this->find();
        if (!$result) {
            Router::abort();
        }

        return $result;
    }
}
