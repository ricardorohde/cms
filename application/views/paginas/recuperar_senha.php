<script>
    $(document).ready(function(){
        $("#login-header-space").html('<h4 class="hidden-mobile">Já é registrado?</h4><a href="<?php echo app_baseurl().'login'?>" class="btn btn-danger">Fazer login</a>');
        $("#recuperacao").submit(function(e){
            e.preventDefault();
            email = $("#email").val();
            captcha = $("#resposta-captcha").val();
            $.ajax({
                url: "<?php echo app_baseurl().'recuperar_senha/verificar'?>",
                type: "POST",
                data: {email: email, captcha: captcha},
                dataType: "html",
                success: function(sucesso){
                    if(sucesso == 3)
                    {
                        alertify.success("<strong>E-mail enviado. Verifique sua caixa de entrada</strong>");
                        $("#email").val("");
                        $("#resposta-captcha").val("");
                        busca_captcha();
                    }
                    else if(sucesso == 0)
                    {
                        alertify.error("<strong>Erro no captcha. Digite novamente</strong>");
                        $("#resposta-captcha").val("").focus();
                        busca_captcha();
                    }
                    else if(sucesso == 1)
                    {
                        alertify.alert("Não há e-mail correspondente na base de dados. Verifique o endereço de email");
                        $("#email").val("").focus();
                        $("#resposta-captcha").val("");
                        busca_captcha();
                    }
                    else if(sucesso == 2)
                    {
                        alertify.error("Não foi possível enviar os dados para o email. Tente novamente mais tarde");
                    }
                    else
                    {
                        alertify.log('Erro desconhecido');
                        $("#resposta-captcha").val("");
                        busca_captcha();
                    }
                },
                error: function(erro){
                    alertify.log("<strong>Ocorreu um erro. Tente mais tarde</strong>");
                }
            });
        });
    });
    function busca_captcha()
    {
        $.get("<?php echo app_baseurl().'recuperar_senha/captcha'?>", function(e){
           $("#captcha").html(e);
        });
    }
    window.onload(busca_captcha());
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
            <button type="submit" class="btn btn-primary">
                Recuperar Senha
            </button>
        </footer>
    </form>
</div>