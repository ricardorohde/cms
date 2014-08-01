<script type="text/javascript" src="./js/jquery_form/jquery.form.min.js"></script>
<style>
    iframe {
        border: none;
        width: 100%;
    }
    .thumb {
        height: 105px;
        border: 1px solid #000;
        margin: 10px 5px 0 0;
    }
    .noticia-imagem {
        width: 170px;
        height: 170px;
        position: relative;
        float: left;
        padding-right: 3px;
        padding-bottom: 3px;
    }

    .noticia-imagem img {
        height: 140px;
        width: 200px;
    }

    .noticia-caption {
        text-transform: uppercase;
        font-size: 10px;
        color: #d8dadc;
        position: absolute;
        top: 106px;
        width: 200px;
        height: 34px;
        right: 0;
        left: 0;
        padding: 0 10px;
        padding-top: 10px;
        background: #333333;
        background: rgba(0, 0, 0, 0.75);
    }
</style>
<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12">
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                <header>
                    <span class="widget-icon">
                        <i class="fa fa-picture-o txt-color-darken"></i> 
                    </span>
                    <h2>Opções para esta galeria</h2>
                    <div class="widget-toolbar">
                        <a href="#" class="excluir-galeria btn btn-danger" id="<?php echo $id_galeria ?>">
                            <i class="fam-photo-delete"></i> 
                            <span class="hidden-mobile hidden-tablet">Excluir esta galeria</span>
                        </a>
                        <a href="<?php echo app_baseurl() . 'painel#index.php?/galerias/galerias' ?>" class="btn btn-success">
                            <i class="fam-arrow-left"></i> 
                            <span class="hidden-mobile hidden-tablet"> Voltar às Galerias</span>
                        </a>
                    </div>
                </header>
                <div class="no-padding">
                    <div class="widget-body">
                        <div class="tab-content">
                            <div class="tab-pane fade active in padding-10 no-padding-bottom" id="todas_galerias">
                                <!-- Div que receberá as fotos via ajax -->
                                <div class="row no-space" id="fotos_destaGaleria"></div>
                                <!--*****************************************-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<section id="opcoes">
    <div class="row">
        <article class="col-sm-12">
            <div class="jarviswidget" id="wid-id-1" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                <header>
                    <span class="widget-icon">
                        <i class="fam-photo-add"></i>
                    </span>
                    <h2>Adicionar fotos a esta galeria</h2>
                </header>
                <div class="no-padding">
                    <div class="widget-body">
                        <div class="tab-content">
                            <div class="tab-pane fade active in padding-10 no-padding-bottom" id="todas_galerias">
                                <div class="row no-space">
                                    <!-- Barra de progresso do upload -->
                                    <div class="progress progress-sm progress-striped active" id="barra_progresso_pai">
                                        <div id="barra_progresso" class="progress-bar bg-color-blue" role="progressbar" style="width: 0%">
                                            <span id="porcentagem"></span>
                                        </div>
                                    </div>
                                    <!--*************************************-->
                                    <form id="formNova_galeria" name="nova_galeria" action="<?php echo app_baseurl() . 'galerias/opcoes_galerias/upload' ?>" method="post" enctype="multipart/form-data">
                                        <label class="input input-file">                                            
                                            <input type="file" id="fotos" name="fotos[]" multiple required id="fotos" />
                                        </label>
                                        <input type="hidden" name="id_galeria" value="<?php echo $id_galeria; ?>">

                                        <button class="btn btn-danger" type="submit">
                                            <i class="fam-drive-go"></i> Fazer upload
                                        </button>
                                        <br /><br />
                                    </form>
                                    <output id="list"></output>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<div id="status"></div>


