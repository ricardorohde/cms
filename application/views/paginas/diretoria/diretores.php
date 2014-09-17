<script>
	//Variável global que receberá o valor da diretoria que será buscada
	var diretoria = '';
    /**
     * Chamada do Jquery
     */
    $(document).ready(function() {
        /**
         * Chamada da função que irá preencher o combobox para selecionar qual a diretoria
         */
        busca_diretorias();

        /**
         * Função que irá realizar a busca das diretorias de acordo com o id da
         * diretoria
         */
        $('#diretorias').change(function() {
            if ($(this).val())
            {
                diretoria = $(this).val();
                busca_diretores(diretoria);
            }
        });

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

        /**
         * Função desenvolvida para salvar um novo diretor na base de dados
         */
        $('#novo_diretor').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo app_baseurl() . 'diretoria/diretores/salvar_diretor' ?>',
                type: 'POST',
                data: {
                    nome_diretor: $('#nome_diretor').val(),
                    cargo: $('#cargo').val(),
                    foto: $('#fotografia').val(),
                    id_diretoria: $('#select_diretoria').val()
                },
                dataType: "html",
                success: function(sucesso)
                {
                    if (sucesso == 1)
                    {
                        $.smallBox({
                            title: "<i class='fa fa-check'></i> Sucesso",
                            content: "Diretor cadastrado",
                            iconSmall: "fa fa-thumbs-down bounce animated",
                            color: "#5CB811",
                            timeout: 5000
                        });
                        busca_diretores($('#select_diretoria').val());
                        $('#cadastro_diretores').modal('hide');
                        limpar_campos();
                    }
                    else
                    {
                        $.smallBox({
                            title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                            content: "<strong>Erro ao salvar os dados. Tente novamente</strong>",
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
    });

    /**
     * Função desenvolvida para buscar, via ajax, a população para preencher o
     * combobox de diretorias
     */
    function busca_diretorias()
    {
        $.get('<?php echo app_baseurl() . 'diretoria/diretores/diretorias_combo' ?>', function(e) {
            $('#diretorias').html(e);
            $('#select_diretoria').html(e);
        });
    }

    /**
     * Função desenvolvida para buscar os diretores cadastrados
     */
    function busca_diretores(id_diretoria)
    {
        $.get('<?php echo app_baseurl() . 'diretoria/diretores/busca_diretores/' ?>' + id_diretoria, function(e) {
            $('#diretores_cadastrados').html(e);
        });
    }

    /**
     * Função desenvolvida para limpar os campos do formulário
     */
    function limpar_campos()
    {
        $('#nome_diretor').val('');
        $('#cargo').val('');
        $('#fotografia').val('');
        $('#select_diretoria').val('');
    }
</script>
<!-- Header da página -->
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-users"></i> Cadastro de diretores
        </h1>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pull-right">
        <a data-toggle="modal" href="#cadastro_diretores" class="btn btn-primary pull-right header-btn">
            <i class="fa fa-plus"></i> Cadastrar diretor
        </a>
    </div>
</div>
<!--*************************************************************************-->

<!-- Elemento onde será feita a pesquisa das diretorias -->
<section>
    <form class="smart-form">
        <section class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <label class="select">
                <select id="diretorias"></select>
            </label>
        </section>
    </form>
</section>
<!--*************************************************************************-->

<br>
<br>
<br>
<!-- Div onde a diretoria será inserida via ajax -->
<div id="diretores_cadastrados">
    <h4 class="page-title txt-color-blueDark">
        &nbsp;Selecione uma diretoria para visualizar seus componentes
    </h4>
</div>
<!--*************************************************************************-->

<!-- Modal que contém o formulário para a inclusão dos diretores -->
<div class="modal fade" id="cadastro_diretores" data-keyboard="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">
                    <img src="./img/logo.png" width="150" alt="Clube Campestre Pentáurea">
                </h4>
            </div>

            <div class="modal-body no-padding">
                <form id="novo_diretor" class="smart-form">
                    <fieldset>
                        <section>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label class="input">
                                        <input id="nome_diretor" type="text" placeholder="Nome do diretor" required />
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                <div class="col col-md-6">
                                    <label class="label">
                                    </label>
                                    <label class="select">
                                        <select id="select_diretoria" required>
                                            <option>Selecione uma diretoria</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="col col-md-6">
                                    <label class="label">
                                    </label>
                                    <label class="input">
                                        <input id="cargo" type="text" class="form-control" placeholder="Cargo" required="">
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label class="input">
                                        <a class="iframe-btn" href="./js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=fotografia&lang=pt_BR&fldr=diretores">
                                            <i class="icon-append fa fa-picture-o"></i>
                                        </a>
                                        <input id="fotografia" type="text" class="form-control" placeholder="Clique ao lado p/ escolher a fotografia...">
                                    </label>
                                </div>
                            </div>
                        </section>
                    </fieldset>

                    <footer>
                        <button type="submit" class="btn btn-default">
                            <i class="fam-disk"></i> 
                            Adicionar diretor
                        </button>
                        <button onclick="limpar_campos()" type="button" class="btn btn-default" data-dismiss="modal">
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