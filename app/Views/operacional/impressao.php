<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['FILA_IMPRESSAO'][0])) {
    extract($this->Dados['FILA_IMPRESSAO'][0]);
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-title">
                        <i class="ik ik-monitor bg-orange"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">FILA IMPRESSÃO</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-------- Grupo -------->
        <div class="table-fixed">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th class="text-nowrap">DESCRICAO</th>
                        <th class="text-nowrap">FILA</th>
                        <th class="text-nowrap">IMPRESSORA</th>
                        <th class="text-center">ATIVO</th>
                        <th class="text-center">EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['FILA_IMPRESSAO'] as $fila_impressao) {
                    extract($fila_impressao);
                    ?>
                    <tr>
                        <td class="text-nowrap"><?php echo $DESCRICAO; ?></td>
                        <td class="text-nowrap"><?php echo $FILA; ?></td>
                        <td class="text-nowrap"><?php echo $IMPRESSORA; ?></td>
                        <td class="text-center">
                            <span class="<?php echo $ID_ATIVO; ?>"><span>
                        </td>
                        <td class="text-center">
                            <a href="javascript:" class="view_impressora" id_empressora="<?php echo $ID; ?>">
                                <i class="ik ik-edit-1"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
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