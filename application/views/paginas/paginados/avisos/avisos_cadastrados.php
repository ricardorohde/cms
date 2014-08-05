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
        <!-- Widget do conteudo -->
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-sm-12">
                    <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">

                        <!-- Header do widget -->
                        <header>
                            <span class="widget-icon"> 
                                <i class="fa fa-clipboard txt-color-darken"></i> 
                            </span>
                            <h2>Todos os avisos cadastrados</h2>
                        </header>
                        <!--*********************************************************-->

                        <!-- Corpo do widget -->
                        <div class="no-padding">
                            <div class="widget-body">
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade active in no-padding-bottom">
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
                                                                <a class="excluir" href="#" data-id="<?php echo $row->id ?>" rel="tooltip" data-placement="top" title="Excluir aviso">
                                                                    <i class="fam-bin"></i>
                                                                </a>
                                                                <?php
                                                                if($row->status == 1)
                                                                {
                                                                    ?>
                                                                    <a class="inativar" href="#" data-id="<?php echo $row->id ?>" rel="tooltip" data-placement="top" title="Inativar aviso">
                                                                        <i class="fam-exclamation"></i>
                                                                    </a>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <a class="ativar" href="#" data-id="<?php echo $row->id ?>" rel="tooltip" data-placement="top" title="Ativar aviso">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--*********************************************************-->
                    </div>
                </article>
            </div>
        </section>
        <!--*************************************************************************-->
        
        <?php
        echo $paginacao;
    }
?>

<script type="text/javascript">
    offset = '<?php echo $offset?>';
    
    /**
     * Metodo utilizado para chamar a função excluir
     */
    $('.excluir').click(function(e){
        e.preventDefault();
        
        id = $(this).data('id');
        excluir(id);
    });
    //**************************************************************************
    
    /**
     * Método utilizado para chamar a função inativar
     */
    $('.inativar').click(function(e){
        e.preventDefault();
        
        id = $(this).data('id');
        inativar(id);
    });
    //**************************************************************************
    
    /**
     * Método utilizado para chamar a função inativar
     */
    $('.ativar').click(function(e){
        e.preventDefault();
        
        id = $(this).data('id');
        ativar(id);
    });
    //**************************************************************************
</script>