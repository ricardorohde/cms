<?php
	if(!$usuarios)
	{
		?>
		<div class="alert alert-block alert-warning">
			<h4 class="alert-heading">:(</h4>
			<p>Ocorreu um erro na busca dos usuários</p>
		</div>
		<?php
	}
	else
	{
		?>
		<table class="table table-striped table-bordered table-hover table-responsive">
			<thead>
                <tr>
                    <th>Nome Completo</th>
                    <th>Nome de Usuário</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            	<?php
            		foreach($usuarios as $row)
            		{
						?>
						<tr>
							<td><?php echo $row->nome_completo?></td>
							<td><?php echo $row->nome_usuario?></td>
							<td><?php echo $row->email?></td>
							<td align="center">
								<?php
									if ($row->nome_usuario != 'administrador')
									{
										?>
										<a href="<?php echo app_baseurl().'config/CadastroUsuarios/editar/'.$row->id?>" rel="tooltip" title="Editar" onclick="return abrirPopup(this.href, 640, 480)">
											<i class="fam fam-pencil"></i>
										</a>
										<?php
											if($row->status == 1)
											{
												?>
												<a href="#" rel="tooltip" title="Inativar usuário" onclick="mudarStatus(event, 'inativar', <?php echo $row->id?>)">
													<i class="fam fam-delete"></i>
												</a>
												<?php
											}
											else
											{
												?>
												<a href="#" rel="tooltip" title="Ativar usuário" onclick="mudarStatus(event, 'ativar', <?php echo $row->id?>)">
													<i class="fam fam-accept"></i>
												</a>
												<?php
											}
										?>
										<a href="#" rel="tooltip" title="Excluir Usuário" onclick="mudarStatus(event, 'excluir', <?php echo $row->id?>)">
											<i class="fam fam-cross"></i>
										</a>
										<?php
									}
									else
									{
										?>
										<a class="question" rel="popover" title="Por que não existem opções para este usuário?">
											<i class="fam fam-help"></i>
										</a>
										<?php
									}
								?>
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

<!-- Div que contém a mensagem para o usuário quanto às opções para o usuário administrador -->
<div class="hidden" id="mensagem">
	<p style='text-align:justify'>
		Este é o usuário padrão do sistema, por isso, não é possível excluí-lo. 
		Apenas o administrador pode fazer esta exclusão.
	</p>
</div>
<!--*************************************************************************-->

<script type="text/javascript">
	//Popover que exibe mensagem de alerta para o usuário
	$('.question').popover({
	    placement: 'left',
	    html: true,
		content: $('#mensagem').html()
	});
</script>