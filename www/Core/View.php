<?php

namespace App\Core;
class View
{
    private string $view;
    private string $template;
    private array $data = [];

    public function __construct(string $view, string $template = "front.php") {
        $this->view = $view;
        $this->template = $template;
    }

    public function addData(string $key, string $value) {
        $this->data[$key] = $value;
    }

    public function __toString() {
        return "Voici la vue utilisée : " . $this->view . " et le template : " . $this->template;
    }

    public function __destruct() {
        extract($this->data);
        include '../Views/' . $this->template;
    }
}