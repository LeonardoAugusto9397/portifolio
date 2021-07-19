<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelOpeMesa {

    private $Resultado;
    private $PaginaId;
    private $LimiteResultado = 30;
    private $ResultadoPagina;

    function getResultadoPagina() {
        return $this->ResultadoPagina;
    }

    //Mesa
    public function list($PaginaId = null) {

        //Paginação
        $this->PaginaId = (int) $PaginaId;
        $paginacao = new \Sts\Models\helper\Paginacao(URL . 'operacional/mesas');
        $paginacao->condicao($this->PaginaId, $this->LimiteResultado);
        $paginacao->paginacao("SELECT COUNT(ID) AS NUM_RESULTADO FROM CARTAO_MESA");
        $this->ResultadoPagina = $paginacao->getResultado();
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT FIRST :first SKIP :skip DISTINCT
                            CM.ID_CARTAO_MESA_EXTERNO AS MESA,
                            DS.DESC_SINGULAR AS TIPO,
                            CM.LUGARES,
                            CM.TIPO_SERVICO,
                            FI.DESCRICAO AS FILA,
                            CASE
                                WHEN CM.ID_ATIVO = 0 THEN 'table-status bg-pink'
                                WHEN CM.ID_ATIVO = 1 THEN 'table-status bg-green'
                            END AS ID_ATIVO
                        FROM CARTAO_MESA CM
                            JOIN FILA_IMPRESSAO FI ON FI.ID = CM.ID_FILA_IMPRESSAO
                            JOIN DESCRICAO DS ON DS.ID = CM.ID_DESCRICAO
                            JOIN PDV PD ON PD.ID = CM.ID_PDV
                            JOIN SISTEMA SI ON SI.ID = PD.ID_SISTEMA", "first={$this->LimiteResultado}&skip={$paginacao->getOffset()}");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}