<?php

namespace App\Controllers;
use App\Core\SQL;
use App\Core\View;
use App\Core\User as CoreUser;

class User
{
    public function register(): void
    {

    }

    public function login(): void
    {


        if (!empty($_POST)) {

            $userValidator = new \App\Core\UserValidator();

            $userValidator->cleanAndCheckEmail($_POST['email']);

            if (!empty($userValidator->errors)) {
                $view = new View("User/login.php");
                $view->addData("title", "Connexion");
                $view->addData("description", "Page de connexion du site");

                $view->addData("errors", $userValidator->errors);
            } else {
                $sql = new SQL();
                $user = $sql->getOneByEmail($_POST['email']);
                if (password_verify($_POST['password'], $user['password'])) {
                    session_start();
                    $_SESSION['user'] = $user;

                    header("Location: /");
                    exit;
                }
            }
        }

        $view = new View("User/login.php", "front.php");
        $view->addData("title", "Connexion");
        $view->addData("description", "Page de connexion du site");
    }

    public function logout(): void
    {
        $user = new CoreUser;
        $user->logout();
        //header("Location: /");
    }
}