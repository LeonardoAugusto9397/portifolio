<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if(!empty($this->Dados['PEDIDO_CONCOMITANTE'][0])) {
    extract($this->Dados['PEDIDO_CONCOMITANTE'][0]);

$qtde    = 0;
$VlTotal = 0;
$perc    = 0;
$Tperc   = 0;
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-bar-chart-2 bg-purple"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">VENDA VENDEDOR</h5>
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

        <!---- Venda Vendedor ---->
        <div class="table-fixed" id="table-print">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th>VENDEDOR</th>
                        <th>PERFIL</th>
                        <th class="text-right">QTDE.</th>
                        <th class="text-right">TOTAL</th>
                        <th class="text-right">%PERC.</th>
                    </tr>
                </thead>
                <tbody class="table-body" id="myTable">
                    <?php foreach ($this->Dados['PEDIDO_CONCOMITANTE'] as $pc) {
                        $qtde    += $pc['QTDE'];
                        $VlTotal += $pc['VALOR_TOTAL'];
                    extract($pc);
                    } ?>

                    <?php foreach ($this->Dados['PEDIDO_CONCOMITANTE'] as $pc) {
                        $perc  = 0;
                        $perc  = ($pc['VALOR_TOTAL'] * 100) / $VlTotal;
                        $Tperc += $perc;
                    extract($pc);
                    ?>
                    <tr>
                        <td class="text-nowrap"><?php echo $VENDEDOR; ?></td>
                        <td class="text-nowrap"><?php echo $PERFIL; ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($QTDE,0,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VALOR_TOTAL,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($perc,2,",",".").'%'; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="table-footer">
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-nowrap text-right"><?php echo number_format($qtde,0,",","."); ?></td>
                        <td class="text-nowrap text-right bg-warning"><?php echo number_format($VlTotal,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($Tperc,2,",",".").'%'; ?></td>
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