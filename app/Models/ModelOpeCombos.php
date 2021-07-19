<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelOpeCombos {

    private $Resultado;

    //Combos
    public function list() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}