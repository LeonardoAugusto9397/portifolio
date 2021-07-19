<?php if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'][0])) {
    extract($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'][0]);

$TValor = 0;
?>

<!--- Modal Documento Fiscal --->
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <div class="text-center font-weight-bold mb-2">
                <div class="text-sm">Extrato Nº: <?php echo $NUMERO_CFE; ?></div>
                <div class="text-sm">CUPOM FISCAL ELETRÔNICO</div>
            </div>
            <div class="font-weight-bold mb-2">
                <div class="text-sm">CPF/CNPJ: <?php echo $DOCUMENTO; ?></div>
                <div class="text-sm">Razão Social/Nome: <?php echo $NOME; ?></div>
            </div>
            <table class="table table-striped table-sm border-top">
                <thead>
                    <tr>
                        <th class="text-nowrap text-right">CODIGO</th>
                        <th class="text-nowrap">DESCRIÇÃO</th>
                        <th class="text-nowrap text-right">QTDE.</th>
                        <th class="text-nowrap text-right">VALOR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Dados['DOCUMENTO_FISCAL_ELETRONICO'] as $dfe) {
                        $TValor = $dfe['QTDE'] * $dfe['VALOR_UNITARIO'];
                    extract($dfe);
                    ?>
                    <tr>
                        <td class="text-nowrap text-right"><?php echo $ID_PRODUTO_FILIAL; ?></td>
                        <td class="text-nowrap"><?php echo $DESCRICAO; ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($QTDE,0,",","."); ?></td>
                        <td class="text-nowrap text-right"><?php echo number_format($TValor,2,",","."); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <td class="text-nowrap">SUBTOTAL</td>
                        <td class="text-right"><?php echo number_format($VALOR_SUBTOTAL,2,",","."); ?></td>
                    </tr>
                    <tr>
                        <td class="text-nowrap">DESCONTO</td>
                        <td class="text-right"><?php echo number_format($VALOR_DESCONTO,2,",","."); ?></td>
                    </tr>
                    <tr>
                        <td class="text-nowrap">ACRESCIMO</td>
                        <td class="text-right"><?php echo number_format($VALOR_ACRESCIMO,2,",","."); ?></td>
                    </tr>
                    <tr>
                        <td class="text-nowrap font-weight-bold">TOTAL</td>
                        <td class="text-right bg-warning"><?php echo number_format($VALOR_LIQUIDO,2,",","."); ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <div class="text-sm font-weight-bold"><?php echo date('d/m/Y H:i', strtotime($DATA_HORA_EMISSAO)); ?></div>
                <div class="text-sm"><?php echo $CHAVE_ACESSO; ?></div>
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