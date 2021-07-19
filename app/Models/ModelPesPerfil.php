<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelPesPerfil {

    private $Resultado;

    //Perfil
    public function list() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
                            PR.ID,
                            PE.APELIDO_FANTASIA AS EMPRESA,
                            PR.DESCRICAO,
                            PR.DATA_CAD,
                            CASE
                                WHEN PR.ID_ATIVO = 0 THEN 'table-status bg-pink'
                                WHEN PR.ID_ATIVO = 1 THEN 'table-status bg-green'
                            END AS ID_ATIVO
                        FROM PROFILE PR
                            JOIN EMPRESA_FILIAL EF ON EF.ID = PR.ID_EMPRESA_FILIAL
                            JOIN PESSOA PE ON PE.ID = EF.ID_PESSOA
                        WHERE PR.ID_ATIVO = 1
                        ORDER BY PR.ID ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}