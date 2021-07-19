<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelDelFrete {

    private $Resultado;

    //Frete
    public function list() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
                            FD.ID,
                            FD.DESCRICAO,
                            FR.VALOR_ENTREGA,
                            CASE
                                WHEN FR.ID_ATIVO = 0 THEN 'table-status bg-pink'
                                WHEN FR.ID_ATIVO = 1 THEN 'table-status bg-green'
                            END AS ID_ATIVO
                        FROM FRETE_DELIVERY FD
                            JOIN FRETE_DELIVERY_REGRA FR ON FR.ID_FRETE_DELIVERY = FD.ID");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}