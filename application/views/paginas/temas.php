<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-fw fa-desktop"></i> Temas do Site
        </h1>
    </div>
</div>

<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                <header>
                    <span class="widget-icon">
                        <i class="fa fa-desktop"></i>
                    </span>
                    <h2>Criar um novo tema</h2>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <form id="salvar_tema" class="smart-form">
                            <fieldset>
                                <div class="row">
                                    <section class='col col-12'>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label class="input">
                                                    <input id="imagem_background" type="text" class="form-control" placeholder="Clique ao lado para selecionar uma imagem de fundo">
                                                </label>
                                                <span class="input-group-addon">
                                                    <a class="iframe-btn" id="busca_background" href="./js/filemanager/filemanager/dialog.php?type=1&field_id=imagem_background&fldr=background&lang=pt_BR">
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
                                                    <input id="imagem_capa" type="text" class="form-control" placeholder="Imagem para Capa" required />
                                                </label>
                                                <span class="input-group-addon">
                                                    <a class="iframe-btn" id="busca_imagem" href="./js/filemanager/filemanager/dialog.php?type=1&editor=mce_0&field_id=imagem_capa&fldr=banner&lang=pt_BR">
                                                        <i class="fam-picture-add"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="col col-6">
                                        <label class="input">
                                            <input id="cor" type="text" class="form-control" required="" placeholder="Escolha uma cor">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label class="input">
                                                    <input class="form-control" id="from" type="text" placeholder="Data Inicial" required>
                                                </label>
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="col col-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label class="input">
                                                    <input class="form-control" id="to"type="text" placeholder="Data Final" required="">
                                                </label>
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <button type="reset" class="btn btn-default">
                                    <i class="fam-cross"></i> Cancelar
                                </button>
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

<!-- Div onde serão injetar os dados via get -->
<div id="todos_temas"></div>

<script src="./js/libs/jquery.ui.datepicker-pt-BR.js"></script>
<script type="text/javascript">
    /*
     * Varável que é utilizada pela função busca_temas
     * É utilizada para setar a paginação
     */
    var offset = 0;
    //**************************************************************************

    /*
     * Chama a função que busca os temas
     */
    $(document).ready(function() {
        buscar_temas();
    });
    //**************************************************************************

    /*
     * Função desenvolvida para buscar os temas via ajax
     */
    function buscar_temas()
    {
        url = '<?php echo app_baseurl().'temas/busca_temas/' ?>' + offset;
        
        loadAjax(url, $("#todos_temas"));
    }
    //**************************************************************************

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
    //**************************************************************************

    /*
     * Função desenvolvida para setar o fancybox para abrir o gerenciador de arquivos
     */
    $('.iframe-btn').fancybox({
        'height': 800,
        'width': 900,
        'type': 'iframe',
        'autoScale': false,
        'autoSize': false
    });
    //**************************************************************************

    /*
     * Função utilizada para unicializar o colorPicker
     */
    $('#cor').colorpicker();
    //**************************************************************************

    /*
     * Função desenvolvida para salvar um novo tema no site
     */
    $("#salvar_tema").submit(function(e) {
        e.preventDefault();
        imagem_background = $('#imagem_background').val();
        imagem_capa = $("#imagem_capa").val();
        cor = $("#cor").val();
        data_inicio = $("#from").val();
        data_expiracao = $("#to").val();

        $.ajax({
            url: "<?php echo app_baseurl().'temas/salvar_tema' ?>",
            type: "POST",
            data: {
                imagem_background: imagem_background,
                imagem_banner: imagem_capa,
                cor_principal: cor,
                data_inicio: data_inicio,
                data_expiracao: data_expiracao
            },
            dataType: "html",
            success: function(sucesso)
            {
                if (sucesso == 1)
                {
                    $.smallBox({
                        title: "<i class='fa fa-check'></i> Sucesso",
                        content: "<strong>Tema salvo com sucesso.</strong>",
                        iconSmall: "fa fa-thumbs-up bounce animated",
                        color: "#5CB811",
                        timeout: 5000
                    });
                    $("#salvar_tema").find('input').val('');
                    buscar_temas();
                }
                else
                {
                    $.smallBox({
                        title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                        content: "<strong>Não foi possível salvar o novo tema.</strong>",
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
    //**************************************************************************
</script>