<script type="text/javascript">

        /** Variável que recebe o ID da galeria atul **/
        var id = <?php echo $id_galeria ?>;

        /** Início do Jquery **/
        (function() {
            
            /** Chamada da função que busca as fotos **/
            buscar_fotos(id);

            /** Variáveis que serão usadas na execução do Jquery Upload **/
            var barra = $('#barra_progresso');
            var percent = $('#porcentagem');
            var status = $('#status');
            var porcentagem = '0%';
            //******************************************************************

            /** Realiza o submit das fotos via ajax **/
            $('#formNova_galeria').ajaxForm({
                beforeSend: function() {
                    status.empty();
                    barra.width(porcentagem);
                    percent.html(porcentagem);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    porcentagem = percentComplete + '%';
                    barra.width(porcentagem);
                    percent.html(porcentagem);
                },
                success: function(sucesso) {
                    porcentagem = '100%';
                    barra.width(porcentagem);
                    percent.html(porcentagem);
                    buscar_fotos(id);
                },
                complete: function(xhr) {
                    //status.html(xhr.responseText);
                }
            });
            //******************************************************************

        })();

        /**
         * Adiciona a classe active ao link correspondente
         */
        $("#galerias").addClass('active');

        /**
         * Adiciona ao breadcrumb a página onde o usuário
         */
        $("#ribbon ol.breadcrumb").append($("<li><i class='fa fa-lg fa-fw fa-picture-o'></i> Galerias</li>"));

        /**
         * Aciona ao evento clique do elemento #fotos, uma smallbox, para informar
         * que as imagens estão sendo carregadas
         */
        $("#fotos").click(function() {
            $.smallBox({
                title: "<i class='fa fa-exclamation'></i> Atenção",
                content: "As imagens estão sendo carregadas",
                iconSmall: "fa fa-refresh fa-spin",
                color: "#5CB811",
                timeout: 10000
            });
        });
        //**********************************************************************

        /**
         * Função que irá mostrar mensagem no decorrer do upload das imagens
         */
        $("#formNova_galeria").submit(function(e) {

            $('#barra_progresso_pai').fadeIn('fast');

            $.smallBox({
                title: "<i class='fa fa-exclamation'></i> Atenção",
                content: "O Upload das fotos foi iniciado",
                iconSmall: "fa fa-refresh fa-spin",
                color: "#5CB811",
                timeout: 5000
            });
        });
        //**********************************************************************

        /**
         * Função desenvolvida para realizar a exclusão de uma foto
         */
        $(document).on("click", ".excluir", function(e) {
            e.preventDefault();
            id_foto = $(this).attr("id");
            id_galeria = $(this).attr("href");
            alertify.confirm("deseja realmente Excluir esta foto?", function(e) {
                if (e)
                {
                    $.ajax({
                        url: "<?php echo app_baseurl() . 'galerias/opcoes_galerias/excluir_foto' ?>",
                        type: "POST",
                        data: {id: id_foto, id_galeria: id_galeria},
                        dataType: "html",
                        success: function(sucesso) {
                            
                            if (sucesso == 0)
                            {
                                $.smallBox({
                                    title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                                    content: "<strong>Não foi possível excluir a foto</strong>",
                                    color: "#FE1A00",
                                    iconSmall: "fa fa-thumbs-down bounce animated",
                                    timeout: 5000
                                });
                            }
                            else if(sucesso == 1)
                            {
                                buscar_fotos(id);
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
        //**********************************************************************

        /**
         * Exclui a galeria especificada. a Exclusão é feita via ajax e exclui
         * as fotos do disco
         */
        $(document).on("click", ".excluir-galeria", function(e) {
            e.preventDefault();
            id_galeria = $(this).attr("id");
            alertify.confirm("deseja realmente Excluir esta Galeria?", function(e)
            {
                if (e)
                {
                    $.ajax({
                        url: "<?php echo app_baseurl() . 'galerias/opcoes_galerias/excluir_galeria' ?>",
                        type: "POST",
                        data: {id_galeria: id_galeria},
                        dataType: "html",
                        success: function(sucesso)
                        {
                            if (sucesso == 0)
                            {
                                $.smallBox({
                                    title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                                    content: "<strong>Não foi possível excluir as fotos do banco de dados</strong>",
                                    color: "#FE1A00",
                                    iconSmall: "fa fa-thumbs-down bounce animated",
                                    timeout: 5000
                                });
                            }
                            if (sucesso == 1)
                            {
                                $.smallBox({
                                    title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                                    content: "<strong>Não foi possível excluir a galeria do banco de dados</strong>",
                                    color: "#FE1A00",
                                    iconSmall: "fa fa-thumbs-down bounce animated",
                                    timeout: 5000
                                });
                            }
                            if (sucesso == 2)
                            {
                                $.smallBox({
                                    title: "<i class='glyphicon glyphicon-remove'></i> Atenção",
                                    content: "<strong>A galeria foi excluida mas os arquivos continuam no servidor.</strong>",
                                    color: "#d8c74e",
                                    iconSmall: "fa fa-thumbs-down bounce animated",
                                    timeout: 5000
                                });
                                location.href = "<?php echo app_baseUrl() . 'painel#index.php?/galerias'; ?>";
                            }
                            if (sucesso == 3)
                            {
                                $.smallBox({
                                    title: "<i class='fa fa-check'></i> Sucesso",
                                    content: "<strong>A galeria foi excluida</strong>",
                                    iconSmall: "fa fa-thumbs-up bounce animated",
                                    color: "#5CB811",
                                    timeout: 5000
                                });
                                location.href = "<?php echo app_baseUrl() . 'painel#index.php?/galerias'; ?>";
                            }
                            if (sucesso == 4)
                            {
                                $.smallBox({
                                    title: "<i class='glyphicon glyphicon-remove'></i> Atenção",
                                    content: "<strong>A galeria foi excluida mas a pasta principal não foi excluída</strong>",
                                    color: "#d8c74e",
                                    iconSmall: "fa fa-thumbs-down bounce animated",
                                    timeout: 5000
                                });
                                location.href = "<?php echo app_baseUrl() . 'painel#index.php?/galerias'; ?>";
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
        //**********************************************************************
        
        /**
         * buscar_fotos()
         * 
         * Função desenvolvida para buscar as fotos que estão cadastradas
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @param       {int} id Contém o ID da galeria
         */
        function buscar_fotos(id)
        {
            /** Esconde o elemento pai da barra de progresso **/
            $('#barra_progresso_pai').hide();
            
            /** Zera a lista onde as imagens são visualizadas **/
            $('#list').empty();
            
            /** Zera o input onde são selecionadas as fotos **/
            $('#fotos').val("");

            $('#fotos_destaGaleria').html('<h4><i class="fa fa-cog fa-spin"></i> Buscando as fotos</h4>')

            $.get('<?php echo app_baseurl() . 'galerias/opcoes_galerias/buscar_fotos/' ?>' + id, function(e) {
                $('#fotos_destaGaleria').html(e);
            });
        }
        //**********************************************************************
</script>
<script type="text/javascript">
        /**
         * Função desenvolvida para mostrar fotos no momento que elas são selecionadas
         * para o upload
         */
        function handleFileSelect(evt)
        {
            var fotos = evt.target.files;
            for (var i = 0, f; f = fotos[i]; i++)
            {
                if (!f.type.match('image.*'))
                {
                    continue;
                }
                var reader = new FileReader();
                reader.onload = (function(theFile)
                {
                    return function(e)
                    {
                        var span = document.createElement('span');
                        span.innerHTML = ['<img class="thumb img-rounded" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
                        document.getElementById('list').insertBefore(span, null);
                    };
                })(f);
                reader.readAsDataURL(f);
            }
        }
        document.getElementById('fotos').addEventListener('change', handleFileSelect, false);
</script>