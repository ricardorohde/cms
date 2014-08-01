<?php
    if (empty($diretores))
    {
        ?>
        <div class="alert alert-block alert-info">
            <h4 class="alert-heading">
                Atenção
            </h4>
            <p>
                Não há diretores cadastrados nesta diretoria.
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
                            <h2>Diretores Cadastrados</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <table class="table table-responsive table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Cargo</th>
                                            <th>Diretoria</th>
                                            <th>Possui foto?</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($diretores as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $row->nome_diretor; ?></td>
                                                <td><?php echo $row->cargo; ?></td>
                                                <td><?php echo $row->ano_inicio.' - '.$row->ano_final?></td>
                                                <td>
                                                    <?php
                                                    if ($row->foto == "")
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
    }
?>