<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['GRUPO'][0])) {
    extract($this->Dados['GRUPO'][0]);
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit-1 bg-dark"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">GRUPOS</h5>
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

        <!-------- Grupo -------->
        <div class="table-fixed">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th class="text-nowrap">DESCRICAO</th>
                        <th class="text-center">ATIVO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['GRUPO'] as $grupo) {
                    extract($grupo);
                    ?>
                    <!--<?php echo "<tr class='table-row' data-href='" . URL . "grupo/edit/$ID'>"; ?>-->
                    <tr>
                        <td class="text-nowrap"><?php echo $DESCRICAO; ?></td>
                        <td class="text-center">
                            <span class="<?php echo $ID_ATIVO; ?>"><span>
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