<!-- Barra no topo, onde há alguns links e a logo da empresa -->
<header id="header">
    <div id="logo-group">
        <span id="logo">
            <img src="img/logo.png" alt="Clube Campestre Pentáurea" title="Clube Campestre Pentáurea">
        </span>
    </div>
    <div class="pull-right">
    	<!-- Botão Para Esconder/ Mostrar Menu -->
		<div id="hide-menu" class="btn-header pull-right">
			<span>
				<a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-align-justify"></i></a>
			</span>
		</div>
		<!--*****************************************************************-->
        
        <!-- Exibe o nome e a foto do associado -->
		<ul id="mobile-profile-img" class="header-dropdown-list padding-5">
			<li class="">
				<a href="#" class="no-margin">
					Olá <span id="nome_usuario"><?php echo $_SESSION['user']->nome_completo; ?></span>
				</a>
			</li>
		</ul>
    </div>
</header>
<!--*************************************************************************-->

<!-- Barra lateral, onde contém o nome do usuário logado e os links -->
<aside id="left-panel">
    <nav>
        <ul>
            <li>
                <a href="index.php?/contato/contato" title="Mensagens">
                    <i class="fa fa-lg fa-fw fa-inbox"></i>  
                    <span>Mensagens</span>
                </a>
            </li>
            <li>
            	<a href="index.php?/depoimentos" title="Depoimentos">
            		<i class="fa fa-lg fa-fw fa-comments"></i>
            		<span>Depoimentos</span>
            	</a>
            </li>
            <li id="noticias">
                <a href="#" title="Notícias">
                    <i class="fa fa-lg fa-fw fa-book"></i> 
                    <span>Notícias</span>
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
                <a href="index.php?/avisos/avisos_cadastrados" title="Avisos">
                    <i class="fa fa-lg fa-fw fa-clipboard"></i> 
                    <span>Avisos</span>
                </a>
            </li>
            <li id="galerias">
                <a href="index.php?/galerias/galerias" title="Galerias">
                    <i class="fa fa-lg fa-fw fa-picture-o"></i> 
                    <span>Galerias</span>
                </a>
            </li>
            <li id="calendario">
                <a href="index.php?/calendario" title="Calendário de Eventos">
                    <i class="fa fa-lg fa-fw fa-calendar-o"></i> 
                    <span>Calendário</span>
                </a>
            </li>
            <li id="temas">
                <a href="index.php?/temas" title="Temas do Site">
                    <i class="fa fa-lg fa-fw fa-desktop"></i> 
                    <span>Temas do Site</span>
                </a>
            </li>
            <li id="mensagem_dia">
                <a href="index.php?/mensagem_diaria" title="Mensagem do dia">
                    <i class="fa fa-lg fa-fw fa-file-text-o"></i> 
                    <span>Mensagem do Dia</span>
                </a>
            </li>
            <li>
                <a href="index.php?/presidentes" title="Ex-presidentes">
                    <i class="fa fa-lg fa-fw fa-users"></i> 
                    <span>Ex-presidentes</span>
                </a>
            </li>
            <li>
                <a href="#" title="Diretorias">
                    <i class="fa fa-lg fa-fw fa-users"></i> 
                    <span>Diretorias</span>
                </a>
                <ul>
                    <li id="noticias_cadastradas">
                        <a href="index.php?/diretoria/diretoria" title="Cadastrar Diretoria">
                            <i class="fam-add"></i> Cadastradar Diretoria
                        </a>
                    </li>
                    <li>
                        <a href="index.php?/diretoria/diretores" title="Cadastrar Diretores">
                            <i class="fam-user-add"></i> Cadastrar Diretores
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-lg fa-fw fa-home"></i> 
                    <span>Instalações e Barracas</span>
                </a>
                <ul>
                	<li>
                		<a href="index.php?/barracas/barracas" title="Barracas">
                			<i class="fam fam-house"></i> Barracas
                		</a>
                	</li>
                	<li>
                		<a href="index.php?/barracas/descricao_barracas" title="Descrição das Barracas">
                			<i class="fam fam-page-white-text"></i> Descrição de barracas
                		</a>
                	</li>
                	<li>
                		<a href="index.php?/barracas/valor_barracas" title="Valor das Barracas">
                			<i class="fam fam-money"></i> Valor das Barracas
                		</a>
                	</li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-lg fa-fw fa-cogs"></i> 
                    <span>Configurações</span>
                </a>
                <ul>
                    <li>
                        <a href="index.php?/config/cadastroUsuarios" title="Cadastro de Usuários">
                            <i class="fam-user"></i> Cadastro de Usuários
                        </a>
                    </li>
                    <li>
                        <a href="index.php?/config/configuracoes_email" title="Envio de E-mail">
                            <i class="fam-email-edit"></i> Envio de Email
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="logout" href="#">
                    <i class="fa fa-lg fa-fw fa-sign-out"></i> 
                    <span>Fazer Logoff</span>
                </a>
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
<div class="carregando"></div>