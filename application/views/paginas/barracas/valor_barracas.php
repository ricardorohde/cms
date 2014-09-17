<script type="text/javascript">
	//Realiza o LOAD do plugin de forma assíncrona
	loadScript('./js/plugin/maskmoney/jquery.maskmoney.min.js', mascara_monetaria);
	
	buscar();
	
    $(document).ready(function(){
		
		//Função que salva um novo valor no banco de dados
		$("#novos-valores").submit(function(e){
			e.preventDefault();
			
			valor 				= $("#valor").val();
			valor_fim_semana 	= $("#valor_fim_semana").val();
			
			$.ajax({
				url: "<?php echo app_baseUrl().'barracas/valor_barracas/salvar_valor';?>",
				type: "POST",
				data: {valor: valor, valor_fim_semana: valor_fim_semana},
				dataType: "html",
				success: function(e){
					if(e == 1)
					{
						msg_sucesso('Os novos valores foram cadastrados');
						limpar_campos($("#novos-valores"));
						$("#adicionar_valor").modal('hide');
						buscar();
					}
					else
					{
						msg_erro('Não foi possível salvar. Tente novamente');
					}
				}
			});
		});
		
		//Função que exclui uma tupla de valores do banco de dados
		$(document).on("click", ".excluir", function(e){
			e.preventDefault();

			id = $(this).attr("id");

			$.SmartMessageBox({
				title: 'Deseja realmente Excluir?',
				content: 'Barracas relacionadas a este preço poderão perder a referência',
				buttons: '[Sim][Não]'
			}, function(e){
				if(e == 'Não')
				{
					return false;
				}
				else
				{
				    $.ajax({
						url: "<?php echo app_baseUrl().'barracas/valor_barracas/excluir_valor' ;?>",
						type: "POST",
						data: {id: id},
						dataType: "html",
						success: function(e){
							if(e == 1)
							{
								msg_sucesso('Valores excluídos com sucesso');
								buscar();
							}
							else
							{
								msg_erro('Ocorreu um erro na exclusão. Tente Novamente');
							}
						}
					});
				}
			});
		});
		
		//Função na qual se baseia a edição de valores
		$(document).on("click", ".editar", function(e){
			e.preventDefault();
			
			id = $(this).attr("id");
			$("#id_valor").attr("value", id);
			
			$.ajax({
				url: "<?php echo app_baseUrl().'barracas/valor_barracas/buscar_valor'?>",
				type: "POST",
				data: {id: id},
				dataType: "html",
				success: function(e){
					$('#modificar_valor').modal('show');
					$('#modal-editar').html(e);
				}
			});
		});
    });
	
	/**
	 * buscar()
	 *
	 * Função que realiza a busca dos dados cadastrados via ajax
	 * 
	 * @author	: Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access	: Public
	 */
	function buscar()
    {
	    url = '<?php echo app_baseUrl().'barracas/valor_barracas/busca_valores/' ?>';
	    loadAjax(url, $("#valores"));
    }
	//**************************************************************************

	/**
	 * mascara_monetaria()
	 *
	 * Função que adiciona a mascara monetária aos campos
	 * 
	 * @author	: Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access	: Public
	 */
	function mascara_monetaria()
	{
	    $(".valores").maskMoney({
			showSymbol: true,
			symbol: "R$",
			decimal: ".",
			precision: 2
		});
	}
</script>

<div class="row">
    <div class="col col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <h1 class="page-title txt-color-blueDark">
			<i class="fa fa-fw fa-money"></i> Valores das Barracas
		</h1>
    </div>
    <div class="col col-lg-6 col-md-6 col-sm-6 col-xs-6">
    	<a class="btn btn-primary pull-right" href="#adicionar_valor" data-toggle="modal" data-backdrop="false">
			<i class="fa fa-plus"></i> Novo Valor
		</a>
    </div>
</div>

<div class="row">
	<!-- Div que irá exibir a tabela que foi buscada por ajax na função buscar -->
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12" id="valores"></div>
	<!--*********************************************************************-->
</div>


<!-- Modal que exibe o formulário de edição de valores -->
<div class="modal fade" id="modificar_valor">
	<div class="modal-dialog">
		<div class="modal-content">
		
			<div class="modal-header">
				<h4 class="modal-title">Editando Valores de Barracas</h4>
			</div>
			
			<!-- Local onde o formulário de edição será inserido -->
			<div class="modal-body no-padding" id="modal-editar"></div>
			<!--*************************************************************-->
			
		</div>
	</div>
</div>
<!--*************************************************************************-->

<!-- Modal que exibe formulário para adicionar um novo valor -->
<div class="modal fade" id="adicionar_valor">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<h4 class="modal-title">Novo Valor de Barracas</h4>
			</div>
			
			<!-- Corpo da janela Modal -->
			<div class="modal-body no-padding">
				<form class="smart-form" id="novos-valores">
					<fieldset>
						<section>
							<div class="row">
								<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
									<label>Valor de <strong>Uma</strong> diária:</label>
									<label class="input">
										<input class="valores" type="text" id="valor" required autofocus>
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
									<label>Valor do <strong>Fim de semana</strong>:</label>
									<label class="input">
										<input class="valores" type="text" id="valor_fim_semana" required>
									</label>
								</div>
							</div>
						</section>
					</fieldset>
					<footer>
						<button class="btn btn-primary" type="submit"><i class="fam-disk"></i> Salvar Valor</button>
						<button class="btn btn-default" type="reset" data-dismiss="modal"><i class="fam-cross"></i> Fechar</button>
					</footer>
				</form>
			</div>
			<!--*************************************************************-->
			
		</div>
	</div>
</div>
<!--*************************************************************************-->