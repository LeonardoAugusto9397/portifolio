<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if(!empty($this->Dados['CONTROLE_DELIVERY'][0])) {
    extract($this->Dados['CONTROLE_DELIVERY'][0]);

$Ttaxa  = 0;
$Tconta = 0;
$Tqtde  = 0;
$Tperc  = 0;
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-bar-chart-2 bg-purple"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">CLIENTES QUE MAIS PEDEM</h5>
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

        <!--- Clientes Que Mais Pedem --->
        <div class="table-fixed" id="table-print">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th>CLIENTE</th>
                        <th class="text-right">QTDE.</th>
                        <th class="text-right">TAXA</th>
                        <th class="text-right">TOTAL</th>
                        <th class="text-right">%PERC.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['CONTROLE_DELIVERY'] as $cd) {
                        $Ttaxa  += $cd['VALOR_TAXA'];
                        $Tconta += $cd['VALOR_CONTA'];
                        $Tqtde  += $cd['QTDE'];
                    extract($cd);
                    } ?>

                    <?php foreach ($this->Dados['CONTROLE_DELIVERY'] as $cd) {
                        $perc  = 0;
                        $perc  = ($cd['VALOR_CONTA'] * 100) / $Tconta;
                        $Tperc += $perc;
                    extract($cd);
                    ?>
                    <tr>
                        <td class="text-nowrap"><?php echo $CLIENTE; ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($QTDE,0,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VALOR_TAXA,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($VALOR_CONTA,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($perc,2,",",".").'%'; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="table-footer">
                    <tr>
                        <td></td>
                        <td class="text-nowrap text-right"><?php echo number_format($Tqtde,0,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($Ttaxa,2,",","."); ?></td>
                        <td class="text-nowrap text-right bg-warning"><?php echo number_format($Tconta,2,",","."); ?></td>
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