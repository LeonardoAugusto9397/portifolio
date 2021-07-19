<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelProdGrupo {

    private $Resultado;

    //Grupo
    public function list() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT DISTINCT
                            DESCRICAO,
                            CASE
                                WHEN ID_ATIVO = 0 THEN 'table-status bg-pink'
                                WHEN ID_ATIVO = 1 THEN 'table-status bg-green'
                            END AS ID_ATIVO
                        FROM GRUPO
                        ORDER BY ID ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}