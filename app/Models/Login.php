<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Login {
    
    private $Dados;
    private $Resultado;

    function getResultado() {
        return $this->Resultado;
    }

    public function acesso(array $Dados) {

        $this->Dados = $Dados;
         //var_dump($this->Dados);
        $this->validarDados();

        if($this->Resultado) {
            
            $this->Dados['login'] = strtoupper($this->Dados['login']);

            $validarLogin = new \Sts\Models\helper\Read();
            $validarLogin->tRead("SELECT
                                    US.ID,
                                    US.LOGIN,
                                    US.SENHA,
                                    UP.ID_PROFILE,
                                    PE.APELIDO_FANTASIA
                                FROM USUARIO US
                                    LEFT JOIN USUARIO_PERFIL UP ON UP.ID_USUARIO = US.ID
                                    LEFT JOIN PROFILE PR ON PR.ID = UP.ID_PROFILE
                                    LEFT JOIN EMPRESA_FILIAL EF ON EF.ID = PR.ID_EMPRESA_FILIAL
                                    LEFT JOIN PESSOA PE ON PE.ID = EF.ID_PESSOA
								WHERE LOGIN =:LOGIN AND US.ID_ATIVO = 1", "LOGIN={$this->Dados['login']}");
            $this->Resultado = $validarLogin->getResultado();
            //var_dump($this->Resultado);

            if(!empty($this->Resultado)) {
                $this->validarSenha();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-warning text-center'>Usuário não cadastrado!</div>";
                $this->Resultado = false;
            }
        }
    }

    //Valida dados, se os campos foram preenchidos
    private function validarDados() {

        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);

        if(in_array('', $this->Dados)) {
            $_SESSION['msg'] = "<div class='alert alert-danger text-center'>Preencha todos os campos!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    //Valida senha
    private function validarSenha() {

        if(strtoupper(md5($this->Dados['login'] . $this->Dados['senha'])) == $this->Resultado[0]['SENHA']) {
            $_SESSION['usuario_id'] = $this->Resultado[0]['ID'];
            $_SESSION['usuario_login'] = $this->Resultado[0]['LOGIN'];
			$_SESSION['usuario_perfil_id'] = $this->Resultado[0]['ID_PROFILE'];
            $_SESSION['usuario_empresa_filial'] = $this->Resultado[0]['APELIDO_FANTASIA'];
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger text-center'>Usuário ou senha incorretos!</div>";
            $this->Resultado = false;
        }
    }
}