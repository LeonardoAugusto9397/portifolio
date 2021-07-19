<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelProd {

    private $Resultado;
    private $PaginaId;
    private $LimiteResultado = 30;
    private $ResultadoPagina;

    function getResultadoPagina() {
        return $this->ResultadoPagina;
    }

    //Produto Venda
    public function produtoVenda($PaginaId = null) {

        //Paginação
        $this->PaginaId = (int) $PaginaId;
        $paginacao = new \Sts\Models\helper\Paginacao(URL . 'produto/venda');
        $paginacao->condicao($this->PaginaId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(ID) AS NUM_RESULTADO FROM PRODUTO");
        $this->ResultadoPagina = $paginacao->getResultado();

        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT FIRST :first SKIP :skip DISTINCT
                            PVF.ID_PRODUTO_FILIAL AS CODIGO,
                            PR.DESCRICAO_AUX AS DESCRICAO,
                            GR.DESCRICAO AS GRUPO, 
                            SB.DESCRICAO AS SUB_GRUPO,
                            FI.DESCRICAO AS FILA,
                            UN.SIGLA AS UNIDADE,
                            PVP.VALOR_UNITARIO AS VALOR,
                            CASE
                                WHEN PVF.ID_ATIVO = 0 THEN 'table-status bg-pink'
                                WHEN PVF.ID_ATIVO = 1 THEN 'table-status bg-green'
                            END AS ID_ATIVO
                        FROM PRODUTO PR
                            JOIN PRODUTO_VENDA PV ON PR.ID = PV.ID_PRODUTO
                            JOIN PRODUTO_VENDA_FILIAL PVF ON PVF.ID_PRODUTO_VENDA = PV.ID
                            JOIN PRODUTO_VENDA_PRECO PVP ON PVP.ID_PRODUTO_VENDA_FILIAL = PVF.ID
                            LEFT JOIN PRODUTO_VENDA_IMPRESSAO PVI ON PVI.ID_PRODUTO_VENDA_FILIAL = PVF.ID
                            LEFT JOIN FILA_IMPRESSAO FI ON FI.ID = PVI.ID_FILA_IMPRESSAO
                            LEFT JOIN UNIDADE UN ON UN.ID = PV.ID_UNIDADE
                            JOIN SUB_GRUPO SB ON SB.ID = PVF.ID_SUB_GRUPO
                            JOIN GRUPO GR ON GR.ID = SB.ID_GRUPO
                            LEFT JOIN UNIDADE U ON U.ID = PV.ID_UNIDADE
                        ORDER BY PVF.ID_PRODUTO_FILIAL DESC", "first={$this->LimiteResultado}&skip={$paginacao->getOffset()}");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }

    //Produto Tributação
    public function produtoTributacao($PaginaId = null) {

        //Paginação
        $this->PaginaId = (int) $PaginaId;
        $paginacao = new \Sts\Models\helper\Paginacao(URL . 'produto/tributacao');
        $paginacao->condicao($this->PaginaId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(ID) AS NUM_RESULTADO FROM PRODUTO");
        $this->ResultadoPagina = $paginacao->getResultado();

        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT FIRST :first SKIP :skip DISTINCT
                            PVF.ID_PRODUTO_FILIAL AS CODIGO,
                            PR.DESCRICAO_AUX AS DESCRICAO,
                            T.SITUACAO || '-' || T.ALIQUOTA AS TRIBUTACAO,
                            T.CFOP,
                            CA.CST AS CST_A,
                            CB.CST AS CST_B,
                            NCM.NCM AS NCM,
                            PVF.PERC_PIS AS PIS,
                            CPP.CST AS CST_PIS,
                            PVF.PERC_COFINS AS COFINS,
                            CPC.CST AS CST_COFINS,
                            C.CEST AS CEST
                        FROM PRODUTO PR
                            JOIN PRODUTO_VENDA PV ON PR.ID = PV.ID_PRODUTO
                            JOIN PRODUTO_VENDA_FILIAL PVF ON PVF.ID_PRODUTO_VENDA = PV.ID
                            JOIN TRIBUTACAO T ON T.ID = PVF.ID_TRIBUTACAO
                            LEFT JOIN NCM ON NCM.ID = PR.ID_NCM
                            LEFT JOIN CST_B CB ON CB.ID = T.ID_CST_B
                            LEFT JOIN CST_A CA ON CA.ID = PR.ID_CST_A
                            LEFT JOIN CST_PIS_COFINS CPC ON CPC.ID = T.ID_COFINS
                            LEFT JOIN CST_PIS_COFINS CPP ON CPP.ID = T.ID_PIS
                            LEFT JOIN CEST C ON C.ID = PR.ID_CEST
                        ORDER BY PVF.ID_PRODUTO_FILIAL DESC", "first={$this->LimiteResultado}&skip={$paginacao->getOffset()}");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }

    //Produto EDITA
    public function edit($id_produto) {
    
        $this->id_produto = (int) $id_produto;
        $edit = new \Sts\Models\helper\Read();
        $edit->tRead("SELECT
                        PVF.ID_PRODUTO_FILIAL AS CODIGO,
                        PR.DESCRICAO_AUX AS DESCRICAO,
                        GR.DESCRICAO AS GRUPO, 
                        SB.DESCRICAO AS SUB_GRUPO,
                        FI.DESCRICAO AS FILA,
                        UN.SIGLA AS UNIDADE,
                        PVP.VALOR_UNITARIO AS VALOR,
                        T.DESCRICAO AS TRIBUTACAO,
                        T.SITUACAO || '-' || T.ALIQUOTA AS ALIQUOTA,
                        T.CFOP AS CFOP,
                        CA.CST AS CST_A,
                        CB.CST AS CST_B,
                        NCM.NCM AS NCM,
                        PVF.PERC_PIS AS PIS,
                        CPP.CST AS CST_PIS,
                        PVF.PERC_COFINS AS COFINS,
                        CPC.CST AS CST_COFINS,
                        C.CEST AS CEST,
                        CASE
                            WHEN PVF.ID_ATIVO = 0 THEN 'table-status bg-pink'
                            WHEN PVF.ID_ATIVO = 1 THEN 'table-status bg-green'
                        END AS ID_ATIVO
                    FROM PRODUTO PR
                        JOIN PRODUTO_VENDA PV ON PR.ID = PV.ID_PRODUTO
                        JOIN PRODUTO_VENDA_FILIAL PVF ON PVF.ID_PRODUTO_VENDA = PV.ID
                        JOIN PRODUTO_VENDA_PRECO PVP ON PVP.ID_PRODUTO_VENDA_FILIAL = PVF.ID
                        LEFT JOIN PRODUTO_VENDA_IMPRESSAO PVI ON PVI.ID_PRODUTO_VENDA_FILIAL = PVF.ID
                        LEFT JOIN FILA_IMPRESSAO FI ON FI.ID = PVI.ID_FILA_IMPRESSAO
                        LEFT JOIN UNIDADE UN ON UN.ID = PV.ID_UNIDADE
                        JOIN SUB_GRUPO SB ON SB.ID = PVF.ID_SUB_GRUPO
                        JOIN GRUPO GR ON GR.ID = SB.ID_GRUPO
                        LEFT JOIN UNIDADE U ON U.ID = PV.ID_UNIDADE
                        JOIN TRIBUTACAO T ON T.ID = PVF.ID_TRIBUTACAO
                        LEFT JOIN NCM ON NCM.ID = PR.ID_NCM
                        LEFT JOIN CST_B CB ON CB.ID = T.ID_CST_B
                        LEFT JOIN CST_A CA ON CA.ID = PR.ID_CST_A
                        LEFT JOIN CST_PIS_COFINS CPC ON CPC.ID = T.ID_COFINS
                        LEFT JOIN CST_PIS_COFINS CPP ON CPP.ID = T.ID_PIS
                        LEFT JOIN CEST C ON C.ID = PR.ID_CEST
                    WHERE PVF.ID_PRODUTO_FILIAL =".$this->id_produto."");

        $this->Resultado = $edit->getResultado();
        return $this->Resultado;
    }
}