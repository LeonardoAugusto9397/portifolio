<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['FRETE_DELIVERY'][0])) {
    extract($this->Dados['FRETE_DELIVERY'][0]);
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-title">
                        <i class="ik ik-map-pin bg-danger"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">FRETE</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-------- Frete -------->
        <div class="table-fixed">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th class="text-left">DESCRIÇÃO</th>
                        <th class="text-right">VALOR ENTREGA</th>
                        <th class="text-center">ATIVO</th>
                        <th class="text-center">EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['FRETE_DELIVERY'] as $frete_delivery) {
                    extract($frete_delivery);
                    ?>
                    <tr>
                        <td class="text-left"><?php echo $DESCRICAO; ?></td>
                        <td class="text-right"><?php echo $VALOR_ENTREGA; ?></td>
                        <td class="text-center">
                            <span class="<?php echo $ID_ATIVO; ?>"><span>
                        </td>
                        <td class="text-center">
                            <a href="javascript:" class="view_mesa" id_mesa="<?php echo $ID; ?>">
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