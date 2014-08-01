<!-- Header da view. Possui botão que chama um modal para cadastro de novas mensagens -->
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-file-text-o"></i> Mensagens Diárias
        </h1>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pull-right">
        <a data-toggle="modal" href="#cadastro_mensagem" class="btn btn-primary pull-right header-btn">
            <i class="fa fa-plus fa-lg"></i> Cadastrar nova mensagem
        </a>
    </div>
</div>
<!--*************************************************************************-->

<!-- Div onde serão inseridas mensagens cadastradas -->
<div id="mensagens_cadastradas"></div>
<!--*************************************************************************-->

<!-- Janela Modal que realiza o cadastro de uma nova mensagem -->
<div class="modal fade" id="cadastro_mensagem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" data-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <img src="img/logo.png" width="150" alt="Clube Campestre Pentáurea">
                </h4>
            </div>
            <div class="modal-body no-padding">
                <form id="nova_mensagem" class="smart-form">
                    <fieldset>
                        <section>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label class="input">
                                        <input type="text" placeholder="Nome do autor" id="autor" maxlength="50" required autofocus>
                                    </label>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label class="textarea">
                                        <textarea id="mensagem" rows="6" placeholder="Digite a mensagem diária" maxlength="500" required></textarea>
                                    </label>
                                </div>
                            </div>
                        </section>
                    </fieldset>
                    <footer>
                        <button type="submit" class="btn btn-default">
                            <i class="fam-disk"></i> 
                            Salvar mensagem
                        </button>
                        <button id="atualizar_depois" type="button" class="btn btn-default" data-dismiss="modal">
                            <i class="fam-cross"></i> 
                            Cancelar
                        </button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
</div>
<!--*************************************************************************-->

<script type="text/javascript">
    /** Inicalização do jquery **/
    $(document).ready(function() {

        /** Realiza o salvamento da mensagem **/
        $('#nova_mensagem').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?php echo app_baseurl() . 'mensagem_diaria/salvar_mensagem' ?>',
                type: 'POST',
                data: {mensagem: $('#mensagem').val(), autor: $('#autor').val()},
                dataType: 'html',
                success: function(sucesso) {
                    if (sucesso == 1)
                    {
                        $.smallBox({
                            title: "<i class='fa fa-check'></i> Sucesso",
                            content: "Mensagem cadastrada",
                            iconSmall: "fa fa-thumbs-down bounce animated",
                            color: "#5CB811",
                            timeout: 5000
                        });
                        $('#nova_mensagem').find('input, textarea').val('');
                        $('#cadastro_mensagem').modal('hide');
                        busca_mensagens();
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
                error: function() {
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

        /** Chamada da função que busca as mensagens cadastradas **/
        busca_mensagens();

        /** Função desenvolvida para excluir uma mensagem **/
        $(document).on('click', '.excluir', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.SmartMessageBox({
                title: 'Atenção',
                content: "Você está prestes a excluir uma mensagem. Deseja prosseguir?",
                buttons: '[Não][Sim, exclua para mim]'
            }, function(botao) {
                if (botao == "Sim, exclua para mim")
                {
                    $.ajax({
                        url: '<?php echo app_baseurl() . 'mensagem_diaria/excluir_mensagem' ?>',
                        type: 'POST',
                        data: {id: id},
                        dataType: 'html',
                        success: function(sucesso) {
                        
                            alert(sucesso)
                            if (sucesso == 1)
                            {
                                $.smallBox({
                                    title: "<i class='fa fa-check'></i> Sucesso",
                                    content: "Mensagem excluida",
                                    iconSmall: "fa fa-thumbs-down bounce animated",
                                    color: "#5CB811",
                                    timeout: 5000
                                });
                                busca_mensagens();
                            }
                            else
                            {
                                $.smallBox({
                                    title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                                    content: "<strong>Não foi possível excluir. Tente novamente</strong>",
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
                }
                else
                {
                    return false;
                }
            });
        });
    });

    /** Função desenvolvida para buscar as mensagens cadastradas **/
    function busca_mensagens()
    {
        $('#mensagens_cadastradas').html('<h4><i class="fa fa-cog fa-spin"></i> Buscando mensagens</h4>');

        $.get('<?php echo app_baseurl() . 'mensagem_diaria/busca_mensagens' ?>', function(e) {
            $('#mensagens_cadastradas').html(e);
        });
    }
</script>