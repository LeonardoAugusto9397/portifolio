<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Home {

    private $Resultado;

    //Home
    public function list() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT * FROM ADMIN_CONFIG ORDER BY ID ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}