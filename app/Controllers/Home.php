<?php
namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Home {

    private $Dados;

    public function index() {

        $listar = new \Sts\Models\Home();
        $this->Dados['ADMIN_CONFIG'] = $listar->list();
        
        $carregarView = new \Core\ConfigView("Views/home/home", $this->Dados);
        $carregarView->pageDefault();
    }
}