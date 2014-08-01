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
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-sm-12">
                    <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                        <header>
                            <span class="widget-icon"> 
                                <i class="fa fa-file-text-o txt-color-darken"></i>
                            </span>
                            <h2>Mensagens Cadastradas</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
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
                                                        <a class="editar" href="#" rel="tooltip" title="Editar" data-id="<?php echo $row->id; ?>">
                                                            <i class="fam-pencil"></i>
                                                        </a>
                                                        <?php
                                                        if ($row->status == 1)
                                                        {
                                                            ?>
                                                            <a class="marcar" href="#" rel="tooltip" title="Marcar como inativo" data-id="<?php echo $row->id; ?>">
                                                                <i class="fam-delete"></i>
                                                            </a>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <a class="marcar" href="#" rel="tooltip" title="Marcar como Ativo" data-id="<?php echo $row->id; ?>">
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
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
        <?php
    }
?>