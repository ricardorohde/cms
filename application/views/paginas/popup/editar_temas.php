<!-- Barra no topo, onde há alguns links e a logo da empresa -->
<header id="header">
    <div id="logo-group">
        <span id="logo">
            <img src="img/logo.png" alt="Núcleo de Tecnologia - Pentáurea Clube" title="Núcleo de Tecnologia - Pentáurea Clube" />
        </span>
    </div>
</header>
<!--*************************************************************************-->

<div id="main" role="main">
    <!-- Div onde serão inseridas as páginas buscadas via ajax -->
    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-fw fa-desktop"></i> Edição de Temas
                </h1>
            </div>
        </div>
        <?php
            if (!isset($tema))
            {
                ?>
                <div class="alert alert-block alert-danger">
                    <h4 class="alert-heading">
                        Erro!
                    </h4>
                    <p style="text-align: justify;">
                        Os parâmetros foram passados incorretamente. Feche esta
                        janela e tente novamente
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
                                        <i class="fa fa-desktop"></i>
                                    </span>
                                    <h2>Editar um tema existente</h2>
                                </header>
                                <div>
                                    <div class="widget-body no-padding">
                                        <form id="salvar_tema" class="smart-form">
                                            <?php
                                            foreach ($tema as $row)
                                            {
                                                ?>
                                                <fieldset>
                                                    <div class="row">
                                                        <section class='col col-12'>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <label class="input">
                                                                        <input id="imagem_background" type="text" class="form-control" placeholder="Clique ao lado para selecionar uma imagem de fundo" value="<?php echo $row->imagem_fundo ?>">
                                                                    </label>
                                                                    <span class="input-group-addon">
                                                                        <a class="iframe-btn" id="busca_background" href="./js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=imagem_background&fldr=background&lang=pt_BR">
                                                                            <i class='fam-picture-add'></i>
                                                                        </a>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div class="row">
                                                        <section class="col col-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <label class="input">
                                                                        <input id="imagem_capa" type="text" class="form-control" placeholder="Imagem para Capa" required value="<?php echo $row->imagem_banner ?>" />
                                                                    </label>
                                                                    <span class="input-group-addon">
                                                                        <a class="iframe-btn" id="busca_imagem" href="./js/tinymce/plugins/filemanager/dialog.php?type=1&editor=mce_0&field_id=imagem_capa&fldr=banner&lang=pt_BR">
                                                                            <i class="fam-picture-add"></i>
                                                                        </a>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <section class="col col-6">
                                                            <label class="input">
                                                                <input id="cor" type="text" class="form-control" required="" placeholder="Escolha uma cor" value="<?php echo $row->cor_principal; ?>">
                                                            </label>
                                                        </section>
                                                    </div>
                                                    <div class="row">
                                                        <section class="col col-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <label class="input">
                                                                        <input class="form-control" id="from" type="text" placeholder="Data Inicial" required value="<?php echo $row->data_inicio; ?>">
                                                                    </label>
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <section class="col col-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <label class="input">
                                                                        <input class="form-control" id="to"type="text" placeholder="Data Final" required="" value="<?php echo $row->data_expiracao; ?>">
                                                                    </label>
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <input type="hidden" id="id" value="<?php echo $row->id ?>">
                                                    <?php
                                                }
                                                ?>
                                            </fieldset>
                                            <footer>
                                                <a class="btn btn-danger" onclick="window.close();">
                                                    Fechar esta Janela
                                                </a>
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fam-application-view-tile"></i> Salvar o tema
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
        ?>
    </div>
    <!-- Fim da inserção do conteúdo -->
    <script src="./js/libs/jquery.ui.datepicker-pt-BR.js"></script>
    <script type="text/javascript">
        /*
         * Função desenvolvida para inicializar os calendários do novo tema
         */
        $('#from').datepicker({
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            onSelect: function(selectedDate) {
                $('#to').datepicker('option', 'minDate', selectedDate);
            }
        });

        $('#to').datepicker({
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            onSelect: function(selectedDate) {
                $('#from').datepicker('option', 'maxDate', selectedDate);
            }
        });

        /*
         * Função desenvolvida para setar o fancybox para abrir o gerenciador de arquivos
         */
        $('.iframe-btn').fancybox({
            'width': '900px',
            'height': '600px',
            'type': 'iframe',
            'autoScale': false
        });

        /*
         * Função utilizada para unicializar o colorPicker
         */
        $('#cor').colorpicker();

        /*
         * Função utilizada para salvar as alterações realizadas em um tema
         */
        $("#salvar_tema").submit(function(e) {
            e.preventDefault();
            imagem_background = $('#imagem_background').val();
            imagem_capa = $("#imagem_capa").val();
            cor = $("#cor").val();
            data_inicio = $("#from").val();
            data_expiracao = $("#to").val();
            id = $("#id").val();

            $.ajax({
                url: "<?php echo app_baseurl() . 'temas/salvar_edicaoTema' ?>",
                type: "POST",
                data: {
                    imagem_background: imagem_background,
                    imagem_banner: imagem_capa,
                    cor_principal: cor,
                    data_inicio: data_inicio,
                    data_expiracao: data_expiracao,
                    id: id
                },
                dataType: "html",
                success: function(sucesso)
                {
                    if (sucesso == 1)
                    {
                        $.smallBox({
                            title: "<i class='fa fa-check'></i> Sucesso",
                            content: "<strong>Tema atualizado.</strong>",
                            iconSmall: "fa fa-thumbs-up bounce animated",
                            color: "#5CB811",
                            timeout: 5000
                        });
                        $("#salvar_tema").find('input').val('');

                        window.opener.buscar_temas();
                        setTimeout(function() {
                            window.close()
                        }, 1000);
                    }
                    else
                    {
                        $.smallBox({
                            title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                            content: "<strong>Não foi possível atualizar o tema.</strong>",
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
    </script>
</div>