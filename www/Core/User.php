<?php

namespace App\Core;

class User
{
    public function isLogged(): bool
    {
        if (session_status() == PHP_SESSION_NONE) {
            echo "Erreur : La session n'est pas activée";
            return false;
        }
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    public function logout(): void
    {
        if (isset($_SESSION['user'])) {
            session_unset();
            session_destroy();
        }
        header("location: /login");
    }
}