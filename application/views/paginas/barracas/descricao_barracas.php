<script type="text/javascript">
	//Chamada de funções que realizam a busca via ajax
	buscar();
	buscar_valores();
	
	$(document).ready(function(){
		
		//Realiza o LOAD do plugin de forma assíncrona
		loadScript('./js/plugin/maskmoney/jquery.maskmoney.min.js', mascara_monetaria);
		
		//Salva os novos dados via ajax
		$("#dados_descricao").submit(function(e){
			e.preventDefault();
			
			sigla			= $("#sigla").val();
			titulo_barraca 	= $("#titulo_barraca").val();
			descricao 		= $("#descricao").val();
            id_valores 		= $("#id_valores").val();
            
			$.ajax({
				url: "<?php echo app_baseUrl().'barracas/descricao_barracas/salvar_descricao'; ?>",
				type: "POST",
				data: {sigla: sigla, titulo_barraca: titulo_barraca, descricao: descricao, id_valores: id_valores},
				dataType: "html",
				success: function(e){
					if(e == 1)
					{
						limpar_campos($("#dados_descricao"));
						$("#nova_descricao").modal('hide');
						buscar();
						msg_sucesso("Descrição salva com sucesso");
					}
					else
					{
						msg_erro("Não foi possível salvar. Tente Novamente");
					}
				}
			});
		});
		//**********************************************************************
		
		
        //Função que salva um novo valor no banco de dados
		$("#novos-valores").submit(function(e){
			e.preventDefault();
			
			valor 				= $("#valor").val();
			valor_fim_semana 	= $("#valor_fim_semana").val();
			
			$.ajax({
				url: "<?php echo app_baseUrl().'valor_barracas/salvar_valor';?>",
				type: "POST",
				data: {valor: valor, valor_fim_semana: valor_fim_semana},
				dataType: "html",
				success: function(e){
					if(e == 1)
					{
						msg_success("Valores Salvos Com sucesso");
						limpar_campos($("#novos-valores"));
						$("#adicionar_valor").modal('hide');
						buscar_valores();
					}
					else
					{
						msg_error("Não foi possível salvar o novo valor");
					}
				}
			});
		});
		//**********************************************************************
		
	});
    //Função que povoa o campo de valores para uma nova descrição
    function buscar_valores()
	{
		$.get("<?php echo app_baseUrl().'barracas/valor_barracas/valores_combo'?>", function(e){
			$("#id_valores").html(e);
		});
	}
	//Função que realiza a busca dos dados já cadastrados
	function buscar()
    {
        $.get("<?php echo app_baseUrl().'barracas/descricao_barracas/busca_descricoes/' ?>", function(b){
            $("#descricoes_cadastradas").html(b);
        });
    }

    //Função que adiciona a mascara monetária aos campos
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

<!-- Header da página -->
<div class="row">
	<div class="col col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-fw fa-file"></i> Descrição das Barracas
		</h1>
	</div>
	<div class="col col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<a class="btn btn-primary pull-right principal" href="#nova_descricao" data-toggle="modal" data-backdrop="false">
			<i class="fa fa-plus"></i> Nova Descrição
		</a>
	</div>
</div>
<!--*************************************************************************-->

<div class="row">
	<!-- Div onde os dados serão inseridos via ajax -->
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12" id="descricoes_cadastradas"></div>
	<!--*********************************************************************-->
</div>

<!-- Modal que contém o formulário para inserção de nova descrição -->
<div class="modal fade" id="nova_descricao" data-backdrop="false">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
                <h4 class="modal-title">
	                Adicionar nova descrição
                </h4>
           	</div>
           	
           	<div class="modal-body no-padding">
           		<form class="smart-form" id="dados_descricao">
           			<fieldset>
           				<section>
            				<div class="row">
            					<div class="col col-md-12">
            						<label><strong>Sigla:</strong></label>
            						<label class="input">
										<input type="text" maxlength="5" id="sigla" required autofocus />
            						</label>
            					</div>
            				</div>
            			</section>
						<section>
            				<div class="row">
            					<div class="col col-md-12">
            						<label><strong>Título da Barraca:</strong></label>
            						<label class="input">
            							<input type="text" maxlength="50" id="titulo_barraca" required />
            						</label>
            					</div>
            				</div>
            			</section>
            			<section>
            				<div class="row">
            					<div class="col col-md-12">
            						<label><strong>Valor da diária:</strong></label>
            						<div class="input-group">
            							<span class="input-group-addon">
            								<a href="#adicionar_valor" data-toggle="modal" data-backdrop="false">
												<i class="fam-money-add"></i>
											</a>
            							</span>
										<select id="id_valores" class="form-control"></select>
            						</div>
            						<p class="note">
            							<strong>Nota:</strong>
            							Se você não encontrar o valor de barraca, você pode cadastrar um valor,
            							clicando no icone das notas acima
            						</p>
            					</div>
            				</div>
            			</section>
            			<section>
            				<div class="row">
            					<div class="col col-md-12">
            						<label><strong>Descrição:</strong></label>
            						<label class="textarea">
										<textarea id="descricao" maxlength="350" required rows="5"></textarea>
            						</label>
            					</div>
            				</div>
            			</section>
           			</fieldset>
           			<footer>
						<button class="btn btn-primary" type="submit"><i class="fam-disk"></i> Salvar Descrição</button>
						<button class="btn btn-default" type="reset" data-dismiss="modal" onclick="limpar_campos($('#dados_descricao'))">
							<i class="fam-cross"></i> Fechar
						</button>
           			</footer>
           		</form>
           	</div>
		</div>
	</div>
</div>
<!----------------------------------------------------------------------------->

<!-- Modal que exibe formulário para adicionar um novo valor -->
<div class="modal fade" id="adicionar_valor" data-backdrop="false">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<h4>Novo Valor de Barracas</h4>
			</div>
			
			<div class="modal-body no-padding">
				<form class="smart-form" id="novos-valores">
					<fieldset>
						<section>
							<div class="row">
								<div class="col col-md-12">
									<label>Valor de <strong>Uma</strong> diária:</label>
									<label class="input">
										<input class="valores" type="text" id="valor" required autofocus />
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<div class="col col-md-12">
									<label>Valor do <strong>Fim de semana</strong>:</label>
									<label class="input">
										<input class="valores" type="text" id="valor_fim_semana" required />
									</label>
								</div>
							</div>
						</section>
					</fieldset>
					<footer>
						<button class="btn btn-primary sucesso" type="submit"><i class="fam-disk"></i> Salvar Valor</button>
						<button class="btn btn-default" type="reset" data-dismiss="modal" onclick="limpar_campos($('#novos-valores'))">
							<i class="fam-cross"></i> Fechar
						</button>
					</footer>
				</form>
			</div>
		</div>
	</div>
</div>
<!----------------------------------------------------------------------------->