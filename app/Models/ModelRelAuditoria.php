<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelAuditoria {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function auditoria($Dados = null) {

        $this->Dados = $Dados;

        $data_inicio = $this->Dados['data_inicio'];
        $data_fim    = $this->Dados['data_fim'];
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
                            NEWTABLE.TIPO_DOCUMENTO,
                            NEWTABLE.DESCRICAO,
                            NEWTABLE.VALOR_TOTAL
                            FROM (SELECT DISTINCT CASE
                                WHEN (DFE.MODELO = 55) THEN 'NFE'
                                WHEN (DFE.MODELO = 59) THEN 'SAT'
                                WHEN (DFE.MODELO = 65) THEN 'NFCE'
                                WHEN (DFE.MODELO = 99) THEN 'MFE'
                                WHEN (SN.ID IS NOT NULL) THEN 'PED'
                            END AS TIPO_DOCUMENTO,
                            RF.DESCRICAO,
                            SUM(CRD.VALOR_RECEBIDO) AS VALOR_TOTAL
                        FROM DOCUMENTO_FISCAL_ELETRONICO DFE
                            JOIN CONTAS_RECEBIDAS CR ON CR.ID_DOCUMENTO_FISCAL_ELETRONICO = DFE.ID
                            JOIN CONTAS_RECEBIDAS_DETALHADA CRD ON CR.ID=CRD.ID_CONTAS_RECEBIDAS
                            JOIN RECEBIMENTO_FORMAS RF ON RF.ID = CRD.ID_RECEBIMENTO_FORMAS
                            JOIN CARTAO_MESA_LUGAR_CONTROLE CMLC ON CMLC.ID=CR.ID_CARTAO_MESA_LUGAR_CONTROLE
                            JOIN CARTAO_MESA_LUGAR CML ON CML.ID = CMLC.ID_CARTAO_MESA_LUGAR
                            JOIN CARTAO_MESA CM ON CM.ID = CML.ID_CARTAO_MESA
                            JOIN PERIODO P ON P.ID = DFE.ID_PERIODO
                            JOIN PDV_PERIODO PP ON PP.ID = P.ID_PDV_PERIODO
                            JOIN PDV PD ON PD.ID = P.ID_PDV
                            JOIN SISTEMA S ON S.ID = PD.ID_SISTEMA
                            LEFT JOIN CONTROLE_DELIVERY CD ON CD.ID_CARTAO_MESA_LUGAR_CONTROLE = CMLC.ID
                            LEFT JOIN SPED_NOTA SN ON SN.ID = CR.ID_SPED_NOTA AND (SN.CANCELADO = 0)
                        WHERE (P.DATA_MOVIMENTO BETWEEN '$data_inicio' AND '$data_fim')
                            AND (DFE.CODIGO_RETORNO) IN (100, 150, 6000)
                            AND (DFE.CANCELADO = 0) OR (DFE.ID IS NULL)
                            AND CD.STATUS = 7
                        GROUP BY 1,2
                        ORDER BY DESCRICAO ASC) AS NEWTABLE WHERE TIPO_DOCUMENTO IN('SAT','NFE','NFCE','PED','MFE')");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}