<!-- Header da página -->
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-clipboard"></i> Avisos Cadastrados
        </h1>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pull-right">
        <a data-toggle="modal" href="#cadastro_avisos" class="btn btn-primary pull-right header-btn">
            <i class="fa fa-plus fa-lg"></i> Cadastrar Aviso
        </a>
    </div>
</div>
<!--*************************************************************************-->

<!-- Div que receberá o conteúdo via ajax -->
<div id="todos_avisos"></div>
<!--*************************************************************************-->

<!-- Modal que conterá o formulário de cadastro de um novo aviso -->
<div class="modal fade" id="cadastro_avisos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<img src="./img/logo.png" width="150" alt="Clube Campestre Pentáurea">
                <h4 class="modal-title pull-right">
                    Criação de Aviso
                </h4>
            </div>
            <div class="modal-body no-padding">
                <form id="salvar_aviso" class="smart-form">
                    <fieldset>
                        <div class="row">
                            <section class="col col-6">
                                <div class="form-group">
                                    <label class="label">
                                        <strong>Selecione a data de expiração do aviso</strong>
                                    </label>
                                    <div class="input-group">
                                        <label class="input">
                                            <input class="form-control" id="data_expiracao" name="data_expiracao" type="text" placeholder="Data de expiração" required>
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
                                <div class="form-group">
                                	<label class="label">
                                        <strong>Selecione a imagem do aviso</strong>
                                    </label>
                                	<div class="input-group">
                                    	<label class="input">
                                        	<input id="imagem_aviso" name="imagem" type="text" class="form-control" placeholder="Clique ao lado para selecionar uma imagem de fundo">
                                        </label>
                                        <span class="input-group-addon">
                                        	<a class="iframe-btn" id="busca_background" href="./js/filemanager/filemanager/dialog.php?type=1&field_id=imagem_aviso&fldr=avisos&lang=pt_BR">
                                            	<i class='fam-picture-add'></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </fieldset>
                    
                    <footer>
                        <button type="submit" class="btn btn-default">
                            <i class="fam-disk"></i> 
                            Adicionar aviso
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpar_campos($('#salvar_aviso'));">
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
	/** Designia o offset para as buscas sql **/
	var offset = 0;
	
	/** Chama a função que realiza a busca **/
	buscar();
	
	/** Realiza o carregamento de script via ajax **/
	loadScript('./js/libs/jquery.ui.datepicker-pt-BR.js');

	/** Inicialização do calendário **/
	$('#data_expiracao').datepicker({
	    dateFormat: 'yy-mm-dd',
	    prevText: '<i class="fa fa-chevron-left"></i>',
	    nextText: '<i class="fa fa-chevron-right"></i>',
		minDate: 0
	});
	//**************************************************************************
	
	/** Configuração para o Gerenciador de arquivos **/
	$('.iframe-btn').fancybox({
	    'width': '900px',
	    'height': '600px',
	    'type': 'iframe',
	    'autoSize': false,
	    'autoScale': false
	});
	//**************************************************************************

	/** Configuração para visualização da imagem **/
	$('a[rel="fancybox"]').fancybox();
	//**************************************************************************

	/** Função desenvolvida para salvar o novo aviso **/
	$('#salvar_aviso').submit(function(e){
		e.preventDefault();

		var aviso = $('#salvar_aviso').serialize();

		$.ajax({
			url: '<?php echo app_baseurl().'avisos/avisos_imagens/salvar_aviso'?>',
			type: 'POST',
			data: aviso,
			dataType: 'html',
			success: function(e) {
				if(e == 1)
				{
					msg_sucesso('O aviso foi salvo');
					limpar_campos($('#salvar_aviso'));
					$('#cadastro_avisos').modal('hide');
					buscar();
				}
				else
				{
					msg_erro('Não foi possível cadastrar o aviso');
				}
			}
		}); 
	});
	//**************************************************************************

	/** Função desenvolvida para realizar a buscar os avisos cadastrados **/
	function buscar()
	{
		url = '<?php echo app_baseurl().'avisos/avisos_imagens/buscar/' ?>' + offset;
		loadAjax(url, $('#todos_avisos'));
	}
</script>