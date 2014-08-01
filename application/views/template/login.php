<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title><?php echo $titulo; ?></title>
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link rel="stylesheet" type="text/css" media="screen" href="./css/bootstrap.css">		
        <link rel="stylesheet" type="text/css" media="screen" href="./css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/smart-forms.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/animated.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/jquery-ui-1.10.3.custom.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/colorpallet.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./css/main.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="./js/alertify/alertify.core.css">
        <link rel="stylesheet" type="text/css" media="screen" href="./js/alertify/alertify.default.css">
        <link rel="shortcut icon" href="./img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="./img/favicon/favicon.ico" type="image/x-icon">
        <script src="./js/libs/jquery-2.0.2.min.js"></script>
        <style>
            #logo_pentaurea {
                display: inline-block;        
                margin-top: -40px;
                margin-left: 175px;
            }
        </style>
    </head>
    <body id="login" class="animated fadeInDown">
        <header id="header">
            <div id="logo-group">
                <span id="logo"> <img src="img/logo.png" alt="SmartAdmin"> </span>
            </div>
            <span id="login-header-space">
            </span>
        </header>
        <div id="main" role="main">
            <!-- MAIN CONTENT -->
            <div id="content" class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
                        <h1 class="txt-color-red login-header-big">MasterAdmin</h1>
                        <div class="hero">
                            <div class="pull-left login-desc-box-l">
                                <h4 class="paragraph-header">Certo, preciso, útil, prático e definitivo. Acesse de qualquer lugar para adição de conteúdo</h4>
                                <div class="login-app-icons">
                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm">Belo design</a>
                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm">Totalmente funcional</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <h5 class="about-heading">Sobre o MasterAdmin - Você está atualizado?</h5>
                                <p>
                                    Pronto para monitoramento de informações preciosas sobre o site do Pentáurea Clube.
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <h5 class="about-heading">Não é apenas uma interface</h5>
                                <p>
                                    O MasterAdmin foi construído para coletar e distribuir uma grande quantidade de informações,
                                    proporcionando uma esperiência única!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                        <?php $this->load->view('paginas/' . $view); ?>
                    </div>
                </div>
            </div>
        </div>
        <!--<script data-pace-options='{ "restartOnRequestAfter": true }' src="./js/plugin/pace/pace.min.js"></script>-->
        <script src="./js/libs/jquery-2.0.2.min.js"></script>
        <script src="./js/libs/jquery-ui-1.10.3.min.js"></script>
        <script src="./js/bootstrap/bootstrap.min.js"></script>
        <script src="./js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
        <script src="./js/blockUI.js"></script>
        <script src="./js/alertify/alertify.min.js"></script>
        <!--[if IE 7]>
                <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
        <![endif]-->
        <!-- MAIN APP JS FILE -->
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
