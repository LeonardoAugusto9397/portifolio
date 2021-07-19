<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->Dados['PRODUTO'][0])) {
    extract($this->Dados['PRODUTO'][0]);
?>

<!--- Modal Produto --->
<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title text-truncate">
                <span class="font-weight-bold"><?php echo $DESCRICAO; ?></span>
            </div>
        </div>
        <div class="modal-body border-top">
            <div class="row">
                <div class="col-3">
                    <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                        <a href="#prod-venda" class="nav-link active" data-toggle="pill" role="tab">PRODUTO</a>
                        <a href="#prod-tributacao" class="nav-link" data-toggle="pill" role="tab">TRIBUTAÇÃO</a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="tab-content">

                        <!------- Produto ------->
                        <div class="tab-pane fade show active" id="prod-venda" role="tabpanel">
                            <div class="form-row">
                                <div class="md-form col-xl-2 col-lg-6">
                                    <label>Código</label>
                                    <input type="text" class="form-control" value="<?php echo $CODIGO; ?>">
                                </div>
                                <div class="md-form col-xl-7 col-lg-6">
                                    <label>Descrição Auxiliar</label>
                                    <input type="text" class="form-control" value="<?php echo $DESCRICAO; ?>">
                                </div>
                                <div class="md-form col-xl-3 col-lg-6">
                                    <label>Unidade</label>
                                    <select class="form-control" id="unidade">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="md-form col-xl-2 col-lg-6">
                                    <label>Salão</label>
                                    <input type="text" class="form-control" value="<?php echo number_format($VALOR,2,",","."); ?>">
                                </div>
                                <div class="md-form col-xl-2 col-lg-6">
                                    <label>Balcão</label>
                                    <input type="text" class="form-control" value="<?php echo number_format($VALOR,2,",","."); ?>">
                                </div>
                                <div class="md-form col-xl-2 col-lg-6">
                                    <label>Touch Salão</label>
                                    <input type="text" class="form-control" value="<?php echo number_format($VALOR,2,",","."); ?>">
                                </div>
                                <div class="md-form col-xl-2 col-lg-6">
                                    <label>Touch Balcão</label>
                                    <input type="text" class="form-control" value="<?php echo number_format($VALOR,2,",","."); ?>">
                                </div>
                                <div class="md-form col-xl-2 col-lg-6">
                                    <label>Delivery</label>
                                    <input type="text" class="form-control" value="<?php echo number_format($VALOR,2,",","."); ?>">
                                </div>
                                <div class="md-form col-xl-2 col-lg-6 text-center">
                                    <label>Ativo</label>
                                    <div>
                                        <span class="<?php echo $ID_ATIVO; ?>"><span>
                                    </div>
                                </div>
                                <div class="md-form col-xl-4 col-lg-6">
                                    <label>Grupo</label>
                                    <select class="form-control" id="grupo">
                                        <option value="1"><?php echo $GRUPO; ?></option>
                                    </select>
                                </div>
                                <div class="md-form col-xl-4 col-lg-6">
                                    <label>Sub Grupo</label>
                                    <select class="form-control" id="sub_grupo">
                                        <option value="1"><?php echo $SUB_GRUPO; ?></option>
                                    </select>
                                </div>
                                <div class="md-form col-xl-4 col-lg-6">
                                    <label>Grupo Celular</label>
                                    <select class="form-control" id="grupo_cardapio">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="md-form col-xl-6 col-lg-6">
                                    <label>Impressão</label>
                                    <select class="form-control" id="impressao">
                                        <option value="1"><?php echo $FILA; ?></option>
                                    </select>
                                </div>
                                <div class="md-form col-xl-6 col-lg-6">
                                    <label>Impressão Cópia</label>
                                    <select class="form-control" id="impressao_copia">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="md-form col-xl-12 col-lg-6">
                                    <label>EAN</label>
                                    <input type="text" class="form-control" placeholder="56.029.862.242.861">
                                </div>
                            </div>
                        </div>

                        <!--- Produto Tribut. --->
                        <div class="tab-pane fade" id="prod-tributacao" role="tabpanel">
                            <div class="form-row">
                                <div class="md-form col-xl-4 col-lg-6">
                                    <label>Tributação</label>
                                    <select class="form-control" id="tributacao">
                                        <option value="1"><?php echo $TRIBUTACAO; ?></option>
                                    </select>
                                </div>
                                <div class="md-form col-xl-4 col-lg-6">
                                    <label>Alíquota</label>
                                    <select class="form-control" id="aliquota">
                                        <option value="1"><?php echo $ALIQUOTA; ?></option>
                                    </select>
                                </div>
                                <div class="md-form col-xl-4 col-lg-6">
                                    <label>CFOP</label>
                                    <select class="form-control" id="cfop">
                                        <option value="1"><?php echo $CFOP; ?></option>
                                    </select>
                                </div>
                                <div class="md-form col-xl-7 col-lg-6">
                                    <label>NCM</label>
                                    <select class="form-control" id="ncm">
                                        <option value="1"><?php echo $NCM; ?></option>
                                    </select>
                                </div>
                                <div class="md-form col-xl-5 col-lg-6">
                                    <label>CEST</label>
                                    <select class="form-control" id="cest">
                                        <option value="1"><?php echo $CEST; ?></option>
                                    </select>
                                </div>
                                <div class="md-form col-xl-7 col-lg-6">
                                    <label>Origem</label>
                                    <select class="form-control" id="cst_a">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="md-form col-xl-5 col-lg-6">
                                    <label>Benefício Fiscal</label>
                                    <select class="form-control" id="beneficio">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="md-form col-xl-6 col-lg-6">
                                    <label>PIS</label>
                                    <input type="text" class="form-control" value="<?php echo number_format($PIS,2,".",","); ?>" placeholder="0.65">
                                </div>
                                <div class="md-form col-xl-6 col-lg-6">
                                    <label>COFINS</label>
                                    <input type="text" class="form-control" value="<?php echo number_format($COFINS,2,".",","); ?>" placeholder="3.00">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">FECHAR</button>
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