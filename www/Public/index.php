<?php

spl_autoload_register("autoloader");
function autoloader(string $class): void
{
    $pathClass = '../' . str_ireplace(["App\\", "\\"], ["", "/"], $class) . ".php";
    if (file_exists($pathClass)){
        include $pathClass;
    }
}


$uri = strtok(strtolower($_SERVER["REQUEST_URI"]),'?');
$uri = (strlen($uri) > 1) ? rtrim($uri, "/") : $uri;

if (file_exists('../routes.yml')) {
    $listOfRoutes = yaml_parse_file('../routes.yml');
} else {
    die("Erreur 404 : Le fichier de routing n'existe pas");
}

if (empty($listOfRoutes[$uri]) || empty($listOfRoutes[$uri]['controller']) || empty($listOfRoutes[$uri]['action'])) {
    die("Erreur 404 : La page n'existe pas");
}

$controller = $listOfRoutes[$uri]['controller'];
$action = $listOfRoutes[$uri]['action'];

if (!file_exists('../Controllers/' . $controller . '.php')) {
    die("Erreur 404 : Le fichier controller n'existe pas (../Controllers/" . $controller . ".php)");
}

require '../Controllers/' . $controller . '.php';
$controller = "\\App\\Controllers\\" . $controller;

if(!class_exists($controller)){
    die("Erreur : La classe controller n'existe pas (" . $controller . ")");

}

$objetController = new $controller();

if(!method_exists($objetController, $action)){
    die("Erreur : La methode controller n'existe pas (" . $action . ")");
}
$objetController->$action();
