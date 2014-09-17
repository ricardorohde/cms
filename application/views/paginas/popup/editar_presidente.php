<?php 
	if(!isset($presidente))
	{
		?>
		<div class="alert alert-block alert-danger">
			<h4 class="alert-heading"><strong>:(</strong></h4>
			<p>Não foi possível resgatar os dados do presidente selecionado</p>		
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
	                                <i class="fa fa-user"></i>
	                            </span>
	                            <h2>Editar Presidente cadastrado</h2>
                        	</header>
                        	<div>
                        		<div class="widget-body no-padding">
                        			<form id="editar_presidente" class="smart-form">
										<?php
											foreach($presidente as $row)
											{
												?>
													<input type="hidden" id="id_presidente" value="<?php echo $row->id?>">
													<fieldset>
								                        <section>
								                            <div class="row">
								                                <div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
								                                    <label class="input">
								                                        <input id="nome_presidente" type="text" placeholder="Nome do Ex-presidente" required value="<?php echo $row->nome?>" />
								                                    </label>
								                                </div>
								                            </div>
								                        </section>

								                        <section>
								                            <div class="row">
								                                <div class="col col-md-6 col-lg-6 col-sm-6 col-xs-6">
								                                    <label class="label">
								                                    </label>
								                                    <label class="input">
								                                        <i class="icon-append fa fa-calendar"></i>
								                                        <input id="inicio_mandato" type="text" class="form-control" placeholder="Início do mandato" data-mask="9999" data-mask-placeholder="*" required value="<?php echo $row->inicio_mandato?>">
								                                    </label>
								                                </div>
								                                <div class="col col-md-6 col-lg-6 col-sm-6 col-xs-6">
								                                    <label class="label">
								                                    </label>
								                                    <label class="input">
								                                        <i class="icon-append fa fa-calendar"></i>
								                                        <input id="fim_mandato" type="text" class="form-control" placeholder="Fim do mandato" data-mask="9999" data-mask-placeholder="*" required="" value="<?php echo $row->fim_mandato?>">
								                                    </label>
								                                </div>
								                            </div>
								                        </section>

								                        <section>
								                            <div class="row">
								                                <div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
								                                    <label class="input">
								                                        <a class="iframe-btn" href="./js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=fotografia&lang=pt_BR&fldr=ex-presidentes">
								                                            <i class="icon-append fa fa-picture-o"></i>
								                                        </a>
								                                        <input id="fotografia" type="text" class="form-control" placeholder="Clique ao lado p/ escolher a fotografia..." required="" value="<?php echo $row->foto?>">
								                                    </label>
								                                </div>
								                            </div>
								                        </section>
								                    </fieldset>
								
								                    <footer>
								                        <button type="submit" class="btn btn-default">
								                            <i class="fam-disk"></i> 
								                            Atualizar presidente
								                        </button>
								                        <button id="atualizar_depois" type="button" class="btn btn-default" onclick="window.close();">
								                            <i class="fam-cross"></i> 
								                            Cancelar
								                        </button>
								                    </footer>
												<?php
											}										
										?>                        			
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
<script src="./js/app.js"></script>
<script src="./js/ajax.js"></script>
<script src="./js/libs/jquery-ui-1.10.3.min.js"></script>
<script src="./js/plugin/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="./js/bootstrap/bootstrap.min.js"></script>
<script src="./js/notification/SmartNotification.min.js"></script>
<script src="./js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
<script src="./js/blockUI.js"></script>
<script src="./js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script src="./js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="./js/fancybox/jquery.fancybox.js" type="text/javascript"></script>
<script type="text/javascript">
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
	 * Função desenvolvida para salvar os novos dados dos presidentes
	 */
	$('#editar_presidente').submit(function(e){
		e.preventDefault();

		id 				= $('#id_presidente').val();
		nome_presidente = $('#nome_presidente').val();
		inicio_mandato	= $('#inicio_mandato').val();
		fim_mandato 	= $('#fim_mandato').val();
		fotografia 		= $('#fotografia').val();

		$.ajax({
			url: '<?php echo app_baseurl().'presidentes/alterar'?>',
			type: 'POST',
			data: {id: id, nome_presidente: nome_presidente, inicio_mandato: inicio_mandato, fim_mandato: fim_mandato, fotografia: fotografia},
			dataType: 'html',
			success: function(e)
			{
				if(e == 1)
				{
					msg_sucesso('Presidente atualizado');
					window.opener.buscar();

					setTimeout(function() {window.close();}, 1000);
				}
				else
				{
					msg_erro('Não foi possível salvar as alterações. Tente novamente');
					return false;
				}
			}
		});
	});
</script>