<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['TRIBUTACAO'][0])) {
    extract($this->Dados['TRIBUTACAO'][0]);
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-title">
                        <i class="ik ik-monitor bg-orange"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">TRIBUTAÇÃO</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!------ Tributação ------>
        <div class="table-fixed">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th class="text-left">DESCRIÇÃO</th>
                        <th class="text-right">TRIBUTAÇÃO</th>
                        <th class="text-center">CFOP</th>
                        <th class="text-center">ALIQUOTA_BASE</th>
                        <th class="text-center">REDUCAO_BASE</th>
                        <th class="text-center">ID_PIS</th>
                        <th class="text-center">ID_COFINS</th>
                        <th class="text-center">CST</th>
                        <th class="text-center">ATIVO</th>
                        <th class="text-center">EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['TRIBUTACAO'] as $tributacao) {
                    extract($tributacao);
                    ?>
                    <tr>
                        <td class="text-left"><?php echo $DESCRICAO; ?></td>
                        <td class="text-right"><?php echo $TRIBUTACAO; ?></td>
                        <td class="text-center"><?php echo $CFOP; ?></td>
                        <td class="text-center"><?php echo $ALIQUOTA_BASE; ?></td>
                        <td class="text-center"><?php echo $REDUCAO_BASE; ?></td>
                        <td class="text-center"><?php echo $ID_PIS; ?></td>
                        <td class="text-center"><?php echo $ID_COFINS; ?></td>
                        <td class="text-center"><?php echo $CST; ?></td>
                        <td class="text-center">
                            <span class="<?php echo $ID_ATIVO; ?>"><span>
                        </td>
                        <td class="text-center">
                            <a href="javascript:" class="view_tributacao" id_tributacao="<?php echo $ID; ?>">
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