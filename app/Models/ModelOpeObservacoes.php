<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelOpeObservacoes {

    private $Resultado;

    //Observações
    public function list() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT DISTINCT
                            DESCRICAO,
                            CASE
                                WHEN ID_ATIVO = 0 THEN 'table-status bg-pink'
                                WHEN ID_ATIVO = 1 THEN 'table-status bg-green'
                            END AS ID_ATIVO
                        FROM OBSERVACAO
                        ORDER BY DESCRICAO ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}