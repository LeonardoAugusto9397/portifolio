<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->Dados['ADMIN_PAGINA_PERMISSAO'][0])) {
    extract($this->Dados['ADMIN_PAGINA_PERMISSAO'][0]);
?>

<!--- Modal Permissão --->
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title text-truncate">
                <span class="font-weight-bold"><?php echo $PERFIL; ?></span>
            </div>
        </div>
        <div class="modal-body border-top">
            <table class="table table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>GRUPO</th>
                        <th>PÁGINA</th>
                        <!--<th>PERFIL</th>-->
                        <th class="text-center">PERMISSÃO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['ADMIN_PAGINA_PERMISSAO'] as $permissao_perfil) {
                    extract($permissao_perfil);
                    ?>
                    <tr>
                        <td class="text-nowrap"><?php echo $CONTROLLER; ?></td>
                        <td class="text-nowrap"><?php echo $DESCRICAO; ?></td>
                        <!--<td class="text-nowrap"><?php echo $PERFIL; ?></td>-->
                        <td class="text-nowrap text-center">
                            <span class="<?php echo $ID_ATIVO; ?>"><span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">FECHAR</button>
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