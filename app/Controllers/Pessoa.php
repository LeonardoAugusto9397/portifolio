<?php
namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Pessoa {

    private $Dados;
    private $PaginaId;

    //Usuário
    public function usuario($PaginaId = null) {

        //Paginação
        $this->PaginaId = (int) $PaginaId ? $PaginaId : 1;

        $listar = new \Sts\Models\ModelPesUsuario();
        $this->Dados['USUARIO'] = $listar->list($this->PaginaId);
        $this->Dados['paginacao'] = $listar->getResultadoPagina();
        
        $carregarView = new \Core\ConfigView("Views/pessoa/usuario", $this->Dados);
        $carregarView->pageDefault();
    }

    //Perfil
    public function perfil() {

        $listar = new \Sts\Models\ModelPesPerfil();
        $this->Dados['PROFILE'] = $listar->list();
        
        $carregarView = new \Core\ConfigView("Views/pessoa/perfil", $this->Dados);
        $carregarView->pageDefault();
    }
}