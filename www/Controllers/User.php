<?php

namespace App\Controllers;
use App\Core\SQL;
use App\Core\View;
use App\Core\User as CoreUser;

use App\Core\View;

class User
{
    public function register(): void
    {

        if (!empty($_POST)) {

            $userValidator = new \App\Core\UserValidator();

            $userValidator->cleanAndCheckEmail($_POST['email']);
            $userValidator->cleanAndCheckFirstname($_POST['firstname']);
            $userValidator->cleanAndCheckLastname($_POST['lastname']);
            $userValidator->cleanAndCheckCountry($_POST['country']);
            $userValidator->checkPassword($_POST['password'], $_POST['passwordConfirm']);

            if (!empty($userValidator->errors)) {
                $view = new View("User/register.php");
                $view->addData("title", "Inscription");
                $view->addData("description", "Page d'inscription du site");

                $view->addData("errors", $userValidator->errors);
                $view->addData("lastData", $userValidator->lastData);
            } else {
                // TODO: Ajout en BDD
            }

        } else {
            $view = new View("User/register.php");
            $view->addData("title", "Inscription");
            $view->addData("description", "Page d'inscription du site");
        }
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