$(document).ready(function () {

    //********************** PRODUTO **********************//
    /*** Modal PRODUTO ***/
    $(document).on('click', '.view_produto', function() {
        var view_produto = $(this).attr('id_produto');       
        if(view_produto !== '') {
            var dados = {
                view_produto: view_produto
            };
            $.post('../produto/produto-edit/' + view_produto, dados, function(retorna) {
                $(".modal").html(retorna);
                $('#modal-produto').modal('show');
            });
        }
    });

    //******************* CONFIGURAÇÕES *******************//
    /** Modal BANCO **/
    $(document).on('click', '.view_modal_banco', function() {
        var view_banco = $(this).attr('id_banco');
        if(view_banco !== '') {
            var dados = {
                view_banco: view_banco
            };
            $.post('../configuration/banco-edit/' + view_banco, dados, function(retorna) {
                $(".modal").html(retorna);
                $('#exibe-banco').modal('show');
            });
        }
    });

    /*** Modal PERMISSÕES ***/
    $(document).on('click', '.view_permissao', function() {
        var view_permissao = $(this).attr('id_perfil');       
        if(view_permissao !== '') {
            var dados = {
                view_permissao: view_permissao
            };
            $.post('../configuration/permission-edit/' + view_permissao, dados, function(retorna) {
                $(".modal").html(retorna);
                $('#modal-permissao').modal('show');
            });
        }
    });

    //********************* RELATÓRIO *********************//
    /*** Modal DOCUMENTOS FISCAIS ***/
    $(document).on('click', '.view_documento_fiscal', function() {
        var view_documento_fiscal = $(this).attr('id_documento_fiscal');       
        if(view_documento_fiscal !== '') {
            var dados = {
                view_documento_fiscal: view_documento_fiscal
            };
            $.post('../relatorio/documentos-fiscais-view/' + view_documento_fiscal, dados, function(retorna) {
                /*alert(retorna);*/
                $(".modal").html(retorna);
                $('#modal-documento_fiscal').modal('show');
            });
        }
    });
});