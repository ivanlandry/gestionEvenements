<?php
class DbConnection{
    private $dbname;
    private $username;
    private $password;
    private $pdo;
    public function __construct($dbname,$username,$password){
        $this->dbname=$dbname;
        $this->username=$username;
        $this->password=$password;

    }

    public function getPDo(){
        if ($this->pdo==null){
            $this->pdo = new PDO("mysql:host=localhost;dbname={$this->dbname};charset=utf8",$this->username,$this->password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }
        return $this->pdo;
    }

}