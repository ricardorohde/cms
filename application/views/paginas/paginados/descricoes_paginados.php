<?php
	if($descricoes == "" || $descricoes == NULL)
	{
?>	
		<div class="alert alert-success">
			<i class="fam-exclamation"></i> Ainda não foram cadastradas descrições para as barracas
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
							<a href="<?php echo app_baseUrl().'descricao_barracas/altera_descricao/'.$row->id; ?>" rel="tooltip" title="Editar descrição" onclick="return abrirPopup(this.href, 640, 480)">
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
<script>
    function abrirPopup(url,w,h)
    {
        var newW = w + 100;
        var newH = h + 100;
        var left = (screen.width-newW)/2;
        var top = (screen.height-newH)/2;
        var newwindow = window.open(url, 'name', 'width='+newW+',height='+newH+',left='+left+',top='+top);
        //newwindow.resizeTo(newW, newH);
        newwindow.moveTo(left, top);
        newwindow.focus();
        return false;
    }
</script>