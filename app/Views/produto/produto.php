<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['PRODUTO'][0])) {
    extract($this->Dados['PRODUTO'][0]);
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit-1 bg-dark"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">PRODUTO VENDA</h5>
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

        <!---- Produto Venda ---->
        <div class="table-fixed-2">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th class="text-center">CODIGO</th>
                        <th class="text-nowrap">DESCRICAO</th>
                        <th class="text-nowrap text-right">VALOR</th>
                        <th class="text-center">UNIDADE</th>
                        <th class="text-nowrap">GRUPO</th>
                        <th class="text-nowrap">SUB_GRUPO</th>
                        <th class="text-nowrap">FILA</th>
                        <th class="text-center">ATIVO</th>
                        <th class="text-center">EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['PRODUTO'] as $produto) {
                    extract($produto);
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $CODIGO; ?></td>
                        <td class="text-nowrap"><?php echo $DESCRICAO; ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VALOR,2,",","."); ?></td>
                        <td class="text-center"><?php echo $UNIDADE; ?></td>
                        <td class="text-nowrap"><?php echo $GRUPO; ?></td>
                        <td class="text-nowrap"><?php echo $SUB_GRUPO; ?></td>
                        <td class="text-nowrap"><?php echo $FILA; ?></td>
                        <td class="text-center">
                            <span class="<?php echo $ID_ATIVO; ?>"><span>
                        </td>
                        <td class="text-center">
                            <a href="javascript:" class="view_produto" id_produto="<?php echo $CODIGO; ?>">
                                <i class="ik ik-edit-1"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!---- Modal Produto ---->
        <div class="modal fade" id="modal-produto" data-backdrop="static"></div>

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