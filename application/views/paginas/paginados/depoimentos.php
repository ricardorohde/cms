<?php
	if(!isset($depoimentos) || $depoimentos == NULL)
	{
		?>
		<div class="alert alert-block alert-warning">
			<h4 class="alert-heading"><strong>:(</strong></h4>
			<p>Não foram encontrados depoimentos cadsatrados</p>
		</div>
		<?php
	}
	else
	{
		?>
		<table class="table table-responsive table-bordered table-hover">
			<thead>
				<tr>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Depoimento</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($depoimentos as $row)
					{
						?>
						<tr>
							<td><?php echo $row->nome?></td>
							<td><?php echo $row->email?></td>
							<td><?php echo $row->depoimento?></td>
							<td align="center">
								<?php
									if($row->status == 1)
									{
										?>
										<a class="acao" rel="tooltip" title="Inativar depoimento" data-id="<?php echo $row->id?>" data-acao="inativar" href="#">
											<i class="fam-exclamation"></i>
										</a>
										<?php
									}
									else
									{
										?>
										<a class="acao" rel="tooltip" title="Ativar depoimento" data-id="<?php echo $row->id?>" data-acao="ativar" href="#">
											<i class="fam-accept"></i>
										</a>
										<?php
									}
								?>
								<a class="excluir" rel="tooltip" title="Excluir depoimento" data-id="<?php echo $row->id?>" data-acao="excluir" href="#">
									<i class="fam-cross"></i>
								</a>
							</td>
						<?php
					}
				?>
			</tbody>
		</table>
		<?php
		echo $paginacao;
	}
?>
<script type="text/javascript">
	//Variável que será usada nas buscas sql
	offset = '<?php echo $verificador?>';

	//Função que ativa ou inativa um depoimento
	$('.acao').click(function(e){
		e.preventDefault();

		id 		= $(this).data('id');
		acao	= $(this).data('acao');
		urlAcao	= '<?php echo app_baseurl().'depoimentos/executa_acao'?>';

		$.post(urlAcao, {id: id, acao: acao}, function(e) {
			(e == 1) ? msg_sucesso('Ação executada com sucesso') : msg_erro('Não foi possível executar o pedido');

			buscar();
		});
	});
	//**************************************************************************

	//Função que exclui um depoimento
	$('.excluir').click(function(e){
		e.preventDefault();

		id 		= $(this).data('id');
		acao	= $(this).data('acao');
		urlAcao	= '<?php echo app_baseurl().'depoimentos/executa_acao'?>';

		$.SmartMessageBox({
			title: 'Atenção',
			content: 'Deseja excluir? Esta ação não pode ser desfeita',
			buttons: '[Sim][Não]'
		}, function(e){
			if(e == 'Não')
			{
				return false;
			}
			else
			{
				$.post(urlAcao, {id: id, acao: acao}, function(e) {
					(e == 1) ? msg_sucesso('Excluido com sucesso') : msg_error('Não foi possível excluir. Tente novamente');

					buscar();
				});
			}
		});
	});
</script>