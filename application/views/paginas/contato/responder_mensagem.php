<style>
    #minha_mensagem {
        border: 0px;
    }
</style>
<h2 class="email-open-header">
    Responder > Formulário de Contato do Site
    <div class="btn-group pull-right">
        <a href="javascript:buscar(offset)" class="btn btn-warning">
            Mensagens <i class="fa fa-inbox"></i>
        </a>
        <a href="javascript:loadAjax(url_lerMensagem, $('#mensagens'));" class="btn btn-warning">
            Voltar à Mensagem <i class="fa fa-reply"></i>
        </a>
        <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">
            Opções <i class="fa fa-cog"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="javascript:void(0);">
                    <i class="fa fa-eye"></i> Marcar Como Lida
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
            <div id="imprimir">
                <form enctype="multipart/form-data" action="" method="POST" class="form-horizontal">
                    <div class="inbox-info-bar no-padding">
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label col-md-1"><strong>Para:</strong></label>
                                <div class="col-md-11">
                                    <select multiple="" style="width:100%" class="select2" data-select-search="false">
                                        <option value="<?php echo $row->email_contato; ?>" selected="selected">
                                            <?php echo $row->email_contato; ?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>	
                    </div>
                    <div class="inbox-info-bar no-padding">
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label col-md-1"><strong>Assunto:</strong></label>
                                <div class="col-md-10">
                                    <input class="form-control" placeholder="Email Subject" type="text" value="Contato - Pentáurea Clube">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="inbox-info-bar no-padding">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <textarea class="form-control" id="minha_mensagem" placeholder="digite sua mensagem" autofocus="" rows="7"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="inbox-info-bar no-padding">
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label"><strong>Minha Mensagem:</strong></label>
                            </div>
                        </div>

                        <div class="inbox-message no-padding">
                            <div id="emailbody">
                                <p style="text-align: justify;">
                                    <?php echo $row->mensagem_contato; ?>
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
                    </div>
                    <div class="inbox-compose-footer">
                        <button class="btn btn-info" type="button">
                            Enviar Mensagem
                        </button>
                    </div>
                </form>
            </div>
            <?php
        }
    }
?>
<script type="text/javascript">
    runAllForms();
    $(".select2-search-choice-close").hide();
</script>