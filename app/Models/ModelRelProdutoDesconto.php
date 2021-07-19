<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelProdutoDesconto {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function produtoDesconto($Dados = null) {

        $this->Dados = $Dados;

        $data_inicio = $this->Dados['data_inicio'];
        $data_fim    = $this->Dados['data_fim'];
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT DISTINCT
                            PD.DATA_HORA_DESCONTO,
                            CM.ID_CARTAO_MESA_EXTERNO AS MESA,
                            PC.DESCRICAO_AUX AS PRODUTO,
                            PD.QTDE,
                            PD.VALOR_DESCONTO,
                            UV.LOGIN AS VENDEDOR,
                            UA.LOGIN AS AUTORIZADOR,
                            MT.DESCRICAO AS MOTIVO
                        FROM PEDIDO_DESCONTO PD
                            JOIN CARTAO_MESA_LUGAR_CONTROLE CMLC ON CMLC.ID = PD.ID_CARTAO_MESA_LUGAR_CONTROLE
                            JOIN CARTAO_MESA_LUGAR CML ON CML.ID = CMLC.ID_CARTAO_MESA_LUGAR
                            JOIN CARTAO_MESA CM ON CM.ID = CML.ID_CARTAO_MESA
                            JOIN PEDIDO_CONCOMITANTE PC ON PC.ID_CARTAO_MESA_LUGAR_CONTROLE = PD.ID_CARTAO_MESA_LUGAR_CONTROLE
                            JOIN PERIODO P ON P.ID = CMLC.ID_PERIODO
                            JOIN USUARIO UV ON UV.ID = PC.ID_USUARIO_VENDEDOR
                            JOIN USUARIO UA ON UA.ID = PD.ID_USUARIO_AUTORIZACAO
                            JOIN MOTIVO MT ON MT.ID = PD.ID_MOTIVO
                            LEFT JOIN DOCUMENTO_FISCAL_ELETRONICO DFE ON DFE.ID = PC.ID_DOCUMENTO_FISCAL_ELETRONICO AND DFE.CODIGO_RETORNO IN (100, 150, 6000) AND (DFE.CANCELADO = 0)
                            LEFT JOIN SPED_NOTA SN ON SN.ID = PC.ID_SPED_NOTA AND (SN.CANCELADO = 0)
                        WHERE (CAST(PD.DATA_HORA_DESCONTO AS DATE) BETWEEN '$data_inicio' AND '$data_fim')
                            AND (PC.KIT NOT IN (1,2,4,6))
                        ORDER BY PD.DATA_HORA_DESCONTO ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}