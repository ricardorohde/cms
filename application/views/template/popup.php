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
        <link rel="stylesheet" type="text/css" media="all" href="./css/pentaurea.css" />
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
        </script>
    </body>
</html>