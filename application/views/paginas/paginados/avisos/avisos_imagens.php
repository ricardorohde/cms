<?php
	if(!$avisos)
	{
		?>
		<div class="alert alert-block alert-warning">
			<h4 class="alert-heading">:(</h4>
			<p>
				Nenhum registro encontrado
			</p>
		</div>
		<?php
	}
	else
	{
		?>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Imagem</th>
					<th>Data de expiração</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($avisos as $row)
					{
						?>
						<tr>
							<td>
								<a rel="fancybox" href="<?php echo $row->imagem?>">
									<?php echo $row->imagem?>
								</a>
							</td>
							<td><?php echo date('d/m/Y', strtotime($row->data_expiracao))?></td>
							<td align="center">
								<a class="excluir" href="#" data-id="<?php echo $row->id?>" data-acao="excluir" rel="tooltip" data-placement="top" title="Excluir aviso">
									<i class="fam-bin"></i>
								</a>
								<?php
									echo $row->status == 1 ?
										'<a class="acao" href="#" data-id="'.$row->id.'" data-acao="inativar" rel="tooltip" data-placement="top" title="Inativar aviso">
							            	<i class="fam-exclamation"></i>
										</a>' :
										'<a class="acao" href="#" data-id="'.$row->id.'" data-acao="ativar" rel="tooltip" data-placement="top" title="Ativar aviso">
											<i class="fam-accept"></i>
										</a>';
								?>
								<a class="editar" href="#" data-href="<?php echo app_baseurl().'avisos/avisos_imagens/editar'?>" data-id="<?php echo $row->id?>" rel="tooltip" data-placement="top" title="Editar aviso" > 
									<i class="fam-comment-edit"></i>
								</a>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
		<?php
		echo $paginacao;
	}
?>
<!-- Modal que receberá o formulário de edição -->
<div id="editar"></div>
<!--*************************************************************************-->

<script>
	/** Indica o offset da busca sql **/
	offset = <?php echo $offset ?>;
	
	/** Realiza ações em cima dos registros (ativar/inativar) **/
	$('.acao').click(function(e){
		e.preventDefault();

		id		= $(this).data('id');
		acao 	= $(this).data('acao');
		urlAcao	= '<?php echo app_baseurl().'avisos/avisos_imagens/executa_acao'?>';

		$.post(urlAcao, {id: id, acao: acao}, function(e){
			e == 1 ? msg_sucesso('A ação foi realizada com sucesso') : msg_erro('Não foi possivel executar a ação');

			buscar();
		});
	});
	//**************************************************************************

	/** Função desenvolvida para excluir um registro **/
	$('.excluir').click(function(e){
		e.preventDefault();

		id		= $(this).data('id');
		acao 	= $(this).data('acao');
		urlAcao	= '<?php echo app_baseurl().'avisos/avisos_imagens/executa_acao'?>';

		$.SmartMessageBox({
			title: 'Atenção',
			content: 'Deseja excluir o registro? a ação não pode ser desfeita',
			buttons: '[Excluir para mim][Não Excluir]'
		}, function(e){
			if(e == 'Não Excluir')
			{
				return false;
			}
			else
			{
			    $.post(urlAcao, {id: id, acao: acao}, function(e){
					e == 1 ? msg_sucesso('Registro excluido com sucesso') : msg_erro('Não foi possivel excluir o registro');

					buscar();
				});
			}
		});
	});
	//**************************************************************************

	/** Função desenvolvida para chamar a edição de um registro **/
	$('.editar').click(function(e){
		e.preventDefault();

		urlAcao = $(this).data('href');
		id 		= $(this).data('id');

		$.post(urlAcao, {id: id}, function(e){
			$('#editar').html(e);
			$('#modal_edicao').modal('show');
		}); 
	});
</script>