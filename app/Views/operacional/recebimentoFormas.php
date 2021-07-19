<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['RECEBIMENTO_FORMAS'][0])) {
    extract($this->Dados['RECEBIMENTO_FORMAS'][0]);
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-monitor bg-orange"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">RECEBIMENTO FORMAS</h5>
                        </div>
                    </div>
                </div>
                <div class="col-6">
					<div class="float-right">
						<div class="md-form md-form-search">
							<div class="input-group-prepend">
								<i class="input-group-text ik ik-search"></i>
							</div>
							<input type="text" class="form-control" placeholder="Pesquisar...">
						</div>
					</div>
				</div>
            </div>
        </div>

        <!---- Recebimento Formas ---->
        <div class="table-fixed">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th class="text-left">DESCRICAO</th>
                        <th class="text-center">ATALHO</th>
                        <th class="text-left">GRUPO</th>
                        <th class="text-center">DIAS</th>
                        <th class="text-center">TAXA</th>
                        <th class="text-center">ATIVO</th>
                        <th class="text-center">EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['RECEBIMENTO_FORMAS'] as $recebimento_formas) {
                    extract($recebimento_formas);
                    ?>
                    <tr>
                        <td class="text-left"><?php echo $DESCRICAO; ?></td>
                        <td class="text-center"><?php echo $ATALHO; ?></td>
                        <td class="text-left"><?php echo $GRUPO; ?></td>
                        <td class="text-center"><?php echo $QTDE_DIAS_RECEBIMENTO; ?></td>
                        <td class="text-center"><?php echo number_format($TAXA_PERCENTUAL_RECEBIMENTO,2,",","."); ?></td>
                        <td class="text-center">
                            <span class="<?php echo $ID_ATIVO; ?>"><span>
                        </td>
                        <td class="text-center">
                            <a href="javascript:" class="view_recebimento_formas" id_recebimento_formas="<?php echo $ID; ?>">
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