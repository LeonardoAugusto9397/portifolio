<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelFiscal {

    private $Resultado;
    private $Dados;
    private $id_documento_fiscal;

    function getResultado() {
        return $this->Resultado;
    }

    //Documentos Fiscais
    public function documentosFiscais($Dados = null) {

        $this->Dados = $Dados;

        $data_inicio = $this->Dados['data_inicio'];
        $data_fim    = $this->Dados['data_fim'];
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
                            DFE.ID,
                            DFE.DATA_HORA_EMISSAO,
                            DFE.VALOR_SUBTOTAL,
                            DFE.VALOR_DESCONTO,
                            DFE.VALOR_ACRESCIMO,
                            DFE.VALOR_LIQUIDO,
                            DFE.CNPJ,
                            DFE.NUMERO_CFE,
                            DFE.CHAVE_ACESSO
                        FROM DOCUMENTO_FISCAL_ELETRONICO DFE
                            JOIN PERIODO P ON P.ID = DFE.ID_PERIODO
                        WHERE (P.DATA_MOVIMENTO BETWEEN '$data_inicio' AND '$data_fim')
                            AND (DFE.CODIGO_RETORNO) IN (100, 150, 6000)
                            AND (DFE.CANCELADO = 0) OR (DFE.ID IS NULL)
                        ORDER BY DFE.DATA_HORA_EMISSAO ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }

    //Documentos Fiscais Cancelados
    public function documentosFiscaisCancelados($Dados = null) {

        $this->Dados = $Dados;

        $data_inicio = $this->Dados['data_inicio'];
        $data_fim    = $this->Dados['data_fim'];
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
                            DFE.ID,
                            DFE.DATA_HORA_CANCELAMENTO,
                            DFE.VALOR_SUBTOTAL,
                            DFE.VALOR_DESCONTO,
                            DFE.VALOR_ACRESCIMO,
                            DFE.VALOR_LIQUIDO,
                            DFE.CNPJ,
                            DFE.NUMERO_CFE,
                            DFE.CHAVE_CANCELAMENTO,
                            DFE.INF_COMPL
                        FROM DOCUMENTO_FISCAL_ELETRONICO DFE
                            JOIN PERIODO P ON P.ID = DFE.ID_PERIODO
                        WHERE (P.DATA_MOVIMENTO BETWEEN '$data_inicio' AND '$data_fim')
                            AND (DFE.CODIGO_RETORNO) IN (7000)
                            AND (DFE.CANCELADO = 1)
                        ORDER BY DFE.DATA_HORA_CANCELAMENTO ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }

    //Documentos Fiscais VISUALIZAR
    public function view($id_documento_fiscal) {

        $this->id_documento_fiscal = (int) $id_documento_fiscal;
        $view = new \Sts\Models\helper\Read();
        $view->tRead("SELECT
                        DFE.ID,
                        PC.ID_PRODUTO_FILIAL,
                        PC.DESCRICAO,
                        PC.VALOR_UNITARIO,
                        PC.QTDE,
                        DFE.DATA_HORA_EMISSAO,
                        DFE.DATA_HORA_CANCELAMENTO,
                        DFE.VALOR_SUBTOTAL,
                        DFE.VALOR_DESCONTO,
                        DFE.VALOR_ACRESCIMO,
                        DFE.VALOR_LIQUIDO,
                        DFE.CNPJ,
                        DFE.NUMERO_CFE,
                        DFE.CHAVE_ACESSO,
                        DFE.CHAVE_CANCELAMENTO,
                        CL.DOCUMENTO,
                        CL.NOME
                    FROM DOCUMENTO_FISCAL_ELETRONICO DFE
                        INNER JOIN PERIODO P ON P.ID = DFE.ID_PERIODO
                        INNER JOIN PEDIDO_CONCOMITANTE PC ON PC.ID_DOCUMENTO_FISCAL_ELETRONICO = DFE.ID
                        LEFT JOIN ECF_SAT_CLIENTE CL ON CL.ID = DFE.ID_CLIENTE
                    WHERE DFE.ID=".$this->id_documento_fiscal."");

        $this->Resultado = $view->getResultado();
        return $this->Resultado;
    }
}