<?php
    class MY_Controller extends CI_Controller
    {
        /*
         * Classe MY_Controller - Este controller pricipal é o que irá controlar
         * todos os outros "sub-controllers" no decorrer da execução do sistema
         */
        
        /*
         * Definições de variáveis protegidas, que serão usadas pelos outros 
         * controllers, desde que instanciem este controller
         */

        protected $template;
        protected $dados;
        protected $view;
        protected $titulo;

        //----------------------------------------------------------------------

        /*
         * Construção da classe com o método parent, além da definição de variá_
         * veis protegidas. Na contrução da classe, definimos um template padrão
         * para todas as páginas e verificamos se há necessidade de estar em uma
         * página com autenticação
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct();
            session_start();
            $this->template = 'template/default';
            $this->titulo = 'Gerenciador de Conteúdo';
            $this->verifica_login($requer_autenticacao);
            
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeiro';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Último';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Próximo &rarr;';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; Anterior';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
        }
        /**********************************************************************/

        /*
         * A função LoadView é a função que receberá as visões e os dados e os
         * lançará no template padrão, renderizando assim toda a página
         */
        public function LoadView()
        {
            $this->dados['view'] = $this->view;
            $this->dados['titulo'] = $this->titulo;
            if(isset($_SESSION['user']))
            {
                $this->dados['nome_usuario'] = $_SESSION['user']->nome_usuario;
            }
            $this->load->view($this->template, $this->dados);
        }

        /**********************************************************************/

        /*
         * Função que irá verificar se o susário efetuou login ou não. Caso não
         * efetuar o login e tentar acessar uma página restrita, o mesmo será
         * redirecionado para a página de login
         */
        public function verifica_login($requer_autenticacao)
        {
            if($requer_autenticacao)
            {
                if(!isset($_SESSION['user']))
                {
                    redirect(app_BaseUrl() . 'login');
                }
            }
        }
        /**********************************************************************/
    }
?>