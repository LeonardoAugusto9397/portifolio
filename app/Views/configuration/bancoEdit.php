<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['ADMIN_CONFIG'][0])) {
    extract($this->Dados['ADMIN_CONFIG'][0]);
?>

<!--- Modal Config. --->
<div class="modal-dialog" role="document">
    <form method="POST" action="">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title text-truncate">
                    <span class="font-weight-bold">CONFIGURAÇÕES DE BANCO</span>
                </div>
            </div>
            <div class="modal-body border-top">
                <div class="form-row">
                    <div class="md-form col-md-4">
                        <label>Empresa</label>
                        <input type="text" class="form-control" value="<?php echo $ID_EMPRESA_FILIAL; ?>" placeholder="1">
                    </div>
                    <div class="md-form col-md-8">
                        <label>Descrição</label>
                        <input type="text" class="form-control" value="<?php echo $DESCRICAO; ?>" placeholder="Loja">
                    </div>
                    <div class="md-form col-md-12">
                        <label>IP Instalação</label>
                        <input type="text" class="form-control" value="<?php echo $IP_INSTALACAO; ?>" placeholder="127.0.0.1:1234">
                    </div>
                    <div class="md-form col-md-12">
                        <label>Caminho Do Banco</label>
                        <input type="text" class="form-control" value="<?php echo $CAMINHO_BANCO; ?>" placeholder="127.0.0.1:C:\Listo\Data\BANCO.FDB">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-sm" name="EditarPessoa" value="SALVAR">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">FECHAR</button>
            </div>
        </div>
    </form>
</div>

<!---- Exibe mensagem caso não encontre resultados ---->
<?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger text-center'>Erro ao carregar a página!</div>";
    $UrlDestino = URL . 'home/index';
    header("Location: $UrlDestino");
}