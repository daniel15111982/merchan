$(document).ready(function(){
    configura_mascaras();
});

function configura_mascaras(){
    $('.cnpj').mask('99.999.999/9999-99');

    $('.cpf_cnpj').mask("999.999.999-99?99999");
    $('#telefone').mask('(00) 0000-00000');
    $('#number').mask("9999999999");

    $('#cpf').mask('000.000.000-00');

    $('.cpf_cnpj').live('keyup', function (e) {

        var query = $(this).val().replace(/[^a-zA-Z 0-9]+/g,'');;

        if (query.length == 11) {
            $('.cpf_cnpj').mask("999.999.999-99?99999");
        }

        if (query.length == 14) {
            $('.cpf_cnpj').mask("99.999.999/9999-99");
        }
    });

    $('.cep').mask('99999-999');
    $('.fone').mask('(99) 9999-9999?9');


}

function get_cidades_from_estado(idEstado, idSelectCidade)
{
    jQuery('#' + idSelectCidade).html("Carregando...");

    jQuery("#" + idSelectCidade).load("cidades_estados/ajax_get_cidades_from_estado/" + idEstado, '', function() {

        if (!idEstado) {
            jQuery('#' + idSelectCidade).html("Selecione um Estado");
        }
    });

}

function get_cidades_from_estado_empresa(idEstado, idSelectCidade)
{
    jQuery('#' + idSelectCidade).html("Carregando...");

    jQuery("#" + idSelectCidade).load("cidades_estados/ajax_get_cidades_from_estado_empresa/" + idEstado, '', function() {

        if (!idEstado) {
            jQuery('#' + idSelectCidade).html("Selecione um Estado");
        }
    });

}
