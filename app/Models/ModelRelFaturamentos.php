<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelFaturamentos {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function faturamentos($Dados = null) {

        $this->Dados = $Dados;

        $data_inicio = $this->Dados['data_inicio'];
        $data_fim    = $this->Dados['data_fim'];
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
                            P.DATA_MOVIMENTO AS DATA,
                            EXTRACT(DAY FROM P.DATA_MOVIMENTO) AS DIA,
                            EXTRACT(MONTH FROM P.DATA_MOVIMENTO) AS MES,
                            (CASE EXTRACT(MONTH FROM P.DATA_MOVIMENTO)
                                WHEN 1 THEN 'JAN'
                                WHEN 2 THEN 'FEV'
                                WHEN 3 THEN 'MAR'
                                WHEN 4 THEN 'ABR'
                                WHEN 5 THEN 'MAI'
                                WHEN 6 THEN 'JUN'
                                WHEN 7 THEN 'JUL'
                                WHEN 8 THEN 'AGO'
                                WHEN 9 THEN 'SET'
                            END) AS MES_ABREV,
                            SUM(CRD.VALOR_RECEBIDO) AS VALOR_TOTAL
                        FROM DOCUMENTO_FISCAL_ELETRONICO DFE
                            JOIN CONTAS_RECEBIDAS CR ON CR.ID_DOCUMENTO_FISCAL_ELETRONICO = DFE.ID
                            JOIN CONTAS_RECEBIDAS_DETALHADA CRD ON CRD.ID_CONTAS_RECEBIDAS = CR.ID
                            JOIN CARTAO_MESA_LUGAR_CONTROLE CMLC ON CMLC.ID = CR.ID_CARTAO_MESA_LUGAR_CONTROLE
                            JOIN PERIODO P ON P.ID = DFE.ID_PERIODO
                            LEFT JOIN CONTROLE_DELIVERY CD ON CD.ID_CARTAO_MESA_LUGAR_CONTROLE = CMLC.ID
                            LEFT JOIN SPED_NOTA SN ON SN.ID = CR.ID_SPED_NOTA AND (SN.CANCELADO = 0)
                        WHERE (P.DATA_MOVIMENTO BETWEEN '$data_inicio' AND '$data_fim')
                            AND (DFE.CODIGO_RETORNO) IN (100, 150, 6000)
                            AND (DFE.CANCELADO = 0) OR (DFE.ID IS NULL)
                            AND CD.STATUS = 7
                        GROUP BY 1,2,3,4
                        ORDER BY DIA ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}