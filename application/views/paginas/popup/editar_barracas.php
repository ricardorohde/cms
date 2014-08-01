<script src="js/monetario.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        /*
         * Adiciona a máscara monetária ao campo de valores
         */
        $(".valores").maskMoney({
			showSymbol: true,
			symbol: "R$",
			decimal: ".",
			precision: 2
		});
        //----------------------------------------------------------------------
        
        /*
         * Esconde o modal de novo valor quando o botão é acionado, além de
         * resetar os campos do formulário
         */
        $("#reseta_valor").click(function(){
			$("#adicionar_valor").modal('hide');
		});
        //----------------------------------------------------------------------
        
        /*
         * Esconde o modal de nova descrição de barraca quando o botão é 
         * acionado, além de resetar os campos do formulário
         */
        $("#reseta_descricao").click(function(){
			$("#nova_descricao").modal('hide');
		});
        //----------------------------------------------------------------------
        
        /*
         * Função que vai buscar o valor de acordo com o que estiver selecionado
         * em tipo de barraca
         */
        $( "#id_descricao" ).change(function(){
            valor = $("select option:selected").data("week");
            valor_fim_semana = $("select option:selected").data("weekend");
            if(valor === null || valor === "" || valor_fim_semana === null || valor_fim_semana === "")
            {
                str = "";
                $( "#valor-barraca" ).html(str);
            }
            else
            {
                var str = "<strong>Valor diária:</strong> R$"+valor+" <strong>Valor Fim de Semana:</strong> R$"+valor_fim_semana;
                $( "#valor-barraca" ).html(str);
            }
        }).trigger("change");
        //----------------------------------------------------------------------
        
        /*
         * Função que salva um novo valor no banco de dados
         */
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
					if(sucesso === 'E01')
					{
						alertify.success("<strong>Valores Salvos Com sucesso</strong>");
						$("#valor").val("");
						$("#valor_fim_semana").val("");
						$("#adicionar_valor").modal('hide');
						buscar_valores();
					}
					if(sucesso === 'E00')
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
        //----------------------------------------------------------------------
        
        /*
         * Salva os novos dados de uma nova descricao via ajax
         */
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
					if(sucesso === 'E0')
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
						buscar_descricao();
						alertify.success("<strong>Descrição salva com sucesso</strong>");
					}
				},
				error: function(erro)
				{
					alertify.error("<strong>Ocorreu um erro. Tente novamente.</strong>");
				}
			});
		});
        //----------------------------------------------------------------------
    });
    
    /*
     * Função desenvolvida para buscar a descrição das barracas
     */
	function buscar_descricao()
	{
		$.get("<?php echo app_baseUrl().'descricao_barracas/descricao_combo' ?>", function(e){
            $("#id_descricao").html(e);
        });
	}
    //--------------------------------------------------------------------------
    
    /*
     * Função que povoa o campo de valores para uma nova descrição
     */
    function buscar_valores()
	{
		$.get("<?php echo app_baseUrl().'valor_barracas/valores_combo'?>", function(a){
			$("#id_valores").html(a);
		});
	}
    window.onload = function()
    {
        buscar_descricao();
        buscar_valores();
    };
</script>
<div class="row-fluid">
    <div class="span12">
        <h4 class="title">
            Edição dos dados de barraca
        </h4>
        <div class="squiggly-border">
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <!-- Modal responsável pela adição de novas barracas -->
        <form class="horizontal" id="nova_barraca">
            <div class="modal-body">
                <div class="control-group">
                    <label class="control-label"><strong>Nº Barraca:</strong></label>
                    <div class="controls">
                        <input type="text" id="numero_barraca" maxlength="5" class="input-mini" required autofocus />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><strong>Tipo de Barraca:</strong></label>
                    <div class="controls">
                        <select id="id_descricao" class="" required>
                        </select>
                        <span class="help-inline">
                            <a href="#nova_descricao" rel="tooltip" title="Adicionar descrição" data-toggle="modal" data-backdrop="false">
                                <i class="fam-house"></i>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><strong>Valor:</strong></label>
                    <div class="controls">
                        <span id="valor-barraca">
                        </span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><strong>Localização:</strong></label>
                    <div class="controls">
                        <input type="text" id="localizacao" maxlength="40" class="input-large" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="botao sucesso" type="submit"><i class="fam-disk"></i> Salvar Valor</button>
            </div>
        </form>
        <!----------------------------------------------------------------------------->

        <!-- Modal que contém o formulário para inserção de nova descrição -->
        <form class="form-horizontal" id="dados_descricao">
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
                            <select id="id_valores">
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
                            <textarea class="input-large" id="descricao" maxlength="350" required rows="5"></textarea>
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
        <form class="form-horizontal" id="novos-valores">
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
    </div>
</div>
