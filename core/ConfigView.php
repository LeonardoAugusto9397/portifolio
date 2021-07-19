<?php
namespace Core;

class ConfigView {

    private $Nome;
    private $Dados;

    public function __construct($Nome, array $Dados = null) {

        $this->Nome = (string) $Nome;
        $this->Dados = $Dados;
    }

    /*** PAGE LOGIN ***/
    public function pageLogin() {

        if(file_exists('app/' . $this->Nome . '.php')) {
            include 'app/Views/include/login_cabecalho.php';
            include 'app/'.$this->Nome . '.php';
            include 'app/Views/include/login_rodape.php';
        } else {
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
    }

    /** PAGE DEFAULT **/
    public function pageDefault() {

        if(file_exists('app/' . $this->Nome . '.php')) {

            include 'app/Views/include/page_cabecalho.php';
            include 'app/Views/include/page_menu.php';
            include 'app/'.$this->Nome . '.php';
            include 'app/Views/include/page_rodape.php';
        } else {
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
    }

    /** PAGE CALENDAR **/
    public function pageCalendar() {

        if(file_exists('app/' . $this->Nome . '.php')) {

            include 'app/Views/include/page_cabecalho.php';
            include 'app/Views/include/page_menu.php';
            include 'app/'.$this->Nome . '.php';
            include 'app/Views/include/page_rodape_calendar.php';
        } else {
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
    }

    //PAGINA Modal
    public function pageModal() {

        if(file_exists('app/' . $this->Nome . '.php')) {
            include 'app/'.$this->Nome . '.php';
            include 'app/Views/include/page_rodape_modal.php';
        } else {
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
    }
}