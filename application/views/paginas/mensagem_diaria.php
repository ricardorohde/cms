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
        
        /** Chamada da função que busca as mensagens cadastradas **/
        busca_mensagens();

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
                        msg_sucesso('Mensagem cadastrada');
                        limpar_campos($('#nova_mensagem'));
                        $('#cadastro_mensagem').modal('hide');
                        busca_mensagens();
                    }
                    else
                    {
                        msg_erro('Erro ao salvar os dados. Tente novamente');                        
                    }
                }
            });
        });
        //**********************************************************************
    });

    /** Função desenvolvida para buscar as mensagens cadastradas **/
    function busca_mensagens()
    {
        url = '<?php echo app_baseurl() . 'mensagem_diaria/busca_mensagens' ?>';
        
        loadAjax(url, $('#mensagens_cadastradas'));
    }
</script>