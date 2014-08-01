<script src="js/monetario.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
		$("#navigation-configuracoes").addClass('active');
		//Função que adiciona uma máscara monetária aos campos de dinheiro
		$(".valores").maskMoney({
			showSymbol: true,
			symbol: "R$",
			decimal: ".",
			precision: 2
		});
		
		$("button[type='reset']").click(function(){
			$("#adicionar_valor").modal('hide');
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
					$("#sucesso").html(
						verifica_save(sucesso)
					);
				},
				error: function(erro){
					$("#erro").html(
						alertify.error("Não foi possível salvar. Tente novamente")
					);
				}
			});
		});
		
		//Função para alteração de valores no banco de dados
		$("#form-edicao").submit(function(e){
			e.preventDefault();
			alertify.confirm("Deseja alterar?", function(confirma){
				if(confirma)
				{
					valor = $("#novo_valor").val();
					valor_fim_semana = $("#novo_valor_fim_semana").val();
					id_valor = $("#id_valor").val();
					$.ajax({
						url: "<?php echo app_baseUrl().'valor_barracas/altera_valor'?>",
						type: "POST",
						data: {valor: valor, valor_fim_semana: valor_fim_semana, id_valor: id_valor},
						dataType: "html",
						success: function(sucesso){
							verifica_atualizacao(sucesso);
						},
						error: function(erro){
							alertify.error("Ocorreu um erro. Tente Mais Tarde");
						}
					});
				}
				else
				{
					return false;
				}
			});
		});
		
		//Função que exclui uma tupla de valores do banco de dados
		$(document).on("click", ".excluir", function(e){
			e.preventDefault();
			id = $(this).attr("id");
			alertify.confirm("Deseja realmente Excluir? <br />Barracas relacionadas a este preço poderão perder a referência", function(confirma){
				if(confirma)
				{
					$.ajax({
						url: "<?php echo app_baseUrl().'valor_barracas/excluir_valor' ;?>",
						type: "POST",
						data: {id: id},
						dataType: "html",
						success: function(sucesso){
							$("#sucesso").html(
								verifica_exclusao(sucesso)
							);
						},
						error: function(erro){
							$("#erro").html(
								alertify.error("<strong>Não foi possível excluir. Tente Novamente</strong>")
							);
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
		
		//Função na qual se baseia a edição de valores
		$(document).on("click", ".editar", function(e){
			e.preventDefault();
			id = $(this).attr("id");
			$("#id_valor").attr("value", id);
			$.ajax({
				url: "<?php echo app_baseUrl().'valor_barracas/buscar_valor'?>",
				type: "POST",
				data: {id: id},
				dataType: "json",
				success: function(sucesso){
					$("#sucesso").html(
						montar_edicao(sucesso)
					);
				},
				erro: function(erro)
				{
					$("#erro").html(
						alertify.error("<strong>Não foi possível excluir. Tente Novamente</strong>")
					);
				}
			});
		});
    });
	
	//Função que verifica se os novos valores inseridos foram salvos no banco de dados
	function verifica_save(verificador)
	{
		if(verificador == 'E01')
		{
			alertify.success("<strong>Valores Salvos Com sucesso</strong>");
			$("#valor").val("");
			$("#valor_fim_semana").val("");
			$("#adicionar_valor").modal('hide');
			buscar();
		}
		if(verificador ==  'E00')
		{
			alertify.error("<strong>Não foi possível salvar o novo valor!</strong>");
			return false;
		}
	}
	
	//Função que verificará se a exclusão foi realizada com sucesso
	function verifica_exclusao(verificador)
	{
		if(verificador ==  'E01')
		{
			alertify.success("<strong>Valores excluídos Com sucesso</strong>");
			buscar();
		}
		if(verificador == 'E00')
		{
			alertify.error("<strong>Não foi possível excluir o valor.</strong>");
			return false;
		}
	}
	
	//Função que montará a tela de edição dos novos valores
	function montar_edicao(data)
	{
		var html = "";
        for($i=0; $i < data.length; $i++)
		{
			html += '<div class="alert alert-info">';
			html += '<strong>Diária antiga: </strong>R$'+ data[$i].valor +'<br />';
			html += '<strong>Fim de semana antigo: </strong>R$'+ data[$i].valor_fim_semana;
			html += '</div>';
        }
		$("#modificar_valor").modal({
			backdrop: false
		});
		$("#mensagem").html(html);
	}
	
	//Função que verifica se o valor foi atualizado ou não
	function verifica_atualizacao(verificador)
	{
		if(verificador == 'E0P')
		{
			alertify.error("É necessário preencher ao menos 1 campo");
			return false;
		}
		if(verificador == 'E0N')
		{
			alertify.error("Os novos valores não foram salvos. Tente novamente");
			return false;
		}
		if(verificador == 'E01')
		{
			alertify.success("Novos valores salvos com sucesso");
			$("#novo_valor").val("");
			$("#novo_valor_fim_semana").val("");
			$("#modificar_valor").modal('hide');
			buscar();
		}
	}
	
	//Função que realiza a busca dos dados cadastrados via ajax
	function buscar()
    {
        $.get("<?php echo app_baseUrl().'valor_barracas/busca_valores/' ?>", function(b){
            $("#valores").html(b);
        });
    }
    window.onload(buscar());
</script>
<div class="row-fluid">
    <div class="span12">
        <h4 class="title">
			Valores das Barracas
			<a class="botao sucesso pull-right principal" href="#adicionar_valor" data-toggle="modal" data-backdrop="false">
				<i class="fam-page-white-edit"></i> Novo Valor
			</a>
		</h4>
        <div class="squiggly-border"></div>
    </div>
</div>
<!-- Div que irá exibir a tabela que foi buscada por ajax na função buscar -->
<div class="row-fluid">
	<div class="span12" id="valores">
	</div>
</div>


<!-- Modal que exibe o formulário de edição de valores -->
<form class="horizontal" id="form-edicao">
	<div class="modal hide fade" id="modificar_valor">
		<div class="modal-header">
			<a href="javascript:void(0)" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
			<h4>Editando Valores de Barracas</h4>
		</div>
		<div class="modal-body">
			<div id="mensagem"></div><!-- Div que exibe as antigos valores -->
			<div class="control-group">
				<label class="control-label"><strong>Valor: </strong>
				<div class="controls">
					<input type="text" class="valores" id="novo_valor" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><strong>Valor de Fim de Semana: </strong>
				<div class="controls">
					<input type="text" class="valores" id="novo_valor_fim_semana" />
				</div>
			</div>
			<input type="hidden" id="id_valor" value=""/>
			<div class="modal-footer">
				<a href="javascript:void(0)" class="botao perigo" data-dismiss="modal" aria-hidden="true"><i class="fam-lightning-delete"></i> Fechar esta Janela</a>
				<button type="submit" class="botao sucesso"><i class="fam-disk"></i> Salvar alterações</button>
			</div>
		</div>
	</div>
</form>

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
			<button class="botao perigo" type="reset"><i class="fam-lightning-delete"></i> Fechar</button>
			<button class="botao sucesso" type="submit"><i class="fam-disk"></i> Salvar Valor</button>
		</div>
	</div>
</form>