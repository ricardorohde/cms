<link href="css/modulos.css" rel="stylesheet" type="text/css">
<style>
    .noticia-imagem {
        width: 203px;
        height: 190px;
        position: relative;
        float: left;
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
<script type="text/javascript">
    $("#data").mask('99/99/9999');

    $("#dados_galeria").submit(function(e) {
        e.preventDefault();
        nome_galeria = $("#nome_galeria").val();
        data = $("#data").val();
        $.ajax({
            url: "<?php echo app_baseurl() . 'galerias/galerias/salvar_galeria' ?>",
            type: "POST",
            data: {nome_galeria: nome_galeria, data: data},
            dataType: "html",
            success: function(sucesso) {
                if (sucesso > 0)
                {
                    location.href = "<?php echo app_baseurl() . 'painel#index.php?/galerias/opcoes_galerias/index/' ?>" + sucesso;
                }
                else
                {
                    msg_erro('Não foi possível criar a galeria');
                }
            },
            error: function() {
                msg_erro('Ocorreu um erro. Tente novamente');
            }
        });
    });

    /** Função desenvolvida para buscar as galerias cadastradas **/
    function buscar()
    {
        url = "<?php echo app_baseUrl() . 'galerias/galerias/busca_galerias' ?>";
        loadAjax(url, $("#galerias_cadastradas"));
    }
    
    /** Chamada da função buscar no Onload **/
    window.onload(buscar());
</script>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-picture-o"></i> Galeria de Fotos
        </h1>
    </div>
</div>
<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12">
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                <header>
                    <span class="widget-icon">
                        <i class="fa fa-picture-o txt-color-darken"></i> 
                    </span>
                    <ul class="nav nav-tabs pull-right in" id="myTab">
                        <li class="active">
                            <a data-toggle="tab" href="#todas_galerias">
                                <i class="fam-images"></i> 
                                <span class="hidden-mobile hidden-tablet">Todas as galerias</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#nova_galeria">
                                <i class="fam-picture-add"></i>
                                <span class="hidden-mobile hidden-tablet"> Criar nova Galeria</span>
                            </a>
                        </li>
                    </ul>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in padding-10 no-padding-bottom" id="todas_galerias">
                                <!-- Receberá as galerias cadastradas via ajax -->
                                <div class="row no-space" id="galerias_cadastradas"></div>
                                <!--*****************************************-->
                            </div>
                            <div class="tab-pane fade no-padding-bottom" id="nova_galeria">
                                <form class="smart-form" id="dados_galeria">
                                    <fieldset>
                                        <section>
                                            <label class="label"><strong>Nome da Galeria:</strong></label>
                                            <label class="input">
                                                <input type="text" id="nome_galeria" maxlength="50" required>
                                            </label>  
                                        </section>
                                        <section>
                                            <label class="label"><strong>Data de Realização:</strong></label>
                                            <label class="input">
                                                <input type="text" id="data" maxlength="10" required data-mask="99/99/9999">
                                            </label>
                                        </section>
                                    </fieldset>
                                    <footer>
                                        <button class="btn btn-primary" type="submit"><i class="fam-disk"></i> Salvar e Proseguir</button>
                                        <button id="reset" class="btn btn-warning" type="reset"><i class="fam-arrow-left"></i> Voltar às Galerias</button>
                                    </footer>
                                </form>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>