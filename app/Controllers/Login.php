<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Login {

    private $Dados;

    //Login
    public function acesso() {

        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //var_dump($this->Dados);

        if(!empty($this->Dados['SendLogin'])) {
            unset($this->Dados['SendLogin']);

            $visualizarLogin = new \Sts\Models\Login();
            $visualizarLogin->acesso($this->Dados);

            if($visualizarLogin->getResultado()) {
                $UrlDestino = URL . 'home/index';
                header("Location: $UrlDestino");
            } else {
                $this->Dados['form'] = $this->Dados;
            }
        }
     
        $carregarView = new \Core\ConfigView("Views/login/acesso", $this->Dados);
        $carregarView->pageLogin();
    }

    //Logout
    public function logout() {

        unset($_SESSION['usuario_id'], $_SESSION['usuario_login'], $_SESSION['usuario_perfil_id'], $_SESSION['usuario_empresa_filial']);
        $_SESSION['msg'] = "<div class='alert alert-success text-center'>Deslogado com sucesso!</div>";

        $UrlDestino = URL . 'login/acesso';
        header("Location: $UrlDestino");
    }
}