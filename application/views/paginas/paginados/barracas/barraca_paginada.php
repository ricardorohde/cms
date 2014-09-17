<?php
	if(!$barracas || $barracas == NULL)
	{
		?>
		<div class="alert alert-bloc alert-warning">
			<h4 class="alert-heading">:(</h4>
			<p>Não existe nenhuma barraca cadastrada</p>
		</div>
		<?php
	}
	else
	{
		?>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Número</th>
					<th>Tipo</th>
					<th>Descrição</th>
					<th>Diária</th>
					<th>Fim de Semana</th>
					<th>Localização</th>
					<th>Ações</th>
				<tr>
			</thead>
			<tbody>
			<?php
				foreach($barracas as $row)
				{
					?>
					<tr>
						<td><?php echo $row->numero_barraca; ?></td>
						<td><?php echo $row->titulo_barraca; ?></td>
						<td><?php echo $row->descricao; ?></td>
						<td><?php echo $row->valor; ?></td>
						<td><?php echo $row->valor_fim_semana; ?></td>
						<td><?php echo $row->localizacao; ?></td>
						<td>
							<div align="center">
	                            <a href="<?php echo app_baseurl().'barracas/barracas/altera_barraca/'.$row->id; ?>" rel="tooltip" title="Editar Dados da Barraca" onclick="return abrirPopup(this.href, 640, 480)">
									<i class="fam-pencil"></i>
								</a>
	                            <a href="<?php echo $verificador; ?>" rel="tooltip" title="Excluir Barraca" class="excluir" id="<?php echo $row->id; ?>">
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
		echo $paginacao;
	}
?>