<script src="js/tiny/tinymce.min.js" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $("#navigation-contato").addClass("active");

            $("#email").submit(function(e) {
                e.preventDefault();
                tinyMCE.triggerSave();
                mensagem = $("#mensagem").val();
                nome_contato = $("#nome_contato").val();
                email_contato = $("#email_contato").val();
                $.ajax({
                    url: "<?php echo app_baseUrl() . 'enviar_email/enviar' ?>",
                    type: "POST",
                    data: {mensagem: mensagem, nome_contato: nome_contato, email_contato: email_contato},
                    dataType: "html",
                    success: function(sucesso) {
                        $("#sucesso").html(
                                verifica_envio(sucesso)
                                );
                    },
                    error: function(erro) {
                        $("#erro").html(
                                notificacao('error', 'Ocorreu um erro ao enviar um email'),
                                fecha_notificacao()
                                );
                    }
                });
            });
        });

        tinymce.init({
            selector: "textarea",
            convert_urls: false,
            language: "pt_BR",
            height: 300,
            content_css: "css/bootstrap_twitter.css, css/pentaurea.css",
            theme: "modern",
            filemanager_title: "MasterAdmin - Gerenciador de Arquivos",
            plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak", "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", "table contextmenu directionality emoticons paste textcolor filemanager"],
            image_advtab: true,
            toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code",
            external_filemanager_path: "js/tiny/plugins/filemanager/"
        });

        function verifica_envio(sucesso)
        {
            if (sucesso == 1)
            {
                alertify.alert("Email enviado com sucesso", function(e) {
                    if (e)
                    {
                        location.href = "<?php echo app_baseUrl() . 'contato'; ?>";
                    }
                });
            }
            else
            {
                alertify.error(sucesso);
                return false;
            }
        }
</script>
<div class="row-fluid">
    <div class="span12">
        <h4>Envio de Email</h4>
        <div class="squiggly-border"></div>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <form class="horizontal-form" id="email">
            <?php
                if (!isset($dados_email))
                {
                    echo "Não foi possível carregar os dados solicitados";
                }
                else
                {
                    if ($definicao == "contato")
                    {
                        foreach ($dados_email as $row)
                        {
                            ?>
                            <textarea id="mensagem">
                                <br /><br /><br /><br /><br />
                                <hr></hr>
                                <strong>Detalhes da Mensagem:</strong>
                                <br />
                                <strong>Nome: </strong><?php echo $row->nome_contato; ?><br />
                                <strong>E-mail: </strong><?php echo $row->email_contato; ?><br />
                                <strong>Data de Contato: </strong><?php echo date('d/m/Y h:m', strtotime($row->data)); ?><br />
                                <strong>Mensagem: </strong><?php echo $row->mensagem_contato; ?>
                            </textarea>
                            <input type="hidden" id="nome_contato" value="<?php echo $row->nome_contato; ?>">
                            <input type="hidden" id="email_contato" value="<?php echo $row->email_contato; ?>">
                            <?php
                        }
                    }
                    elseif ($definicao == "sugestao")
                    {
                        foreach ($dados_email as $row)
                        {
                            ?>
                            <textarea id="mensagem">
                                								<br /><br /><br /><br /><br />
                                								<hr></hr>
                                								<strong>Detalhes da Mensagem:</strong>
                                								<br />
                                								<strong>Nome: </strong><?php echo $row->nome_sugestao; ?><br />
                                								<strong>E-mail: </strong><?php echo $row->email_sugestao; ?><br />
                                								<strong>Data de Contato: </strong><?php echo date('d/m/Y h:m', strtotime($row->data)); ?><br />
                                								<strong>Mensagem: </strong><?php echo $row->mensagem_sugestao; ?>
                            </textarea>
                            <input type="hidden" id="nome_contato" value="<?php echo $row->nome_sugestao; ?>">
                            <input type="hidden" id="email_contato" value="<?php echo $row->email_sugestao; ?>">
                            <?php
                        }
                    }
                }
            ?>
            <br />
            <button class="botao primario" type="submit"><i class="fam-email-go"></i> Enviar e-mail</button>
        </form>
    </div>
</div>
<div id="sucesso"></div>
<div id="erro"></div>