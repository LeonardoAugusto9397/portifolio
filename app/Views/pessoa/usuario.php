<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['USUARIO'][0])) {
    extract($this->Dados['USUARIO'][0]);
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">USUÁRIOS</h5>
                        </div>
                    </div>
                </div>
				<div class="col-6">
					<div class="float-right">
						<div class="md-form md-form-search">
							<div class="input-group-prepend">
								<i class="input-group-text ik ik-search"></i>
							</div>
							<input type="text" class="form-control" id="myInput" placeholder="Pesquisar...">
						</div>
					</div>
				</div>
            </div>
        </div>

        <!------- Usuário ------->
        <div class="table-fixed-2">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th class="text-center">CODIGO</th>
                        <th class="text-nowrap">NOME</th>
                        <th class="text-nowrap">LOGIN</th>
                        <th class="text-nowrap">PERFIL</th>
                        <th class="text-center">DATA\CAD</th>
                        <th class="text-center">ATIVO</th>
                        <th class="text-center">EDITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['USUARIO'] as $usuario) {
                    extract($usuario);
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $ID; ?></td>
                        <td class="text-nowrap"><?php echo $NOME; ?></td>
                        <td class="text-nowrap"><?php echo $LOGIN; ?></td>
                        <td class="text-nowrap"><?php echo $PERFIL; ?></td>
                        <td class="text-center"><?php echo date('d/m/Y H:i', strtotime($DATA_CAD)); ?></td>
                        <td class="text-center">
                            <span class="<?php echo $ID_ATIVO; ?>"><span>
                        </td>
                        <td class="text-center">
                            <a href="javascript:" class="view_usuario" id_usuario="<?php echo $ID; ?>">
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