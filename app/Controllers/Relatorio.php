<?php
namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Relatorio {

    private $Dados;
    private $DadosForm;
    private $ID;
    private $id_documento_fiscal;

    //Relatório Dashboard
    public function dashboard() {

        $listar = new \Sts\Models\ModelRelMenu();
        $this->Dados['ADMIN_PAGINA_GRUPO'] = $listar->relatorioTipo();

        $listar = new \Sts\Models\ModelRelMenu();
        $this->Dados['ADMIN_PAGINA'] = $listar->relatorio();
        
        $carregarView = new \Core\ConfigView("Views/relatorio/dashboard", $this->Dados);
        $carregarView->pageDefault();
    }

    //Relatório Filtro
    public function filtro($ID = null) {

        $this->ID = (int) $ID;
        if (!empty($this->ID)) {

            $listar = new \Sts\Models\ModelRelFiltro();
            $this->Dados['ADMIN_PAGINA'] = $listar->relatorioNome($this->ID);

            $listar = new \Sts\Models\ModelRelFiltro();
            $this->Dados['SISTEMA'] = $listar->relatorioPdv();

            $carregarView = new \Core\ConfigView("Views/relatorio/filtro", $this->Dados);
            $carregarView->pageDefault();

        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning text-center'>Erro: Model não encontrada!</div>";
            $UrlDestino = URL . 'relatorio/dashboard';
            header("Location: $UrlDestino");
        }
    }

    /************ PRODUTO ************/
    //Relatório Produto ABC
    public function produtoAbc() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelProdutoAbc();
        $this->Dados['PEDIDO_CONCOMITANTE'] = $listar->produtoAbc($this->DadosForm);

        $carregarView = new \Core\ConfigView("Views/relatorio/produto/produtoABC", $this->Dados);
        $carregarView->pageDefault();
    }

    //Relatório Produto Desconto
    public function produtoDesconto() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelProdutoDesconto();
        $this->Dados['PEDIDO_DESCONTO'] = $listar->produtoDesconto($this->DadosForm);

        $carregarView = new \Core\ConfigView("Views/relatorio/produto/produtoDesconto", $this->Dados);
        $carregarView->pageDefault();
    }

    //Relatório Produto Cancelado
    public function produtoCancelado() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelProdutoCancelado();
        $this->Dados['PEDIDO_EXCLUIDO'] = $listar->produtoCancelado($this->DadosForm);

        $carregarView = new \Core\ConfigView("Views/relatorio/produto/produtoCancelado", $this->Dados);
        $carregarView->pageDefault();
    }

    //Relatório Produto Transferência
    public function produtoTransferencia() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelProdutoTransferencia();
        $this->Dados['PEDIDO_TRANSFERENCIA'] = $listar->produtoTransferencia($this->DadosForm);

        $carregarView = new \Core\ConfigView("Views/relatorio/produto/produtoTransferencia", $this->Dados);
        $carregarView->pageDefault();
    }

    /********** FINANCEIRO ***********/
    //Auditoria
    public function auditoria() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelAuditoria();
        $this->Dados['DOCUMENTO_FISCAL_ELETRONICO'] = $listar->auditoria($this->DadosForm);
        
        $carregarView = new \Core\ConfigView("Views/relatorio/financeiro/auditoria", $this->Dados);
        $carregarView->pageDefault();
    }

    //Relatório Contas Assinadas
    public function contaAssinada() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelContaAssinada();
        $this->Dados['CONTAS_RECEBIDAS'] = $listar->contaAssinada($this->DadosForm);
        
        $carregarView = new \Core\ConfigView("Views/relatorio/financeiro/contaAssinada", $this->Dados);
        $carregarView->pageDefault();
    }

    //Relatório Contas Recebidas
    public function contaRecebida() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelContaRecebida();
        $this->Dados['DOCUMENTO_FISCAL_ELETRONICO'] = $listar->contaRecebida($this->DadosForm);
        
        $carregarView = new \Core\ConfigView("Views/relatorio/financeiro/contaRecebida", $this->Dados);
        $carregarView->pageDefault();
    }

    //Relatório Contas Recebidas Detalhadas
    public function contaRecebidaDetalhada() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelContaRecebidaDetalhada();
        $this->Dados['DOCUMENTO_FISCAL_ELETRONICO'] = $listar->contaRecebidaDetalhada($this->DadosForm);
        
        $carregarView = new \Core\ConfigView("Views/relatorio/financeiro/contaRecebidaDetalhada", $this->Dados);
        $carregarView->pageDefault();
    }

    //Relatório Faturamentos
    public function faturamentos() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelFaturamentos();
        $this->Dados['DOCUMENTO_FISCAL_ELETRONICO'] = $listar->faturamentos($this->DadosForm);
        
        $carregarView = new \Core\ConfigView("Views/relatorio/financeiro/faturamentos", $this->Dados);
        $carregarView->pageDefault();
    }

    /********** OPERACIONAL **********/
    //Relatório Venda Por Vendedor
    public function vendaVendedor() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelVendaVendedor();
        $this->Dados['PEDIDO_CONCOMITANTE'] = $listar->vendaVendedor($this->DadosForm);

        $carregarView = new \Core\ConfigView("Views/relatorio/operacional/vendaVendedor", $this->Dados);
        $carregarView->pageDefault();
    }

    /*********** DELIVERY ************/
    //Relatório Pedidos Delivery
    public function pedidoDelivery() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelPedidoDelivery();
        $this->Dados['CONTROLE_DELIVERY'] = $listar->pedidoDelivery($this->DadosForm);
        
        $carregarView = new \Core\ConfigView("Views/relatorio/delivery/pedidoDelivery", $this->Dados);
        $carregarView->pageDefault();
    }

    //Hora Hora
    public function horaHora() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelHoraHora();
        $this->Dados['CONTROLE_DELIVERY'] = $listar->horaHora($this->DadosForm);
        
        $carregarView = new \Core\ConfigView("Views/relatorio/delivery/horaHora", $this->Dados);
        $carregarView->pageDefault();
    }

    //Relatório Pedidos Delivery Cancelados
    public function pedidoDeliveryCancelado() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelPedidoDeliveryCancelado();
        $this->Dados['CONTROLE_DELIVERY'] = $listar->pedidoDeliveryCancelado($this->DadosForm);
        
        $carregarView = new \Core\ConfigView("Views/relatorio/delivery/pedidoDeliveryCancelado", $this->Dados);
        $carregarView->pageDefault();
    }

    //Clientes Que Mais Pedem
    public function clientesMaisPedem() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelClientesMaisPedem();
        $this->Dados['CONTROLE_DELIVERY'] = $listar->clientesMaisPedem($this->DadosForm);
        
        $carregarView = new \Core\ConfigView("Views/relatorio/delivery/clientesMaisPedem", $this->Dados);
        $carregarView->pageDefault();
    }

    /************* FISCAL ************/
    //Documentos Fiscais
    public function documentosFiscais() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelFiscal();
        $this->Dados['DOCUMENTO_FISCAL_ELETRONICO'] = $listar->documentosFiscais($this->DadosForm);
        
        $carregarView = new \Core\ConfigView("Views/relatorio/fiscal/documentosFiscais", $this->Dados);
        $carregarView->pageDefault();
    }

    //Documentos Fiscais Cancelados
    public function documentosFiscaisCancelados() {

        $this->DadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->DadosForm['BtnGerarRelatorio'])) {
            unset($this->DadosForm['BtnGerarRelatorio']);
        }

        $listar = new \Sts\Models\ModelRelFiscal();
        $this->Dados['DOCUMENTO_FISCAL_ELETRONICO'] = $listar->documentosFiscaisCancelados($this->DadosForm);
        
        $carregarView = new \Core\ConfigView("Views/relatorio/fiscal/documentosFiscaisCancelados", $this->Dados);
        $carregarView->pageDefault();
    }

    //Documentos Fiscais View
    public function documentosFiscaisView($id_documento_fiscal = null) {

        $this->id_documento_fiscal = (int) $id_documento_fiscal;
        if (!empty($this->id_documento_fiscal)) {

            $view = new \Sts\Models\ModelRelFiscal();
            $this->Dados['DOCUMENTO_FISCAL_ELETRONICO'] = $view->view($this->id_documento_fiscal);
            
            $carregarView = new \Core\ConfigView("Views/relatorio/documentosFiscaisView", $this->Dados);
            $carregarView->pageModal();
        }
    }
}