<?php
namespace Sts\Models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Paginacao {

    private $Link;
    private $Pagina;
    private $LimiteResultado;
    private $Offset;
    private $Query;
    private $ParseString;
    private $ResultadoBanco;
    private $Resultado;
    private $TotalPaginas;
    private $MaxLinks = 2;

    function getResultado() {
        return $this->Resultado;
    }

    function getOffset() {
        return $this->Offset;
    }

    function __construct($Link) {

        $this->Link = $Link;
    }

    public function condicao($Pagina, $LimiteResultado) {

        $this->Pagina = (int)$Pagina ? $Pagina : 1;
        $this->LimiteResultado = (int) $LimiteResultado;
        $this->Offset = ($this->Pagina * $this->LimiteResultado) - $this->LimiteResultado;
        //var_dump($this->Offset);
    }

    public function paginacao($Query, $ParseString = null) {

        $this->Query = (string) $Query;
        $this->ParseString = (string) $ParseString;
        
        $contar = new \Sts\Models\helper\Read();
        $contar->tRead($this->Query, $this->ParseString);
        $this->ResultadoBanco = $contar->getResultado();
        //var_dump($this->ResultadoBanco);

        if($this->ResultadoBanco[0]['NUM_RESULTADO'] > $this->LimiteResultado) {
            $this->instrucaoPaginacao();
        } else {
            $this->Resultado = null;
        }
    }

    private function instrucaoPaginacao() {

        $this->TotalPaginas = ceil($this->ResultadoBanco[0]['NUM_RESULTADO'] / $this->LimiteResultado);

        if($this->TotalPaginas >= $this->Pagina) {
            $this->layoutPaginacao();
        } else {
            header("Location: {$this->Link}");
        }
    }

    private function layoutPaginacao() {
        $this->Resultado = "<nav class='float-right'>";
        $this->Resultado .= "<ul class='pagination'>";
        $this->Resultado .= "<li class='page-item'>";
        $this->Resultado .= "<a class='page-link' href='" . $this->Link . "' tabindex='-1'>Primeira</a>";
        $this->Resultado .= "</li>";
        for ($iPag = $this->Pagina - $this->MaxLinks; $iPag <= $this->Pagina - 1; $iPag++) {
            if ($iPag >= 1) {
                $this->Resultado .= "<li class='page-item'><a class='page-link' href='" . $this->Link . "/" . $iPag . "'>$iPag</a></li>";
            }
        }
        $this->Resultado .= "<li class='page-item active'>";
        $this->Resultado .= "<a class='page-link' href='#'>" . $this->Pagina . "</a>";
        $this->Resultado .= "</li>";
        for ($dPag = $this->Pagina + 1; $dPag <= $this->Pagina + $this->MaxLinks; $dPag++) {
            if ($dPag <= $this->TotalPaginas) {
                $this->Resultado .= "<li class='page-item'><a class='page-link' href='" . $this->Link . "/" . $dPag . "'>$dPag</a></li>";
            }
        }
        $this->Resultado .= "<li class='page-item'>";
        $this->Resultado .= "<a class='page-link' href='" . $this->Link . "/" . $this->TotalPaginas . "'>Última</a>";
        $this->Resultado .= "</li>";
        $this->Resultado .= "</ul>";
        $this->Resultado .= "</nav>";
    }
}