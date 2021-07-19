<?php
namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Configuration {

    private $Dados;
    private $id_banco;
    private $id_perfil;

    //Banco
    public function banco() {

        $listar = new \Sts\Models\ModelConfBanco();
        $this->Dados['ADMIN_CONFIG'] = $listar->list();
        
        $carregarView = new \Core\ConfigView("Views/configuration/banco", $this->Dados);
        $carregarView->pageDefault();
    }

    //Banco Edit
    public function bancoEdit($id_banco = null) {

        $this->id_banco = (int) $id_banco;
        if (!empty($this->id_banco)) {

            $edit = new \Sts\Models\ModelConfBanco();
            $this->Dados['ADMIN_CONFIG'] = $edit->edit($this->id_banco);
            
            $carregarView = new \Core\ConfigView("Views/configuration/bancoEdit", $this->Dados);
            $carregarView->pageModal();
        }
    }

    //Permissões
    public function permission() {

        $listar = new \Sts\Models\ModelPesPerfil();
        $this->Dados['PROFILE'] = $listar->list();
        
        $carregarView = new \Core\ConfigView("Views/configuration/permissoes", $this->Dados);
        $carregarView->pageDefault();
    }

    //Permissões Edit
    public function permissionEdit($id_perfil = null) {

        $this->id_perfil = (int) $id_perfil;
        if (!empty($this->id_perfil)) {

            $edit = new \Sts\Models\ModelConfPermissoes();
            $this->Dados['ADMIN_PAGINA_PERMISSAO'] = $edit->edit($this->id_perfil);
            
            $carregarView = new \Core\ConfigView("Views/configuration/permissoesEdit", $this->Dados);
            $carregarView->pageModal();
        }
    }

    //Empresa
    public function empresa() {

        $listar = new \Sts\Models\Empresa();
        $this->Dados['EMPRESA_FILIAL'] = $listar->list();
        
        $carregarView = new \Core\ConfigView("Views/configuration/empresa", $this->Dados);
        $carregarView->pageDefault();
    }
}