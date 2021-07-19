<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelOpeEventos {

    private $Resultado;

    //Eventos
    public function list() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}