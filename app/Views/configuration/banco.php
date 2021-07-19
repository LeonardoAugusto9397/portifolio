<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['ADMIN_CONFIG'][0])) {
    extract($this->Dados['ADMIN_CONFIG'][0]);
?>

<div class="page">
    <div class="page-content">
        <div class="row">

            <!-------- Menu -------->
            <div class="col-md-3 mb-3">
                <div class="list-group list-menu">
                    <a href="<?php echo URL . 'configuration/banco'; ?>" class="list-group-item active">
                        <span class="text-truncate">Banco</span>
                    </a>
                    <a href="<?php echo URL . 'configuration/permission'; ?>" class="list-group-item">
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
                                <i class="ik ik-settings bg-warning"></i>
                                <div class="d-inline">
                                    <h5 class="text-truncate">CONFIGURAÇÕES</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--- Configurações --->
                <div class="table-fixed">
                    <table class="table table-striped">
                        <thead class="table-header">
                            <tr>
                                <th class="text-center">EMPRESA</th>
                                <th>DESCRIÇÃO</th>
                                <th>IP INSTALAÇÃO</th>
                                <th>CAMINHO DO BANCO</th>
                                <th class="text-center">EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->Dados['ADMIN_CONFIG'] as $config) {
                            extract($config);
                            ?>
                            <tr>
                                <td class="text-center pt-3"><?php echo $ID_EMPRESA_FILIAL; ?></td>
                                <td class="pt-3"><?php echo $DESCRICAO; ?></td>
                                <td class="pt-3"><?php echo $IP_INSTALACAO; ?></td>
                                <td class="pt-3"><?php echo $CAMINHO_BANCO; ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-xs view_modal_banco" id_banco="<?php echo $ID; ?>">
                                        <i class="ik ik-edit-1"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!---- Modal Banco ---->
                <div class="modal fade" id="exibe-banco" data-backdrop="static"></div>
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