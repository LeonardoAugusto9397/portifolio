<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelPesUsuario {

    private $Resultado;
    private $PaginaId;
    private $LimiteResultado = 30;
    private $ResultadoPagina;

    function getResultadoPagina() {
        return $this->ResultadoPagina;
    }

    //Usuário
    public function list($PaginaId = null) {

        //Paginação
        $this->PaginaId = (int) $PaginaId;
        $paginacao = new \Sts\Models\helper\Paginacao(URL . 'pessoa/usuario');
        $paginacao->condicao($this->PaginaId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(ID) AS NUM_RESULTADO FROM USUARIO");
        $this->ResultadoPagina = $paginacao->getResultado();
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT FIRST :first SKIP :skip DISTINCT
                            US.ID,
                            PE.NOME_RAZAO_SOCIAL AS NOME,
                            US.LOGIN,
                            PR.DESCRICAO AS PERFIL,
                            US.DATA_CAD,
                            CASE
                                WHEN US.ID_ATIVO = 0 THEN 'table-status bg-pink'
                                WHEN US.ID_ATIVO = 1 THEN 'table-status bg-green'
                            END AS ID_ATIVO
                        FROM USUARIO US
                            JOIN USUARIO_PERFIL UP ON UP.ID_USUARIO = US.ID
                            JOIN PROFILE PR ON PR.ID = UP.ID_PROFILE
                            JOIN PESSOA PE ON PE.ID = US.ID_PESSOA
                        ORDER BY US.ID DESC", "first={$this->LimiteResultado}&skip={$paginacao->getOffset()}");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}