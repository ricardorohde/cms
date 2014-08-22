<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12">
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                
                <!-- Header do widget -->
                <header>
                    <span class="widget-icon"> 
                        <i class="fa fa-envelope-o txt-color-darken"></i> 
                    </span>
                    <h2>Configurações de E-mail</h2>
                </header>
                <!--*********************************************************-->
                
                <div class="">
                    <div class="widget-body no-padding">
                        <form id="atualizar_config" class="smart-form">
                            <?php
                                foreach($config as $row)
                                {
                                    ?>
                                    <fieldset>
                                        <section class="col col-6">
                                        	<div class="form-group">
                                            	<label class="control-label"><strong>Host SMTP:</strong></label>
                                            	<div>
                                                	<input class="form-control" type="text" id="smtp_host" required value="<?php echo $row->smtp_host?>">
                                            	</div>
                                           	</div>
                                        </section>
                                        <section class="col col-6">
                                        	<div class="form-group">
                                            	<label class="control-label"><strong>Porta SMTP:</strong></label>
	                                            <div>
	                                                <input class="form-control" type="text" id="smtp_port" required value="<?php echo $row->smtp_port?>">
	                                            </div>
                                            </div>
                                        </section>
                                        <section class="col col-6">
                                        	<div class="form-group">
                                            	<label class="control-label"><strong>Usuário SMTP:</strong></label>
	                                            <div>
	                                                <input class="form-control" type="text" id="smtp_userName" required value="<?php echo $row->smtp_userName?>">
	                                            </div>
                                            </div>
                                        </section>
                                        <section class="col col-6">
                                        	<div class="form-group">
	                                            <label class="control-label"><strong>Senha SMTP:</strong></label>
	                                            <div>
	                                                <input class="form-control" type="password" id="smtp_password" required value="<?php echo $row->smtp_password?>">
	                                            </div>
                                            </div>
                                        </section>
                                        <section class="col col-6">
                                        	<div class="form-group">
	                                            <label class="control-label"><strong>Segurança SMTP:</strong></label>
	                                            <div>
	                                                <input class="form-control" type="text" id="smtp_secure" required value="<?php echo $row->smtp_secure?>">
	                                            </div>
	                                        </div>
                                        </section>
                                        <section class="col col-6">
                                        	<div class="form-group">
	                                            <label class="control-label"><strong>Email SMTP:</strong></label>
	                                            <div>
	                                                <input class="form-control" type="text" id="smtp_from" required value="<?php echo $row->smtp_from?>">
	                                            </div>
                                           	</div>
                                        </section>
                                        <section class="col col-6">
                                        	<div class="form-group">
	                                            <label class="control-label"><strong>Nome SMTP:</strong></label>
	                                            <div>	                                                
	                                                <input class="form-control" type="text" id="smtp_fromName" required value="<?php echo $row->smtp_fromName?>">
	                                            </div>
                                            </div>
                                        </section>
                                    </fieldset>
                                    <input type="hidden" id="id_config" value="<?php echo $row->id?>">
                                    <?php
                                }
                            ?>
                            <footer>
                                <button class="btn btn-default" type="submit">Atualizar configurações</button>
                                <a class="btn btn-danger" data-action='editar' id='editar_informacoes'>
                                    Editar informações
                                </a>
                            </footer>
                        </form>
                    </div>
                </div>
                
            </div>
        </article>
    </div>
</section>

<script type="text/javascript">
	//Chamada da função que desabilita os elementos do formulário
	desabilitar();
	
	/** 
     * desabilitar()
     * 
     * Função desenvolvida para desabilitar elementos do form
 	 *
 	 * @author	:	Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 */
	function desabilitar()
	{
		$('#atualizar_config').find('input, button').prop('disabled', true);		
	}
	//**************************************************************************

    //Variável que receberá valores se os campos forem editados
    var modificado = '';

    //Previne que o formulário seja enviado do modo tradicional
    $('#atualizar_config').submit(function(e){
        e.preventDefault();

        salvar();
    });

    //Função desenvolvida para habilitar ou desabilitar a edição dos dados
    $('#editar_informacoes').click(function(e){
        e.preventDefault();
        
        if($(this).data('action') == 'editar')
        {
            $(this).html('Cancelar edição').data('action', 'cancelar');
            $('#atualizar_config').find('input').prop('disabled', false);
        }
        else
        {
        	$(this).html('Editar Informações').data('action', 'editar');
        	
            if(modificado >= 1 )
            {
            	$.SmartMessageBox({
                	title: 'Atenção',
                	content: 'Você realizou mudanças no cadastro. Deseja salvar?',
                	buttons: '[Não][Sim]'                    
               	}, function(e){
                   	if(e == 'Não')
                   	{
                       	buscar();
                       	modificado = '';
						return false;                  
                    }
                   	else
                   	{
                       	salvar();
                    }
                });
            }
            
            desabilitar();
        }
    });
	//**************************************************************************

	//Função desenvolvida para verificar se algum dado foi modificado
	$(document).on('change, keyup', 'input', function(){
		modificado = modificado + 1;
		
		$('#atualizar_config').find('button').prop('disabled', false);		
	});
    //**************************************************************************

    /**
     * salvar()
     *
     * Função desenvolvida para salvar os dados
	 *
     * @author	:	Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     */
    function salvar()
    {
		id 				= $('#id_config').val();
		smtp_host		= $('#smtp_host').val();
		smtp_port		= $('#smtp_port').val();
		smtp_userName	= $('#smtp_userName').val();
		smtp_password	= $('#smtp_password').val();
		smtp_secure		= $('#smtp_secure').val();
		smtp_from		= $('#smtp_from').val();
		smtp_fromName	= $('#smtp_fromName').val();

		$.ajax({
			url: '<?php echo app_baseurl().'config/configuracoes_email/salvar'?>',
			type: 'POST',
			data: {
				id: id,
				smtp_host: smtp_host,
				smtp_port: smtp_port,
				smtp_userName: smtp_userName,
				smtp_password: smtp_password,
				smtp_secure: smtp_secure,
				smtp_from: smtp_from,
				smtp_fromName: smtp_fromName
			},
			dataType: 'html',
			success: function(e)
			{
				if(e == 1)
				{
					msg_sucesso('As configurações foram salvas');
					modificado = '';
					buscar();
				}
				else
				{
					msg_erro('Não foi possível salvar. Tente novamente');
				}
			}
		});
	}
</script>