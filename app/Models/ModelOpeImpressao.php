<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelOpeImpressao {

    private $Resultado;

    //Fila Impressão
    public function list() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
                            FI.ID,
                            FI.DESCRICAO,
                            FI.FILA,
                            IP.DESCRICAO AS IMPRESSORA,
                            CASE
                                WHEN FI.ID_ATIVO = 0 THEN 'table-status bg-pink'
                                WHEN FI.ID_ATIVO = 1 THEN 'table-status bg-green'
                            END AS ID_ATIVO
                        FROM FILA_IMPRESSAO FI
                            INNER JOIN IMPRESSORA IP ON IP.ID = FI.ID_IMPRESSORA
                        ORDER BY FI.ID ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}