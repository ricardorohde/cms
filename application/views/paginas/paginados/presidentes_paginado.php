<?php
    if(!isset($presidentes))
    {
        ?>
        <div class="alert alert-block alert-info">
            <h4 class="alert-heading">
                Atenção
            </h4>
            <p>
                Não há presidentes cadastrados ou ocorreu um erro na rotina de
                busca.
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
                    	<th>Nome</th>
                        <th>Início do mandato</th>
                        <th>Final do mandato</th>
                        <th>Possui foto?</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                	<?php
                    	foreach($presidentes as $row)
                        {
                        	?>
                            <tr>
                            	<td><?php echo $row->nome; ?></td>
                                <td><?php echo $row->inicio_mandato; ?></td>
                                <td><?php echo $row->fim_mandato; ?></td>
                                <td>
                                	<?php echo ($row->foto == "") ? "Não" : "Sim"?>
								</td>
                                <td>
                                	<div align="center">
                                    	<a class="editar" href="<?php echo app_baseurl().'presidentes/alterar_presidente/'.$row->id?>" rel="tooltip" title="Editar" onclick="return abrirPopup(this.href, 640, 480)">
                                        	<i class="fam-user-edit"></i>
                                        </a>
                                        <a class="excluir" href="#" rel="tooltip" title="Excluir" data-id="<?php echo $row->id; ?>">
                                        	<i class="fam-user-delete"></i>
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
<script type="text/javascript">
    /**
     * Função utilizada para a exclusão de um presidente
     */
    $(".excluir").click(function(e){
        e.preventDefault();
        
        var id = $(this).data('id');

        $.SmartMessageBox({
            title: '<i class="fa fa-times" style="color:red"></i> Atenção',
            content: 'Deseja excluir este presidente?',
            buttons: '[Sim][Não]'
        }, function(e) {
            if (e == "Não")
            {
                return false;
            }
            else
            {
                $.post('<?php echo app_baseurl().'presidentes/excluir' ?>', {id: id}).done(function(sucesso) {
                    if (sucesso == 1)
                    {
                        $.smallBox({
                            title: "<i class='fa fa-check'></i> Sucesso",
                            content: "Presidente excluido",
                            iconSmall: "fa fa-thumbs-down bounce animated",
                            color: "#5CB811",
                            timeout: 5000
                        });
                        buscar();
                    }
                    else
                    {
                        $.smallBox({
                            title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                            content: "<strong>Erro ao excluir os dados. Tente novamente</strong>",
                            color: "#FE1A00",
                            iconSmall: "fa fa-thumbs-down bounce animated",
                            timeout: 5000
                        });
                    }
                });
            }
        });
        
        buscar();
    });

    /**
     * Função desenvolvida para alterar os dados de um presidente
     */
    $(".editar").click(function(e) {
        
    });
</script>