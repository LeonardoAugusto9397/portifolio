<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelConfBanco {

    private $Resultado;
    private $id_banco;

    //Banco De Dados LISTA
    public function list() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT * FROM ADMIN_CONFIG ORDER BY ID ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }

    //Banco De Dados EDITA
    public function edit($id_banco) {

        $this->id_banco = (int) $id_banco;
        $edit = new \Sts\Models\helper\Read();
        $edit->tRead("SELECT * FROM ADMIN_CONFIG WHERE ID=".$this->id_banco."");

        $this->Resultado = $edit->getResultado();
        return $this->Resultado;
    }
}