<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>CMS - Pentáurea Clube</title>
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/bootstrap.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/smartadmin-skins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/icones.css">
        <link rel="stylesheet" type="text/css" href="./css/colorpicker.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/TableTools.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui-1.10.3.custom.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/colorpallet.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./js/alertify/alertify.core.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./js/alertify/alertify.default.css">
        <link rel="stylesheet" type="text/css" media="all" href="./js/fancybox/jquery.fancybox.css" />
        <link rel="stylesheet" type="text/css" media="all" href="./css/pentaurea.css" />
        <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">
    </head>
    <body class="smart-style-2 menu-on-top">
        <?php $this->load->view('/paginas/' . $view); ?>

        <script src="./js/libs/jquery-2.0.2.min.js"></script>
        <script src="./js/ajax.js"></script>
        <script src="./js/libs/jquery-ui-1.10.3.min.js"></script>
        <script src="./js/plugin/colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="./js/bootstrap/bootstrap.min.js"></script>
        <script src="./js/notification/SmartNotification.min.js"></script>
        <script src="./js/smartwidgets/jarvis.widget.min.js"></script>
        <script src="./js/plugin/masked-input/jquery.maskedinput.min.js"></script>
        <script src="./js/plugin/select2/select2.min.js"></script>
        <script src="./js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
        <script src="./js/alertify/alertify.min.js"></script>
        <script src="./js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script src="./js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
        <script src="./js/fancybox/jquery.fancybox.js" type="text/javascript"></script>
        <script src="./js/app.js"></script>
        <script type="text/javascript">
            /** Inicialização dos tooltips e popovers **/
            $("[rel=tooltip]").tooltip();
            
            $('body').tooltip({
                selector: '[rel="tooltip"]'
            });
            
            $('body').popover({
                selector: '[rel="popover"]',
                placement: 'top',
                trigger: 'hover'
            });
            //******************************************************************
            
            /** Configurações utilizadas no ajax **/
            $(document).ajaxStart(function() {
                show_loading();
            });
            
            $(document).ajaxComplete(function() {
                hide_loading();
            });
            
            $.ajaxSetup({
                error: function(){
                    msg_erro('Ocorreu um erro. Tente novamente');
                }
            });
            //******************************************************************
            
            /** Configurações do alertify **/
            alertify.set({
                labels: {
                    ok: "Ok",
                    cancel: "Cancelar"
                },
                buttonFocus: "none"
            });
            //******************************************************************

            /**
             * Função desenvolvida para fazer o logoff do sistema
             */
            $('.logout').click(function(e) {
                //Recebe o link da página de logoff
                $.loginURL = '<?php echo app_baseurl().'login/logout' ?>';

                // Realiza o questionamento se o usuário deseja sair
                $.SmartMessageBox({
                    title: "<i class='fa fa-sign-out txt-color-orangeDark'></i> Deseja sair <span class='txt-color-orangeDark'><strong>" + $('#show-shortcut').text() + "</strong></span> ?",
                    content: "Você pode melhorar a segurança fechando esta aba após realizar o logoff",
                    buttons: '[Não][Sim]'
                }, function(ButtonPressed) {
                    if (ButtonPressed == "Sim") {
                        $.root_.addClass('animated fadeOutUp');
                        setTimeout(logout, 1000);
                    }
                    else
                    {
                        return false;
                    }

                });
                e.preventDefault();
            });
            function logout() {
                window.location = $.loginURL;
            }
        </script>
    </body>
</html>