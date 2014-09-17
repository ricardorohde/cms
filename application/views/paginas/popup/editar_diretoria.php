<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-fw fa-book"></i> Edição de Diretoria
        </h1>
    </div>
</div>
<?php
	if(!$diretoria)
	{
		?>
		<div class="alert alert-block alert-danger">
			<h4 class="alert-heading">:(</h4>
			<p>
				Ocorreu um erro na busca dos dados. Feche esta janela e tente
				novamente.			
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
	                        	<i class="fa fa-book"></i>
	                            </span>
	                        <h2>Editar Diretoria cadastrada</h2>
                       	</header>
                       	<div>
                       		<div class="widget-body no-padding">
                       			<form id="atualizar_diretoria" class="smart-form">
                       				<?php
                       					foreach ($diretoria as $row)
                       					{
											?>
												<input type="hidden" id="id" value="<?php echo $row->id?>">
												<fieldset>
							                        <section>
							                            <div class="row">
							                                <div class="col col-md-6 col-lg-6 col-sm-6 col-xs-6">
							                                    <label class="label"></label>
							                                    <label class="input">
							                                        <i class="icon-append fa fa-calendar"></i>
							                                        <input id="ano_inicio" type="text" class="form-control" placeholder="Início do mandato" data-mask="9999" data-mask-placeholder="*" required value="<?php echo $row->ano_inicio?>">
							                                    </label>
							                                </div>
							                                <div class="col col-md-6 col-lg-6 col-sm-6 col-xs-6">
							                                    <label class="label"></label>
							                                    <label class="input">
							                                        <i class="icon-append fa fa-calendar"></i>
							                                        <input id="ano_final" type="text" class="form-control" placeholder="Fim do mandato" data-mask="9999" data-mask-placeholder="*" required value="<?php echo $row->ano_final?>">
							                                    </label>
							                                </div>
							                            </div>
							                        </section>
							                        <section>
							                            <div class="row">
							                                <div class="col col-md-12 col-md-12 col-sm-12 col-xs-12">
							                                    <label class="textarea">
							                                        <i class="icon-prepend fa fa-comment-o"></i>
							                                        <textarea id="observacoes" rows="5" maxlength="500" placeholder="Comentários sobre esta diretorias"><?php echo $row->observacoes?></textarea>
							                                    </label>
							                                </div>
							                            </div>
							                        </section>
							                    </fieldset>
											<?php
										}
                       				?>
				                    <footer>
				                        <button type="submit" class="btn btn-default">
				                            <i class="fam-disk"></i> Salvar diretoria
				                        </button>
				                        <button id="fechar_modal" type="button" class="btn btn-default" onclick="window.close();">
				                            <i class="fam-cross"></i> Cancelar
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
<script src="./js/app.js"></script>
<script src="./js/ajax.js"></script>
<script src="./js/libs/jquery-ui-1.10.3.min.js"></script>
<script src="./js/bootstrap/bootstrap.min.js"></script>
<script src="./js/notification/SmartNotification.min.js"></script>
<script src="./js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
<script src="./js/blockUI.js"></script>
<script>
	$('#atualizar_diretoria').submit(function(e){
		e.preventDefault();

		id 			= $('#id').val();
		ano_inicio 	= $('#ano_inicio').val();
		ano_final 	= $('#ano_final').val();
		observacoes = $('#observacoes').val();

		$.ajax({
			url: '<?php echo app_baseurl().'diretoria/diretoria/salvarEdicao'?>',
			type: 'POST',
			data: {id: id, ano_inicio: ano_inicio, ano_final: ano_final, observacoes: observacoes},
			dataType: 'html',
			success: function(e)
			{
				if(e == 1)
				{
					msg_sucesso('Diretoria atualizada');
					window.opener.busca_diretorias();
					setTimeout(function() {window.close();}, 1000);
				}
				else
				{
					msg_erro('Não foi possível atualizar, tente novamente');
				}
			}
		});
	});
</script>