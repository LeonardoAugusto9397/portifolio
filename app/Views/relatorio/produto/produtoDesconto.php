<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['PEDIDO_DESCONTO'][0])) {
    extract($this->Dados['PEDIDO_DESCONTO'][0]);

$tqtde     = 0;
$tdesconto = 0;
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-bar-chart-2 bg-purple"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">PRODUTOS DESCONTO</h5>
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

        <!-- Produto Desconto -->
        <div class="table-fixed" id="table-print">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th class="text-center"><i class="ik ik-arrow-down"></i>DATA/HORA</th>
                        <th class="text-center">MESA</th>
                        <th>DESCRIÇÃO</th>
                        <th>VENDEDOR</th>
                        <th>AUTORIZADOR</th>
                        <th>MOTIVO</th>
                        <th class="text-right">QTDE.</th>
                        <th class="text-right">DESCONTO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['PEDIDO_DESCONTO'] as $cd) {
                        $tqtde     += $cd['QTDE'];
                        $tdesconto += $cd['VALOR_DESCONTO'];
                    extract($cd);
                    ?>
                    <tr>
                        <td class="text-nowrap text-center"><?php echo date('d/m/Y H:i:s', strtotime($DATA_HORA_DESCONTO)); ?></td>
                        <td class="text-center"><?php echo $MESA; ?></td>
                        <td class="text-nowrap"><?php echo $PRODUTO; ?></td>
                        <td class="text-nowrap"><?php echo $VENDEDOR; ?></td>
                        <td class="text-nowrap"><?php echo $AUTORIZADOR; ?></td>
                        <td class="text-nowrap"><?php echo $MOTIVO; ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($QTDE,0,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VALOR_DESCONTO,2,",","."); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="table-footer">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-nowrap text-right"><?php echo number_format($tqtde,0,",","."); ?></td>
                        <td class="text-nowrap text-right bg-warning"><?php echo number_format($tdesconto,2,",","."); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!---- Exibe mensagem caso não encontre resultados ---->
<?php } else {
    $_SESSION['msg'] = "<div class='alert alert-info text-center'>Sem resultados!</div>";
    $UrlDestino = URL . 'relatorio/dashboard';
    header("Location: $UrlDestino");
}