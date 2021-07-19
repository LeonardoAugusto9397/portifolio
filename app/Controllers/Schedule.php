<?php
namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Schedule {

    private $Dados;

    //Calendário
    public function list() {

        $listar = new \Sts\Models\ModelPesPerfil();
        $this->Dados['PROFILE'] = $listar->list();
        
        $carregarView = new \Core\ConfigView("Views/schedule/schedule", $this->Dados);
        $carregarView->pageCalendar();
    }
}