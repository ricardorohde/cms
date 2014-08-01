<style>
    li {
        list-style: none;
    }
</style>
<h2 class="email-open-header">
    Formulário de Contato do Site
    <div class="btn-group pull-right">
        <a href="javascript:buscar(offset);" class="btn btn-warning">
            Mensagens <i class="fa fa-inbox"></i>
        </a>
        <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">
            Opções <i class="fa fa-cog"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="javascript:void(0);">
                    <i class="fa fa-eye"></i> Mover para lidas
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="fa fa-trash-o"></i> Mover para Excluídas
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="javascript:imprimir($('#impressao'));">
                    <i class="fa fa-print"></i> Imprimir esta Mensagem
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="fa fa-bitbucket"></i> Excluir definitivamente
                </a>
            </li>
        </ul>
    </div>
</h2>
<?php
    if(!isset($mensagem))
    {
        ?>
        <div class="alert alert-block alert-danger fadeIn">
            <h4 class="alert-heading">
                <i class="glyphicon glyphicon-remove"></i> Ocorreu um erro
            </h4>
            <p>
                Ocorreu um erro na busca da mensagem selecionada
            </p>
        </div>
        <?php
    }
    else
    {
        foreach($mensagem as $row)
        {
            ?>
            <div id="impressao">
                <div class="inbox-info-bar">
                    <div class="row">
                        <div class="col-sm-9">
                            <strong><?php echo $row->nome_contato ?></strong>
                            <span class="hidden-mobile">&lt;<?php echo $row->email_contato; ?>&gt; 
                                para <strong>mim</strong> em <i><?php echo date('d/m/Y h:m', strtotime($row->data)); ?></i>
                            </span> 
                        </div>
                        <div class="col-sm-3 text-right">
                            <div class="btn-group text-left">
                                <button class="btn btn-primary btn-sm replythis" id="responder">
                                    <i class="fa fa-reply"></i> Responder a mensagem
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inbox-message">
                    <p style="text-align: justify;">
                        <?php echo $row->mensagem_contato;?>
                    </p>
                    <br />
                    <br />
                    <strong><?php echo $row->nome_contato ?></strong>
                    <br /><br />
                    <small>
                        <i class="fa fa-envelope"> <?php echo $row->email_contato; ?></i> 
                    </small>
                    <br />
                </div>
            </div>
            <?php
        }
    }
?>
<script type="text/javascript">
    $("#responder").click(function() {
        
        url_responder = "<?php echo app_baseUrl() . 'contato/contato/responder_mensagem/' ?>" + id_mensagem;
        
        loadAjax(url_responder, $('#mensagens'));
    });
</script>