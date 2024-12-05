<?php

namespace App\Core;

class SQL
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO("mysql:host=mariadb;dbname=esgi","esgi","esgipwd");
            $this->createUserTable();
        } catch(\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function createUserTable(): bool
    {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS USER(
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    email VARCHAR(255) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    firstname VARCHAR(100) NOT NULL,
                    lastname VARCHAR(100) NOT NULL,
                    country CHAR(2) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                );";

            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute();
            return true;
        } catch (\Exception $e) {
            echo "Erreur SQL : " . $e->getMessage();
            return false;
        }
    }

    public function createUser(array $userData): bool
    {
        try {
            $queryPrepared = $this->pdo->prepare("
                INSERT INTO USER (email, password, firstname, lastname, country) 
                VALUES (:email, :password, :firstname, :lastname, :country)
            ");
            
            return $queryPrepared->execute([
                "email" => $userData["email"],
                "password" => password_hash($userData["password"], PASSWORD_DEFAULT),
                "firstname" => $userData["firstname"],
                "lastname" => $userData["lastname"],
                "country" => $userData["country"]
            ]);
        } catch (\Exception $e) {
            echo "Erreur lors de l'ajout : " . $e->getMessage();
            return false;
        }
    }

    public function getOneByEmail(string $email): ?array
    {
        $queryPrepared = $this->pdo->prepare("SELECT * FROM USER WHERE email = :email");
        $queryPrepared->execute([
            "email" => $email
        ]);
        $result = $queryPrepared->fetch();
        return $result ?: null;
    }

}
