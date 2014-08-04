<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title><?php echo $titulo; ?></title>

        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link rel="stylesheet" type="text/css" media="screen" href="./css/bootstrap.css">		
        <link rel="stylesheet" type="text/css" media="screen" href="./css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/pentaurea.css">
        <link rel="shortcut icon" href="./img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="./img/favicon/favicon.ico" type="image/x-icon">
        <script src="./js/libs/jquery-2.0.2.min.js"></script>
    </head>
    <body id="login" class="animated fadeInDown">
        <header id="header">
            <div id="logo-group">
                <span id="logo"> <img src="./img/logo.png" alt="Clube Campestre Pentáurea"> </span>
            </div>
            <span id="login-header-space" class="elemento-topo pull-right"></span>
        </header>
        <div id="" role="main">
            <!-- MAIN CONTENT -->
            <div id="content" class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm"></div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <br><br>
                        <?php $this->load->view('paginas/' . $view); ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="./js/libs/jquery-ui-1.10.3.min.js"></script>
        <script src="./js/bootstrap/bootstrap.min.js"></script>
        <script src="./js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
        <script src="./js/blockUI.js"></script>
        <!--[if IE 7]>
                <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
        <![endif]-->
        <!-- MAIN APP JS FILE -->
        <script src="./js/app.js"></script>
        <script src="./js/ajax.js"></script>
        <script src="./js/notification/SmartNotification.min.js"></script>
        <script type="text/javascript">
            /** 
             * Função desenvolvida para setar as configurações visuais que serão
             * utilizadas nas requisições ajax
             **/
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
