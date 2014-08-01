<?php

    class Menu_Principal extends MY_Model
    {

        //Construção da classe--------------------------------------------------
        public function __construct()
        {
            parent::__construct();
            $this->_primary = 'id';
            $this->_tabela = 'menu_permissoes';
        }

        /*
         * Função construída para montar o menú, de acordo com as permissões do 
         * usuário
         */

        function montar_menu($id_usuario)
        {
            $m1 = '
                <li class="accordion" id="navigation-contato">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#navigation-mensagens" href="#mensagens-menu">
                        <span class="box">
                            <i class="radmin-icon radmin-newspaper"></i>
                        </span>
                        <span class="hidden-tablet hidden-phone">Formulários</span>
                        <span class="label pull-right hidden-tablet hidden-phone">2</span>
                    </a>
                    <div id="mensagens-menu" class="accordion-body collapse">
                        <ul class="nav nav-stacked submenu">
                            <li>
                                <a href="' . app_baseurl() . 'contato' . '">
                                    <span class="box">
                                        <i class="fam-comment"></i>
                                    </span>
                                    <span class="hidden-tablet hidden-phone">Contato</span>
                                </a>
                            </li>
                            <li class="submenu-last">
                                <a href="' . app_baseurl() . 'sugestao' . '">
                                    <span class="box">
                                        <i class="fam-comments"></i>
                                    </span>
                                    <span class="hidden-tablet hidden-phone">Sugestões</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            ';

            $m2 = '
                <li class="accordion" id="navigation-noticias">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#navigation-noticias" href="#cadastradas">
                        <span class="box">
                            <i class="radmin-icon radmin-file"></i>
                        </span>
                        <span class="hidden-tablet hidden-phone">Notícias</span>
                        <span class="label pull-right hidden-tablet hidden-phone">2</span>
                    </a>
                    <div id="cadastradas" class="accordion-body collapse">
                        <ul class="nav nav-stacked submenu">
                            <li>
                                <a href="' . app_baseurl() . 'noticias_cadastradas' . '">
                                    <span class="box">
                                        <i class="fam-page-white-text"></i>
                                    </span>
                                    <span class="hidden-tablet hidden-phone">Cadastradas</span>
                                </a>
                            </li>
                            <li class="submenu-last">
                                <a href="' . app_baseurl() . 'noticias' . '">
                                    <span class="box">
                                        <i class="fam-add"></i>
                                    </span>
                                    <span class="hidden-tablet hidden-phone">Nova Notícia</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            ';

            $m3 = '
                <li class="accordion" id="navigation-vereador">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#navigation-vereador" href="#vereadores">
                        <span class="box">
                            <i class="radmin-icon radmin-user-3"></i>
                        </span>
                        <span class="hidden-tablet hidden-phone">Vereadores</span>
                        <span class="label pull-right hidden-tablet hidden-phone">2</span>
                    </a>
                    <div id="vereadores" class="accordion-body collapse">
                        <ul class="nav nav-stacked submenu">
                            <li>
                                <a href="' . app_baseurl() . 'cadastro_vereador' . '">
                                    <span class="box">
                                        <i class="radmin-icon radmin-plus-2"></i>
                                    </span>
                                    <span class="hidden-tablet hidden-phone">Adicionar</span>
                                </a>
                            </li>
                            <li class="submenu-last">
                                <a href="' . app_baseurl() . 'vereadores_cadastrados' . '">
                                    <span class="box">
                                        <i class="radmin-icon radmin-eye-2"></i>
                                    </span>
                                    <span class="hidden-tablet hidden-phone">Visualizar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            ';

            $m4 = '
                <li id="navigation-galerias">
                    <a href="' . app_baseurl() . 'galerias' . '">
                        <span class="box">
                            <i class="radmin-icon radmin-pictures"></i>
                        </span>
                        <span class="hidden-tablet hidden-phone">Galerias</span>
                    </a>
                </li>
            ';
            $m5 = '

                <li id="navigation-camara">
                    <a href="' . app_baseurl() . 'camara' . '">
                        <span class="box">
                            <i class="radmin-icon radmin-home"></i>
                        </span>
                        <span class="hidden-tablet hidden-phone">Dados da Câmara</span>
                    </a>
                </li>

            ';
            $m6 = '
                <li id="navigation-usuarios">
                    <a href="' . app_baseurl() . 'usuarios' . '">
                        <span class="box">
                            <i class="radmin-icon radmin-user"></i>
                        </span>
                        <span class="hidden-tablet hidden-phone">Usuários</span>
                    </a>
                </li>
            ';
            $m7 = '
                <li class="accordion" id="navigation-configuracoes">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#navigation-configuracoes" href="#configuracoes">
                        <span class="box">
                            <i class="radmin-icon radmin-wrench"></i>
                        </span>
                        <span class="hidden-tablet hidden-phone">configurações</span>
                        <span class="label pull-right hidden-tablet hidden-phone">4</span>
                    </a>
                    <div id="configuracoes" class="accordion-body collapse">
                        <ul class="nav nav-stacked submenu">
                            <li>
                                <a href="' . app_baseurl() . 'valor_barracas' . '">
                                    <span class="box">
                                        <i class="fam-money"></i>
                                    </span>
                                    <span class="hidden-tablet hidden-phone">Valor das Barracas</span>
                                </a>
                            </li>
							<li>
								<a href="' . app_baseUrl() . 'descricao_barracas' . '">
									<span class="box">
										<i class="fam-script-edit"></i>
									</span>
									<span class="hidden-tablet hidden-phone">
										Descrições
									</span>
								</a>
							</li>
							<li>
								<a href="' . app_baseUrl() . 'barracas' . '">
									<span class="box">
										<i class="fam-house"></i>
									</span>
									<span class="hidden-tablet hidden-phone">
										Barracas
									</span>
								</a>
							</li>
                            <li>
                                <a href="' . app_baseurl() . 'a_camara' . '">
                                    <span class="box">
                                        <i class="radmin-icon radmin-plus-2"></i>
                                    </span>
                                    <span class="hidden-tablet hidden-phone">A Câmara</span>
                                </a>
                            </li>
                            <li>
                                <a href="' . app_baseurl() . 'cidade' . '">
                                    <span class="box">
                                        <i class="radmin-icon radmin-plus-2"></i>
                                    </span>
                                    <span class="hidden-tablet hidden-phone">A Cidade</span>
                                </a>
                            </li>
                            <li>
                                <a href="' . app_baseurl() . 'links' . '">
                                    <span class="box">
                                        <i class="radmin-icon radmin-plus-2"></i>
                                    </span>
                                    <span class="hidden-tablet hidden-phone">Links Úteis</span>
                                </a>
                            </li>
                            <li class="submenu-last">
                                <a href="' . app_baseurl() . 'imagens_banner' . '">
                                    <span class="box">
                                        <i class="radmin-icon radmin-plus-2"></i>
                                    </span>
                                    <span class="hidden-tablet hidden-phone">Imagens do Banner</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            ';

            $this->BD->select('*');
            $this->BD->where(array('id_usuario' => $id_usuario));
            $query = $this->BD->get('menu_permissoes');
            if ($query->num_rows() > 0)
            {
                $menu = NULL;
                foreach ($query->result() as $row)
                {
                    if ($row->id_menu == 1)
                    {
                        $menu .= $m1;
                    }
                    if ($row->id_menu == 2)
                    {
                        $menu .= $m2;
                    }
                    if ($row->id_menu == 3)
                    {
                        $menu .= $m3;
                    }
                    if ($row->id_menu == 4)
                    {
                        $menu .= $m4;
                    }
                    if ($row->id_menu == 5)
                    {
                        $menu .= $m5;
                    }
                    if ($row->id_menu == 6)
                    {
                        $menu .= $m6;
                    }
                    if ($row->id_menu == 7)
                    {
                        $menu .= $m7;
                    }
                }
                return $menu;
            }
            else
            {
                echo "Ocorreu um erro ao carregar o template";
            }
        }

        function redirecionamento($id_usuario)
        {
            $m1 = app_baseurl() . 'contato';
            $m2 = app_baseurl() . 'noticias_cadastradas';
            $m3 = app_baseurl() . 'vereadores_cadastrados';
            $m4 = app_baseurl() . 'galerias';
            $m5 = app_baseurl() . 'camara';
            $m6 = app_baseurl() . 'usuarios';
            $m7 = app_baseurl() . 'a_camara';

            $this->BD->select('id_menu');
            $this->BD->where(array('id_usuario' => $id_usuario));
            $this->BD->order_by('id_menu');
            $query = $this->BD->get('menu_permissoes');
            if ($query->num_rows() > 0)
            {
                foreach ($query->result() as $row)
                {
                    if ($row->id_menu == 1)
                    {
                        return $m1;
                    }
                    elseif ($row->id_menu == 2)
                    {
                        return $m2;
                    }
                    elseif ($row->id_menu == 3)
                    {
                        return $m3;
                    }
                    elseif ($row->id_menu == 4)
                    {
                        return $m4;
                    }
                    elseif ($row->id_menu == 5)
                    {
                        return $m5;
                    }
                    elseif ($row->id_menu == 6)
                    {
                        return $m6;
                    }
                    elseif ($row->id_menu == 7)
                    {
                        return $m7;
                    }
                }
            }
        }

        //----------------------------------------------------------------------

        /*
         * Função que faz a busca de todas as permissoes de usuário
         */
        function permissoes($id)
        {
            $this->BD->select('*');
            $this->BD->where(array('id_usuario' => $id));
            $query = $this->BD->get($this->_tabela);
            if ($query->num_rows() > 0)
            {
                return $query->result();
            }
            else
            {
                return false;
            }
        }

        //----------------------------------------------------------------------

        /*
         * Função que retira uma permissão
         */
        function retira_permissao($id_permissao)
        {
            $this->BD->where(array('id' => $id_permissao));
            $query = $this->BD->delete($this->_tabela);
            return $query;
        }

        //----------------------------------------------------------------------

        /*
         * Função utilizada para setar permissões a um usuário
         */
        function salvar_permissao($dados)
        {
            $data = array(
                'id_usuario' => $dados['id_usuario'],
                'id_menu' => $dados['id_menu']
            );
            $query = $this->BD->insert($this->_tabela, $data);
            return $query;
        }

        //----------------------------------------------------------------------
    }

?>