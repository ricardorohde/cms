<?php
	if(!isset($valores))
	{
		echo '
			<div class="alert alert-success span12">
				<strong>Atenção!</strong> Não existem valores cadastrados!
			</div>
		';
	}
	else
	{
?>
		<table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor de Diária</th>
                    <th>Valor de Fim de Semana</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
<?php
		foreach($valores as $row)
		{
?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td>R$ <?php echo $row->valor; ?></td>
				<td>R$ <?php echo $row->valor_fim_semana; ?></td>
				<td>
					<div align="center">
						<a id="<?php echo $row->id; ?>" rel="tooltip" href="javascript:void(0)" data-original-title="Editar este valor" class="editar">
							<i class="fam-pencil"></i>
						</a>
						&nbsp;
						<a rel="tooltip" data-original-title="Excluir Valores" href="javascript:void(0)" class="excluir" id="<?php echo $row->id; ?>">
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