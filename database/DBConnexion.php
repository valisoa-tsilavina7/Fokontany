<?php
namespace Database;

use PDO;

class DBconnexion
{

    private string $dbname;
    private string $host;
    private string $username;
    private $password;
    private $pdo;


    public function __construct( string $dbname,string $host,string $username, $password)
    {
        $this->dbname=$dbname;
        $this->host=$host;
        $this->username=$username;
        $this->password=$password;

    }

    public function getPdo(): PDO
    {
        if($this->pdo===null)
        {
            $this->pdo=new PDO("mysql:dbname={$this->dbname};host={$this->host}",$this->username,$this->password,
        [
            PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
        }
        return $this->pdo;
    }



}




   //LE GET PDO
   
   

