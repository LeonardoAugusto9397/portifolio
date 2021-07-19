<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['PROFILE'][0])) {
    extract($this->Dados['PROFILE'][0]);
?>

<div class="page">
    <div class="page-content">
        <div class="row">

            <!-------- Menu -------->
            <div class="col-md-3 mb-3">
                <div class="list-group list-menu">
                    <a href="<?php echo URL . 'configuration/banco'; ?>" class="list-group-item">
                        <span class="text-truncate">Banco</span>
                    </a>
                    <a href="<?php echo URL . 'configuration/permission'; ?>" class="list-group-item active">
                        <span class="text-truncate">Permissões</span>
                    </a>
                    <a href="<?php echo URL . 'configuration/empresa'; ?>" class="list-group-item">
                        <span class="text-truncate">Empresa</span>
                    </a>
                </div>
            </div>

            <!----- Permissões ----->
            <div class="col-md-9">
                <div class="page-header">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-header-title">
                                <i class="ik ik-unlock bg-warning"></i>
                                <div class="d-inline">
                                    <h5 class="text-truncate">PREMISSÕES</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!----- Permissão ----->
                <div class="table-fixed">
                    <table class="table table-striped">
                        <thead class="table-header">
                            <tr>
                                <th class="text-center">CODIGO</th>
                                <th>PERFIL</th>
                                <th>EMPRESA</th>
                                <th class="text-center">EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->Dados['PROFILE'] as $perfil) {
                            extract($perfil);
                            ?>
                            <tr>
                                <td class="text-nowrap text-center pt-3"><?php echo $ID; ?></td>
                                <td class="text-nowrap pt-3"><?php echo $DESCRICAO; ?></td>
                                <td class="text-nowrap pt-3"><?php echo $EMPRESA; ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-purple btn-xs view_permissao" id_perfil="<?php echo $ID; ?>">
                                        <i class="ik ik-edit-1"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!--- Modal Permissão --->
				<div class="modal fade" id="modal-permissao" data-backdrop="static"></div>
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