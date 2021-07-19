<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelProdutoAbc {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function produtoAbc($Dados = null) {
        
        $this->Dados = $Dados;

        $data_inicio = $this->Dados['data_inicio'];
        $data_fim    = $this->Dados['data_fim'];
        $pdv         = $this->Dados['pdv'];
        $pdv_numero  = $this->Dados['pdv_numero'];

        $sql = "SELECT DISTINCT
                    PC.DESCRICAO_AUX AS DESCRICAO,
                    SUM(PC.QTDE) AS QTDE,
                    SUM(PC.VALOR_SERVICO) AS VALOR_SERVICO,
                    SUM(PC.VALOR_DESCONTO) AS VALOR_DESCONTO,
                    SUM(PC.VALOR_TOTAL) AS VALOR_TOTAL
                FROM PEDIDO_CONCOMITANTE PC
                    LEFT JOIN DOCUMENTO_FISCAL_ELETRONICO DFE ON DFE.ID = PC.ID_DOCUMENTO_FISCAL_ELETRONICO AND DFE.CODIGO_RETORNO IN (100, 150, 6000) AND (DFE.CANCELADO = 0)
                    LEFT JOIN SPED_NOTA SN ON SN.ID = PC.ID_SPED_NOTA AND (SN.CANCELADO = 0)
                    JOIN PDV ON PDV.ID = DFE.NUMERO_CAIXA
                    JOIN PERIODO P ON P.ID = DFE.ID_PERIODO
                    /*JOIN PDV_PERIODO PP ON PP.ID_PDV = PDV.ID*/
                WHERE (P.DATA_MOVIMENTO BETWEEN '$data_inicio' AND '$data_fim')";
                    if ($pdv != '') {
                        $sql .= "AND (PDV.ID = $pdv)";
                    }
                    if ($pdv_numero != '') {
                        $sql .= "AND (PDV.NUMERO = $pdv_numero)";
                    }
                    $sql .= "AND (PC.KIT NOT IN (2,4))
                    AND (PC.VALOR_TOTAL > 0)
                    AND (PC.CANCELADO = 0)
                    AND (PC.ID_PEDIDO_EXCLUIDO IS NULL)
                GROUP BY 1
                ORDER BY SUM(PC.VALOR_TOTAL) DESC";
    
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead($sql);
                        
        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}