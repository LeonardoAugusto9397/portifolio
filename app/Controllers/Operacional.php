<?php
namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Operacional {

    private $Dados;
    private $PaginaId;

    //Combos
    public function combos() {

    }

    //Fila Impressão
    public function impressao() {

        $listar = new \Sts\Models\ModelOpeImpressao();
        $this->Dados['FILA_IMPRESSAO'] = $listar->list();
        
        $carregarView = new \Core\ConfigView("Views/operacional/impressao", $this->Dados);
        $carregarView->pageDefault();
    }

    //Mesas
    public function mesas($PaginaId = null) {

        //Paginação
        $this->PaginaId = (int) $PaginaId ? $PaginaId : 1;

        $listar = new \Sts\Models\ModelOpeMesa();
        $this->Dados['CARTAO_MESA'] = $listar->list($this->PaginaId);
        $this->Dados['paginacao'] = $listar->getResultadoPagina();
        
        $carregarView = new \Core\ConfigView("Views/operacional/mesas", $this->Dados);
        $carregarView->pageDefault();
    }

    //Observações
    public function observacoes() {

        $listar = new \Sts\Models\ModelOpeObservacoes();
        $this->Dados['OBSERVACAO'] = $listar->list();
        
        $carregarView = new \Core\ConfigView("Views/operacional/observacao", $this->Dados);
        $carregarView->pageDefault();
    }

    //PDV
    public function pdv() {

    }

    //Recebimento Formas
    public function recebimentoFormas() {

        $listar = new \Sts\Models\ModelOpeRecebimentoFormas();
        $this->Dados['RECEBIMENTO_FORMAS'] = $listar->list();
        
        $carregarView = new \Core\ConfigView("Views/operacional/recebimentoFormas", $this->Dados);
        $carregarView->pageDefault();
    }

    //Taxa Serviço
    public function eventos() {

    }

    //Tributação
    public function tributacao() {

        $listar = new \Sts\Models\ModelOpeTributacao();
        $this->Dados['TRIBUTACAO'] = $listar->list();
        
        $carregarView = new \Core\ConfigView("Views/operacional/tributacao", $this->Dados);
        $carregarView->pageDefault();
    }
}