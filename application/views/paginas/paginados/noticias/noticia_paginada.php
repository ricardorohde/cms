<?php
    if(!isset($noticias))
    {
        echo '
            <div class="alert alert-success span12">
                <strong>Atenção!</strong> Não existem notícias cadastradas
            </div>
        ';
    }
    else
    {
        ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Título da Notícia</th>
                    <th>Resumo da Notícia</th>
                    <th>Autor</th>
                    <th>Ações para Notícias</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($noticias as $row)
                {
                    ?>
                    <tr>
                        <td><?php echo date('d/m/Y h:m', strtotime($row->data)); ?></td>
                        <td><?php echo $row->titulo_noticia; ?></td>
                        <td><?php echo $row->resumo_noticia; ?></td>
                        <td><?php echo $row->autor; ?></td>
                        <td>
                            <div align="center">
                                <a href="index.php?/painel#index.php?/noticias_cadastradas/editar/<?php echo $row->id; ?>" class="editar" rel="tooltip" data-placement="top" title="Editar Noticia">
                                    <i class="fam-pencil"></i>
                                </a>
                                <?php
                                if($row->status == 0)
                                {
                                    ?>
                                    <a href="<?php echo $verificador; ?>" title="Marcar como Ativa" id="<?php echo $row->id; ?>" class="ativar" rel="tooltip" data-placement="top" data-original-title="Marcar como Ativa">
                                        <i class="fam-accept"></i>
                                    </a>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <a href="<?php echo $verificador; ?>" title="Marcar como Inativa" id="<?php echo $row->id; ?>" class="inativar" rel="tooltip" data-placement="top" data-original-title="Marcar como Inativa">
                                        <i class="fam-exclamation"></i>
                                    </a>
                                    <?php
                                }
                                ?>
                                <a href="<?php echo $verificador; ?>" id="<?php echo $row->id; ?>" class="excluir" title="Excluir Notícia" rel="tooltip" data-placement="top" data-original-title="Excluir Notícia">
                                    <i class="fam-report-delete"></i>
                                </a>
                            </div>
                        </td>
                        <td>
                            <?php
                            if($row->status == 0)
                            {
                                echo '<span class="label label-warning"><small>Inativo</small></span>';
                            }
                            else
                            {
                                echo '<span class="label label-success"><small>Ativo</small></span>';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            }
        ?>
    </tbody>
</table>
<?php
    echo $paginacao;
?>