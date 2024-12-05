<?php

namespace App\Controllers;

use App\Core\View;

class Main
{
    public function home(): void
    {
        session_start();
        if (!isset($_SESSION['user'])){
            header('Location: /login');
            exit;
        }

        $view = new View("Main/home.php");
        $view->addData("title", "Accueil");
        $view->addData("description", "Voici la page d'accueil du site");
    }
}