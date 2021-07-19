<?php

namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Paginas {
    
    private $Resultado;
    private $UrlController;
    private $UrlMetodo;

    public function listarPaginas($UrlController = null, $UrlMetodo = null) {
		
		if(!isset($_SESSION['usuario_perfil_id'])){
			$_SESSION['usuario_perfil_id'] = null;
		}

        $this->UrlController = (string) $UrlController;
        $this->UrlMetodo = (string) $UrlMetodo;

        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT
							AP.ID
						FROM ADMIN_PAGINA AP
							LEFT JOIN ADMIN_PAGINA_PERMISSAO APP ON APP.ID_ADMIN_PAGINA = AP.ID AND APP.ID_PROFiLE =:id_profile
						WHERE (AP.CONTROLLER =:controller AND AP.METODO =:metodo)
						AND ((AP.PUBLICA =:publica) OR (APP.PERMISSAO =:permissao))", "id_profile={$_SESSION['usuario_perfil_id']}&controller={$this->UrlController}&metodo={$this->UrlMetodo}&publica=1&permissao=1");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}