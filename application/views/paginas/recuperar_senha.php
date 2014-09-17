<script>
    $(document).ready(function(){

        //Função que busca o CAPTCHA
        busca_captcha();

        //Adiciona um botão para que o usuário possa voltar a página de login
        $("#login-header-space").html('<a href="<?php echo app_baseurl().'login'?>" class="btn btn-danger">Fazer login</a>');
        
        $("#recuperacao").submit(function(e){
            e.preventDefault();

            $('#btn-enviar').button('loading');
            
            email   = $("#email").val();
            captcha = $("#resposta-captcha").val();
            
            $.ajax({
                url: "<?php echo app_baseurl().'recuperar_senha/verificar'?>",
                type: "POST",
                data: {email: email, captcha: captcha},
                dataType: "html",
                success: function(sucesso){
                    if(sucesso == 3)
                    {
                		limpar_campos($("#recuperacao"));
                        msg_sucesso('E-mail enviado. Verifique sua caixa de entrada');
                        $("#email").focus();
                        busca_captcha();
                        $('#btn-enviar').button('reset');
                    }
                    else if(sucesso == 0)
                    {
                        msg_erro('Erro no captcha. Digite novamente');
                        $("#resposta-captcha").val("").focus();
                        busca_captcha();
                        $('#btn-enviar').button('reset');
                    }
                    else if(sucesso == 1)
                    {
                        msg_erro("Não há e-mail correspondente na base de dados. Verifique o endereço de email");
                        limpar_campos($("#recuperacao"));
                        $("#email").focus();
                        busca_captcha();
                        $('#btn-enviar').button('reset');
                    }
                    else if(sucesso == 2)
                    {
                        msg_erro("Não foi possível enviar os dados para o email. Tente novamente mais tarde");
                    }
                }
            });
        });
    });

    //Função que realiza a busca do captcha
    function busca_captcha()
    {
        url = "<?php echo app_baseurl().'recuperar_senha/captcha'?>"
        
        loadAjax(url, $("#captcha"));
    }
</script>
<div class="well no-padding">
    <form id="recuperacao" class="smart-form client-form">
        <header>
            Recuperação de senha
        </header>
        <fieldset>
            <section>
                <label class="label">Digite seu email e lhe enviaremos sua senha</label>
                <label class="input">
                    <i class="icon-append fa fa-envelope"></i>
                    <input type="email" id="email" placeholder="Endereço de Email" required/>
                    <b class="tooltip tooltip-top-right">
                        <i class="fa fa-user txt-color-teal"></i> 
                        Entre com seu endereço de E-mail
                    </b>
                </label>
            </section>
            <section>
                <label class="label">Prove que você não é um robô</label>
                <label class="input">
                    <div id="captcha"></div>
                    <br />
                    <input type="text" id="resposta-captcha" placeholder="A resposta é..." required="" maxlength="5" />
                </label>
            </section>
        </fieldset>
        <footer>
            <button id="btn-enviar" type="submit" class="btn btn-primary" data-loading-text="Verificando e enviando...">
                Recuperar Senha
            </button>
        </footer>
    </form>
</div>