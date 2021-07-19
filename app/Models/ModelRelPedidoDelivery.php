<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelPedidoDelivery {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function pedidoDelivery($Dados = null) {

        $this->Dados = $Dados;

        $data_inicio = $this->Dados['data_inicio'];
        $data_fim    = $this->Dados['data_fim'];
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT DISTINCT
                            CD.DATA_PRODUCAO AS DATA,
                            CD.SEQ_CENTRAL AS CONTROLE,
                            ESC.NOME AS CLIENTE,
                            CD.TELEFONE_RESIDENCIAL || ' ' || CD.TELEFONE_COMERCIAL || ' ' || CD.TELEFONE_MOVEL AS TELEFONE,
                            CD.VALOR_TAXA,
                            CD.VALOR_CONTA,
                            CASE
                                WHEN (CD.TIPO_DELIVERY = 0) THEN 'DELIVERY'
                                WHEN (CD.TIPO_DELIVERY = 1) THEN 'TOGO'
                                WHEN (CD.TIPO_DELIVERY = 2) THEN 'LOJA'
                                WHEN (CD.TIPO_DELIVERY = 3) THEN 'IFOOD'
                                WHEN (CD.TIPO_DELIVERY = 4) THEN 'IFOOD TOGO'
                                WHEN (CD.TIPO_DELIVERY = 5) THEN 'ECOMMERCE'
                                WHEN (CD.TIPO_DELIVERY = 6) THEN 'ECOMMERCE TOGO'
                                WHEN (CD.TIPO_DELIVERY = 7) THEN 'TOGO UBER'
                                WHEN (CD.TIPO_DELIVERY = 8) THEN 'TOGO RAPPI'
                                WHEN (CD.TIPO_DELIVERY = 9) THEN 'PEDIDOS JA'
                                WHEN (CD.TIPO_DELIVERY = 10) THEN 'PEDIDOS JA TOGO'
                            END AS TIPO_DELIVERY
                        FROM CONTROLE_DELIVERY CD
                            JOIN ECF_SAT_CLIENTE ESC ON ESC.ID = CD.ID_ECF_SAT_CLIENTE
                            JOIN CARTAO_MESA_LUGAR_CONTROLE CMLC ON CMLC.ID = CD.ID_CARTAO_MESA_LUGAR_CONTROLE
                            JOIN CONTAS_RECEBIDAS CR ON CR.ID_CARTAO_MESA_LUGAR_CONTROLE = CMLC.ID
                            JOIN PERIODO P ON P.ID = CMLC.ID_PERIODO
                            JOIN DOCUMENTO_FISCAL_ELETRONICO DFE ON DFE.ID = CR.ID_DOCUMENTO_FISCAL_ELETRONICO AND DFE.CODIGO_RETORNO IN (100, 150, -1, 6000) AND (DFE.CANCELADO = 0) OR (DFE.ID IS NULL)
                        WHERE (P.DATA_MOVIMENTO BETWEEN '$data_inicio' AND '$data_fim')
                            AND CD.STATUS = 7
                        ORDER BY DATA_PRODUCAO ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}