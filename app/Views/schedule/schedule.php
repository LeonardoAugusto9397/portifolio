<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['PROFILE'][0])) {
    extract($this->Dados['PROFILE'][0]);
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-calendar bg-purple-dark"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">MEUS EVENTOS</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
            
            </div>
            <div class="col-9">
                <div class="page-content-2">
            
                    <!------- Calendar ------->
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!---- Exibe mensagem caso não encontre resultados ---->
<?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger text-center'>Erro ao carregar a página!</div>";
    $UrlDestino = URL . 'home/index';
    header("Location: $UrlDestino");
}