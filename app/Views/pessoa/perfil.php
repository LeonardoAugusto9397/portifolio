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
                <div class="col-12">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">PERFIL</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!------- Perfil ------->
        <div class="table-fixed">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th>DESCRIÇÃO</th>
                        <th>EMPRESA</th>
                        <th class="text-center">DATA\CAD</th>
                        <th class="text-center">ATIVO</th>
                        <th class="text-center">EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['PROFILE'] as $usuario_perfil) {
                    extract($usuario_perfil);
                    ?>
                    <tr>
                        <td class="text-nowrap"><?php echo $DESCRICAO; ?></td>
                        <td class="text-nowrap"><?php echo $EMPRESA; ?></td>
                        <td class="text-nowrap text-center"><?php echo date('d/m/Y H:i', strtotime($DATA_CAD)); ?></td>
                        <td class="text-center">
                            <span class="<?php echo $ID_ATIVO; ?>"><span>
                        </td>
                        <td class="text-center">
                            <a href="javascript:" class="view_perfil" id_perfil="<?php echo $ID; ?>">
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