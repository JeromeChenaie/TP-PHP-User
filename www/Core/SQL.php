<?php

namespace App\Core;

class SQL
{
    private $pdo;

    public function __construct(){
        try{
            $this->pdo = new \PDO("mysql:host=mariadb;dbname=esgi","esgi","esgipwd");
        }catch(\Exception $e){
            die("Erreur SQL ".$e->getMessage());
        }
    }

    public function getOneById(string $table, int $id): array{
        $queryPrepared = $this->pdo->prepare("SELECT * FROM ".$table." WHERE id= :id");
        $queryPrepared->execute([
            "id"=>$id
        ]);
        return $queryPrepared->fetch();
    }

    

    public function createUser(string $username, string $email, string $password): bool{
        try {
            $queryPrepared = $this->pdo->prepare("
                INSERT INTO USER (username, email, password) 
                VALUES (:username, :email, :password)
            ");
            
            return $queryPrepared->execute([
                "username" => $username,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT)
            ]);
        } catch (\Exception $e) {
            echo "Erreur, veuillez réessayer : " . $e->getMessage();
            return false;
        }
    }

    public function getOneByEmail(string $email): ?array{
        $queryPrepared = $this->pdo->prepare("SELECT * FROM USER WHERE email = :email");
        $queryPrepared->execute([
            "email" => $email
        ]);
        $result = $queryPrepared->fetch();
        return $result ?: null;
    }

}
