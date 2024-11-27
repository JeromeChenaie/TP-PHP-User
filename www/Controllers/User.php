<?php

namespace App\Controllers;

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

    }

    public function logout():void
    {

    }
}