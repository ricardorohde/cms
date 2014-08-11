<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12">
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                
                <!-- Header do widget -->
                <header>
                    <span class="widget-icon"> 
                        <i class="fa fa-envelope-o txt-color-darken"></i> 
                    </span>
                    <h2>Configurações de E-mail</h2>
                </header>
                <!--*********************************************************-->
                
                <div class="">
                    <div class="widget-body no-padding">
                        <form id="atualizar_config" class="smart-form">
                            <?php
                                foreach($config as $row)
                                {
                                    ?>
                                    <fieldset>
                                        <section class="col col-6">
                                            <label class="label"><strong>Host SMTP:</strong></label>
                                            <label class="input">
                                                <i class="icon-append fa fa-hdd-o"></i>
                                                <input type="text" id="smtp_host" required value="<?php echo $row->smtp_host?>">
                                                <b class="tooltip tooltip-top-right">
                                                    Indique o endereço do host SMTP
                                                </b>
                                            </label>  
                                        </section>
                                        <section class="col col-6">
                                            <label class="label"><strong>Porta SMTP:</strong></label>
                                            <label class="input">
                                                <i class="icon-append fa fa-sign-in"></i>
                                                <input type="text" id="smtp_port" required value="<?php echo $row->smtp_port?>">
                                                <b class="tooltip tooltip-top-right">
                                                    Indique a porta SMTP
                                                </b>
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="label"><strong>Usuário SMTP:</strong></label>
                                            <label class="input">
                                                <i class="icon-append fa fa-user"></i>
                                                <input type="text" id="smtp_userName" required value="<?php echo $row->smtp_userName?>">
                                                <b class="tooltip tooltip-top-right">
                                                    Indique o usuário SMTP
                                                </b>
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="label"><strong>Senha SMTP:</strong></label>
                                            <label class="input">
                                                <i class="icon-append fa fa-lock"></i>
                                                <input type="password" id="smtp_password" required value="<?php echo $row->smtp_password?>">
                                                <b class="tooltip tooltip-top-right">
                                                    Indique a senha SMTP
                                                </b>
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="label"><strong>Segurança SMTP:</strong></label>
                                            <label class="input">
                                                <i class="icon-append fa fa-shield"></i>
                                                <input type="text" id="smtp_secure" required value="<?php echo $row->smtp_secure?>">
                                                <b class="tooltip tooltip-top-right">
                                                    Indique o nível de segurança
                                                </b>
                                            </label>
                                        </section><section class="col col-6">
                                            <label class="label"><strong>Email SMTP:</strong></label>
                                            <label class="input">
                                                <i class="icon-append fa fa-envelope-o"></i>
                                                <input type="text" id="smtp_from" required value="<?php echo $row->smtp_from?>">
                                                <b class="tooltip tooltip-top-right">
                                                    Indique o Remetente de envio
                                                </b>
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="label"><strong>Nome SMTP:</strong></label>
                                            <label class="input">
                                                <i class="icon-append fa fa-font"></i>
                                                <input type="text" id="smtp_fromName" required value="<?php echo $row->smtp_fromName?>">
                                                <b class="tooltip tooltip-top-right">
                                                    Indique o nome do remetente
                                                </b>
                                            </label>
                                        </section>
                                    </fieldset>
                                    <?php
                                }
                            ?>
                            <footer>
                                <button class="btn btn-default">Atualizar configurações</button>
                                <a class="btn btn-danger" data-action='editar' id='editar_informacoes'>
                                    Editar informações
                                </a>
                            </footer>
                        </form>
                    </div>
                </div>
                
            </div>
        </article>
    </div>
</section>

<script type="text/javascript">
    $('#atualizar_config').find('input, button').prop('disabled', true);
    
    $('#editar_informacoes').click(function(e){
        e.preventDefault();
        
        if($(this).data('action') == 'editar')
        {
            $(this).html('Cancelar edição').data('action', 'cancelar');
            $('#atualizar_config').find('input, button').prop('disabled', false);
        }
        else
        {
            $(this).html('Editar Informações').data('action', 'editar');
            $('#atualizar_config').find('input, button').prop('disabled', true);
        }
    });
</script>