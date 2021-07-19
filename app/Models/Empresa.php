<?php
namespace Sts\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Empresa {

    private $Resultado;

    //Empresa
    public function list() {
        
        $listar = new \Sts\Models\helper\Read();
        $listar->tRead("SELECT DISTINCT
                            EF.ID AS ID,
                            P.NOME_RAZAO_SOCIAL AS RAZAO_SOCIAL,
                            P.APELIDO_FANTASIA AS NOME_FANTASIA,
                            PC.VALOR AS TELEFONE,
                            PD.VALOR AS CNPJ,
                            C.CEP,
                            C.NOME AS LOGRADOURO,
                            PL.NUMERO,
                            C.BAI_INI AS BAIRRO,
                            C.LOCALIDADESEMACENTO AS LOCALIDADE,
                            C.UF
                        FROM EMPRESA_FILIAL EF
                            JOIN PESSOA P ON P.ID = EF.ID_PESSOA
                            JOIN PESSOA_DOCUMENTO PD ON PD.ID_PESSOA = P.ID
                            JOIN PESSOA_COMUNICACAO PC ON PC.ID_PESSOA = P.ID
                            JOIN PESSOA_LOGRADOURO PL ON PL.ID_PESSOA = P.ID
                            JOIN CEP C ON C.ID = PL.ID_LOGRADOURO
                        WHERE
                            PD.ID_PESSOA_TIPO_DOCUMENTO = 1 AND
                            PC.ID_PESSOA_TIPO_COMUNICACAO = 2");

        $this->Resultado = $listar->getResultado();
        return $this->Resultado;
    }
}