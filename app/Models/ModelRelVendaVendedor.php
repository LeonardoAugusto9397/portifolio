<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelVendaVendedor {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function vendaVendedor($Dados = null) {

        $this->Dados = $Dados;

        $data_inicio = $this->Dados['data_inicio'];
        $data_fim    = $this->Dados['data_fim'];
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT DISTINCT
                            U.ID AS CODIGO,
                            U.LOGIN AS VENDEDOR,
                            PR.DESCRICAO AS PERFIL,
                            SUM(PC.QTDE) AS QTDE,
                            SUM(PC.VALOR_TOTAL - PC.VALOR_SERVICO) AS VALOR_TOTAL
                        FROM PEDIDO_CONCOMITANTE PC
                            JOIN USUARIO U ON U.ID = PC.ID_USUARIO_VENDEDOR
                            JOIN USUARIO_PERFIL UP ON UP.ID_USUARIO = U.ID
                            JOIN PROFILE PR ON PR.ID = UP.ID_PROFILE
                            LEFT JOIN DOCUMENTO_FISCAL_ELETRONICO DFE ON DFE.ID = PC.ID_DOCUMENTO_FISCAL_ELETRONICO AND DFE.CODIGO_RETORNO IN (100, 150, -1, 6000) AND (DFE.CANCELADO = 0) OR (DFE.ID IS NULL)
                            LEFT JOIN SPED_NOTA SN ON SN.ID = PC.ID_SPED_NOTA AND (SN.CANCELADO = 0)
                            JOIN PERIODO P ON P.ID = DFE.ID_PERIODO
                        WHERE (P.DATA_MOVIMENTO BETWEEN '$data_inicio' AND '$data_fim')
                            AND (PC.KIT NOT IN (2,4))
                            AND (PC.VALOR_TOTAL > 0)
                            AND (PC.CANCELADO = 0)
                            AND (PC.ID_PEDIDO_EXCLUIDO IS NULL)
                            AND (PR.ID_SISTEMA NOT IN (13))
                        GROUP BY 1,2,3
                        ORDER BY SUM(PC.VALOR_TOTAL) DESC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}