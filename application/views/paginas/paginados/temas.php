<?php
    if ($temas == NULL)
    {
        ?>
        <div class="alert alert-block alert-info">
            <h4 class="alert-heading">
                Atenção
            </h4>
            <p>
                Você ainda não cadastrou nenhum tema para o site.
            </p>
        </div>
        <?php
    }
    else
    {
        ?>
        <table class="table table-condensed table-striped table-hover">
        	<thead>
            	<tr>
                	<th>#</th>
                    <th>Cor</th>
                    <th>Data Inicial</th>
                    <th>Data Final</th>
                    <th>Imagem</th>
                    <th>Ações</th>
            	</tr>
			</thead>
            <tbody>
            	<?php
                	foreach ($temas as $row)
                    {
                    	?>
                        	<tr>
                            	<td>
                                	<?php echo $row->id; ?>
                                </td>
                                <td style="background-color: <?php echo $row->cor_principal; ?>"></td>
								<td>
                                	<?php echo date('d/m/Y', strtotime($row->data_inicio)); ?>
                                </td>
                                <td>
                                	<?php echo date('d/m/Y', strtotime($row->data_expiracao)); ?>
                                </td>
                                <td>
                                	<a href="#" rel="tooltip" data-original-title="<img width='180' src='<?php echo $row->imagem_banner; ?>'>" data-html="true">
                                		<?php echo $row->imagem_banner; ?>
                                    </a>
                                </td>
                                <td>
                                	<a href="<?php echo app_baseurl() . 'temas/editar_tema/' . $row->id ?>" rel="tooltip" title="Alterar" onclick="return abrirPopup(this.href, 640, 480)">
                                    	<i class="fam-pencil"></i>
                                    </a>
                                <a class="excluir" href="#" rel="tooltip" title="Excluir" data-id="<?php echo $row->id; ?>">
                                	<i class="fam-cross"></i>
                                </a>
                                <?php
                                	if ($row->status == 1)
                                    {
                                    	?>
                                        <a class="marcar" href="#" rel="tooltip" title="Inativar" data-id='<?php echo $row->id ?>' data-status='<?php echo $row->status ?>'>
                                        	<i class="fam-exclamation"></i>
                                        </a>
                                        <?php
                                        }
                                        else
                                        {
                                        	?>
                                            <a class="marcar" href="#" rel="tooltip" title="Ativar" data-id='<?php echo $row->id ?>' data-status='<?php echo $row->status ?>'>
                                            	<i class="fam-accept"></i>
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
<script type="text/javascript">
    /*
     * Função global do sistema
     */
    pageSetUp();

    /*
     * Função desenvolvida para excluir um tema
     */
    $(".excluir").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        alertify.confirm("Deseja excluir este tema? Esta ação não pode ser desfeita", function(click) {
            if (click)
            {
                $.ajax({
                    url: "<?php echo app_baseurl() . 'temas/excluir_tema' ?>",
                    type: "POST",
                    data: {id: id},
                    dataType: "html",
                    success: function(sucesso)
                    {
                        if (sucesso == 1)
                        {
                            $.smallBox({
                                title: "<i class='fa fa-check'></i> Sucesso",
                                content: "<strong>O tema foi excluído.</strong>",
                                iconSmall: "fa fa-thumbs-up bounce animated",
                                color: "#5CB811",
                                timeout: 5000
                            });
                            buscar_temas();
                        }
                        else
                        {
                            $.smallBox({
                                title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                                content: "<strong>Não foi possível remover o novo tema.</strong>",
                                color: "#FE1A00",
                                iconSmall: "fa fa-thumbs-down bounce animated",
                                timeout: 5000
                            });
                        }
                    },
                    error: function()
                    {
                        $.smallBox({
                            title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                            content: "<strong>Ocorreu um erro. Tente novamente</strong>",
                            color: "#FE1A00",
                            iconSmall: "fa fa-thumbs-down bounce animated",
                            timeout: 5000
                        });
                    }
                });
            }
        });
    });
    //**************************************************************************

    /*
     * Função desenvolvida para desativar uma função
     */
    $(".marcar").click(function(e) {
        e.preventDefault();
        tipo = $(this).data('status');
        id = $(this).data('id');
        $.ajax({
            url: "<?php echo app_baseurl() . 'temas/marcar' ?>",
            type: "POST",
            data: {tipo: tipo, id: id},
            dataType: "html",
            success: function(sucesso)
            {
                if (sucesso == 1)
                {
                    $.smallBox({
                        title: "<i class='fa fa-check'></i> Sucesso",
                        content: "<strong>Modificação de status realizada.</strong>",
                        iconSmall: "fa fa-thumbs-up bounce animated",
                        color: "#5CB811",
                        timeout: 5000
                    });
                    buscar_temas();
                }
                else
                {
                    $.smallBox({
                        title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                        content: "<strong>Não foi possível modificar o status.</strong>",
                        color: "#FE1A00",
                        iconSmall: "fa fa-thumbs-down bounce animated",
                        timeout: 5000
                    });
                }
            },
            error: function()
            {
                $.smallBox({
                    title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                    content: "<strong>Ocorreu um erro. Tente novamente</strong>",
                    color: "#FE1A00",
                    iconSmall: "fa fa-thumbs-down bounce animated",
                    timeout: 5000
                });
            }
        });
    });
</script>