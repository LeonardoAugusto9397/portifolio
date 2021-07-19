<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelProdutoTransferencia {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function produtoTransferencia($Dados = null) {

        $this->Dados = $Dados;

        $data_inicio = $this->Dados['data_inicio'];
        $data_fim    = $this->Dados['data_fim'];
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT DISTINCT
                            PT.DATA_HORA_TRANSFERENCIA,
                            CM.ID_CARTAO_MESA_EXTERNO AS MESA_ORIGEM,
                            CMD.ID_CARTAO_MESA_EXTERNO AS MESA_DESTINO,
                            PC.ID_PRODUTO_FILIAL,
                            PC.DESCRICAO_AUX AS PRODUTO,
                            PT.QTDE,
                            PT.VALOR_TOTAL,
                            UV.LOGIN AS VENDEDOR,
                            UA.LOGIN AS AUTORIZADOR,
                            MT.DESCRICAO AS MOTIVO
                        FROM PEDIDO_TRANSFERENCIA PT
                            JOIN PEDIDO_CONCOMITANTE PC ON PC.ID_PEDIDO = PT.ID_PEDIDO
                            JOIN CARTAO_MESA_LUGAR_CONTROLE CMLC ON CMLC.ID = PT.ID_CRT_MS_LGR_CNTRL_ORIGEM
                            JOIN CARTAO_MESA_LUGAR CML ON CML.ID = CMLC.ID_CARTAO_MESA_LUGAR
                            JOIN CARTAO_MESA CM ON CM.ID = CML.ID_CARTAO_MESA
                            JOIN CARTAO_MESA_LUGAR_CONTROLE CMLCD ON CMLCD.ID = PT.ID_CRT_MS_LGR_CNTRL_DESTINO
                            JOIN CARTAO_MESA_LUGAR CMLD ON CMLD.ID = CMLCD.ID_CARTAO_MESA_LUGAR
                            JOIN CARTAO_MESA CMD ON CMD.ID = CMLD.ID_CARTAO_MESA
                            JOIN PERIODO P ON P.ID = CMLC.ID_PERIODO
                            JOIN PDV_PERIODO PP ON PP.ID = P.ID_PDV_PERIODO
                            JOIN PDV ON PDV.ID = P.ID_PDV
                            JOIN USUARIO UV ON UV.ID = PC.ID_USUARIO_VENDEDOR
                            JOIN USUARIO UA ON UA.ID = PT.ID_USUARIO_AUTORIZACAO
                            JOIN MOTIVO MT ON MT.ID = PT.ID_MOTIVO
                            LEFT JOIN DOCUMENTO_FISCAL_ELETRONICO DFE ON DFE.ID = PC.ID_DOCUMENTO_FISCAL_ELETRONICO AND DFE.CODIGO_RETORNO IN (100, 150, 6000) AND (DFE.CANCELADO = 0)
                            LEFT JOIN SPED_NOTA SN ON SN.ID = PC.ID_SPED_NOTA AND (SN.CANCELADO = 0)
                        WHERE (CAST(PT.DATA_HORA_TRANSFERENCIA AS DATE) BETWEEN '$data_inicio' AND '$data_fim')
                            AND (PC.KIT NOT IN (1,2,4,6))
                        ORDER BY PT.DATA_HORA_TRANSFERENCIA ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}