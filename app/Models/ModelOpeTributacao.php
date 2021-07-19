<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelOpeTributacao {

    private $Resultado;

    //Tributação
    public function list() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
                            TR.ID,
                            TR.DESCRICAO,
                            TR.SITUACAO || '-' || TR.ALIQUOTA AS TRIBUTACAO,
                            TR.CFOP,
                            TR.ALIQUOTA_BASE,
                            TR.REDUCAO_BASE,
                            TR.ID_PIS,
                            TR.ID_COFINS,
                            CB.CST,
                            CASE
                                WHEN TR.ID_ATIVO = 0 THEN 'table-status bg-pink'
                                WHEN TR.ID_ATIVO = 1 THEN 'table-status bg-green'
                            END AS ID_ATIVO
                        FROM TRIBUTACAO TR
                            INNER JOIN CST_B CB ON CB.ID = TR.ID_CST_B
                        ORDER BY TR.ID ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}