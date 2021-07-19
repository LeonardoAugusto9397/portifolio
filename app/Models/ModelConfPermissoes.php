<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelConfPermissoes {

    private $Resultado;
    private $id_perfil;

    //Permissões EDITA
    public function edit($id_perfil) {
        
        $this->id_perfil = (int) $id_perfil;
        $edit = new \Sts\Models\helper\Read();
        $edit->tRead("SELECT DISTINCT
                        AP.CONTROLLER,
                        AP.DESCRICAO,
                        PR.DESCRICAO AS PERFIL,
                        CASE
                            WHEN APP.PERMISSAO = 0 THEN 'table-status bg-pink'
                            WHEN APP.PERMISSAO = 1 THEN 'table-status bg-green'
                        END AS ID_ATIVO
                    FROM ADMIN_PAGINA_PERMISSAO APP
                        INNER JOIN ADMIN_PAGINA AP ON AP.ID = APP.ID_ADMIN_PAGINA
                        INNER JOIN PROFILE PR ON PR.ID = APP.ID_PROFILE
                    WHERE APP.ID_PROFILE =".$this->id_perfil."
                    ORDER BY AP.ID ASC");

        $this->Resultado = $edit->getResultado();
        return $this->Resultado;
    }
}