<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->Dados['ADMIN_PAGINA'][0])) {
    extract($this->Dados['ADMIN_PAGINA'][0]);
?>

<div class="page">
    <div class="page-content">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-12">
                    <div class="page-header-title">
                        <i class="ik ik-bar-chart-2 bg-purple"></i>
                        <div class="d-inline">
                            <h5 class="text-truncate"><?php echo $RELATORIO; ?></h5>
                            <!--<h6 class="text-truncate"><?php echo $RELATORIO_TIPO; ?></h6>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo "<form method='POST' action='" . URL . $URL_CONTROLLER . "/" . $URL_METODO . "'>"; ?>

            <!---- Seleciona Data ---->
            <div class="row">
                <div class="md-form col-md-6">
                    <label>De</label>
                    <input type="date" class="form-control" name="data_inicio" value="<?php echo date('Y-m-d', strtotime("-1 days"));?>">
                </div>
                <div class="md-form col-md-6">
                    <label>Até</label>
                    <input type="date" class="form-control" name="data_fim" value="<?php echo date('Y-m-d', strtotime("-1 days"));?>">
                </div>
            </div>

            <div class="row">

                <!------ Período ------>
                <div class="md-form col-md-4">
                    <label>Período</label>
                    <select class="custom-select" id="periodo" name="periodo">
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>

                <!------ Módulos ------>
                <div class="md-form col-md-4">
                    <label>PDV</label>
                    <select class="custom-select" id="pdv" name="pdv">
                        <option value=""></option>
                        <?php foreach ($this->Dados['SISTEMA'] as $pdv) {
                        extract($pdv);
                        ?>
                        <option value="<?php echo $ID; ?>"><?php echo $DESCRICAO; ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <!-------- PDV -------->
                <div class="md-form col-md-4">
                    <label>PDV Nº</label>
                    <select class="custom-select" id="pdv_numero" name="pdv_numero">
                        <option value=""></option>
                        <?php foreach ($this->Dados['SISTEMA'] as $pdv_numero) {
                        extract($pdv_numero);
                        ?>
                        <option value="<?php echo $NUMERO; ?>"><?php echo $NUMERO; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!--- Gerar Relatório --->
            <div class="row">
                <div class="col-12">
                    <div class="float-right">
                        <input type="submit" name="BtnGerarRelatorio" value="GERAR RELATÓRIO" class="btn btn-purple">
                        <a href="<?php echo URL . 'relatorio/dashboard'; ?>" class="btn btn-dark">VOLTAR</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!---- Exibe mensagem caso não encontre resultados ---->
<?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-warning text-center'>Relatório não encontrado!</div>";
    $UrlDestino = URL . 'relatorio/dashboard';
    header("Location: $UrlDestino");
}