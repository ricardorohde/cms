<script type="text/javascript">
    $(document).on("click", ".pagination li a", function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        $("#todas_noticias").load(href);
    });

    $(document).on("click", "table div .inativar", function(e) {
        e.preventDefault();
        id = $(this).attr("id");
        pagina = $(this).attr("href");
        $.SmartMessageBox({
            title: '<i class="fa fa-question-circle txt-color-blue"></i> Deseja realmente inativar esta notícia?',
            content: 'Você pode desfazer esta ação mais tarde',
            buttons: '[Sim][Não]'
        }, function(verifica) {
            if (verifica == "Sim")
            {
                $.ajax({
                    url: "<?php echo app_baseUrl() . 'noticias/noticias_cadastradas/inativar' ?>",
                    type: "POST",
                    data: {id: id},
                    dataType: "html",
                    success: function(sucesso)
                    {
                        $.smallBox({
                            title: "<i class='fa fa-check'></i> Sucesso",
                            content: "<strong>Notícia inativada</strong>",
                            iconSmall: "fa fa-thumbs-up bounce animated",
                            color: "#5CB811",
                            timeout: 5000
                        });
                        buscar(pagina);
                    },
                    error: function(erro)
                    {
                        $.smallBox({
                            title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                            content: "<strong>Ocorreu um erro ao inativa a noticia</strong>",
                            color: "#FE1A00",
                            iconSmall: "fa fa-thumbs-down bounce animated",
                            timeout: 5000
                        });
                    }
                });
            }
        });
    });

    $(document).on("click", "table div .ativar", function(e) {
        e.preventDefault();
        id = $(this).attr("id");
        pagina = $(this).attr("href");
        $.SmartMessageBox({
            title: '<i class="fa fa-question-circle txt-color-blue"></i> Deseja realmente ativar esta notícia?',
            content: 'Você pode desfazer esta ação mais tarde',
            buttons: '[Sim][Não]'
        }, function(verifica)
        {
            if (verifica == "Sim")
            {
                $.ajax({
                    url: "<?php echo app_baseUrl() . 'noticias/noticias_cadastradas/ativar' ?>",
                    type: "POST",
                    data: {id: id},
                    dataType: "html",
                    success: function(sucesso)
                    {
                        $.smallBox({
                            title: "<i class='fa fa-check'></i> Sucesso",
                            content: "<strong>Notícia ativada</strong>",
                            iconSmall: "fa fa-thumbs-up bounce animated",
                            color: "#5CB811",
                            timeout: 5000
                        });
                        buscar(pagina);
                    },
                    error: function(erro)
                    {
                        $.smallBox({
                            title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                            content: "<strong>Ocorreu um erro ao inativa a noticia</strong>",
                            color: "#FE1A00",
                            iconSmall: "fa fa-thumbs-down bounce animated",
                            timeout: 5000
                        });
                    }
                });
            }
        });
    });

    $(document).on("click", "table div .excluir", function(e) {
        e.preventDefault();
        id = $(this).attr("id");
        pagina = $(this).attr("href");
        $.SmartMessageBox({
            title: '<i class="glyphicon glyphicon-remove" style="color: red;"></i> Deseja realmente excluir esta notícia?',
            content: 'Esta ação não pode ser desfeita',
            buttons: '[Sim][Não]'
        }, function(verifica) {
            if (verifica == "Sim")
            {
                $.ajax({
                    url: "<?php echo app_baseUrl() . 'noticias/noticias_cadastradas/excluir' ?>",
                    type: "POST",
                    data: {id: id},
                    dataType: "html",
                    success: function(sucesso) {
                        $.smallBox({
                            title: "<i class='fa fa-check'></i> Sucesso",
                            content: "<strong>Notícia excluída</strong>",
                            iconSmall: "fa fa-thumbs-up bounce animated",
                            color: "#5CB811",
                            timeout: 5000
                        });
                        buscar(pagina);
                    },
                    error: function(erro)
                    {
                        $.smallBox({
                            title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                            content: "<strong>Ocorreu um erro ao excluir a noticia</strong>",
                            color: "#FE1A00",
                            iconSmall: "fa fa-thumbs-down bounce animated",
                            timeout: 5000
                        });
                    }
                });
            }
        });
    });

    /**
     * buscar()
     * 
     * Função responsável por buscar as notícias que estão cadastradas na base de dados
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com> 
     * @param       {int} offset Contém o offset que será passado para a busca no php
     **/
    function buscar(offset)
    {
        $.get("<?php echo app_baseUrl() . 'noticias/noticias_cadastradas/busca_noticias/' ?>" + offset, function(b) {
            $("#todas_noticias").html(b);
        });
    }
    
    window.onload(buscar());
</script>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-book"></i> Artigos cadastrados
        </h1>
    </div>
</div>
<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12">
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                <header>
                    <span class="widget-icon"> 
                        <i class="fa fa-book txt-color-darken"></i> 
                    </span>
                    <h2>Todos os artigos e notícias cadastradas</h2>
                </header>
                <div class="no-padding">
                    <div class="widget-body">
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in no-padding-bottom" id="s1">
                                <!-- Div que receberá as notícias via ajax -->
                                <div class="row no-space" id="todas_noticias"></div>
                                <!--*****************************************-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>