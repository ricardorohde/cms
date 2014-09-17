<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-fw fa-file-o"></i> Edição de descrições
        </h1>
    </div>
</div>

<?php
	if($descricao == "" || $descricao == NULL)
	{
		?>
		<div class="alert alert-block alert-warning">
			<h4 class="alert-heading">:(</h4>
			<p>Não foi possível resgatar os dados. Tente novamente</p>
		</div>
		<?php	
	}
	else
	{
		?>
		<section id="widget-grid" class="">
			<div class="row">
				<article class="col-sm-12 col-md-12 col-lg-12">
					<div class="jarviswidget jarviswidget-color-darken">
						<header>
                            <span class="widget-icon">
                                <i class="fa fa-file"></i>
                            </span>
                            <h2>Editar um aviso cadastrado</h2>
                        </header>
                        <div>
	                        <div class="widget-body no-padding">
	                        	<form class="smart-form" id="edita_descricao">
	                        		<?php
	                        			foreach($descricao as $row)
	                        			{
											?>
											<input type="hidden" id="id" value="<?php echo $row->id; ?>">
											<fieldset>
												<div class="row">
													<section class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<label><strong>Sigla:</strong></label>
		                                                <label class="input">
		                                                	<input type="text" maxlength="5" id="sigla" value="<?php echo $row->sigla; ?>" required />
		                                            	</label>
	                                                </section>
												</div>
												<div class="row">
													<section class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                                                <label><strong>Título da Barraca:</strong></label>
		                                                <label class="input">
		                                                	<input type="text" maxlength="50" id="titulo_barraca" value="<?php echo $row->titulo_barraca; ?>" required />
		                                            	</label>
		                                            </section>
												</div>
												<div class="row">
													<section>
							            				<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
							            					<label><strong>Valor da diária:</strong></label>
							            					<div class="input-group">
							            						<span class="input-group-addon">
							            							<a href="#adicionar_valor" data-toggle="modal" data-backdrop="false">
																		<i class="fam-money-add"></i>
																	</a>
							            						</span>
							            						<input type="hidden" id="valor_salvo" value="<?php echo $row->id_valores?>">	
																<select id="id_valores" class="form-control"></select>
							            					</div>
							            					<p class="note">
							            						<strong>Nota:</strong>
							            						Se você não encontrar o valor de barraca, você pode cadastrar um valor,
							            						clicando no icone das notas acima
							            					</p>
							            				</div>
							            			</section>
												</div>
												<div class="row">
													<section class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                                                <label><strong>Descrição:</strong></label>
		                                                <label class="textarea">
		                                                	<textarea id="descricao" maxlength="350" required rows="5"><?php echo $row->descricao; ?></textarea>
		                                            	</label>
		                                            </section>
												</div>
											</fieldset>
											<footer>
												<button class="btn btn-primary" type="submit">
													<i class="fam-disk"></i> Salvar Descrição
												</button>
												<button class="btn btn-default" type="button" onclick="window.close();">
													<i class="fam-cross"></i> Fechar esta Janela
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

<!-- Modal que exibe formulário para adicionar um novo valor -->
<div class="modal fade" id="adicionar_valor">
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
								<div class="col col-lg-6 col-md-6 col-sm-6 col-xs-6">
									<label>Valor de <strong>Uma</strong> diária:</label>
									<label class="input">
										<input class="valores" type="text" id="valor" required autofocus />
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<div class="col col-lg-6 col-md-6 col-sm-6 col-xs-6">
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
<script src="./js/app.js"></script>
<script src="./js/ajax.js"></script>
<script src="./js/libs/jquery-ui-1.10.3.min.js"></script>
<script src="./js/plugin/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="./js/bootstrap/bootstrap.min.js"></script>
<script src="./js/notification/SmartNotification.min.js"></script>
<script src="./js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
<script type="text/javascript">
	//Chamada da Função que busca os valores cadastrados
	buscar_valores();

	//Realiza o LOAD do plugin de forma assíncrona
	loadScript('./js/plugin/maskmoney/jquery.maskmoney.min.js', mascara_monetaria);

	//Realiza a atualização dos dados via ajax
	$(document).ready(function(){

		$("#edita_descricao").submit(function(e){
			e.preventDefault();
			
			sigla			= $("#sigla").val();
			titulo_barraca 	= $("#titulo_barraca").val();
			id_valores		= $('#id_valores').val();
			descricao 		= $("#descricao").val();
			id 				= $("#id").val();
			
			
			$.ajax({
				url: "<?php echo app_baseUrl().'barracas/descricao_barracas/atualizar_descricao'; ?>",
				type: "POST",
				data: {sigla: sigla, titulo_barraca: titulo_barraca, id_valores: id_valores, descricao: descricao, id: id},
				dataType: "html",
				success: function(e){
					if(e == 1)
					{
						msg_sucesso('A descrição foi atualizada');
						window.opener.buscar();
						setTimeout(function() {window.close();}, 1000);
					}
					else
					{
						msg_erro('Não foi possível atualizar. Tente novamente');
					}
				}
			});
		});
	});
	//**************************************************************************

	/*
	 * Função que povoa o campo de valores para uma nova descrição
	 */
	 function buscar_valores()
	{
		$.get("<?php echo app_baseUrl().'barracas/valor_barracas/valores_combo'?>", function(a){
			$("#id_valores").html(a);
		}).done(function(){
		    $("#id_valores").find('option').each(function(){
			    if($(this).val() == $('#valor_salvo').val())
			    {
				    $(this).prop('selected', true);
				}
			});
		});
	}
	//**************************************************************************

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
	//**************************************************************************

	/*
     * Função que salva um novo valor no banco de dados
     */
	$("#novos-valores").submit(function(e){
		e.preventDefault();
		
		valor 				= $("#valor").val();
		valor_fim_semana 	= $("#valor_fim_semana").val();
			
		$.ajax({
			url: "<?php echo app_baseUrl().'barracas/valor_barracas/salvar_valor';?>",
			type: "POST",
			data: {valor: valor, valor_fim_semana: valor_fim_semana},
			dataType: "html",
			success: function(sucesso){
				if(sucesso == 1)
				{
					msg_sucesso("Valores Salvos Com sucesso");
					limpar_campos($("#novos-valores"));
					$("#adicionar_valor").modal('hide');
					buscar_valores();
				}
				else
				{
					msg_erro("Não foi possível salvar o novo valor!");
					return false;
				}
			}
		});
	});
    //**************************************************************************
</script>