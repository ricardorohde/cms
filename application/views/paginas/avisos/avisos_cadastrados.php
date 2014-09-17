<!-- Header da página -->
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-clipboard"></i> Avisos Cadastrados
        </h1>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pull-right">
        <a data-toggle="modal" href="#cadastro_avisos" class="btn btn-primary pull-right header-btn">
            <i class="fa fa-plus fa-lg"></i> Cadastrar Aviso
        </a>
    </div>
</div>
<!--*************************************************************************-->

<!-- Div que receberá o conteúdo via ajax -->
<div id="todos_avisos"></div>
<!--*************************************************************************-->

<!-- Modal que conterá o formulário de cadastro de um novo aviso -->
<div class="modal fade" id="cadastro_avisos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <img src="./img/logo.png" width="150" alt="Clube Campestre Pentáurea">
                </h4>
            </div>
            <div class="modal-body no-padding">
                <form id="salvar_aviso" class="smart-form">
                    <fieldset>
                        <div class="row">
                            <section class="col col-6">
                                <div class="form-group">
                                    <label class="label">
                                        <strong>Selecione a data de expiração da mensagem</strong>
                                    </label>
                                    <div class="input-group">
                                        <label class="input">
                                            <input class="form-control" id="data_expiracao" type="text" placeholder="Data de expiração" required>
                                        </label>
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="row">
                            <section class="col col-12">
                                <label class="label"><strong>Aviso:</strong></label>
                                <label class="textarea"> 
                                    <textarea class="edit" id="mensagem"></textarea>
                                </label>
                            </section>
                        </div>

                    </fieldset>
                    
                    <footer>
                        <button type="submit" class="btn btn-default">
                            <i class="fam-disk"></i> 
                            Adicionar aviso
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
    /** Realiza o carregamento de script via ajax **/
    loadScript('./js/libs/jquery.ui.datepicker-pt-BR.js');
    
    /** Inicialização do Editor de texto **/
    tinymce.init({
        selector: "textarea.edit",
        convert_urls: false,
        language: "pt_BR",
        content_css: "css/bootstrap.css",
        theme: "modern",
        width: '100%',
        height: 150,
        plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak", "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", "directionality emoticons paste textcolor filemanager"],
        image_advtab: true,
        toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media",
        external_filemanager_path: "js/filemanager/filemanager/"
    });
    //**************************************************************************

    /** Inicialização do calendário **/
    $('#data_expiracao').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        minDate: 0
    });
    //**************************************************************************
    
    /** Define esta variável como global **/
    var offset = '';
    
    /** Início do jquery **/
    $(document).ready(function(){
        
        /** Chama a funçao que busca os avisos cadastrados **/
        busca_avisos();
        
        /**
         * Função desenvolvida para salvar os avisos via ajax
         */
        $('#salvar_aviso').submit(function(e) {
            tinyMCE.triggerSave();
            e.preventDefault();

            data_expiracao  = $('#data_expiracao').val();
            mensagem        = $('#mensagem').val();

            $.ajax({
                url: '<?php echo app_baseurl().'avisos/avisos_cadastrados/salvar_aviso' ?>',
                type: 'POST',
                data: {mensagem: mensagem, data_expiracao: data_expiracao},
                dataType: 'html',
                success: function(sucesso)
                {
                    if (sucesso == 1)
                    {
                        $('#cadastro_avisos').modal('hide');
                        msg_sucesso('Aviso salvo');
                        tinymce.activeEditor.setContent('');
                        limpar_campos($('#salvar_aviso'));
                        busca_avisos();
                    }
                    else if(sucesso == 2)
                    {
                        msg_erro('Não foi possível salvar o aviso. Tente novamente');
                    }
                },
                error: function()
                {
                    msg_erro('Ocorreu um erro. Tente novamente.');
                }
            });

        });
        //**********************************************************************
    });
    
    /**
     * busca_avisos()
     * 
     * Funçao que busca os avisos cadastrados
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     */
    function busca_avisos()
    {
        url = '<?php echo app_baseurl().'avisos/avisos_cadastrados/busca_cadastrados/'?>'+offset;
        
        loadAjax(url, $('#todos_avisos'));
    }
    //**************************************************************************
    
    /**
     * Função que previne o evento padrão da paginação e faz o load do mesmo via
     * ajax
     */
    $(document).on("click", ".pagination li a", function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        loadAjax(href, $('#todos_avisos'));
    });
    //**************************************************************************
    
    /**
     * excluir()
     * 
     * Função desenvolvida para exclusão de um aviso
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @param       {int} id Contém o ID da mensagem que será apagada
     */
    function excluir(id)
    {   
        $.SmartMessageBox({
            title: "<i class='fa fa-times txt-color-red'></i> Atenção",
            content: "Você está prestes a apagar um aviso. Deseja continuar?",
            buttons: "[Sim][Não]"
        }, function(e){
            if(e == "Não")
            {
                return false;
            }
            else
            {
                $.post('<?php echo app_baseurl().'avisos/avisos_cadastrados/apagar_aviso'?>', {id: id}, function(e){
                    if(e == 1)
                    {
                        busca_avisos();
                        msg_sucesso('Aviso excluido');
                    }
                    else
                    {
                        msg_erro('Não foi possível excluir. Tente novamente');
                    }
                }).fail(function(){
                    msg_erro('Ocorreu um erro. Tente novamente');
                });
            }
        });
    }
    //**************************************************************************
    
    /**
     * inativar()
     * 
     * Função desenvolvida para inativar avisos
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @param       {int} id Contém o ID do aviso que será inativado
     */
     function inativar(id)
     {
        $.post('<?php echo app_baseurl().'avisos/avisos_cadastrados/inativar_aviso'?>', {id: id}, function(e){
            if(e == 1)
            {
                busca_avisos();
                msg_sucesso('Aviso Inativado');
            }
            else
            {
                msg_erro('Não foi possível inativar. Tente novamente');
            }
        }).fail(function(){
            msg_erro('Ocorreu um erro. Tente novamente');
        });
     }
     //*************************************************************************
     
     /**
     * ativar()
     * 
     * Função desenvolvida para ativar avisos
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @param       {int} id Contém o ID do aviso que será ativado
     */
     function ativar(id)
     {
        $.post('<?php echo app_baseurl().'avisos/avisos_cadastrados/ativar_aviso'?>', {id: id}, function(e){
            if(e == 1)
            {
                busca_avisos();
                msg_sucesso('Aviso ativado');
            }
            else
            {
                msg_erro('Não foi possível ativar. Tente novamente');
            }
        }).fail(function(){
            msg_erro('Ocorreu um erro. Tente novamente');
        });
     }
     //*************************************************************************
</script>