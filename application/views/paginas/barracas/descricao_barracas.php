<script src="js/monetario.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		//Adiciona a classe active ao menu correspondente
		$("#navigation-configuracoes").addClass('active');
        //Adiciona a máscara monetária ao campo de valores
        $(".valores").maskMoney({
			showSymbol: true,
			symbol: "R$",
			decimal: ".",
			precision: 2
		});
		//Esconde o modal quando o botão reset do formulário é acionado
        $("#reseta_valor").click(function(){
			$("#adicionar_valor").modal('hide');
		});
        $("#reseta_descricao").click(function(){
			$("#nova_descricao").modal('hide');
		});
		
		//Salva os novos dados via ajax
		$("#dados_descricao").submit(function(e){
			e.preventDefault();
			sigla = $("#sigla").val();
			titulo_barraca = $("#titulo_barraca").val();
			descricao = $("#descricao").val();
            id_valores = $("#id_valores").val();
			$.ajax({
				url: "<?php echo app_baseUrl().'descricao_barracas/salvar_descricao'; ?>",
				type: "POST",
				data: {sigla: sigla, titulo_barraca: titulo_barraca, descricao: descricao, id_valores: id_valores},
				dataType: "html",
				success: function(sucesso){
					if(sucesso == 'E0')
					{
						alertify.error("<strong>Não foi possível salvar. Tente Novamente</strong>");
						return false;
					}
					else
					{
						$("#nova_descricao").modal('hide');
						$("#sigla").val("");
						$("#titulo_barraca").val("");
						$("#descricao").val("");
						buscar();
						alertify.success("<strong>Descrição salva com sucesso</strong>");
					}
				},
				error: function(erro)
				{
					alertify.error("<strong>Ocorreu um erro. Tente novamente.</strong>");
				}
			});
		});
		//Realiza a exclusão de uma descrição
		$(document).on("click", ".excluir", function(e){
			e.preventDefault();
			id = $(this).attr("id");
			alertify.confirm('<i class="fam-error"></i> Deseja realmente excluir?<br />Barracas com esta marcação podem perder a referencia', function(confirma){
				if(confirma)
				{
					$.ajax({
						url: "<?php echo app_baseUrl().'descricao_barracas/excluir'; ?>",
						type: "POST",
						data: {id: id},
						dataType: "html",
						success: function(sucesso){
							if(sucesso === 'E0')
							{
								alertify.error("<strong>Ocorreu um erro ao excluir. Tente novamente.</strong>");
								return false;
							}
							if(sucesso === 'E1')
							{
								buscar();
								alertify.success("<strong>Excluído com sucesso</strong>");
							}
                            else
                            {
                                alertify.log('Ocorreu um erro. Tente novamente');
                            }
						},
						error: function(erro){
							alertify.error("<strong>Ocorreu um erro. Tente mais tarde</strong>");
							return false;
						}
					});
				}
				else
				{
                    id = "";
					return false;
				}
			});
		});
        //Função que salva um novo valor no banco de dados
		$("#novos-valores").submit(function(e){
			e.preventDefault();
			valor = $("#valor").val();
			valor_fim_semana = $("#valor_fim_semana").val();
			$.ajax({
				url: "<?php echo app_baseUrl().'valor_barracas/salvar_valor';?>",
				type: "POST",
				data: {valor: valor, valor_fim_semana: valor_fim_semana},
				dataType: "html",
				success: function(sucesso){
					if(sucesso == 'E01')
					{
						alertify.success("<strong>Valores Salvos Com sucesso</strong>");
						$("#valor").val("");
						$("#valor_fim_semana").val("");
						$("#adicionar_valor").modal('hide');
						buscar_valores();
					}
					if(sucesso ==  'E00')
					{
						alertify.error("<strong>Não foi possível salvar o novo valor!</strong>");
						return false;
					}
				},
				error: function(erro){
					$("#erro").html(
						alertify.error("Não foi possível salvar. Tente novamente")
					);
				}
			});
		});
	});
    //Função que povoa o campo de valores para uma nova descrição
    function buscar_valores()
	{
		$.get("<?php echo app_baseUrl().'valor_barracas/valores_combo'?>", function(e){
			$("#id_valores").html(e);
		});
	}
	//Função que realiza a busca dos dados já cadastrados
	function buscar()
    {
        $.get("<?php echo app_baseUrl().'descricao_barracas/busca_descricoes/' ?>", function(b){
            $("#descricoes_cadastradas").html(b);
        });
    }
    window.onload = function(){
        buscar();
        buscar_valores();
    };
</script>
<div class="row-fluid">
	<div class="span12">
		<h4 class="title">
			Descrição das Barracas
			<a class="botao sucesso pull-right principal" href="#nova_descricao" data-toggle="modal" data-backdrop="false">
				<i class="fam-page-white-edit"></i> Nova Descrição
			</a>
		</h4>
		<div class="squiggly-border"></div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12" id="descricoes_cadastradas">
	</div>
</div>

<!-- Modal que contém o formulário para inserção de nova descrição -->
<form class="vertical" id="dados_descricao">
	<div class="modal hide fade" id="nova_descricao">
		<div class="modal-header">
			<a class="close" type="button" data-dismiss="modal">&times;</a>
			<h4>Adicionar nova Descrição</h4>
		</div>
		<div class="modal-body">
			<div class="control-group">
				<label class="control-label"><strong>Sigla:</strong></label>
				<div class="controls">
					<input type="text" maxlength="5" id="sigla" required autofocus />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><strong>Título da Barraca:</strong></label>
				<div class="controls">
					<input type="text" maxlength="50" id="titulo_barraca" required />
				</div>
			</div>
            <div class="control-group">
                <label class="control-label"><strong>Valor da diária</strong></label>
                <div class="controls">
                    <select id="id_valores" class="input-xlarge" required>
					</select>
                    <span class="help-inline">
						<a href="#adicionar_valor" rel="tooltip" title="Adicionar valor" data-toggle="modal" data-backdrop="false">
							<i class="fam-money-add"></i>
						</a>
					</span>
                </div>
            </div>
			<div class="control-group">
				<label class="control-label"><strong>Descrição:</strong></label>
				<div class="controls">
					<textarea class="span8" id="descricao" maxlength="350" required rows="5"></textarea>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="botao perigo" type="reset" id="reseta_descricao"><i class="fam-lightning-delete"></i> Fechar</button>
			<button class="botao sucesso" type="submit"><i class="fam-disk"></i> Salvar Descrição</button>
		</div>
	</div>
</form>
<!----------------------------------------------------------------------------->

<!-- Modal que exibe formulário para adicionar um novo valor -->
<form class="horizontal" id="novos-valores">
	<div class="modal hide fade" id="adicionar_valor">
		<div class="modal-header">
			<a class="close" type="button" data-dismiss="modal">&times;</a>
			<h4>Novo Valor de Barracas</h4>
		</div>
		<div class="modal-body">
			<div class="control-group">
				<label class="control-label">Valor de <strong>Uma</strong> diária:</label>
				<div class="controls">
					<input class="valores" type="text" id="valor" required autofocus />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Valor do <strong>Fim de semana</strong>:</label>
				<div class="controls">
					<input class="valores" type="text" id="valor_fim_semana" required />
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="botao perigo" type="reset" id="reseta_valor"><i class="fam-lightning-delete"></i> Fechar</button>
			<button class="botao sucesso" type="submit"><i class="fam-disk"></i> Salvar Valor</button>
		</div>
	</div>
</form>
<!----------------------------------------------------------------------------->