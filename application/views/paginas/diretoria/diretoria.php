<script>
    /**
     * Inicialização do JQuery
     */
    $(document).ready(function() {
        /**
         * Chamada da função que irá mostrar as diretorias
         */
        busca_diretorias();

        /*
         * Função utilizada para inicialização dos formulários
         */
        runAllForms();

        /**
         * Função utilizada para previnir a ação padrão dos links de paginação e 
         * chamar a próxima página dos presidentes via ajax
         */
        $(document).on("click", ".pagination li a", function(e) {
            e.preventDefault();
            var href = $(this).attr("href");
            $('#presidentes_cadastrados').load(href).fadeIn('slow');
        });

        /**
         * Função desenvolvida para salvar a diretoria
         */
        $('#nova_diretoria').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo app_baseurl() . 'diretoria/diretoria/salvar_diretoria' ?>',
                type: 'POST',
                data: {
                    ano_inicio: $('#ano_inicio').val(),
                    ano_final: $('#ano_final').val(),
                    observacoes: $('#observacoes').val()
                },
                dataType: 'html',
                success: function(sucesso)
                {
                    if (sucesso == 1)
                    {
                        $.smallBox({
                            title: "<i class='fa fa-check'></i> Sucesso",
                            content: "Diretoria cadastrado",
                            iconSmall: "fa fa-thumbs-down bounce animated",
                            color: "#5CB811",
                            timeout: 5000
                        });
                        $('#ano_inicio').val('');
                        $('#ano_final').val('');
                        $('#observacoes').val('');
                        $('#cadastro_diretoria').modal('hide');
                        busca_diretorias();
                    }
                    else
                    {
                        $.smallBox({
                            title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                            content: "<strong>Erro ao salvar os dados. Tente novamente</strong>",
                            color: "#FE1A00",
                            iconSmall: "fa fa-thumbs-down bounce animated",
                            timeout: 5000
                        });
                    }
                },
                error: function()
                {
                    $.smallBox({
                        title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                        content: "<strong>Ocorreu um erro. Tente novamente</strong>",
                        color: "#FE1A00",
                        iconSmall: "fa fa-thumbs-down bounce animated",
                        timeout: 5000
                    });
                }
            });
        });

        /**
         * Função desenvolvida para limpar os campos do modal quando ele for 
         * fechado
         */
        $('#fechar_modal').click(function() {
            $('#ano_inicio').val('');
            $('#ano_final').val('');
            $('#observacoes').val('');
        });
    });

    /**
     * Função desenvolvida para buscar as diretorias cadastradas
     */
    function busca_diretorias() {
        $('#diretorias_cadastradas').empty().html('<h4><i class="fa fa-cog fa-spin"></i> Realizando pesquisa...</h4>');
        $.get('<?php echo app_baseurl() . 'diretoria/diretoria/busca_diretorias' ?>', function(e) {
            $('#diretorias_cadastradas').html(e);
        });
    }
</script>
<!-- Header da página -->
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-book"></i> Cadastro de diretorias
        </h1>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pull-right">
        <a data-toggle="modal" href="#cadastro_diretoria" class="btn btn-primary btn-lg pull-right header-btn">
            <i class="fa fa-plus"></i> Cadastrar diretoria
        </a>
    </div>
</div>
<!--*************************************************************************-->

<!-- Div onde serão inseridas diretorias cadastradas -->
<div id="diretorias_cadastradas"></div>
<!--*************************************************************************-->

<!-- Modal que contem o formulário para inclusão da diretoria -->
<div class="modal fade" id="cadastro_diretoria" aria-hidden="true" data-backdrop="false" data-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <img src="./img/logo.png" width="150" alt="Clube Campestre Pentáurea">
                </h4>
            </div>
            <div class="modal-body no-padding">
                <form id="nova_diretoria" class="smart-form">
                    <fieldset>
                        <section>
                            <div class="row">
                                <div class="col col-md-6">
                                    <label class="label"></label>
                                    <label class="input">
                                        <i class="icon-append fa fa-calendar"></i>
                                        <input id="ano_inicio" type="text" class="form-control" placeholder="Início do mandato" data-mask="9999" data-mask-placeholder="*" required>
                                    </label>
                                </div>
                                <div class="col col-md-6">
                                    <label class="label"></label>
                                    <label class="input">
                                        <i class="icon-append fa fa-calendar"></i>
                                        <input id="ano_final" type="text" class="form-control" placeholder="Fim do mandato" data-mask="9999" data-mask-placeholder="*" required>
                                    </label>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label class="textarea">
                                        <i class="icon-prepend fa fa-comment-o"></i>
                                        <textarea id="observacoes" rows="5" maxlength="500" placeholder="Comentários sobre esta diretorias"></textarea>
                                    </label>
                                </div>
                            </div>
                        </section>
                    </fieldset>
                    <footer>
                        <button type="submit" class="btn btn-default">
                            <i class="fam-disk"></i> Salvar diretoria
                        </button>
                        <button id="fechar_modal" type="button" class="btn btn-default" data-dismiss="modal">
                            <i class="fam-cross"></i> Cancelar
                        </button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************-->