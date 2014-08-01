<script type="text/javascript">
    offset = 0
    $(document).ready(function(){
		$("#navigation-usuarios").addClass('active');
       
		$(document).on("click",".pagination li a", function(e){
			e.preventDefault();
            var href = $(this).attr("href");
            $("#usuarios").load(href);
        });
        
		$("#salvar").click(function(e){
			e.preventDefault();
			nome_completo = $("#nome_completo").val();
			nome_usuario = $("#nome_usuario").val();
			senha = $("#senha").val();
			if(nome_completo == "")
			{
				alertify.alert("O campo Nome Completo não pode ficar em branco", function(e){
					if(e)
					{
						$("#nome_completo").focus();
					}
				});
				return false;
			}
			if(nome_usuario == "")
			{
				alertify.alert("O campo Login não pode ficar em branco", function(e){
					if(e)
					{
						$("#nome_usuario").focus();
					}
				});
				return false;
			}
			if(senha == "")
			{
				alertify.alert("O campo Senha não pode ficar em branco", function(e){
					if(e)
					{
						$("#senha").focus();
					}
				});
				return false;
			}
			$.ajax({
				url: "<?php echo app_baseurl().'usuarios/salva_usuario'?>",
				type: "POST",
				data: {nome_completo: nome_completo, nome_usuario: nome_usuario, senha: senha},
				dataType: "html",
				success: function(sucesso){
					$("#sucesso").html(
                        verifica_usuarioSalvo(sucesso)
                    );
				},
				error: function(erro){
					alertify.error("<strong><i class='fam-error'></i> Ocorreu um erro. Tente novamente</strong>");
				}
			});
		});
       
		$(document).on("click", "table .inativo", function(e){
			e.preventDefault();
			id = $(this).attr("id");
			pagina = $(this).attr("href");
			$.ajax({
				url: "<?php echo app_baseUrl().'usuarios/inativar' ?>", 
				type: "POST",
				data: {id: id},
				dataType: "html",
				success: function(sucesso){
					$("#sucesso").html(
						alertify.success('<strong>'+sucesso+'</strong>'),
						buscar(pagina)
					);
				},
				error: function(erro)
				{
					$("#erro").html(
						alertify.error("<strong><i class='fam-error'></i> Ocorreu um erro. Tente novamente</strong>")
					);
				}
			});
		});
       
       
		$(document).on("click", "table .ativo", function(e){
			e.preventDefault();
			id = $(this).attr("id");
			pagina = $(this).attr("href");
			$.ajax({
				url: "<?php echo app_baseUrl().'usuarios/ativar' ?>", 
				type: "POST",
				data: {id: id},
				dataType: "html",
				success: function(sucesso){
					$("#sucesso").html(
						alertify.success('<strong>'+sucesso+'</strong>'),
						buscar(pagina)
					);
				},
				error: function(erro)
				{
					$("#erro").html(
						alertify.error("<strong><i class='fam-error'></i> Ocorreu um erro. Tente novamente</strong>")
					);
				}
			});
		});
		
		$(document).on("click", ".excluir", function(e){
			e.preventDefault();
			id = $(this).attr("id");
			pagina = $(this).attr("href");
			alertify.confirm("Deseja realmente excluir este usuário?", function(confirma){
				if(confirma)
				{
					$.ajax({
						url: "<?php echo app_baseUrl().'usuarios/excluir_usuario'?>",
						type: "POST",
						data: {id: id},
						dataType: "html",
						success: function(sucesso){
							if(sucesso == 'E0')
							{
								alertify.error("<strong>Não foi possível excluir o usuário selecionado</strong>");
								return false;
							}
							if(sucesso == 'E1')
							{
								alertify.success("<strong>Usuário excluído com sucesso</strong>");
								buscar(pagina);
							}
						},
						error: function(erro){
							$("#erro").html(
								alertify.log("<strong>Não foi possivel excluir</strong>")
							);
						}
					});
				}
				else
				{
					return false;
				}
			});
		});
		
		$("#fechar").click(function(e){
			e.preventDefault();
			$("#nome_completo").val("");
			$("#nome_usuario").val("");
			$("#senha").val("");
			$("#formulario_usuario").modal('hide');
		});
    });
    
    function verifica_usuarioSalvo(sucesso)
    {
        if(sucesso == 0)
        {
			alertify.error("<strong><i class='fam-error'></i> Não foi possível salvar o usuário. <br />Tente novamente</strong>")
            return false;
        }
        if(sucesso == 1)
        {
			$("#formulario_usuario").modal('hide');
			$("#nome_completo").val("");
			$("#nome_usuario").val("");
			$("#senha").val("");
			alertify.success("<strong>Usuário cadastrado com sucesso!</strong>");
            buscar();
        }
    }
    
    function buscar(offset)
    {
        $.get("<?php echo app_baseUrl().'usuarios/buscar_usuarios/' ?>" + offset, function(b) {
            $("#usuarios").html(b);
        });
    }
    
    window.onload(buscar());
</script>
<div class="row-fluid">
    <div class="span12">
        <h4 class="title">
			Usuários do sistema
			<a href="#formulario_usuario" class="botao sucesso pull-right principal" data-toggle="modal" data-backdrop="false">
				<i class="fam-user-add"></i> Cadastrar novo Usuário
			</a>
		</h4>
        <div class="squiggly-border"></div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <div id="usuarios">
        </div>
    </div>
</div>
<div id="formulario_usuario" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" >×</button>
		<h4>Cadastrar novo Usuário</h4>
	</div>
	<div class="modal-body">
		<form id="novo_usuario" class="vertical">
			<div class="control-group">
				<label class="control-label">Nome Completo:</label>
				<div class="controls">
					<input type="text" id="nome_completo" maxlength="40" required autofocus />
				</div>
            </div>
			<div class="control-group">
				<label class="control-label">Login:</label>
				<div class="controls">
					<input type="text" id="nome_usuario" maxlength="15" required />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Senha:</label>
				<div class="controls">
					<input type="password" id="senha" required />
				</div>
			</div>
        </form>
	</div>
	<div class="modal-footer">
		<button class="botao perigo" id="fechar"><i class="fam-lightning-delete"></i> Fechar</button>
		<button class="botao sucesso" id="salvar"><i class="fam-disk"></i> Salvar Usuário</button>
	</div>
</div>

<div id="sucesso"></div>
<div id="erro"></div>