<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-fw fa-file-text-o"></i> Edição de mensagens
        </h1>
    </div>
</div>
<?php
    if(!$mensagem)
    {
        ?>
        <div class="alert alert-block alert-danger">
            <h4 class="alert-heading"><i class="fa fa-times"></i> Erro</h4>
            <p>
                Não foi possível resgatar esta mensagem para edição
            </p>
        </div>
        <?php
    }
    else
    {
       ?>
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget jarviswidget-color-darken">
                        <header>
                            <span class="widget-icon">
                                <i class="fa fa-file-text-o"></i>
                            </span>
                            <h2>Editar uma mensagem cadastrada</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <form id="atualizar_mensagem" class="smart-form">
                                    <?php
                                        foreach ($mensagem as $row)
                                        {
                                            ?>
                                            <input type="hidden" id="id_mensagem" value="<?php echo $row->id?>">
                                            <fieldset>
                                                <section>
                                                    <div class="row">
                                                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label class="input">
                                                                <input type="text" placeholder="Nome do autor" id="autor" maxlength="50" required autofocus value="<?php echo $row->autor?>">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section>
                                                    <div class="row">
                                                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label class="textarea">
                                                                <textarea id="mensagem" rows="3" maxlength="500" required><?php echo $row->mensagem?></textarea>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </section>
                                            </fieldset>
                                            <footer>
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fam-disk"></i> 
                                                    Atualizar mensagem
                                                </button>
                                                <button type="button" class="btn btn-default" onclick="window.close()">
                                                    <i class="fam-cross"></i> 
                                                    Fechar esta janela
                                                </button>
                                            </footer>
                                            <?php
                                        }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
       <?php
    }
?>
<script src="./js/app.js"></script>
<script src="./js/ajax.js"></script>
<script src="./js/libs/jquery-ui-1.10.3.min.js"></script>
<script src="./js/bootstrap/bootstrap.min.js"></script>
<script src="./js/notification/SmartNotification.min.js"></script>
<script src="./js/smartwidgets/jarvis.widget.min.js"></script>
<script src="./js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
<script src="./js/blockUI.js"></script>
<script src="./js/libs/jquery.ui.datepicker-pt-BR.js"></script>

<script type="text/javascript">
    $('#atualizar_mensagem').submit(function(e){
        e.preventDefault();
        
        id          = $('#id_mensagem').val();
        autor       = $('#autor').val();
        mensagem    = $('#mensagem').val();
        
        $.ajax({
            url: '<?php echo app_baseurl().'mensagem_diaria/salvar_alteracao'?>',
            type: 'POST',
            data: {
                id: id,
                autor: autor,
                mensagem: mensagem
            },
            dataType: "html",
            success: function(e)
            {
                if(e == 1)
                {
                    msg_sucesso('Mensagem atualizada');
                    window.opener.busca_mensagens();
                    
                    setTimeout(function() {window.close();}, 1000);
                }
                else
                {
                    msg_erro('Não foi possível atualizar a mensagem')
                }
            }
        });
    });
</script>