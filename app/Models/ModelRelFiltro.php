<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelFiltro {

    private $Resultado;
    private $ID;

    //Filtro
    public function relatorioNome($ID) {

        $this->ID = (int) $ID;
        $view = new \Sts\Models\helper\Read();
        $view->tRead("SELECT
                            AP.ID,
                            AP.DESCRICAO AS RELATORIO,
                            AP.URL_CONTROLLER,
                            AP.URL_METODO,
                            RT.DESCRICAO AS RELATORIO_TIPO
                        FROM ADMIN_PAGINA AP
                            INNER JOIN ADMIN_PAGINA_GRUPO RT ON RT.ID = AP.ID_ADMIN_PAGINA_GRUPO
                            LEFT JOIN ADMIN_PAGINA_PERMISSAO APP ON APP.ID_ADMIN_PAGINA = AP.ID AND APP.ID_PROFiLE =:id_profile
                        WHERE AP.ID=".$this->ID." AND ((AP.publica =:publica) OR (APP.PERMISSAO =:permissao))", "id_profile={$_SESSION['usuario_perfil_id']}&publica=1&permissao=1");

        $this->Resultado = $view->getResultado();
        return $this->Resultado;
    }

    //Período
    public function relatorioPeriodo() {

        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }

    //PDV
    public function relatorioPdv() {
    
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT DISTINCT
                            PDV.ID,
                            PDV.NUMERO,
                            SI.DESCRICAO
                        FROM SISTEMA SI
                            JOIN PDV ON PDV.ID_SISTEMA = SI.ID");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}