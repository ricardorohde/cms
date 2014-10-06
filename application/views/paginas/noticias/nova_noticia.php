<script type="text/javascript">

    /** Configuração para o Gerenciador de arquivos **/
    $('.iframe-btn').fancybox({
        'width': '900px',
        'height': '600px',
        'type': 'iframe',
        'autoSize': false,
        'autoScale': false
    });
    //**************************************************************************

    /** Função ajax para salvar os dados primários da notícia **/
    $("#configuracao_noticia").submit(function(e) {
        tinyMCE.triggerSave();
        e.preventDefault();
		
		// Realiza o serialize() do jquery para pegar os valores
		var noticia = $("#configuracao_noticia").serialize();
		
        $.ajax({
            url: "<?php echo app_baseUrl() . 'noticias/nova_noticia/salva_noticia'; ?>",
            type: "POST",
            data: noticia,
            dataType: "json",
            success: function(e)
            {
                if(e.r_salvar == 0)
                {
                    msg_erro('Não foi possível salvar a notícia');
                }
                else
                {
                    msg_sucesso("A notícia foi salva com sucesso. " + e.r_imagem);
                    location.href = "<?php echo app_baseurl() . 'painel#index.php?/noticias/noticias_cadastradas' ?>";
                }
            }
        });
    });
	
	/** Configuração do editor de texto **/
    tinymce.init({
        selector: "textarea.edit",
        convert_urls: false,
        language: "pt_BR",
        content_css: "css/bootstrap.css",
        theme: "modern",
        height: 400,
        filemanager_title: "MasterAdmin - Gerenciador de Arquivos",
        plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak", "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", "table contextmenu directionality emoticons paste textcolor filemanager"],
        image_advtab: true,
        toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code",
        external_filemanager_path: "js/filemanager/filemanager/"
    });
    //**************************************************************************
</script>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-plus"></i> Nova notícia
        </h1>
    </div>
</div>

<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12">
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                <header>
                    <span class="widget-icon"> 
                        <i class="fam-add"></i> 
                    </span>
                    <h2>Criar nova notícia</h2>
                </header>
                <div class="">
                    <div class="widget-body no-padding">

                        <form class="smart-form" id="configuracao_noticia">
                            <fieldset>
                                <section>
                                    <label class="label"><strong>Título da Notícia:</strong></label>
                                    <label class="input"> 
                                        <i class="icon-prepend fa fa-question-circle"></i>
                                        <input type="text" id="titulo_noticia" name="titulo_noticia" maxlength="100" autofocus />
                                        <b class="tooltip tooltip-top-left">
                                            <i class="fa fa-warning txt-color-teal"></i>
                                            Insira o título da notícia
                                        </b>
                                    </label>
                                </section>
                                <section>
                                    <label class="label"><strong>Resumo da Notícia:</strong></label>
                                    <label class="textarea"> 
                                        <i class="icon-prepend fa fa-question-circle"></i>
                                        <textarea id="resumo_noticia" name="resumo_noticia" maxlength="250" rows="7" required></textarea>
                                        <b class="tooltip tooltip-top-left">
                                            <i class="fa fa-warning txt-color-teal"></i>
                                            Insira o resumo da notícia
                                        </b>
                                    </label>
                                </section>
                                <section>
                                    <label class="label"><strong>Imagem de Capa:</strong></label>
                                    <label class="input"> 
                                        <i class="icon-prepend fa fa-question-circle"></i>
                                        <input type="text" id="imagem_noticia" name="imagem_noticia" required />
                                        <a id="busca_imagem" href="./js/filemanager/filemanager/dialog.php?type=1&editor=mce_0&field_id=imagem_noticia&fldr=imagens_noticias&lang=pt_BR" class="botao iframe-btn">
                                            <i class="fam-image-add"></i> Selecionar a Imagem
                                        </a>
                                        <b class="tooltip tooltip-top-left">
                                            <i class="fa fa-warning txt-color-teal"></i>
                                            Insira uma imagem para capa da notícia
                                        </b>
                                    </label>
                                </section>
                                <section>
                                    <label class="label"><strong>Tipo de Notícia:</strong></label>
                                    <label class="select">
                                        <select id="tipo_noticia" name="tipo_noticia">
                                            <option value="Esportes">Esportes</option>
                                            <option value="Lazer e Cultura">Lazer e Cultura</option>
                                            <option value="Negócios">Negócios</option>
                                        </select>
                                    </label>
                                </section>
                                <section>
                                    <label class="label"><strong>Posicionamento:</strong></label>
                                    <label class="select"> 
                                        <select id="posicionamento" name="posicionamento">
                                            <option value="1">Banner</option>
                                            <option value="2">Notícia secundária</option>
                                        </select>
                                    </label>
                                </section>
                                <section>
                                    <label class="label"><strong>Corpo da Notícia:</strong></label>
                                    <label class="textarea">
                                        <textarea class="edit span12" id="corpo_noticia" name="corpo_noticia"></textarea>
                                    </label>
                                    <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['user']->nome_usuario ?>" />
                                </section>
                            </fieldset>
                            <footer>
                                <button class="btn btn-primary" id="salvar" type="submit"><i class="fam-accept"></i> Salvar Notícia</button>
                                <button class="btn btn-warning" type="reset"><i class="fam-error"></i>Limpar Formulário</button>
                            </footer>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>