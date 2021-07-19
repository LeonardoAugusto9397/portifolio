<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if(!empty($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'][0])) {
    extract($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'][0]);

$VlTotal    = 0;
$VlGorjeta  = 0;
$VlDesconto = 0;
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-bar-chart-2 bg-purple"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">CONTAS RECEBIDAS</h5>
                            <!--<h6 class="text-truncate">01/01/2020 à 31/01/2020</h6>-->
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-right">
                        <button type="button" class="btn btn-danger" data-target="#myModal" data-toggle="modal">REABRIR AUDITORIA</button>
                        <button type="button" class="btn btn-outline-dark">
                            <i class="ik ik-download"></i>
                        </button>
                        <button type="button" class="btn btn-outline-dark" id="btn-print">
                            <i class="ik ik-printer"></i>
                        </button>
                        <a href="<?php echo URL . 'relatorio/dashboard'; ?>" class="btn btn-dark">VOLTAR</a>
                    </div>

                    <!-- Confirmar Exclusão -->
                    <div class="modal fade" id="myModal" data-backdrop="static">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="modal-confirm-icon">
                                        <i class="ik ik-alert-circle"></i>
                                    </div>
                                    <div class="modal-confirm-mensage">Deseja reabrir o MOVIM?</div>
                                    <div class="modal-confirm-title">Referente á 04/07/2021</div>
                                </div>
                                <div class="modal-footer modal-confirm-button">
                                    <button type="button" class="btn btn-danger">REABRIR</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--- Contas Recebidas --->
        <div class="table-fixed" id="table-print">
            <table class="table">
                <thead class="table-header">
                    <tr>
                        <th class="text-nowrap">RECEBIMENTO</th>
                        <th class="text-nowrap text-right">SALÃO</th>
                        <th class="text-nowrap text-right">DELIVERY</th>
                        <th class="text-nowrap text-right">TOTAL USUÁRIO</th>
                        <th class="text-nowrap text-right">TOTAL SISTEMA</th>
                        <th class="text-nowrap text-right">DIFERENÇA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'] as $dfe) {
                        $VlTotal    += $dfe['VALOR_TOTAL'];
                        $VlGorjeta  += $dfe['VALOR_ACRESCIMO'];
                        $VlDesconto += $dfe['VALOR_DESCONTO'];
                    extract($dfe);
                    ?>
                    <tr>
                        <td class="text-nowrap"><?php echo $DESCRICAO; ?></td>
                        <td class="text-nowrap text-right">0.00</td>
                        <td class="text-nowrap text-right">0.00</td>
                        <td class="text-nowrap text-right">0.00</td>
                        <td class="text-nowrap text-right">0.00</td>
                        <td class="text-nowrap text-right bg-light-blue"><?php echo number_format($VALOR_TOTAL,2,",","."); ?></td>
                        <td class="text-nowrap text-right bg-warning">0.00</td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="table-footer">
                    <tr>
                        <td></td>
                        <td class="text-nowrap text-right">0.00</td>
                        <td class="text-nowrap text-right">0.00</td>
                        <td class="text-nowrap text-right">0.00</td>
                        <td class="text-nowrap text-right">0.00</td>
                        <td class="text-nowrap text-right bg-light-blue"><?php echo number_format($VlTotal,2,",","."); ?></td>
                        <td class="text-nowrap text-right bg-warning">0.00</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!---- Totalizadores ---->
        <!--<div class="text-nowrap text-sm text-center font-weight-bold bg-primary p-1">TOTALIZADORES</div>
        <table class="table table-hover table-sm">
            <tbody>
                <tr>
                    <td class="text-nowrap">GORJETA</td>
                    <td class="text-right"><?php echo number_format($VlGorjeta,2,",","."); ?></td>
                </tr>
                <tr>
                    <td class="text-nowrap">DESCONTO</td>
                    <td class="text-right"><?php echo number_format($VlDesconto,2,",","."); ?></td>
                </tr>
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