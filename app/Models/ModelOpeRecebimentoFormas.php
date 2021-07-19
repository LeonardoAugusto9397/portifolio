<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelOpeRecebimentoFormas {

    private $Resultado;

    //Recebimento Formas
    public function list() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
                            RF.ID,
                            RF.DESCRICAO,
                            RF.ATALHO,
                            RG.DESCRICAO AS GRUPO,
                            RF.QTDE_DIAS_RECEBIMENTO,
                            RF.TAXA_PERCENTUAL_RECEBIMENTO,
                            CASE
                                WHEN RF.ID_ATIVO = 0 THEN 'table-status bg-pink'
                                WHEN RF.ID_ATIVO = 1 THEN 'table-status bg-green'
                            END AS ID_ATIVO
                        FROM RECEBIMENTO_FORMAS RF
                            JOIN RECEBIMENTO_GRUPO RG ON RG.ID = RF.ID_RECEBIMENTO_GRUPO
                        ORDER BY RF.ID ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}