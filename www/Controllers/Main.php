<?php

namespace App\Controllers;

use App\Core\View;

class Main
{

    public function home():void
    {
        session_start();
        var_dump($_SESSION);
        if (!isset($_SESSION['user'])){
            header('Location: /login');
            exit;
        }

        $username = $_SESSION['user']['username'];
        $view = new View("Main/home.php");
        $view->addData("Nom :", $username);


    }

}
