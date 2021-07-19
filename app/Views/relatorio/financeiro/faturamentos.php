<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'][0])) {
    extract($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'][0]);

$VlTotalMes = 0;
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-bar-chart-2 bg-purple"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">FATURAMENTOS</h5>
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

        <!----- Faturamentos ----->
        <div class="table-fixed" id="table-print">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th class="text-center">Dia</th>
                        <th class="text-center">JAN</th>
                        <th class="text-center">FEV</th>
                        <th class="text-center">MAR</th>
                        <th class="text-center">ABR</th>
                        <th class="text-center">MAI</th>
                        <th class="text-center">JUN</th>
                        <th class="text-center">JUL</th>
                        <th class="text-center">AGO</th>
                        <th class="text-center">SET</th>
                        <th class="text-center">OUT</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'] as $dfe_total) {
                    extract($dfe_total);
                    ?>
                    <tr>
                        <th class="text-center border-right"><?php echo $DIA; ?></th>
                        <td class="text-right border-right">12.568,86</td>
                        <td class="text-right border-right">12.568,86</td>
                        <td class="text-right border-right">12.568,86</td>
                        <td class="text-right border-right">12.568,86</td>
                        <td class="text-right border-right">12.568,86</td>
                        <td class="text-right border-right">12.568,86</td>
                        <td class="text-right border-right">12.568,86</td>
                        <td class="text-right border-right">12.568,86</td>
                        <td class="text-right border-right">12.568,86</td>
                        <td class="text-right border-right">12.568,86</td>
                        <th class="text-right table-column">12.568,8</th>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="table-footer">
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-right">12.568,86</td>
                        <td class="text-right">12.568,86</td>
                        <td class="text-right">12.568,86</td>
                        <td class="text-right">12.568,86</td>
                        <td class="text-right">12.568,86</td>
                        <td class="text-right">12.568,86</td>
                        <td class="text-right">12.568,86</td>
                        <td class="text-right">12.568,86</td>
                        <td class="text-right">12.568,86</td>
                        <td class="text-right">12.568,86</td>
                        <td class="text-right bg-warning">12.568,86</td>
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