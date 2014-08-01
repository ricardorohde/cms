<?php
    if(empty($avisos))
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
                foreach($avisos as $row)
                {
                    ?>
                    <tr>
                        <td><?php echo $row->mensagem ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row->data_expiracao)) ?></td>
                        <td>
                            <div align="center">
                                <a href="#" data-id="<?php echo $row->id ?>" rel="tooltip" data-placement="top" title="Excluir aviso">
                                    <i class="fam-bin"></i>
                                </a>
                                <?php
                                if($row->status == 1)
                                {
                                    ?>
                                    <a href="#" data-id="<?php echo $row->id ?>" rel="tooltip" data-placement="top" title="Inativar aviso">
                                        <i class="fam-exclamation"></i>
                                    </a>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <a href="#" data-id="<?php echo $row->id ?>" rel="tooltip" data-placement="top" title="Ativar aviso">
                                        <i class="fam-accept"></i>
                                    </a>
                                    <?php
                                }
                                ?>
                                <a href="#" data-id="<?php echo $row->id ?>" rel="tooltip" data-placement="top" title="Editar aviso">
                                    <i class="fam-comment-edit"></i>
                                </a>
                                &nbsp;
                                &nbsp;
                                &nbsp;
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