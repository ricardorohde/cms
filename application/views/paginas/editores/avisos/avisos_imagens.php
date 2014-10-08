<?php
	if(!$aviso)
	{
		?>
		<div class="alert alert-block alert-warning">
			<a class="close" href="#" data-dismiss="alert">&times;</a>
			<h4 class="alert-heading">:(</h4>
			<p>Não foi possível resgatar o aviso para edição</p>
		</div>
		<?php
	}
	else
	{
		?>
		<div class="modal fade" id="modal_edicao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" data-keyboard="false">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
		                <img src="./img/logo.png" width="150" alt="Clube Campestre Pentáurea">
		                <h4 class="modal-title pull-right">
		                    Edição de Aviso
		                </h4>
		            </div>
		            <div class="modal-body no-padding">
		            	<form id="editar_aviso" class="smart-form">
		            		<fieldset>
		            			<?php
		            				foreach($aviso as $row)
		            				{
										?>
										<input type="hidden" id="id" name="id" value="<?php echo $row->id?>">
										<div class="row">
				                            <section class="col col-6">
				                                <div class="form-group">
				                                    <label class="label">
				                                        <strong>Selecione a data de expiração do aviso</strong>
				                                    </label>
				                                    <div class="input-group">
				                                        <label class="input">
				                                            <input class="form-control" id="ed_data_expiracao" name="data_expiracao" type="text" placeholder="Data de expiração" required value="<?php echo $row->data_expiracao?>">
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
				                                        	<input id="ed_imagem_aviso" name="imagem" type="text" class="form-control" placeholder="Clique ao lado para selecionar uma imagem de fundo" value="<?php echo $row->imagem?>" required>
				                                        </label>
				                                        <span class="input-group-addon">
				                                        	<a class="iframe-btn" id="busca_background" href="./js/filemanager/filemanager/dialog.php?type=1&field_id=ed_imagem_aviso&fldr=avisos&lang=pt_BR">
				                                            	<i class='fam-picture-add'></i>
				                                            </a>
				                                        </span>
				                                    </div>
				                                </div>
				                            </section>
				                        </div>
										<?php
									}
		            			?>
		            		</fieldset>
		            		<footer>
	                        	<button type="submit" class="btn btn-default">
		                            <i class="fam-disk"></i> 
		                            Salvar edição
		                        </button>
		                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpar_campos($('#editar_aviso'));">
		                            <i class="fam-cross"></i> 
		                            Cancelar
		                        </button>
		                    </footer>
		            	</form>
		            </div>
				</div>
			</div>
		</div>
		<?php
	}
?>
<script type="text/javascript">
	/** Seta o Calendário ao elemento **/
	$('#ed_data_expiracao').datepicker({
	    dateFormat: 'yy-mm-dd',
	    prevText: '<i class="fa fa-chevron-left"></i>',
	    nextText: '<i class="fa fa-chevron-right"></i>',
		minDate: 0
	});
	//**************************************************************************

	/** Salva os dados do formulário via ajax **/
	$('#editar_aviso').submit(function(e){
		e.preventDefault();

		var edicao = $(this).serialize();

		$.ajax({
			url: '<?php echo app_baseurl().'avisos/avisos_imagens/salvar_edicao'?>',
			type: 'POST',
			data: edicao,
			dataType: 'html',
			success: function(e)
			{
				if(e == 1)
				{
					msg_sucesso('O registro foi atualizado');
					$('#modal_edicao').modal('hide');
					buscar();
				}
				else
				{
					msg_erro('Ocorreu um erro ao atualizar. Tente novamente');
				}
			}
		});
	});
</script>