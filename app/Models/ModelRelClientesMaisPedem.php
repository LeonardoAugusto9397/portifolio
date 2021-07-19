<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelClientesMaisPedem {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function clientesMaisPedem($Dados = null) {

        $this->Dados = $Dados;

        $data_inicio = $this->Dados['data_inicio'];
        $data_fim    = $this->Dados['data_fim'];
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT DISTINCT
                            ESC.NOME AS CLIENTE,
                            CD.TELEFONE_RESIDENCIAL || ' ' || CD.TELEFONE_COMERCIAL || ' ' || CD.TELEFONE_MOVEL AS TELEFONE,
                            COUNT(ESC.NOME) AS QTDE,
                            SUM(CD.VALOR_TAXA) AS VALOR_TAXA,
                            SUM(CD.VALOR_CONTA) AS VALOR_CONTA
                        FROM CONTROLE_DELIVERY CD
                            JOIN ECF_SAT_CLIENTE ESC ON ESC.ID = CD.ID_ECF_SAT_CLIENTE
                            JOIN CARTAO_MESA_LUGAR_CONTROLE CMLC ON CMLC.ID = CD.ID_CARTAO_MESA_LUGAR_CONTROLE
                            JOIN CONTAS_RECEBIDAS CR ON CR.ID_CARTAO_MESA_LUGAR_CONTROLE = CMLC.ID
                            JOIN PERIODO P ON P.ID = CMLC.ID_PERIODO
                            JOIN DOCUMENTO_FISCAL_ELETRONICO DFE ON DFE.ID = CR.ID_DOCUMENTO_FISCAL_ELETRONICO AND DFE.CODIGO_RETORNO IN (100, 150, -1, 6000) AND (DFE.CANCELADO = 0) OR (DFE.ID IS NULL)
                        WHERE (P.DATA_MOVIMENTO BETWEEN '$data_inicio' AND '$data_fim')
                            AND CD.STATUS = 7
                        GROUP BY 1,2
                        ORDER BY SUM(CD.VALOR_CONTA) DESC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}