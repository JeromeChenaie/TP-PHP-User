<?php

namespace App\Controllers;

use App\Core\View;

class Main
{
    public function home(): void
    {
        session_start();
        if (!isset($_SESSION['user'])){
            header('Location: /');
            exit;
        }

        $view = new View("Main/home.php");
    }
}