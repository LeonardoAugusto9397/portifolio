<?php
namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Delivery {

    private $Dados;
    private $PaginaId;

    //Área Atuação
    public function areaAtuacao($PaginaId = null) {

        //Paginação
        $this->PaginaId = (int) $PaginaId ? $PaginaId : 1;

        $listar = new \Sts\Models\ModelDelAtuacao();
        $this->Dados['ATUACAO_DELIVERY'] = $listar->list($this->PaginaId);
        $this->Dados['paginacao'] = $listar->getResultadoPagina();
        
        $carregarView = new \Core\ConfigView("Views/delivery/areaAtuacao", $this->Dados);
        $carregarView->pageDefault();
    }

    //Frete
    public function frete() {

        $listar = new \Sts\Models\ModelDelFrete();
        $this->Dados['FRETE_DELIVERY'] = $listar->list();
        
        $carregarView = new \Core\ConfigView("Views/delivery/frete", $this->Dados);
        $carregarView->pageDefault();
    }
}