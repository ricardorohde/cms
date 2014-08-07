<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title> Clube Campestre Pentáurea </title>
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
    </head>
    <body class="no-right-panel">
        <!-- Barra no topo, onde há alguns links e a logo da empresa -->
        <header id="header">
            <div id="logo-group">
                <span id="logo">
                    <img src="img/logo.png" alt="Núcleo de Tecnologia - Pentáurea Clube" title="Núcleo de Tecnologia - Pentáurea Clube" />
                </span>
            </div>
        </header>
        <!--*************************************************************************-->
        <div id="main" role="main">
            <div id="content" class="container">
                <?php $this->load->view('paginas/' . $view); ?>
            </div>
        </div>

        <script type="text/javascript">
            /** Configurações utilizadas no ajax **/
            $(document).ajaxStart(function() {
                $.blockUI({
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        'border-radius': '10px',
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
            
            $.ajaxSetup({
                error: function(xhr){
                    if (xhr.status === 0) {
                        msg_erro('Não há conexão. verifique sua conexão');
                    } else if (xhr.status == 404) {
                        msg_erro('Error 404 (Not Found)');
                    } else if (xhr.status == 500) {
                        msg_erro('Error 500 (Internal error server).');
                    }
                }
            });
            //******************************************************************
        </script>
    </body>
</html>