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
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-sm-12">
                    <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                        <header>
                            <span class="widget-icon"> 
                                <i class="fa fa-users txt-color-darken"></i>
                            </span>
                            <h2>Ex-presidentes Cadastrados</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
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
                                                    <?php
                                                    if($row->foto == "")
                                                    {
                                                        echo "Não";
                                                    }
                                                    else
                                                    {
                                                        echo "Sim";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div align="center">
                                                        <a class="editar" href="#" rel="tooltip" title="Editar" data-id="<?php echo $row->id; ?>">
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
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
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
        e.preventDefault();
        alert($(this).data('id'));
    });
</script>

