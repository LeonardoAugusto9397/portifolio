<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if(!empty($this->Dados['CONTROLE_DELIVERY'][0])) {
    extract($this->Dados['CONTROLE_DELIVERY'][0]);

$Ttotal  = 0;
$Tqtde   = 0;
$TTicket = 0;
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-bar-chart-2 bg-purple"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">HORA HORA</h5>
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

        <!--- Hora Hora --->
        <div class="table-fixed" id="table-print">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th class="text-center"><i class="ik ik-arrow-down"></i> HORA</th>
                        <th class="text-right">QTDE.</th>
                        <th class="text-right">TOTAL</th>
                        <th class="text-right">TICKET MÉDIO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['CONTROLE_DELIVERY'] as $cd) {
                        $Ttotal  += $cd['TOTAL'];
                        $Tqtde   += $cd['QTDE'];
                    extract($cd);
                    } ?>

                    <?php foreach ($this->Dados['CONTROLE_DELIVERY'] as $cd) {
                        $TTicket  = 0;
                        $TTicket  = $Ttotal / $Tqtde;
                    extract($cd);
                    ?>
                    <tr>
                        <td class="text-nowrap text-center"><?php echo number_format($HORA).":00"; ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($QTDE,0,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($TOTAL,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($TICKET_MEDIO,2,",","."); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="table-footer">
                    <tr>
                        <td></td>
                        <td class="text-nowrap text-right"><?php echo number_format($Tqtde,0,",","."); ?></td>
                        <td class="text-nowrap text-right bg-warning"><?php echo number_format($Ttotal,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($TTicket,2,",","."); ?></td>
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