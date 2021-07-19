<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelRelMenu {

    private $Resultado;

    //Relatório Tipo
    public function relatorioTipo() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT * FROM ADMIN_PAGINA_GRUPO ORDER BY ID ASC");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }

    //Relatório
    public function relatorio() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
                            AP.ID,
                            AP.DESCRICAO,
                            AP.ICONE,
                            AP.ID_ATIVO,
                            AP.ID_ADMIN_PAGINA_GRUPO,
                            APP.PERMISSAO
                        FROM ADMIN_PAGINA AP
                            LEFT JOIN ADMIN_PAGINA_PERMISSAO APP ON APP.ID_ADMIN_PAGINA = AP.ID AND APP.ID_PROFiLE =:id_profile
                        WHERE ((AP.publica =:publica) OR (APP.PERMISSAO =:permissao) AND (AP.ID_ATIVO =:ativo)) ORDER BY AP.DESCRICAO ASC", "id_profile={$_SESSION['usuario_perfil_id']}&publica=1&permissao=1&ativo=1");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}