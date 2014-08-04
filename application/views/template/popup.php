<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title> ClubSystem Softwares </title>
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/bootstrap.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/smartadmin-skins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/icones.css">
        <link rel="stylesheet" type="text/css" media="all" href="./js/fancybox/jquery.fancybox.css" />
        <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">
        <script src="./js/libs/jquery-2.0.2.min.js"></script>
        <style>
            .btn-logout > :first-child > a {
                padding-top: 5px;
            }
        </style>
    </head>
    <body class="no-right-panel">
        <script src="./js/libs/jquery-ui-1.10.3.min.js"></script>
        <script src="./js/plugin/colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="./js/bootstrap/bootstrap.min.js"></script>
        <script src="./js/notification/SmartNotification.min.js"></script>
        <script src="./js/smartwidgets/jarvis.widget.min.js"></script>
        <script src="./js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
        <script src="./js/blockUI.js"></script>
        <script src="./js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script src="./js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
        <script src="./js/fancybox/jquery.fancybox.js" type="text/javascript"></script>
        
        <?php $this->load->view('/paginas/' . $view); ?>

        <script src="./js/app.js"></script>
        <script type="text/javascript">
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
        </script>
    </body>
</html>