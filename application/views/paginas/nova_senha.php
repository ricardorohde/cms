<script type="text/javascript">
    $(document).ready(function(){
        $("#login-header-space").html('<h4 class="hidden-mobile">Já é registrado?</h4><a href="<?php echo app_baseurl().'login'?>" class="btn btn-danger">Fazer login</a>');
        
        $("#verificador").blur(function(){
            if($("#senha").val() != $("#verificador").val())
            {
                alertify.error('As duas senhas não coincidem.');
            }
        });
        
        $("#nova-senha").submit(function(e){
            e.preventDefault();
            id_usuario = $("#id_usuario").val();
            senha = $("#senha").val();
            resposta_captcha = $("#resposta_captcha").val();
            $.ajax({
                url: "<?php echo app_baseurl().'recuperar_senha/altera_senha'?>",
                type: "POST",
                data: {id_usuario: id_usuario, senha: senha, captcha: resposta_captcha},
                dataType: "html",
                success: function(sucesso)
                {
                    if(sucesso == 0)
                    {
                        alertify.error("<strong>Erro no captcha. Digite novamente</strong>");
                        $("#resposta_captcha").val("").focus();
                        busca_captcha();
                    }
                    if(sucesso == 1)
                    {
                        alertify.error('<strong>Não foi possível redefinir a senha</strong>');
                        $("#senha").val();
                        $("#verificador").val();
                        $("#resposta_captcha").val("");
                        busca_captcha();
                    }
                    if(sucesso == 2)
                    {
                        alertify.alert('Não foi possível fazer o login automático. Voçê será redirecionado à pagina de login');
                        location.href = "<?php app_baseurl().'login'?>";
                    }
                    if(sucesso == 3)
                    {
                        alertify.alert('A sua senha foi alterada.', function(e){
                            if(e)
                            {
                                location.href = "<?php echo app_baseUrl().'permissoes'; ?>";
                            }
                        });
                    }
                },
                error: function(erro)
                {
                    alertify.log('Ocorreu um erro. Tente novamente mais tarde');
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
    <form id="nova-senha" class="smart-form client-form">
        <input type="hidden" value="<?php echo $id_usuario?>" id="id_usuario">
        <header>
            Redefinição de Senha
        </header>
        <fieldset>
            <section>
                <label class="label">Endereço de Email</label>
                <label class="input">
                    <i class="icon-append fa fa-envelope"></i>
                    <input type="email" id="email" value="<?php echo $email; ?>" required disabled/>
                    <b class="tooltip tooltip-top-right">
                        <i class="fa fa-user txt-color-teal"></i> 
                        Entre com seu endereço de E-mail
                    </b>
                </label>
            </section>
            <section>
                <label class="label">Nova senha</label>
                <label class="input">
                    <i class="icon-append fa fa-lock"></i>
                    <input type="password" id="senha" maxlength="20" required placeholder="Entre com a sua nova senha" />
                    <b class="tooltip tooltip-top-right">
                        <i class="fa fa-lock txt-color-teal"></i>
                        Entre com a sua nova senha
                    </b>
                </label>
            </section>
            <section>
                <label class="input">
                    <i class="icon-append fa fa-lock"></i>
                    <input type="password" id="verificador" maxlength="20" required placeholder="Repita a senha" />
                    <b class="tooltip tooltip-top-right">
                        <i class="fa fa-lock txt-color-teal"></i>
                        Repita a senha
                    </b>
                </label>
            </section>
            <section>
                <label class="label">Prove que você não é um robô</label>
                <label class="input">
                    <div id="captcha"></div>
                    <br />
                    <input type="text" id="resposta_captcha" placeholder="A resposta é..." required="" maxlength="5" />
                </label>
            </section>
        </fieldset>
        <footer>
            <button type="submit" class="btn btn-primary">
                Alterar senha
            </button>
        </footer>
    </form>
</div>
