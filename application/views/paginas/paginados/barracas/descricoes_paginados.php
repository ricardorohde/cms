<?php
	if($descricoes == "" || $descricoes == NULL)
	{
		?>	
		<div class="alert alert-block alert-warning">
			<h4 class="alert-heading">:(</h4>
			<p>Ainda não foram cadastradas descrições para as barracas</p>
		</div>
		<?php
	}
	else
	{
		?>
		<table class="table table-striped table-bordered table-hover">
			<thead>
                <tr>
                    <th>Sigla</th>
                    <th>Título da Barraca</th>
                    <th>Descrição</th>
                    <th>Diária (R$)</th>
                    <th>Fim de Semana (R$)</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
		<?php
			foreach($descricoes as $row)
			{
				?>
				<tr>
					<td><?php echo $row->sigla; ?></td>
					<td><?php echo $row->titulo_barraca ;?></td>
					<td><?php echo $row->descricao; ?></td>
	                <td><?php echo $row->valor; ?></td>
	                <td><?php echo $row->valor_fim_semana; ?></td>
					<td>
						<div align="center">
							<a href="<?php echo app_baseUrl().'barracas/descricao_barracas/altera_descricao/'.$row->id; ?>" rel="tooltip" title="Editar descrição" onclick="return abrirPopup(this.href, 640, 480)">
								<i class="fam-pencil"></i>
							</a>
							<a href="#" rel="tooltip" title="Excluir descrição" class="excluir" id="<?php echo $row->id; ?>">
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
?>
<script type="text/javascript">

	//Realiza a exclusão de uma descrição
	$('.excluir').click(function(e){
		e.preventDefault();
		
		id = $(this).attr("id");
	
		$.SmartMessageBox({
			title: 'Atenção',
			content: '<p>Você está prestes a excluir uma descrição. Pode haver barracas cadastradas com esta descrição. Deseja Continuar?</p><p><small>(Esta ação não pode ser desfeita)</small></p>',
			buttons: '[Sim][Não]'
		}, function(e){
			if(e == 'Não')
			{
				return false;
			}
			else
			{
			    $.ajax({
					url: "<?php echo app_baseUrl().'barracas/descricao_barracas/excluir'; ?>",
					type: "POST",
					data: {id: id},
					dataType: "html",
					success: function(e){
						if(e == 1)
						{
							buscar();
							msg_sucesso("Excluído com sucesso");
						}
	                    else
	                    {
	                        msg_erro('Ocorreu um erro. Tente novamente');
	                    }
					}
				});
			}
		});
	});
</script>