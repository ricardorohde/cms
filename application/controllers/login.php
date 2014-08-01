<?php

    class Login extends MY_Controller
    {
        /*
         * Classe de login
         * Esta classe irá conter todos os comandos relacionados ao login, como as 
         * funções de login e logoff
         */
        
        /*
         * Contrução da classe, extendendo a MY_Controller
         */

        public function __construct()
        {
            parent::__construct(FALSE);
        }

        //----------------------------------------------------------------------

        /*
         * Função principal do controller de login. Esta função irá buscar na
         * pasta views/paginas a visão desejada para ser apresentada, que neste
         * caso é a visão login. Defino como template padrão o template de login
         * que é diferente do template do restante do sistema
         */
        function index()
        {
            $this->template = 'template/login';
            $this->titulo = 'MasterAdmin - Fazer Login';
            $this->view = 'login';
            $this->LoadView();
        }

        //----------------------------------------------------------------------

        /*
         * Função desenvolvida para realizar o login
         */
        function logar()
        {
            $login = $this->input->post('login');
            $senha = $this->input->post('senha');
            if ($login || $senha)
            {
                $this->load->model('usuarios');
                $usuario = $this->usuarios->autenticar($login, $senha);
                if ($usuario)
                {
                    $_SESSION['user'] = $usuario;
                    echo 1;
                }
                else
                {
                    echo 2;
                }
            }
        }
        //----------------------------------------------------------------------

        /*
         * Função de logoff
         */
        function logout()
        {
            unset($_SESSION['user']);
            session_destroy();
            redirect(app_baseUrl());
        }
        //----------------------------------------------------------------------
    }

?>