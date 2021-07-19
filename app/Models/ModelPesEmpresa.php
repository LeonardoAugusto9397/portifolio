<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelPesEmpresa {

    private $Resultado;

    //Empresa
    public function list() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
                        EF.ID,
                        PE.NOME_RAZAO_SOCIAL,
                        PE.APELIDO_FANTASIA
                    FROM EMPRESA_FILIAL EF
                        JOIN PESSOA PE ON PE.ID = EF.ID_PESSOA
                    WHERE EF.ID = 2");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}