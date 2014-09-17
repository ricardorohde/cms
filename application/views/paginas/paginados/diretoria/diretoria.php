<?php
    if (!isset($diretorias))
    {
        ?>
        <div class="alert alert-block alert-warning">
            <h4 class="alert-heading"><strong>:(</strong></h4>
            <p>
                Não há diretorias cadastradas ou ocorreu um erro na rotina de
                busca
            </p>
        </div>
        <?php
    }
    else
    {
		if($diretorias == NULL)
		{
			?>
			<div class="alert alert-block alert-info">
	            <h4 class="alert-heading"><strong>:(</strong></h4>
	            <p>
	                Não há diretorias cadastradas. Você pode cadastrar uma agora
	                se desejar
	            </p>
        	</div>
			<?php
		}
		else
		{
        ?>
        	<table class="table table-responsive table-bordered table-hover">
            	<thead>
                	<tr>
                    	<th>Início do mandato</th>
                        <th>Final do mandato</th>
                        <th>Observações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                	<?php
                    	foreach ($diretorias as $row)
                        {
                           	?>
                            <tr>
                            	<td><?php echo $row->ano_inicio;?></td>
                                <td><?php echo $row->ano_final;?></td>
                                <td><?php echo $row->observacoes;?></td>
                                <td>
                                  	<div align="center">
                                       	<a class="editar" href="<?php echo app_baseurl().'diretoria/diretoria/editar_diretoria/'.$row->id?>" rel="tooltip" title="Editar" onclick="return abrirPopup(this.href, 640, 480)">
                                           	<i class="fam-pencil"></i>
                                        </a>
                                        <a class="excluir" href="#" rel="tooltip" title="Excluir" data-id="<?php echo $row->id; ?>">
                                           	<i class="fam-cross"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
        }
    }
?>
<script type="text/javascript">
	/** Script desenvolvido para exclusão de uma galeria **/
	$('.excluir').click(function(e){
		e.preventDefault();

		var id = $(this).data('id');

		$.SmartMessageBox({
			title: 'Atenção',
			content: 'Deseja excluir esta diretoria?',
			buttons: '[Sim][Não]'
		}, function(e){
			if(e == 'Não')
			{
				return false;
			}
			else
			{
			    $.post('<?php echo app_baseurl().'diretoria/diretoria/verificar_diretores'?>', {id: id}, function(e){
					if(e > 0)
					{
						$.SmartMessageBox({
							title: 'Atenção',
							content: 'Você está prestes a excluir uma diretoria que possui diretores cadastrados. Estes diretores também serão excluidos. Deseja continuar?',
							buttons: '[Sim][Não]'
						}, function(e){
							if(e == 'Não')
							{
								return false;
							}
							else
							{
								excluir(id, 1);
							}
						});
					}
					else
					{
						excluir(id, 0);
					}
				});
			}
		});
	});

	/**
	 * excluir()
	 *
	 * Função desenvolvida para excluir uma diretoria
	 *
	 * @author	:	Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @param	:	{int} id Contém o ID da diretoria a ser excluida
	 * @param	:	{int} excluirDiretores Indica se os diretores cadastrados para
	 *				a diretoria serão excluidos também
	 */
	function excluir(id, excluirDiretores)
	{
		if(excluirDiretores == undefined)
		{
			excluirDiretores = 1;
		}

		$.post('<?php echo app_baseurl().'diretoria/diretoria/excluir'?>', {id: id, excluir_diretores: excluirDiretores}, function(e){
			if(e == 1)
			{
				msg_sucesso('Diretoria excluida');
				busca_diretorias();
			}
			else
			{
				msg_erro('Não foi possível excluir a diretoria. Tente Novamente');
			}
		});
	}
	 
</script>