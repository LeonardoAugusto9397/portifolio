<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if(!empty($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'][0])) {
    extract($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'][0]);

$VlProduto     = 0;
$VlGorjeta     = 0;
$VlGorjetaNp   = 0;
$VlTaxaEntrega = 0;
$VlDesconto    = 0;
$VlTotal       = 0;
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-bar-chart-2 bg-purple"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">CONTAS RECEBIDAS DETALHADAS</h5>
                            <!--<h6 class="text-truncate">01/01/2020 à 31/01/2020</h6>-->
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-right">
                        <button type="button" class="btn btn-outline-dark" id="">
                            <i class="ik ik-download"></i>
                        </button>
                        <button type="button" class="btn btn-outline-dark" id="btn-print">
                            <i class="ik ik-printer"></i>
                        </button>
                        <a href="<?php echo URL . 'relatorio/dashboard'; ?>" class="btn btn-dark">VOLTAR</a>
                    </div>
                </div>
            </div>
        </div>

        <!--- Contas Recebidas Detalhadas --->
        <div class="table-fixed" id="table-print">
            <table class="table table-striped">
                <thead class="table-header">
                    <tr>
                        <th class="text-center">DATA/HORA</th>
                        <th class="text-center">TIPO</th>
                        <th class="text-center">DOCUMENTO</th>
                        <th class="text-center">MESA</th>
                        <th class="text-right text-nowrap">TOTAL PRODUTO</th>
                        <th class="text-right">GORJETA</th>
                        <th class="text-right text-nowrap">GORJETA NP</th>
                        <th class="text-right text-nowrap">TAXA ENTREGA</th>
                        <th class="text-right">DESCONTO</th>
                        <th class="text-right">TOTAL</th>
                        <th class="text-left">RECEBIMENTO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'] as $dfe) {
                        $VlProduto     += $dfe['VALOR_SUBTOTAL'];
                        $VlGorjeta     += $dfe['VALOR_ACRESCIMO'];
                        $VlGorjetaNp   += $dfe['VALOR_SERVICO_NAO_PAGO'];
                        $VlTaxaEntrega += $dfe['VALOR_ENTREGA'];
                        $VlDesconto    += $dfe['VALOR_DESCONTO'];
                        $VlTotal       += $dfe['VALOR_LIQUIDO'];
                    extract($dfe);
                    ?>
                    <tr>
                        <td class="text-nowrap text-center"><?php echo date('d/m/Y H:i', strtotime($DATA_HORA_EMISSAO)); ?></td>
                        <td class="text-nowrap text-center"><?php echo $TIPO_DOCUMENTO; ?></td>
                        <td class="text-nowrap text-center"><?php echo $NUMERO_CFE; ?></td>
                        <td class="text-nowrap text-center"><?php echo $MESA; ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VALOR_SUBTOTAL,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VALOR_ACRESCIMO,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VALOR_SERVICO_NAO_PAGO,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VALOR_ENTREGA,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VALOR_DESCONTO,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VALOR_LIQUIDO,2,",","."); ?></td>
                        <td class="text-nowrap text-left"><?php echo $RECEBIMENTO_FORMAS; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="table-footer">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VlProduto,2,",","."); ?></td>
                        <td class="text-nowrap text-right bg-info"><?php echo number_format($VlGorjeta,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VlGorjetaNp,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VlTaxaEntrega,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VlDesconto,2,",","."); ?></td>
                        <td class="text-nowrap text-right bg-warning"><?php echo number_format($VlTotal,2,",","."); ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!---- Totalizadores ---->
        <!--<div class="text-nowrap text-sm text-center font-weight-bold bg-primary p-1">TOTALIZADORES</div>
        <table class="table table-hover table-sm">
            <tbody>
                <tr>
                    <td class="text-nowrap">TROCO</td>
                    <td class="text-right">0.00</td>
                </tr>
                <tr>
                    <td class="text-nowrap">PESSOA</td>
                    <td class="text-right">0.00</td>
                </tr>
                <tr>
                    <td class="text-nowrap">TICKET MEDIO</td>
                    <td class="text-right">0.00</td>
                </tr>
                <tr>
                    <td class="text-nowrap">TOTAL DE CONTAS</td>
                    <td class="text-right">0.00</td>
                </tr>
            </tbody>
        </table>-->
    </div>
</div>

<!---- Exibe mensagem caso não encontre resultados ---->
<?php } else {
    $_SESSION['msg'] = "<div class='alert alert-info text-center'>Sem resultados!</div>";
    $UrlDestino = URL . 'relatorio/dashboard';
    header("Location: $UrlDestino");
}