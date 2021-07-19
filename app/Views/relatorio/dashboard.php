<?php if (!defined('URL')) {
    header("Location: /");
    exit();
} ?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-title">
                        <i class="ik ik-bar-chart-2 bg-purple"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">RELATÓRIOS</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!---- Exibe Mensagem ---->
        
        <?php if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        } ?>

        <!---- Relatório Menu ---->
        <div class="panel-group">
            <?php foreach ($this->Dados['ADMIN_PAGINA_GRUPO'] as $relatorio_tipo) {
            extract($relatorio_tipo);
            ?>
            <a href="#typeReport<?php echo $ID; ?>" class="panel-heading" data-toggle="collapse">
                <span><?php echo $DESCRICAO; ?></span>
                <i class="ik ik-plus"></i>
            </a>
            <div id="typeReport<?php echo $ID; ?>" class="panel-collapse collapse">
                <?php foreach ($this->Dados['ADMIN_PAGINA'] as $relatorio):
                    extract($relatorio); 
                ?>    
                <?php if($relatorio['ID_ADMIN_PAGINA_GRUPO'] == $relatorio_tipo['ID']): ?>
                    <?php echo "<a href='" . URL . "relatorio/filtro/$ID' class='panel-collapse-item'>$DESCRICAO</a>"; ?>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>