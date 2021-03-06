<script type="text/javascript" >
    $(document).ready(function() {
        $("#login").submit(function(e) {
            e.preventDefault();

            $('#entrar').button('loading');
            
            login = $("#usuario").val();
            senha = $("#senha").val();
            $.ajax({
                url: "<?php echo app_baseUrl().'login/logar'; ?>",
                type: "POST",
                data: {login: login, senha: senha},
                dataType: "html",
                success: function(sucesso)
                {
                    if(sucesso == 1)
                    {
                        location.href = "<?php echo app_baseUrl().'painel'; ?>";
                    }
                    else
                    {
                        msg_erro('Usuário ou senha incorretos');
                        $('#entrar').button('reset');
                        $("#usuario").focus();
                        $("#senha").val("");
                    }
                }
            });
        });

    });
</script>
<div class="well no-padding">
    <form id="login" class="smart-form client-form">
        <header>
            Acessar sua conta
        </header>
        <fieldset>
            <section>
                <label class="label">E-mail</label>
                <label class="input">
                    <i class="icon-append fa fa-user"></i>
                    <input type="email" id="usuario" required />
                    <b class="tooltip tooltip-top-right">
                        <i class="fa fa-user txt-color-teal"></i> 
                        Entre com seu endereço de E-mail
                    </b>
                </label>
            </section>
            <section>
                <label class="label">Senha</label>
                <label class="input">
                    <i class="icon-append fa fa-lock"></i>
                    <input type="password" id="senha" maxlength="20" required />
                    <b class="tooltip tooltip-top-right">
                        <i class="fa fa-lock txt-color-teal"></i>
                        Entre com a sua Senha
                    </b>
                </label>
                <div class="note">
                    <a href="<?php echo app_baseurl().'recuperar_senha'; ?>">Esqueceu sua senha?</a>
                </div>
            </section>
        </fieldset>
        <footer>
            <button id="entrar" type="submit" class="btn btn-primary" data-loading-text="Acessando o sistema...">
                Fazer login
            </button>
        </footer>
    </form>
</div>