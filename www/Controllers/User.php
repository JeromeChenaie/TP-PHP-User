<?php

namespace App\Controllers;
use App\Core\View;
use App\Core\User as CoreUser;

class User
{
    public function register(): void
    {

    }

    public function login(): void
    {
        $view = new View("User/login.php", "front.php");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $view->addData('erreur', 'Tous les champs sont obligatoires.');
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $view->addData('erreur', "L'email n'est pas valide.");
                return;
            }

            $sql = new \App\Core\SQL();
            $user = $sql->getOneByEmail($email);
            if ($user && password_verify($password, $user['password'])) {

                session_start();
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                ];

                header("Location: /");
                exit;
            } else {
                $view->addData('erreur', 'tout est incorrect.');
            }
        }
    }

    public function logout(): void
    {
        $user = new CoreUser;
        $user->logout();
        //header("Location: /");
    }
}