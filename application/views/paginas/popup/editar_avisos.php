<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-fw fa-clipboard"></i> Edição de Avisos
        </h1>
    </div>
</div>
<?php
    if(!$aviso)
    {
        ?>
        <div class="alert alert-block alert-danger">
            <h4 class="alert-heading"><i class="fa fa-times"></i> Erro</h4>
            <p>
                Não foi possível resgatar o aviso
            </p>
        </div>
        <?php
    }
    else
    {
        ?>
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                        <header>
                            <span class="widget-icon">
                                <i class="fa fa-clipboard"></i>
                            </span>
                            <h2>Editar um aviso cadastrado</h2>
                        </header>
                        <div>
                        <div class="widget-body no-padding">
                            <form id="atualizar_aviso" class="smart-form">
                                <?php
                                    foreach($aviso as $row)
                                    {
                                        ?>
                                        <input type="hidden" id="id_aviso" value="<?php echo $row->id?>">
                                        <fieldset>
                                            <div class="row">
                                                <section class="col col-6">
                                                    <div class="form-group">
                                                        <label class="label">
                                                            <strong>Selecione a data de expiração da mensagem</strong>
                                                        </label>
                                                        <div class="input-group">
                                                            <label class="input">
                                                                <input class="form-control" id="data_expiracao" type="text" placeholder="Data de expiração" required="" value="<?php echo $row->data_expiracao?>">
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
                                                        <textarea class="edit" id="mensagem">
                                                            <?php echo $row->mensagem?>
                                                        </textarea>
                                                    </label>
                                                </section>
                                            </div>

                                        </fieldset>
                    
                                        <footer>
                                            <button type="submit" class="btn btn-default">
                                                <i class="fam-disk"></i> 
                                                Atualizar aviso
                                            </button>
                                            <button type="button" class="btn btn-default" onclick="window.close();">
                                                <i class="fam-cross"></i> 
                                                Fechar esta janela
                                            </button>
                                        </footer>
                                        <?php
                                    }
                                ?>
                            </form>
                        </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
        <?php
    }
?>

<script src="./js/app.js"></script>
<script src="./js/ajax.js"></script>
<script src="./js/libs/jquery-ui-1.10.3.min.js"></script>
<script src="./js/plugin/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="./js/bootstrap/bootstrap.min.js"></script>
<script src="./js/notification/SmartNotification.min.js"></script>
<script src="./js/smartwidgets/jarvis.widget.min.js"></script>
<script src="./js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
<script src="./js/blockUI.js"></script>
<script src="./js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script src="./js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="./js/fancybox/jquery.fancybox.js" type="text/javascript"></script>
<script src="./js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script src="./js/libs/jquery.ui.datepicker-pt-BR.js"></script>
<script type="text/javascript">
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
    
    /**
     * função desenvolvida para fazer a atualização do aviso
     */
    $('#atualizar_aviso').submit(function(e){
        tinyMCE.triggerSave();
        e.preventDefault();
        
        id              = $('#id_aviso').val();
        data_expiracao  = $('#data_expiracao').val();
        mensagem        = $('#mensagem').val();
        
        $.ajax({
            url: "<?php echo app_baseurl().'avisos/avisos_cadastrados/atualizar_aviso'?>",
            type: "POST",
            data: {
                id: id,
                data_expiracao: data_expiracao,
                mensagem: mensagem
            },
            dataType: 'html',
            success: function(sucesso)
            {
                if(sucesso == 1)
                {
                    msg_sucesso('Aviso atualizado');
                    window.opener.busca_avisos();
                    
                    setTimeout(function() {
                        window.close();
                    }, 1000);
                }
                else
                {
                    msg_erro('Não foi possível atualizar o aviso. Tente novamente');
                }
            },
            error: function()
            {
                msg_erro('Ocorreu um erro. Tente mais tarde');
            }
        });
        //**********************************************************************
    });
</script>