<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['CARTAO_MESA'][0])) {
    extract($this->Dados['CARTAO_MESA'][0]);
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-title">
                        <i class="ik ik-monitor bg-orange"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">MESAS</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-------- Mesas -------->
        <div class="table-fixed-2">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th class="text-center">MESA</th>
                        <th class="text-left">TIPO</th>
                        <th class="text-center">LUGARES</th>
                        <th class="text-center">SERVICO</th>
                        <th class="text-left">FILA</th>
                        <th class="text-center">ATIVO</th>
                        <th class="text-center">EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['CARTAO_MESA'] as $cartao_mesa) {
                    extract($cartao_mesa);
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $MESA; ?></td>
                        <td class="text-left"><?php echo $TIPO; ?></td>
                        <td class="text-center"><?php echo $LUGARES; ?></td>
                        <td class="text-center"><?php echo $TIPO_SERVICO; ?></td>
                        <td class="text-left"><?php echo $FILA; ?></td>
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

        <!------ Paginação ------>
        <?php echo $this->Dados['paginacao']; ?>
    </div>
</div>

<!---- Exibe mensagem caso não encontre resultados ---->
<?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger text-center'>Erro ao carregar a página!</div>";
    $UrlDestino = URL . 'home/index';
    header("Location: $UrlDestino");
}