<script type="text/javascript">
    document.title = "Edição de Artigo";
    $("#noticias_cadastradas").addClass('active');
    $(document).ready(function() {

        //Configuração para o Gerenciador de arquivos---------------------------
        $('.iframe-btn').fancybox({
            'width': 900,
            'height': 600,
            'type': 'iframe',
            'autoScale': false
        });

        $("#editor_noticia").submit(function(e) {
            tinyMCE.triggerSave();
            e.preventDefault();

            /** Mostra status de carregando ao clicar no botão **/
            $('#salvar').button('loading');
			
			//Recebe os valores da notícia por meio do `serialize()` do jQuery
			var noticia = $("#editor_noticia").serialize();
			
            $.ajax({
                url: "<?php echo app_baseurl() . 'noticias/noticias_cadastradas/atualiza_noticia'; ?>",
                type: "POST",
                data: noticia,
                dataType: "json",
                success: function(e) {
					if(e.r_salvar == 0)
					{
						msg_erro('A notícia não foi atualizada');
						$('#salvar').button('reset');
					}
					else
					{
						msg_sucesso('A notícia foi atualizada. ' + e.r_imagem);
						$('#salvar').button('reset');
						location.href = "<?php echo app_baseurl() . 'painel#index.php?/noticias/noticias_cadastradas' ?>";
					}
                }
            });
        });

        $("#posicionamento").blur(function() {
            alertify.alert('<p align="justify">Sugerimos que, ao modificar o posicionamento da notícia, troque também a imagem, pois a mesma será redimensionada, neste caso, se a tiver altura e largura menores, a imagem ficará desfocada</p>');
        });
    });

    //Configuração do editor de texto-------------------------------------------
    tinymce.init({
        selector: "textarea.edit",
        convert_urls: false,
        relative_urls: false,
        language: "pt_BR",
        theme: "modern",
        height: 400,
        filemanager_title: "MasterAdmin - Gerenciador de Arquivos",
        plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak", "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", "table contextmenu directionality emoticons paste textcolor filemanager"],
        image_advtab: true,
        toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code",
        external_filemanager_path: "js/filemanager/filemanager/"
    });
</script>

<?php
    if($noticia == FALSE || !$noticia)
    {
        echo '
      <div class="alert alert-danger alert-block">
        <h4 class="alert-heading">Erro</h4>
        Não foi possivel resgatar a notícia. Desculpe-nos.
        <p class="text-align-left">
          <br />
          <a href="index.php?/painel#index.php?/noticias_cadastradas" class="btn btn-sm btn-default">Voltar às notícias</a>
        </p>
      </div>
    ';
    }
    else
    {
        foreach($noticia as $row)
        {
            ?>
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 class="page-title txt-color-blueDark">
                        <i class="fa-fw fa fa-pencil-square-o"></i> Edição de Noticia
                    </h1>
                </div>
            </div>
            <section id="widget-grid">
                <div class="row">
                    <article class="col-sm-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                            <header>
                                <span class="widget-icon">
                                    <i class="fam-page-edit"></i>
                                </span>
                                <h2>Edição de notícia cadastrada</h2>
                                <div class="widget-toolbar">
                                    <a class="btn btn-primary" href="index.php?/painel#index.php?/noticias/noticias_cadastradas">
                                        <i class="fam-arrow-left"></i> Voltar às notícias
                                    </a>
                                </div>
                            </header>
                            <div>
                                <div class="widget-body no-padding">
                                    <form class="smart-form" id="editor_noticia">
                                        <fieldset>
                                            <section>
                                                <label class="label"><strong>Título da notícia</strong></label>
                                                <label class="input">
                                                    <input type="text" id="titulo_noticia" name="titulo_noticia" value="<?php echo $row->titulo_noticia ?>" maxlength="100">
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label"><strong>Resumo da notícia</strong></label>
                                                <label class="textarea">
                                                    <textarea id="resumo_noticia" name="resumo_noticia" maxlength="250" rows="7" required><?php echo $row->resumo_noticia ?></textarea>
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label"><strong>Imagem da capa</strong></label>
                                                <label class="input">
                                                    <input type="text" id="foto" name="imagem_noticia" value="<?php echo $row->imagem_noticia ?>">
                                                    <a id="busca_imagem" href="./js/filemanager/filemanager/dialog.php?type=1&editor=mce_0&field_id=foto&lang=pt_BR" class="botao iframe-btn">
                                                        <i class="fam-image-add"></i> Selecionar a Imagem
                                                    </a>
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label"><strong>Tipo de notícia</strong></label>
                                                <label class="select">
                                                    <select id="tipo_noticia" name="tipo_noticia">
                                                        <option value="Esportes" <?php
                                                        if($row->tipo_noticia == "Esportes")
                                                        {
                                                            echo 'selected';
                                                        }
                                                        ?>>Esportes</option>
                                                        <option value="Lazer e Cultura" <?php
                                                        if($row->tipo_noticia == "Lazer e Cultura")
                                                        {
                                                            echo 'selected';
                                                        }
                                                        ?>>Lazer e Cultura</option>
                                                        <option value="Negócios" <?php
                                                        if($row->tipo_noticia == "Negócios")
                                                        {
                                                            echo 'selected';
                                                        }
                                                        ?>>Negócios</option>
                                                    </select>
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label"><strong>Posicionamento</strong></label>
                                                <label class="select">
                                                    <select id="posicionamento" name="posicionamento">
                                                        <option value="1" <?php echo $row->posicionamento == 1 ? 'selected' : '';?>>>Banner</option>
                                                        <option value="2" <?php echo $row->posicionamento == 2 ? 'selected' : '';?>>Notícia secundária</option>
                                                    </select>
                                                </label>
                                            </section>
                                            <section>
                                                <label class="label"><strong>Corpo da notícia</strong></label>
                                                <label class="textarea">
                                                    <textarea class="edit span12" id="corpo_noticia" name="corpo_noticia"><?php echo $row->corpo_noticia; ?></textarea>
                                                </label>
                                                <input type="hidden" id="id_noticia" name="id" value="<?php echo $row->id ?>">
                                                <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['user']->nome_usuario ?>">
                                            </section>
                                        </fieldset>
                                        <footer>
                                            <button id="salvar" class="btn btn-primary" type="submit" data-loading-text="Atualizando notícia">
                                                <i class="fam-disk"></i> Salvar Alterações
                                            </button>
                                        </footer>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
            <?php
        }
    }
?>