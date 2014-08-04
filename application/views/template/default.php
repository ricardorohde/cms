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
        <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">
        <style>
            .btn-logout > :first-child > a {
                padding-top: 5px;
            }
        </style>
    </head>
    <body class="smart-style-2 menu-on-top">
        <?php $this->load->view('/paginas/' . $view); ?>

        <script src="./js/ajax.js"></script>
        <script src="./js/libs/jquery-2.0.2.min.js"></script>
        <script src="./js/libs/jquery-ui-1.10.3.min.js"></script>
        <script src="./js/plugin/colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="./js/bootstrap/bootstrap.min.js"></script>
        <script src="./js/notification/SmartNotification.min.js"></script>
        <script src="./js/smartwidgets/jarvis.widget.min.js"></script>
        <script src="./js/plugin/masked-input/jquery.maskedinput.min.js"></script>
        <script src="./js/plugin/select2/select2.min.js"></script>
        <script src="./js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
        <script src="./js/alertify/alertify.min.js"></script>
        <script src="./js/blockUI.js"></script>
        <script src="./js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script src="./js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
        <script src="./js/fancybox/jquery.fancybox.js" type="text/javascript"></script>
        <!--[if IE 7]>
                <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
        <![endif]-->
        <script src="./js/app.js"></script>
        <script type="text/javascript">
            $("[rel=tooltip]").tooltip();
            $('body').tooltip({
                selector: '[rel="tooltip"]'
            });
            $('body').popover({
                selector: '[rel="popover"]',
                placement: 'top'
            });
            $(document).ajaxStart(function() {
                $.blockUI({
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'},
                    message: 'Processando Pedido...'
                });
            });
            $(document).ajaxComplete(function() {
                $.unblockUI();
            });
            alertify.set({
                labels: {
                    ok: "Ok",
                    cancel: "Cancelar"
                },
                buttonFocus: "none"
            });
            $('.logout').click(function(e) {
                //get the link
                $.loginURL = $(this).attr('href');

                // ask verification
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