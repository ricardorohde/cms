<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-fw fa-home"></i> Edição de barracas
        </h1>
    </div>
</div>
<?php
	if(!$barraca)
	{
		?>
		<div class="alert alert-block alert-warning">
			<h4 class="alert-heading">:(</h4>
			<p>Não foi possível resgatar os dados solicitados</p>
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
                                <i class="fa fa-home"></i>
                            </span>
                            <h2>Editar uma barraca cadastrada</h2>
                        </header>
                        <div>
                        	<div class="widget-body no-padding">
                        		<form class="smart-form" id="nova_barraca">
                        			<?php
                        				foreach($barraca as $row)
                        				{
											?>
											<input type="hidden" id="id" value="<?php echo $row->id?>">
											<fieldset>
						            			<section>
						            				<div class="row">
						            					<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
						            						<label><strong>Nº da Barraca</strong></label>
						            						<label class="input">
						            							<input type="text" id="numero_barraca" maxlength="5" class="span2" required value="<?php echo $row->numero_barraca?>" />
						            						</label>
						            					</div>
						            				</div>
						            			</section>
						            			<section>
						            				<div class="row">
						            					<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
						            						<label><strong>Tipo de Barraca:</strong></label>
						            						<div class="input-group">
						            							<span class="input-group-addon">
						            								<a href="#nova_descricao" rel="tooltip" title="Adicionar descrição" data-toggle="modal" data-backdrop="false">
																		<i class="fam-house"></i>
																	</a>
						            							</span>
						            							<input type="hidden" id="tipo_cadastrado" value="<?php echo $row->id_descricao?>">
						            							<select class="form-control" id="id_descricao" required></select>
						            						</div>
						            						<p class="note">
						            							<strong>Nota:</strong>
						            							Se você não encontrar o tipo de barraca, você pode cadastrar um tipo,
						            							clicando no icone da casinha acima
						            						</p>
						            					</div>
						            				</div>
						            			</section>
						            			<section>
						            				<div class="row">
						            					<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
						            						<label><strong>Valor:</strong></label>
						            						<label class="input">
						            							<span id="valor-barraca"></span>
						            						</label>
						            					</div>
						            				</div>
						            			</section>
						            			<section>
						            				<div class="row">
						            					<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
						            						<label><strong>Localização:</strong></label>
						            						<label class="input">
						            							<input type="text" id="localizacao" maxlength="40" required value="<?php echo $row->localizacao?>" />
						            						</label>
						            					</div>
						            				</div>
						            			</section>
						            		</fieldset>
						            		<footer>		
												<button class="btn btn-primary" type="submit"><i class="fam-disk"></i> Atualizar Barraca</button>
												<button class="btn btn-default" type="button" onclick="window.close()">
													<i class="fam fam-cross"></i> Fechar
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

<!-- Modal que contém o formulário para inserção de nova descrição -->
<div class="modal fade" id="nova_descricao" data-backdrop="false" data-keyboard="true">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
                <h4 class="modal-title">
	                Descrição de Barracas
                </h4>
                
           	</div>
           	
           	<div class="modal-body no-padding">
           		<form class="smart-form" id="dados_descricao">
           			<fieldset>
           				<section>
            				<div class="row">
            					<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
            						<label><strong>Sigla:</strong></label>
            						<label class="input">
										<input type="text" maxlength="5" id="sigla" required autofocus />
            						</label>
            					</div>
            				</div>
            			</section>
						<section>
            				<div class="row">
            					<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
            						<label><strong>Título da Barraca:</strong></label>
            						<label class="input">
            							<input type="text" maxlength="50" id="titulo_barraca" required />
            						</label>
            					</div>
            				</div>
            			</section>
            			<section>
            				<div class="row">
            					<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
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
            					<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
            						<label><strong>Descrição:</strong></label>
            						<label class="textarea">
										<textarea class="span8" id="descricao" maxlength="350" required rows="5"></textarea>
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
								<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
									<label>Valor de <strong>Uma</strong> diária:</label>
									<label class="input">
										<input class="valores" type="text" id="valor" required autofocus />
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
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
	//Realiza o LOAD do plugin de forma assíncrona
	loadScript('./js/plugin/maskmoney/jquery.maskmoney.min.js', mascara_monetaria);
	
	
	//Variável que será usada na exibição dos valores das barracas
	var valor_barraca = '';
	
	buscar_descricao();
	buscar_valores();

	$(document).ready(function(){
        
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
					}
				}
			});
		});
        //----------------------------------------------------------------------
        
        /*
         * Salva os novos dados de uma nova descricao via ajax
         */
		$("#dados_descricao").submit(function(e){
			e.preventDefault();
			
			sigla 			= $("#sigla").val();
			titulo_barraca	= $("#titulo_barraca").val();
			descricao 		= $("#descricao").val();
            id_valores 		= $("#id_valores").val();
            
			$.ajax({
				url: "<?php echo app_baseUrl().'barracas/descricao_barracas/salvar_descricao'; ?>",
				type: "POST",
				data: {sigla: sigla, titulo_barraca: titulo_barraca, descricao: descricao, id_valores: id_valores},
				dataType: "html",
				success: function(e)
				{
					if(e == 1)
					{
					    msg_sucesso("Descrição salva com sucesso");
						limpar_campos($("#dados_descricao"));
						buscar_descricao();
						$("#nova_descricao").modal('hide');
					}
					else
					{
					    msg_erro("Não foi possível salvar. Tente Novamente");
					}
					
				}
			});
		});
        //----------------------------------------------------------------------
        
        /*
         * Função para salvar uma nova barraca no banco de dados
         */
         $("#nova_barraca").submit(function(e){
            e.preventDefault();

            id				= $('#id').val();
            numero_barraca	= $("#numero_barraca").val();
            id_descricao 	= $("#id_descricao").val();
            localizacao 	= $("#localizacao").val();
            
            $.ajax({
                url: "<?php echo app_baseurl().'barracas/barracas/atualizar_barraca';?>",
                type: "POST",
                data: {id: id, numero_barraca: numero_barraca, id_descricao: id_descricao, localizacao: localizacao},
                dataType: "html",
                success: function(e)
                {
                    if(e == 1)
                    {
                        msg_sucesso("Barraca Salva com sucesso");
                        window.opener.buscar();
                        setTimeout(function() {window.close();}, 1000);
                    }
                    else
                    {
                		msg_erro("Não foi possível salvar a barraca");
                    }
                }
            });
        });
        //---------------------------------------------------------------------
         
        
        /*
         * Função que vai buscar o valor de acordo com o que estiver selecionado
         * em tipo de barraca
         */
        $("#id_descricao").change(function(){
            valor 				= $("select option:selected").data("week");
            valor_fim_semana 	= $("select option:selected").data("weekend");

            if(valor == null || valor == "" || valor_fim_semana == null || valor_fim_semana == "")
            {
        		valor_barraca = "";
                $( "#valor-barraca" ).html(valor_barraca);
            }
            else
            {
        		valor_barraca = "<strong>Valor diária:</strong> R$"+valor+"<br /><strong>Valor Fim de Semana:</strong> R$"+valor_fim_semana;
                $( "#valor-barraca" ).html(valor_barraca);
            }
        }).trigger("change");
        //----------------------------------------------------------------------
	});

	/*
	 * Função que, ao esconder a janela de cadastro de nova barraca, limpa os
	 * valores que foram colocados no Span via jQuery
	 */
	$('#reseta_barraca').click(function(){
	    $( "#valor-barraca" ).html('');
	});
    
	/*
     * Função desenvolvida para buscar a descrição das barracas
     */
	function buscar_descricao()
	{
		$.get("<?php echo app_baseUrl().'barracas/descricao_barracas/descricao_combo' ?>", function(e){
            $("#id_descricao").html(e);
        }).done(function(){
            $("#id_descricao").find('option').each(function(){
                if($(this).val() == $('#tipo_cadastrado').val())
                {
                    //Adiciona a propriedade SELECTED ao elemento correspondente
                    $(this).prop('selected', true);

                    //Recebe os valores da diária e do fim de semana
                    valor 				= $(this).data("week");
                    valor_fim_semana 	= $(this).data("weekend");
                    
                    //Insere o valor da barraca
                    valor_barraca = "<strong>Valor diária:</strong> R$"+valor+"<br /><strong>Valor Fim de Semana:</strong> R$"+valor_fim_semana;
                    $( "#valor-barraca" ).html(valor_barraca);
                }
            });
        });
	}
    //--------------------------------------------------------------------------
    
    /*
     * Função que povoa o campo de valores para uma nova descrição
     */
    function buscar_valores()
	{
		$.get("<?php echo app_baseUrl().'barracas/valor_barracas/valores_combo'?>", function(a){
			$("#id_valores").html(a);
		});
	}
    //--------------------------------------------------------------------------

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