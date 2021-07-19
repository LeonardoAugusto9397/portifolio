<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['EMPRESA_FILIAL'][0])) {
    extract($this->Dados['EMPRESA_FILIAL'][0]);
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
                    <a href="<?php echo URL . 'configuration/permission'; ?>" class="list-group-item">
                        <span class="text-truncate">Permissões</span>
                    </a>
                    <a href="<?php echo URL . 'configuration/empresa'; ?>" class="list-group-item active">
                        <span class="text-truncate">Empresa</span>
                    </a>
                </div>
            </div>

            <!----- Permissões ----->
            <div class="col-md-9">
                <div class="page-header">
                    <div class="row">
                        <div class="col-6">
                            <div class="page-header-title">
                                <i class="ik ik-home bg-warning"></i>
                                <div class="d-inline">
                                    <h5 class="text-truncate">EMPRESA</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary" name="">SALVAR</button>
                                <a href="<?php echo URL . 'configuration/empresa'; ?>" class="btn btn-dark">CANCELAR</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php extract($this->Dados['EMPRESA_FILIAL'][0]); ?>
                <form method="POST" action="">
                    <div class="form-row">

                        <!------ Empresa ------>
                        <div class="md-form col-md-1">
                            <label>Cod.</label>
                            <input type="text" class="form-control" value="<?php echo $ID; ?>" disabled>
                        </div>
                        <div class="md-form col-md-6">
                            <label>Razão Social</label>
                            <input type="text" class="form-control" value="<?php echo $RAZAO_SOCIAL; ?>">
                        </div>
                        <div class="md-form col-md-5">
                            <label>Nome Fantasia</label>
                            <input type="text" class="form-control" value="<?php echo $NOME_FANTASIA; ?>">
                        </div>
                        
                        <!---- Documentação ---->
                        <div class="md-form col-md-4">
                            <label>CNPJ</label>
                            <input type="text" class="form-control" maxlength="18" value="<?php echo $CNPJ; ?>">
                        </div>
                        <div class="md-form col-md-4">
                            <label>IE</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="md-form col-md-4">
                            <label>Regime</label>
                            <select class="custom-select" id="id_regime" name="id_regime">
                                <option value="1">Simples Nacional</option>
                                <option value="2">Regime Normal</option>
                            </select>
                        </div>

                        <!----- Comunicação ----->
                        <div class="md-form col-md-3">
                            <label>Telefone</label>
                            <input type="text" class="form-control" maxlength="14" placeholder="(00) 0000-0000" value="<?php echo $TELEFONE; ?>">
                        </div>	
                        <div class="md-form col-md-3">
                            <label>Celular</label>
                            <input type="text" class="form-control" maxlength="15" placeholder="(00) 00000-0000">
                        </div>
                        <div class="md-form col-md-6">
                            <label>E-mail</label>
                            <input type="text" class="form-control" placeholder="exemplo@exemplo.com.br">
                        </div>						
                            
                        <!------- Endereço ------->
                        <div class="md-form col-md-2">
                            <label>Cep</label>
                            <input type="text" class="form-control" id="cep" name="cep" maxlength="9" placeholder="00000-000" value="<?php echo $CEP; ?>">
                        </div>
                        <div class="md-form col-md-4">
                            <label>Endereço</label>
                            <input type="text" class="form-control" id="logradouro" name="logradouro" value="<?php echo $LOGRADOURO; ?>">
                        </div>
                        <div class="md-form col-md-2">
                            <label>Número</label>
                            <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $NUMERO; ?>">
                        </div>
                        <div class="md-form col-md-4">
                            <label>Complemento</label>
                            <input type="text" class="form-control" id="complemento" name="complemento">
                        </div>
                        <div class="md-form col-md-5">
                            <label>Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $BAIRRO; ?>">
                        </div>
                        <div class="md-form col-md-5">
                            <label>Localidade</label>
                            <input type="text" class="form-control" id="localidade" name="localidade" value="<?php echo $LOCALIDADE; ?>">
                        </div>
                        <div class="md-form col-md-2">
                            <label>UF</label>
                            <input type="text" class="form-control" id="uf" name="uf" value="<?php echo $UF; ?>">
                        </div>
                    </div>
                </form>
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