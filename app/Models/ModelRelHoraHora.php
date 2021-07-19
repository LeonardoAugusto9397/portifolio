<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelHoraHora {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function horaHora($Dados = null) {

        $this->Dados = $Dados;

        $data_inicio = $this->Dados['data_inicio'];
        $data_fim    = $this->Dados['data_fim'];
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
                            NEWTABLE.TIPO_DELIVERY,
                            NEWTABLE.HORA,
                            NEWTABLE.TOTAL,
                            NEWTABLE.QTDE,
                            NEWTABLE.TICKET_MEDIO
                        FROM (SELECT DISTINCT
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
                            END AS TIPO_DELIVERY,
                            EXTRACT(HOUR FROM CD.DATA_PRODUCAO) AS HORA,
                            COUNT(CD.DATA_PRODUCAO) AS QTDE,
                            SUM(CD.VALOR_CONTA) AS TOTAL,
                            SUM(CD.VALOR_CONTA) / (COUNT(CD.DATA_PRODUCAO)) AS TICKET_MEDIO
                        FROM CONTROLE_DELIVERY CD
                            JOIN CARTAO_MESA_LUGAR_CONTROLE CMLC ON CMLC.ID = CD.ID_CARTAO_MESA_LUGAR_CONTROLE
                            JOIN CONTAS_RECEBIDAS CR ON CR.ID_CARTAO_MESA_LUGAR_CONTROLE = CMLC.ID
                            JOIN PERIODO P ON P.ID = CMLC.ID_PERIODO
                            JOIN DOCUMENTO_FISCAL_ELETRONICO DFE ON DFE.ID = CR.ID_DOCUMENTO_FISCAL_ELETRONICO AND DFE.CODIGO_RETORNO IN (100, 150, -1, 6000) AND (DFE.CANCELADO = 0) OR (DFE.ID IS NULL)
                        WHERE (P.DATA_MOVIMENTO BETWEEN '$data_inicio' AND '$data_fim')
                            AND CD.STATUS = 7
                        GROUP BY 1,2) AS NEWTABLE");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}