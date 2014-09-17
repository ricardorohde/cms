<!-- Header da página -->
<div class="row">
	<div class="col col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-users"></i> Usuários Cadastrados
		</h1>
	</div>
	<div class="col col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<a href="#cadastro_usuario" class="pull-right btn btn-primary header-btn" data-toggle="modal">
			<i class="fa fa-plus"></i> Cadastrar Usuário
		</a>
	</div>
</div>
<!--*************************************************************************-->

<!-- Div onde os dados do usuários serão inseridos via ajax -->
<div id="cadastrados"></div>
<!--*************************************************************************-->

<!-- Modal que contém o formulário para cadastro de um novo usuário -->
<div class="modal fade" id="cadastro_usuario" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
                <h4 class="modal-title">
                    <img src="./img/logo.png" width="150" alt="Clube Campestre Pentáurea">
                </h4>
            </div>
            
            <div class="modal-body no-padding">
            	<form id="salvar_usuario" class="smart-form">
            		<fieldset>
            			<div class="row">
            				<section class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
            					<div class="form-group">
            						<label class="label">
            							Nome Completo
            						</label>
                                    <label class="input">
                                    	<input class="form-control" id="nome_completo" type="text" required autofocus>
                                    </label>
            					</div>
            				</section>
            			</div>
            			<div class="row">
            				<section class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
            					<div class="form-group">
            						<label class="label">
            							Nome de usuário
            						</label>
                                    <label class="input">
                                    	<input class="form-control" id="nome_usuario" type="text" required>
                                    </label>
            					</div>
            				</section>
            			</div>
            			<div class="row">
            				<section class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
            					<div class="form-group">
            						<label class="label">
            							Email
            						</label>
                                    <label class="input">
                                    	<input class="form-control" id="email" type="text" required>
                                    </label>
            					</div>
            				</section>
            			</div>
            			<div class="row">
            				<section class="col col-lg-6 col-md-6 col-sm-6 col-xs-6">
            					<div class="form-group">
            						<label class="label">
            							Senha
            						</label>
                                    <label class="input">
                                    	<input class="form-control" id="senha" type="password" required>
                                    </label>
            					</div>
            				</section>
            				<section class="col col-lg-6 col-md-6 col-sm-6 col-xs-6">
            					<div class="form-group">
            						<label class="label">
            							Redigite a senha
            						</label>
                                    <label class="input">
                                        <input class="form-control" id="redigite_senha" type="password" required>
                                    </label>
                                    <span class="help-block"></span>
            					</div>
            				</section>
            			</div>
            		</fieldset>
            		<footer>
            			<button type="submit" id="salvar" class="btn btn-primary">Salvar usuário</button>
            			<a class="btn btn-default" data-dismiss="modal" onclick="limpar_campos($('#cadastro_usuario'))">
            				<i class="fam fam-cross"></i> Cancelar
            			</a>
            		</footer>
            	</form>
            </div>
		</div>
	</div>
</div>
<!--*************************************************************************-->

<script>
	//Variável que recebe a url da busca dos usuários
	url = '<?php echo app_baseurl().'config/CadastroUsuarios/buscar'?>';
	
	//Busca os dados dos usuaários cadastrados
	buscar();

	//Função desenvolvida para verificar se as senhas digitadas conferem
	$('#redigite_senha').on('keyup', function(){
		if($(this).val() == "" && $('#senha').val() == "")
		{
			return false;
		}
		else
		{
			if($(this).val() != $('#senha').val())
			{
				$('.help-block').html('<i class="fam fam-cross"></i> As senhas não conferem');
				$('#salvar').prop('disabled', true);
				return false;
			}
			else
			{
			    $('.help-block').html('<i class="fam fam-tick"></i> As senhas conferem');
			    $('#salvar').prop('disabled', false);
			}
		}
	});

	//Salva um novo usuário via ajax
	$('#cadastro_usuario').submit(function(e){
		e.preventDefault();

		nome_completo	= $('#nome_completo').val();
		nome_usuario	= $('#nome_usuario').val();
		email			= $('#email').val();
		senha			= $('#senha').val();

		$.ajax({
			url: '<?php echo app_baseurl().'config/CadastroUsuarios/salvar'?>',
			type: 'POST',
			data: {nome_completo: nome_completo, nome_usuario: nome_usuario, email: email, senha: senha},
			dataType: 'html',
			success: function(e)
			{
				if(e == 1)
				{
					msg_sucesso('O usuário foi salvo');
					buscar();
					limpar_campos($('#cadastro_usuario'));
					$('#cadastro_usuario').modal('hide');
				}
				else
				{
					msg_erro('Não foi possível salvar. Tente novamente');
				}
			}
		});
	});
	//**************************************************************************

	/**
	 * buscar()
	 *
	 * Função desenvolvida para buscar os usuários cadastrados
	 * 
	 * @author	: Matheus Lopes Santos <fale_com_lopez@hotmail.com>   
	 */
	function buscar()
	{
	    loadAjax(url, $('#cadastrados'));
	}
	//**************************************************************************

	/**
	 * mudarStatus()
	 *
	 * Função desenvolvida para alterar o status do usuário
	 * 
	 * @author	: Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @param	: {mixed}	e		Contém o evento e será usado para prevenir o
	 *			  evento padrão do elemento
	 * @param	: {string} 	acao	Contém a ação que será executada no servidor
	 * @param	: {int}		id		Contém o ID do registro a ser modificado
	 */
	function mudarStatus(e, acao, id)
	{
		e.preventDefault();

		if(acao == 'excluir')
		{
			$.SmartMessageBox({
				title: 'Atenção',
				content: 'Deseja excluir este usuário?',
				buttons: '[Sim][Não]'
			}, function(e){
				if(e == 'Não')
				{
					return false;
				}
				else
				{
					mudar(acao, id);
				}
			});
		}
		else
		{
		    mudar(acao, id);
		}
	}
	//**************************************************************************

	/**
	 * mudar()
	 *
	 * Função desenvolvida para enviar os dados da função mudarStatus() para a
	 * função no PHP
	 * 
	 * @author	: Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @param	: {string} 	acao	Contém a ação que será executada no servidor
	 * @param	: {int}		id		Contém o ID do registro a ser modificado
	 */
	function mudar(acao, id)
	{
	    $.post('<?php echo app_baseurl().'config/CadastroUsuarios/mudarStatus'?>', {acao: acao, id: id}, function(e){
			if(e == 1)
			{
				if(acao == 'excluir')
				{
				    msg_sucesso('O usuário foi excluido');
				}
				else
				{
					msg_sucesso('Status do usuário alterado');
				}
				
				buscar();
			}
			else if(e == 0)
			{
				if(acao == 'excluir')
				{
				    msg_erro('Não foi possível excluir o usuário. Tente novamente');
				}
				else
				{
				    msg_erro('Não foi possível alterar o status');
				}
			}
			else
			{
				msg_erro(e);
			}
		});
	}
</script>