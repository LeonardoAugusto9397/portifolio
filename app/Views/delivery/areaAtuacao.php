<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['ATUACAO_DELIVERY'][0])) {
    extract($this->Dados['ATUACAO_DELIVERY'][0]);
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-map-pin bg-danger"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">ÁREA ATUAÇÃO</h5>
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
                        <th class="text-left">LOGRADOURO</th>
                        <th class="text-left">NOME</th>
                        <th class="text-left">BAIRRO</th>
                        <th class="text-left">LOCALIDADE</th>
                        <th class="text-center text-nowrap">CEP</th>
                        <th class="text-right">FRETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['ATUACAO_DELIVERY'] as $atuacao_delivery) {
                    extract($atuacao_delivery);
                    ?>
                    <tr>
                        <td class="text-left"><?php echo $LOGRADOURO; ?></td>
                        <td class="text-left"><?php echo $NOME; ?></td>
                        <td class="text-left"><?php echo $BAIRRO; ?></td>
                        <td class="text-left"><?php echo $LOCALIDADE; ?></td>
                        <td class="text-center text-nowrap"><?php echo $CEP; ?></td>
                        <td class="text-right"><?php echo number_format($FRETE,2,",","."); ?></td>
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