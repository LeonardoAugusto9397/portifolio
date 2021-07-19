<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelDelAtuacao {

    private $Resultado;
    private $PaginaId;
    private $LimiteResultado = 30;
    private $ResultadoPagina;

    function getResultadoPagina() {
        return $this->ResultadoPagina;
    }

    //Área Atuação
    public function list($PaginaId = null) {

        //Paginação
        $this->PaginaId = (int) $PaginaId;
        $paginacao = new \Sts\Models\helper\Paginacao(URL . 'delivery/area-atuacao');
        $paginacao->condicao($this->PaginaId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(ID) AS NUM_RESULTADO FROM ATUACAO_DELIVERY");
        $this->ResultadoPagina = $paginacao->getResultado();
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT FIRST :first SKIP :skip DISTINCT
                            C.LOGRADOURO,
                            C.NOME AS NOME,
                            C.BAI_INI AS BAIRRO,
                            C.LOCALIDADESEMACENTO AS LOCALIDADE,
                            AD.CEP_INICIO AS CEP,
                            FDR.VALOR_ENTREGA AS FRETE,
                            FD.DESCRICAO AS REGRA
                        FROM ATUACAO_DELIVERY AD
                            JOIN CEP C ON C.CEP = AD.CEP_INICIO
                            JOIN FRETE_DELIVERY FD ON FD.ID = AD.ID_FRETE_DELIVERY
                            JOIN FRETE_DELIVERY_REGRA FDR ON FDR.ID_FRETE_DELIVERY = FD.ID
                        ORDER BY AD.CEP_INICIO ASC", "first={$this->LimiteResultado}&skip={$paginacao->getOffset()}");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}