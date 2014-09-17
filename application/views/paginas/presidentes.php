<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-users"></i> Ex-presidentes
        </h1>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pull-right">
        <a data-toggle="modal" href="#cadastro_presidentes" class="btn btn-primary pull-right header-btn">
            <i class="fa fa-plus fa-lg"></i> Cadastrar Ex-presidente
        </a>
    </div>
</div>

<!-- Div onde serão inseridas os dados dos presidentes -->
<div id="presidentes_cadastrados"></div>
<!--*************************************************************************-->

<!-- Janela modal que realiza o cadastro dos presidentes -->
<div class="modal fade" id="cadastro_presidentes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <img src="img/logo.png" width="150" alt="SmartAdmin">
                </h4>
            </div>
            <div class="modal-body no-padding">
                <form id="novo_presidente" class="smart-form">
                    <fieldset>
                        <section>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label class="input">
                                        <input id="nome_presidente" type="text" placeholder="Nome do Ex-presidente" required />
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                <div class="col col-md-6">
                                    <label class="label">
                                    </label>
                                    <label class="input">
                                        <i class="icon-append fa fa-calendar"></i>
                                        <input id="inicio_mandato" type="text" class="form-control" placeholder="Início do mandato" data-mask="9999" data-mask-placeholder="*" required>
                                    </label>
                                </div>
                                <div class="col col-md-6">
                                    <label class="label">
                                    </label>
                                    <label class="input">
                                        <i class="icon-append fa fa-calendar"></i>
                                        <input id="fim_mandato" type="text" class="form-control" placeholder="Fim do mandato" data-mask="9999" data-mask-placeholder="*" required="">
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label class="input">
                                        <a class="iframe-btn" href="./js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=fotografia&lang=pt_BR&fldr=ex-presidentes">
                                            <i class="icon-append fa fa-picture-o"></i>
                                        </a>
                                        <input id="fotografia" type="text" class="form-control" placeholder="Clique ao lado p/ escolher a fotografia..." required="">
                                    </label>
                                </div>
                            </div>
                        </section>
                    </fieldset>

                    <footer>
                        <button type="submit" class="btn btn-default">
                            <i class="fam-disk"></i> 
                            Adicionar Presidente
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
    $(document).ready(function() {
        /*
         * Chamada da função que realiza a busca dos presidentes cadastrados
         */
        buscar();
    });

    /*
     * Variável utilizada na busca páginada
     */
    var offset = 0;

    /*
     * Função desenvolvida para buscar os presidentes cadastrados
     */
    function buscar()
    {
        $.get("<?php echo app_baseurl().'presidentes/buscar/' ?>" + offset, function(e) {
            $("#presidentes_cadastrados").html(e);
        });
    }

    /*
     * Script desenvolvido para abrir a fancybox com o gerenciador de arquivos
     */
    $('.iframe-btn').fancybox({
        'height': 800,
        'width': 900,
        'type': 'iframe',
        'autoScale': false,
        'autoSize': false
    });

    /*
     * Função utilizada para inicialização dos formulários
     */
    runAllForms();

    /*
     * Função desenvolvida para salvar um novo presidente
     */
    $("#novo_presidente").submit(function(e) {
        e.preventDefault();

        nome_presidente = $("#nome_presidente").val();
        inicio_mandato = $("#inicio_mandato").val();
        fim_mandato = $("#fim_mandato").val();
        fotografia = $("#fotografia").val();

        $.ajax({
            url: "<?php echo app_baseurl().'presidentes/salvar_presidente' ?>",
            type: "POST",
            data: {
                nome: nome_presidente,
                inicio_mandato: inicio_mandato,
                fim_mandato: fim_mandato,
                foto: fotografia
            },
            dataType: "html",
            success: function(sucesso)
            {
                if (sucesso == 1)
                {
                    msg_sucesso('Presidente Cadastrado');
                    $("#nome_presidente").val("");
                    $("#inicio_mandato").val("");
                    $("#fim_mandato").val("");
                    $("#fotografia").val("");
                    $("#cadastro_presidentes").modal('hide');
                    buscar();
                }
                else if (sucesso == 2)
                {
                    $.smallBox({
                        title: "<i class='fa fa-check'></i> Sucesso",
                        content: "Presidente cadastrado, mas a foto não foi redimensionada",
                        iconSmall: "fa fa-thumbs-down bounce animated",
                        color: "#5CB811",
                        timeout: 5000
                    });
                    $("#nome_presidente").val("");
                    $("#inicio_mandato").val("");
                    $("#fim_mandato").val("");
                    $("#fotografia").val("");
                    $("#cadastro_presidentes").modal('hide');
                    buscar();
                }
                else
                {
                    msg_erro('Erro ao salvar os dados. Tente novamente');
                }

            }
        });
    });

    /**
     * Função desenvolvida para limpar os campos da modal quando o usuário 
     * clique no botão "Fechar"
     */

    $("#atualizar_depois").click(function() {
        $("#nome_presidente").val("");
        $("#inicio_mandato").val("");
        $("#fim_mandato").val("");
        $("#fotografia").val("");
    });

    /**
     * Função utilizada para previnir a ação padrão dos links de paginação e 
     * chamar a próxima página dos presidentes via ajax
     */
    $(document).on("click", ".pagination li a", function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        $('#presidentes_cadastrados').load(href).fadeIn('slow');
    });
</script>