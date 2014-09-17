<?php
    if (!isset($mensagens))
    {
        ?>
        <div class="alert alert-block alert-info">
            <h4 class="alert-heading">
                Atenção
            </h4>
            <p>
                Não há mensagens cadastradas
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
                	<th>Autor</th>
                    <th>Mensagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            	<?php
                	foreach ($mensagens as $row)
                    {
                    	?>
                        <tr>
                        	<td><?php echo $row->autor; ?></td>
                            <td><?php echo $row->mensagem; ?></td>
                            <td>
                            	<div align="center">
                                	<a href="<?php echo app_baseurl().'mensagem_diaria/editar/'.$row->id;?>" rel="tooltip" title="Editar" onclick="return abrirPopup(this.href, 640, 480)">
                                    	<i class="fam-pencil"></i>
                                    </a>
                                    <?php
                                    	if ($row->status == 1)
                                        {
                                        	?>
                                            <a class="marcar" href="#" rel="tooltip" title="Marcar como inativo" data-id="<?php echo $row->id; ?>" data-acao="inativar">
                                            	<i class="fam-delete"></i>
                                            </a>
                                            <?php
                                         }
                                         else
                                         {
                                         	?>
                                            <a class="marcar" href="#" rel="tooltip" title="Marcar como Ativo" data-id="<?php echo $row->id; ?>" data-acao="ativar">
                                            	<i class="fam-accept"></i>
                                            </a>
                                            <?php
                                         }
									?>
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
?>
<script type="text/javascript">
    /** 
     * Função desenvolvida para ativar ou inativar uma notícia
     */
    $('.marcar').click(function(e){
        e.preventDefault();
        
        acao    = $(this).data('acao');
        id      = $(this).data('id');
        
        $.post('<?php echo app_baseurl().'mensagem_diaria/marcar_mensagem'?>', {acao: acao, id: id}, function(e){
            if(e == 1)
            {
                msg_sucesso('O status da mensagem foi alterado');
                busca_mensagens();
            }
            else
            {
                msg_erro('Não foi possível alterar o status da mensagem');
            }
        });
    });
    //**************************************************************************
    
    /** Função desenvolvida para excluir uma mensagem **/
    $('.excluir').click(function(e){
        e.preventDefault();
        
        var id = $(this).data('id');
        
        $.SmartMessageBox({
            title: 'Atenção',
            content: "Você está prestes a excluir uma mensagem. Deseja prosseguir?",
            buttons: '[Não][Sim, exclua para mim]'
        }, function(e) {
            if (e == "Não")
            {
                return false;
            }
            else
            {
                $.post('<?php echo app_baseurl() . 'mensagem_diaria/excluir_mensagem' ?>',{id: id}, function(e){
                    if (e == 1)
                    {
                        msg_sucesso('Mensagem excluida');
                        busca_mensagens();
                    }
                    else
                    {
                        msg_erro('Não foi possível excluir. Tente novamente');
                    }
                });
            }
        });
    });
</script>