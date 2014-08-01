<script src="./js/libs/jquery.ui.datepicker-pt-BR.js"></script>
<script type="text/javascript">
    /** Inicio do jquery **/
    $(document).ready(function() {

        /** Eventos para o submit do form **/
        $('#salvar_aviso').submit(function(e) {
            tinyMCE.triggerSave();
            e.preventDefault();

            data_expiracao = $('#data_expiracao').val();
            mensagem = $('#mensagem').val();

            $.ajax({
                url: '<?php echo app_baseurl().'avisos/novo_aviso/salvar_aviso' ?>',
                type: 'POST',
                data: {mensagem: mensagem, data_expiracao: data_expiracao},
                dataType: 'html',
                success: function(sucesso)
                {
                    if (sucesso == 1)
                    {
                        $.smallBox({
                            title: "<i class='fa fa-check'></i> Sucesso",
                            content: "<strong>Aviso salvo com sucesso.</strong>",
                            iconSmall: "fa fa-thumbs-up bounce animated",
                            color: "#5CB811",
                            timeout: 5000
                        });
                        url = "index.php?/avisos/avisos_cadastrados";
                        loadURL(url, $("#content"));
                    }
                    else if(sucesso == 2)
                    {
                        $.smallBox({
                            title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                            content: "<strong>Não foi possível salvar o aviso. Tente novamente</strong>",
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
                        content: "<strong>Ocorreu um erro. Tente novamente.</strong>",
                        color: "#FE1A00",
                        iconSmall: "fa fa-thumbs-down bounce animated",
                        timeout: 5000
                    });
                }
            });

        });

        /** Inicialização do Editor de texto **/
        tinymce.init({
            selector: "textarea.edit",
            convert_urls: false,
            language: "pt_BR",
            content_css: "css/bootstrap.css",
            theme: "modern",
            width: '100%',
            height: 300,
            filemanager_title: "MasterAdmin - Gerenciador de Arquivos",
            plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak", "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", "table contextmenu directionality emoticons paste textcolor filemanager"],
            image_advtab: true,
            toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code",
            external_filemanager_path: "js/filemanager/filemanager/"
        });

        /** Inicialização do calendário **/
        $('#data_expiracao').datepicker({
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            minDate: 0
        });
    });
</script>

<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-clipboard"></i> Novo Aviso
        </h1>
    </div>
</div>

<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget" id="wid-id" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">

                <!-- Header do painel -->
                <header>
                    <span class="widget-icon">
                        <i class="fa fa-clipboard"></i>
                    </span>
                    <h2>Criar um aviso</h2>
                </header>
                <!--*********************************************************-->

                <!-- Corpo do Widget -->
                <div>
                    <div class="widget-body no-padding">
                        <form id="salvar_aviso" class="smart-form">
                            <fieldset>

                                <div class="row">
                                    <section class="col col-6">
                                        <div class="form-group">
                                            <label class="label">
                                                <strong>Digite a data de expiração da mensagem</strong>
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
                                        <label class="label"><strong>Corpo da Notícia:</strong></label>
                                        <label class="texarea"> 
                                            <textarea class="edit" id="mensagem"></textarea>
                                        </label>
                                    </section>
                                </div>

                            </fieldset>

                            <footer>
                                <button class="btn btn-primary" type="submit"><i class="fam-accept"></i> Salvar Notícia</button>
                                <button class="btn btn-warning" type="reset"><i class="fam-error"></i>Limpar Formulário</button>
                            </footer>
                        </form>
                    </div>
                </div>
                <!--*********************************************************-->

            </div>
        </article>
    </div>
</section>