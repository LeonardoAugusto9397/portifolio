<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelProdutoCancelado {

    private $Resultado;
    private $Dados;

    function getResultado() {
        return $this->Resultado;
    }

    public function produtoCancelado($Dados = null) {

        $this->Dados = $Dados;

        $data_inicio = $this->Dados['data_inicio'];
        $data_fim    = $this->Dados['data_fim'];
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT DISTINCT
                            PE.DATA_HORA_EXCLUSAO,
                            CM.ID_CARTAO_MESA_EXTERNO AS MESA,
                            PE.DESCRICAO_AUX AS PRODUTO,
                            UV.LOGIN AS VENDEDOR,
                            UA.LOGIN AS AUTORIZADOR,
                            MT.DESCRICAO AS MOTIVO,
                            PE.QTDE AS QTDE,
                            PE.VALOR_TOTAL AS VALOR_TOTAL
                        FROM PEDIDO_EXCLUIDO PE
                            JOIN CARTAO_MESA_LUGAR_CONTROLE CMLC ON CMLC.ID = PE.ID_CARTAO_MESA_LUGAR_CONTROLE
                            JOIN CARTAO_MESA_LUGAR CML ON CML.ID = CMLC.ID_CARTAO_MESA_LUGAR
                            JOIN CARTAO_MESA CM ON CM.ID = CML.ID_CARTAO_MESA
                            JOIN USUARIO UV ON UV.ID = PE.ID_USUARIO_VENDEDOR
                            JOIN USUARIO UA ON UA.ID = PE.ID_USUARIO_AUTORIZACAO
                            JOIN MOTIVO MT ON MT.ID = PE.ID_MOTIVO
                        WHERE (CAST(PE.DATA_HORA_EXCLUSAO AS DATE) BETWEEN '$data_inicio' AND '$data_fim')
                        ORDER BY PE.DATA_HORA_EXCLUSAO ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}