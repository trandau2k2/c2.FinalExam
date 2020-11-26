<?php


namespace Product\Model;

use PDO;

class DBconnect
{
    protected $dsn;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->dsn = 'mysql:host=localhost;dbname=product_management;charset=utf8';
        $this->username = 'root';
        $this->password = '123456';
    }

    function connectDB()
    {
        $connectDB = NULL;
        $connectDB = new PDO($this->dsn, $this->username, $this->password);
        return $connectDB;

    }
}