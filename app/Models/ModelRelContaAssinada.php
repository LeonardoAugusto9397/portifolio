<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelContaAssinada {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function contaAssinada($Dados = null) {

        $this->Dados = $Dados;

        $data_inicio = $this->Dados['data_inicio'];
        $data_fim    = $this->Dados['data_fim'];
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
                            NEWTABLE.NOME_CLIENTE,
                            NEWTABLE.DATA_HORA_RECEBIMENTO,
                            NEWTABLE.TIPO_DOCUMENTO,
                            NEWTABLE.AREA,
                            NEWTABLE.NUMERO_DOCUMENTO,
                            NEWTABLE.NUMERO_DOCUMENTO_BUSCA,
                            NEWTABLE.MESA,
                            SUM(NEWTABLE.SOMA_PRODUTOS) AS SOMA_PRODUTOS,
                            SUM(NEWTABLE.VALOR_SERVICO) AS VALOR_SERVICO,
                            SUM(NEWTABLE.VALOR_SERVICO_NAO_PAGO) AS VALOR_SERVICO_NAO_PAGO,
                            SUM(NEWTABLE.VALOR_DESCONTO) AS VALOR_DESCONTO,
                            SUM(NEWTABLE.VALOR_ENTREGA) AS VALOR_ENTREGA,
                            SUM(NEWTABLE.VALOR_TOTAL) AS VALOR_TOTAL,
                            SUM(NEWTABLE.VALOR_TROCO) AS VALOR_TROCO,
                            SUM(NEWTABLE.VALOR_REPIQUE) AS VALOR_REPIQUE
                        FROM (SELECT
                            ESCC.NOME AS NOME_CLIENTE,
                            CR.DATA_HORA_RECEBIMENTO, 
                        CASE
                            WHEN (DFE.MODELO = 55 ) THEN 'NFE'
                            WHEN (DFE.MODELO = 59 ) THEN 'SAT'
                            WHEN (DFE.MODELO = 65 ) THEN 'NFCE'
                            WHEN (DFE.MODELO = 99 ) THEN 'MFE'
                            WHEN (SN.ID IS NOT NULL) THEN 'PED'
                            WHEN (DFE.MODELO = 60) THEN 'ECF'
                        END AS TIPO_DOCUMENTO,CASE WHEN CM.ID_CARTAO_MESA_EXTERNO BETWEEN 1 AND  9999 THEN 'SALAO' END AS AREA,
                        CASE
                            WHEN (DFE.MODELO = 55 ) THEN DFE.NUMERO_CFE
                            WHEN (DFE.MODELO = 59 ) THEN DFE.NUMERO_CFE
                            WHEN (DFE.MODELO = 65 ) THEN DFE.NUMERO_CFE
                            WHEN (DFE.MODELO = 99 ) THEN DFE.NUMERO_CFE
                            WHEN (SN.ID IS NOT NULL) THEN SN.NUMERO
                            WHEN (DFE.MODELO = 60) THEN DFE.NUMERO_CFE
                        END AS NUMERO_DOCUMENTO,
                        CASE
                            WHEN (DFE.MODELO = 55 ) THEN DFE.NUMERO_CFE
                            WHEN (DFE.MODELO = 59 ) THEN DFE.NUMERO_CFE
                            WHEN (DFE.MODELO = 65 ) THEN DFE.NUMERO_CFE
                            WHEN (DFE.MODELO = 99 ) THEN DFE.NUMERO_CFE
                            WHEN (SN.ID IS NOT NULL) THEN SN.NUMERO
                            WHEN (DFE.MODELO = 60) THEN  DFE.NUMERO_CFE
                        END AS NUMERO_DOCUMENTO_BUSCA, CM.ID_CARTAO_MESA_EXTERNO AS MESA,
                            SUM(CR.SOMA_PRODUTOS) AS SOMA_PRODUTOS,
                            SUM(CR.VALOR_SERVICO) AS VALOR_SERVICO,
                            SUM(CR.VALOR_SERVICO_NAO_PAGO) AS VALOR_SERVICO_NAO_PAGO,
                            SUM(CR.VALOR_DESCONTO) AS VALOR_DESCONTO,
                            SUM(CR.VALOR_ENTREGA) AS VALOR_ENTREGA,
                            SUM(CR.VALOR_TOTAL) AS VALOR_TOTAL,
                            SUM(CR.VALOR_TROCO) AS VALOR_TROCO,
                            SUM(CR.VALOR_REPIQUE) AS VALOR_REPIQUE
                        FROM CONTAS_RECEBIDAS CR
                            JOIN CONTAS_RECEBIDAS_DETALHADA CRD ON CRD.ID_CONTAS_RECEBIDAS = CR.ID
                            JOIN CARTAO_MESA_LUGAR_CONTROLE CMLC ON CMLC.ID=CR.ID_CARTAO_MESA_LUGAR_CONTROLE
                            JOIN CARTAO_MESA_LUGAR CML ON CML.ID = CMLC.ID_CARTAO_MESA_LUGAR
                            JOIN CARTAO_MESA CM ON CM.ID = CML.ID_CARTAO_MESA
                            JOIN ECF_SAT_CLIENTE ESCC ON ESCC.ID = CR.ID_ECF_SAT_CLIENTE
                            LEFT JOIN RECEBIMENTO_FORMAS RF ON RF.ID = CRD.ID_RECEBIMENTO_FORMAS
                            LEFT JOIN CONTROLE_DELIVERY CD ON CD.ID_CARTAO_MESA_LUGAR_CONTROLE = CMLC.ID
                            LEFT JOIN DOCUMENTO_FISCAL_ELETRONICO DFE ON DFE.ID = CR.ID_DOCUMENTO_FISCAL_ELETRONICO AND DFE.CODIGO_RETORNO IN (100, 150, 6000) AND (DFE.CANCELADO = 0)
                            LEFT JOIN SPED_NOTA SN ON SN.ID = CR.ID_SPED_NOTA AND (SN.CANCELADO = 0)
                            JOIN PERIODO P ON P.ID = DFE.ID_PERIODO
                            JOIN PDV_PERIODO PP ON PP.ID=P.ID_PDV_PERIODO
                            JOIN PDV ON PDV.ID = P.ID_PDV
                        WHERE (P.DATA_MOVIMENTO BETWEEN '$data_inicio' AND '$data_fim')
                            AND RF.DESCRICAO LIKE 'ASSINAD%'
                        GROUP BY 1,2,3,4,5,6,7 
                        ORDER BY 1,2) AS NEWTABLE GROUP BY 1,2,3,4,5,6,7");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}