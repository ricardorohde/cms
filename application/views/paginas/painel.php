<!-- Barra no topo, onde há alguns links e a logo da empresa -->
<header id="header">
    <div id="logo-group">
        <span id="logo">
            <img src="img/logo.png" alt="ClubSystem Softwares" title="ClubSystem Softwares" />
        </span>
    </div>
    <div class="pull-right">
        <div id="hide-menu" class="btn-header transparent pull-right btn-logout">
            <span>
                <a href="javascript:usuariovoid(0);" rel="tooltip" data-placement="left" data-title="Mostrar/ Esconder Menu">
                    <i class="fa fa-align-justify"></i>
                </a>
            </span>
        </div>
        <div class="btn-header transparent pull-right btn-logout">
            <span>
                <a class="logout" href="<?php echo app_baseurl() . 'login/logout' ?>" rel="tooltip" data-placement="left" title="Fazer Logoff">
                    <i class="fam-house-go"></i>
                </a>
            </span>
        </div>
    </div>
</header>
<!--*************************************************************************-->

<!-- Barra lateral, onde contém o nome do usuário logado e os links -->
<aside id="left-panel">
    <nav>
        <ul>
            <li>
                <a href="index.php?/contato" title="Mensagens">
                    <i class="fa fa-lg fa-fw fa-inbox"></i>  
                    <span class="menu-item-parent">Mensagens</span>
                    <span class="badge pull-right inbox-badge">14</span>
                </a>
            </li>
            <li id="noticias">
                <a href="#" title="Notícias">
                    <i class="fa fa-lg fa-fw fa-book"></i> 
                    <span class="menu-item-parent">Notícias</span>
                </a>
                <ul>
                    <li id="noticias_cadastradas">
                        <a href="index.php?/noticias/noticias_cadastradas" title="Notícias Cadastradas">
                            <i class="fam-newspaper"></i> Cadastradas
                        </a>
                    </li>
                    <li>
                        <a href="index.php?/noticias/nova_noticia" title="Nova notícia">
                            <i class="fam-add"></i> Nova Notícia
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" title="Avisos">
                    <i class="fa fa-lg fa-fw fa-clipboard"></i> 
                    <span class="menu-item-parent">Avisos</span>
                </a>
                <ul>
                    <li id="novo_aviso">
                        <a href="index.php?/avisos/novo_aviso" title="Novo Aviso">
                            <i class="fam-add"></i> Novo Aviso
                        </a>
                    </li>
                    <li id="avisos_cadastrados">
                        <a href="index.php?/avisos/avisos_cadastrados" title="Avisos Cadastrados">
                            <i class="fam-newspaper"></i> Avisos Cadastrados  
                        </a>
                    </li>
                </ul>
            </li>
            <li id="galerias">
                <a href="index.php?/galerias/galerias" title="Galerias">
                    <i class="fa fa-lg fa-fw fa-picture-o"></i> 
                    <span class="menu-item-parent">Galerias</span>
                </a>
            </li>
            <li id="calendario">
                <a href="index.php?/calendario" title="Calendário de Eventos">
                    <i class="fa fa-lg fa-fw fa-calendar-o"></i> 
                    <span class="menu-item-parent">Calendário</span>
                </a>
            </li>
            <li id="temas">
                <a href="index.php?/temas" title="Temas do Site">
                    <i class="fa fa-lg fa-fw fa-desktop"></i> 
                    <span class="menu-item-parent">Temas do Site</span>
                </a>
            </li>
            <li id="mensagem_dia">
                <a href="index.php?/mensagem_diaria" title="Mensagem do dia">
                    <i class="fa fa-lg fa-fw fa-file-text-o"></i> 
                    <span class="menu-item-parent">Mensagem do Dia</span>
                </a>
            </li>
            <li>
                <a href="index.php?/presidentes" title="Ex-presidentes">
                    <i class="fa fa-lg fa-fw fa-users"></i> 
                    <span class="menu-item-parent">
                        Ex-presidentes
                    </span>
                </a>
            </li>
            <li>
                <a href="#" title="Diretorias">
                    <i class="fa fa-lg fa-fw fa-users"></i> 
                    <span class="menu-item-parent">Diretorias</span>
                </a>
                <ul>
                    <li id="noticias_cadastradas">
                        <a href="index.php?/diretoria/diretoria" title="Cadastrar Diretoria">
                            <i class="fam-add"></i> Cadastradar Diretoria
                        </a>
                    </li>
                    <li>
                        <a href="index.php?/diretoria/diretores" title="Cadastrar Diretores">
                            <i class="fam-user-add"></i> Cadastrar Diretores</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-lg fa-fw fa-user"></i> 
                    <span class="menu-item-parent">Meu Perfil</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-lg fa-fw fa-cogs"></i> 
                    <span class="menu-item-parent">Configurações</span>
                </a>
                <ul>
                    <li>
                        <a href="#">
                            <i class="fam-user"></i> Cadastro de Usuários
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fam-group"></i> Grupos de Usuários
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fam-page-white-gear"></i> Gerenciador de Arquivos
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fam-email-edit"></i> Envio de Email
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fam-vcard"></i> Permissões de Acesso
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>
<aside id="right-panel"></aside>
<!--*************************************************************************-->

<!-- Aqui é onde virão as páginas principais -->
<div id="main" role="main">

    <!-- Montagem do breadcrumb, onde aparecerá a página onde o usuário está -->
    <div id="ribbon">
        <ol class="breadcrumb"></ol>
    </div>
    <!--*********************************************************************-->

    <!-- Div onde serão inseridas as páginas buscadas via ajax -->
    <div id="content">
    </div>
    <!-- Fim da inserção do conteúdo -->
</div>
<div class="page-footer">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <span class="txt-color-white">Sistema de Gerência de Conteúdo - Clube Campestre Pentáurea 2014</span>
        </div>
    </div>
    <!-- end row -->
</div>