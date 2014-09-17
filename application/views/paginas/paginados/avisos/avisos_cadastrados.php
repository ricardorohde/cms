<?php
	if (empty ( $avisos ))
	{
		?>
		<div class="alert alert-success">
			<h4 class="alert-heading">Atenção</h4>
			<p>Não existem avisos cadastrados</p>
		</div>
		<?php
	}
	else
	{
		?>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Aviso</th>
					<th>Data de expiração</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
            <?php
				foreach ( $avisos as $row )
				{
					?>
                    <tr>
						<td><?php echo $row->mensagem ?></td>
						<td><?php echo date('d/m/Y', strtotime($row->data_expiracao)) ?></td>
						<td>
							<div align="center">
								<a class="excluir" href="#" data-id="<?php echo $row->id ?>"
									rel="tooltip" data-placement="top" title="Excluir aviso"> <i
									class="fam-bin"></i>
								</a>
                                <?php
									if ($row->status == 1)
									{
										?>
							            <a class="inativar" href="#" data-id="<?php echo $row->id ?>" rel="tooltip" data-placement="top" title="Inativar aviso">
							            	<i class="fam-exclamation"></i>
										</a>
							            <?php
									}
									else
									{
										?>
										<a class="ativar" href="#" data-id="<?php echo $row->id ?>" rel="tooltip" data-placement="top" title="Ativar aviso">
											<i class="fam-accept"></i>
										</a>
	                                    <?php
									}
								?>
                                <a href="<?php echo app_baseurl().'avisos/avisos_cadastrados/editar_aviso/'.$row->id?>" rel="tooltip" data-placement="top" title="Editar aviso" onclick="return abrirPopup(this.href, 640, 480)"> 
									<i class="fam-comment-edit"></i>
								</a> &nbsp; &nbsp; &nbsp;
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

<script type="text/javascript">
    offset = '<?php echo $offset?>';
    
    /**
     * Metodo utilizado para chamar a função excluir
     */
    $('.excluir').click(function(e){
        e.preventDefault();
        
        id = $(this).data('id');
        excluir(id);
    });
    //**************************************************************************
    
    /**
     * Método utilizado para chamar a função inativar
     */
    $('.inativar').click(function(e){
        e.preventDefault();
        
        id = $(this).data('id');
        inativar(id);
    });
    //**************************************************************************
    
    /**
     * Método utilizado para chamar a função inativar
     */
    $('.ativar').click(function(e){
        e.preventDefault();
        
        id = $(this).data('id');
        ativar(id);
    });
    //**************************************************************************
</script>