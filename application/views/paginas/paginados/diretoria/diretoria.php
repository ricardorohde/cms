<?php
    if (!isset($diretorias))
    {
        ?>
        <div class="alert alert-block alert-info">
            <h4 class="alert-heading">Atenção</h4>
            <p>
                Não há diretorias cadastradas ou ocorreu um erro na rotina de
                busca
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
                                <i class="fa fa-book txt-color-darken"></i>
                            </span>
                            <h2>Diretorias Cadastrados</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <table class="table table-responsive table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Início do mandato</th>
                                            <th>Final do mandato</th>
                                            <th>Observações</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($diretorias as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $row->ano_inicio;?></td>
                                                <td><?php echo $row->ano_final;?></td>
                                                <td><?php echo $row->observacoes;?></td>
                                                <td>
                                                    <div align="center">
                                                        <a class="editar" href="#" rel="tooltip" title="Editar" data-id="<?php echo $row->id; ?>">
                                                            <i class="fam-pencil"></i>
                                                        </a>
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