<?php
	if(!$valores)
	{
		?>
		<div class="alert alert-block alert-info">
			<h4 class="alert-heading">:(</h4>
			<p>Não foi possível resgatar os valores</p>
		</div>
		<?php
	}
	else
	{
		foreach ($valores as $row)
		{
			?>
			<form class="smart-form" id="form-edicao">
				<input type="hidden" id="id_valor" value="<?php echo $row->id?>">
				<fieldset>
					<section>
						<div class="row">
							<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<label><strong>Valor: </strong></label>
								<label class="input">
									<input type="text" class="valores" id="novo_valor" value="<?php echo $row->valor?>">
								</label>
							</div>
						</div>
					</section>
					<section>
						<div class="row">
							<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<label><strong>Valor de Fim de Semana: </strong></label>
								<label class="input">
									<input type="text" class="valores" id="novo_valor_fim_semana" value="<?php echo $row->valor_fim_semana?>">
								</label>
							</div>
						</div>
					</section>
				</fieldset>
				<footer>
					<button type="submit" class="btn btn-primary"><i class="fam-disk"></i> Salvar alterações</button>
					<button class="btn btn-default" data-dismiss="modal" type="button"><i class="fam-cross"></i> Fechar esta Janela</button>
				</footer>
			</form>
			<?php
		}
	}
?>
<script type="text/javascript">
	//Função para alteração de valores no banco de dados
	$("#form-edicao").submit(function(e){
		e.preventDefault();
	
		$.SmartMessageBox({
			title: 'Deseja alterar?',
			content: '',
			buttons: '[Sim][Não]'
		}, function(e){
			if(e == 'Não')
			{
				return false;
			}
			else
			{
			    valor 				= $("#novo_valor").val();
				valor_fim_semana 	= $("#novo_valor_fim_semana").val();
				id_valor 			= $("#id_valor").val();
	
				$.ajax({
					url: "<?php echo app_baseUrl().'barracas/valor_barracas/altera_valor'?>",
					type: "POST",
					data: {valor: valor, valor_fim_semana: valor_fim_semana, id_valor: id_valor},
					dataType: "html",
					success: function(e){
						if(e == 1)
						{
						    msg_sucesso("Novos valores salvos com sucesso");
							limpar_campos($("#form-edicao"));
							$("#modificar_valor").modal('hide');
							buscar();
						}
						else
						{
							msg_erro('Não foi possível alterar. Tente novamente');
						}
					}
				});
			}
		});
	});
</script>