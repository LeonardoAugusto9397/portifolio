<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if(!empty($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'][0])) {
    extract($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'][0]);

$VlTotal = 0;
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-bar-chart-2 bg-purple"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">AUDITORIA</h5>
                            <!--<h6 class="text-truncate">01/01/2020 à 31/01/2020</h6>-->
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary" name="">SALVAR</button>
                        <a href="<?php echo URL . 'relatorio/dashboard'; ?>" class="btn btn-dark">CANCELAR</a>
                    </div>
                </div>
            </div>
        </div>

        <!---- Auditoria ---->
        <div class="table-fixed">
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
                        $VlTotal += $dfe['VALOR_TOTAL'];
                    extract($dfe);
                    ?>
                    <tr>
                        <td class="text-nowrap"><?php echo $DESCRICAO; ?></td>
                        <td class="text-nowrap text-right">
                            <a href="javascript:;" id="table-edit">0.00</a>
                        </td>
                        <td class="text-nowrap text-right">
                            <a href="javascript:;" id="table-edit">0.00</a>
                        </td>
                        <td class="text-nowrap text-right bg-light-grey">0.00</td>
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
                        <td class="text-nowrap text-right bg-light-grey">0.00</td>
                        <td class="text-nowrap text-right bg-light-blue"><?php echo number_format($VlTotal,2,",","."); ?></td>
                        <td class="text-nowrap text-right bg-warning">0.00</td>
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