<script type="text/javascript">
	$(document).ready(function(){
		$("#edita_descricao").submit(function(e){
			e.preventDefault();
			sigla = $("#sigla").val();
			titulo_barraca = $("#titulo_barraca").val();
			descricao = $("#descricao").val();
			id = $("#id").val();
			alertify.confirm("<i class='fam-disk'></i> Deseja realmente atualizar este registro?", function(e){
				if(e)
				{
					$.ajax({
						url: "<?php echo app_baseUrl().'descricao_barracas/atualizar_descricao'; ?>",
						type: "POST",
						data: {sigla: sigla, titulo_barraca: titulo_barraca, descricao: descricao, id: id},
						dataType: "html",
						success: function(sucesso){
							if(sucesso == 'E0')
							{
								alertify.error("<strong>Não foi possível salvar. Tente Novamente</strong>");
								return false;
							}
							else
							{
								alertify.alert("<strong>Descrição salva com sucesso</strong>", function(e){
									if(e)
									{
										location.href = window.location;
									}
								});
							}
						},
						error: function(erro)
						{
							alertify.error("<strong>Ocorreu um erro. Tente novamente.</strong>");
						}
					});
				}
				else
				{
					return false;
				}
			});
		});
	});
	function fechar()
	{
		window.close();
	}
	
	window.onunload = function(){
		window.opener.buscar();
	};
</script>

<?php
	if($descricao == "" || $descricao == NULL)
	{
?>
		<div class="alert alert-error">
			<i class="fam-error"></i> <strong>Não foi possível resgatar os dados. Tente novamente</strong>
		</div>
<?php	
	}
	else
	{
?>
		<h4>Edição de descrição de barraca</h4>
		<div class="squiggly-border"></div>
		<form class="vertical" id="edita_descricao">
<?php
			foreach($descricao as $row)
			{
?>
				<div class="control-group">
					<label class="control-label"><strong>Sigla:</strong></label>
					<div class="controls">
						<input type="text" maxlength="5" id="sigla" value="<?php echo $row->sigla; ?>" required />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><strong>Título da Barraca:</strong></label>
					<div class="controls">
						<input type="text" maxlength="50" id="titulo_barraca" value="<?php echo $row->titulo_barraca; ?>" required />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><strong>Descrição:</strong></label>
					<div class="controls">
						<textarea class="span8" id="descricao" maxlength="350" required rows="5"><?php echo $row->descricao; ?></textarea>
					</div>
				</div>
				<input type="hidden" id="id" value="<?php echo $row->id; ?>">
<?php			
			}
?>
			<button class="botao perigo" type="button" onclick="javascript:fechar();">
				<i class="fam-lightning-delete"></i> Fechar esta Janela
			</button>
			<button class="botao sucesso" type="submit"><i class="fam-disk"></i> Salvar Descrição</button>
		</form>
<?php
	}
?>