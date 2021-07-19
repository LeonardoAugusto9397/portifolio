<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}

if(!empty($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'][0])) {
    extract($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'][0]);

$Tsubtotal  = 0;
$Tdesconto  = 0;
$Tacrescimo = 0;
$Tliquido   = 0;
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-bar-chart-2 bg-purple"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate">DOCUMENTOS FISCAIS CANCELADOS</h5>
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

        <!--- Documentos Fiscais Cancelados --->
        <div class="table-fixed" id="table-print">
            <table class="table table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th class="text-center">DATA/HORA</th>
                        <th class="text-right">SUBTOTAL</th>
                        <th class="text-right">DESCONTO</th>
                        <th class="text-right">ACRESCIMO</th>
                        <th class="text-right">LIQUIDO</th>
                        <th class="text-center">CNPJ</th>
                        <th class="text-center text-nowrap">NUMERO CFE</th>
                        <th class="text-center text-nowrap">CHAVE CANCELAMENTO</th>
                        <th class="text-left">MOTIVO</th>
                        <th class="text-center text-nowrap">VISUALIZAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'] as $dfe) {
                        $Tsubtotal  += $dfe['VALOR_SUBTOTAL'];
                        $Tdesconto  += $dfe['VALOR_DESCONTO'];
                        $Tacrescimo += $dfe['VALOR_ACRESCIMO'];
                        $Tliquido   += $dfe['VALOR_LIQUIDO'];
                    extract($dfe);
                    ?>
                    <tr>
                        <td class="text-nowrap text-center pt-3"><?php echo date('d/m/Y H:i', strtotime($DATA_HORA_CANCELAMENTO)); ?></td>
                        <td class="text-nowrap text-right pt-3"><?php echo number_format($VALOR_SUBTOTAL,2,",","."); ?></td>
                        <td class="text-nowrap text-right pt-3"><?php echo number_format($VALOR_DESCONTO,2,",","."); ?></td>
                        <td class="text-nowrap text-right pt-3"><?php echo number_format($VALOR_ACRESCIMO,2,",","."); ?></td>
                        <td class="text-nowrap text-right pt-3"><?php echo number_format($VALOR_LIQUIDO,2,",","."); ?></td>
                        <td class="text-center text-nowrap pt-3"><?php echo $CNPJ; ?></td>
                        <td class="text-center text-nowrap pt-3 bg-danger"><?php echo $NUMERO_CFE; ?></td>
                        <td class="text-center text-nowrap pt-3"><?php echo $CHAVE_CANCELAMENTO; ?></td>
                        <td class="text-nowrap text-nowrap pt-3"><?php echo $INF_COMPL; ?></td>
                        <td class="text-center">
                            <a href="javascript:" class="view_documento_fiscal" id_documento_fiscal="<?php echo $ID; ?>">
                                <i class="ik ik-file"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="table-footer">
                    <tr>
                        <td></td>
                        <td class="text-nowrap text-right"><?php echo number_format($Tsubtotal,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($Tdesconto,2,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($Tacrescimo,2,",","."); ?></td>
                        <td class="text-nowrap text-right bg-warning"><?php echo number_format($Tliquido,2,",","."); ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!---- Modal Documento Fiscal ---->
        <div class="modal fade" id="modal-documento_fiscal" data-backdrop="static"></div>
    </div>
</div>

<!---- Exibe mensagem caso não encontre resultados ---->
<?php } else {
    $_SESSION['msg'] = "<div class='alert alert-info text-center'>Sem resultados!</div>";
    $UrlDestino = URL . 'relatorio/dashboard';
    header("Location: $UrlDestino");
}