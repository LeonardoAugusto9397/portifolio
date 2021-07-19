<?php
namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Produto {

    private $Dados;
    private $PaginaId;
    private $id_produto;

    //Grupos
    public function grupo() {

        $listar = new \Sts\Models\ModelProdGrupo();
        $this->Dados['GRUPO'] = $listar->list();
        
        $carregarView = new \Core\ConfigView("Views/produto/grupo", $this->Dados);
        $carregarView->pageDefault();
    }

    //Produto Venda
    public function venda($PaginaId = null) {

        //Paginação
        $this->PaginaId = (int) $PaginaId ? $PaginaId : 1;

        $listar = new \Sts\Models\ModelProd();
        $this->Dados['PRODUTO'] = $listar->produtoVenda($this->PaginaId);
        $this->Dados['paginacao'] = $listar->getResultadoPagina();
        
        $carregarView = new \Core\ConfigView("Views/produto/produto", $this->Dados);
        $carregarView->pageDefault();
    }

    //Produto Tributação
    public function tributacao($PaginaId = null) {

        //Paginação
        $this->PaginaId = (int) $PaginaId ? $PaginaId : 1;

        $listar = new \Sts\Models\ModelProd();
        $this->Dados['PRODUTO'] = $listar->produtoTributacao($this->PaginaId);
        $this->Dados['paginacao'] = $listar->getResultadoPagina();
        
        $carregarView = new \Core\ConfigView("Views/produto/produtoTributacao", $this->Dados);
        $carregarView->pageDefault();
    }

    //Produto Edit
    public function produtoEdit($id_produto = null) {

        $this->id_produto = (int) $id_produto;
        if (!empty($this->id_produto)) {

            $edit = new \Sts\Models\ModelProd();
            $this->Dados['PRODUTO'] = $edit->edit($this->id_produto);
            
            $carregarView = new \Core\ConfigView("Views/produto/produtoEdit", $this->Dados);
            $carregarView->pageModal();
        }
    }
}