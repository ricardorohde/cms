<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Content Manegement System
	 * 
	 * Sistema desenvolvido para facilitar a inserção e atualização de dados no
	 * site do Pentáurea Clube
	 * 
	 * @package		CMS
	 * @author		Masterkey Informática
	 * @copyright	Copyright (c) 2010 - 2014, Masterkey Informática LTDA
	 */
	
	/**
	 * MY_Controller
	 * 
	 * Subclasse padrão do sistema. Todas as variáveis protegidas que serão
     * utilizadas pelos controllers são definidas aqui, além de algumas funções
     * globais. Todas os controllers devem extender a esta classe
	 * 
	 * @package		Core
	 * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version		v1.1.0
	 * @since		15/09/2014
	 *
	 */
    class MY_Controller extends CI_Controller
    {
    	/**
    	 * Variável que receberá o template que será exibido ao usuário final
    	 * 
    	 * @var string
    	 */
		protected $template;
		
		/**
		 * Variável que receberá os dados que serão exibidos aos usuário final
		 *
		 * @var	string
		 */
        protected $dados;
        
        /**
         * Variável que recebe a visão que será inserida no template
         *
         * @var	string
         */
        protected $view;
        
        /**
         * Variável que recebe o título que a página requisitada receberá
         *
         * @var	string
         */
        protected $titulo;

        /**
         * __construct()
         * 
         * Realiza a construção da classe
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		Bool $requer_autenticacao É utilizada para controlar as 
         *              páginas que necessitam de login		
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct();
            
            session_start();
            
            $this->template	= 'template/default';
            $this->titulo 	= 'Gerenciador de Conteúdo';
            
            $this->verifica_login($requer_autenticacao);
            
            /** Realiza o load da configuração de paginação e a inicializa **/
            
			$this->config->load('custom/paginacao', true);
			$config_paginacao = $this->config->item('custom/paginacao');
			
            $this->pagination->initialize($config_paginacao);
        }
        //**********************************************************************

        /**
         * LoadView()
         * 
         * Função responsável por fazer a integração entre a view os dados 
         * e o template
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         */
        public function LoadView()
        {
            $this->dados['view']	= $this->view;
            $this->dados['titulo'] 	= $this->titulo;
            
            if(isset($_SESSION['user']))
            {
                $this->dados['nome_usuario'] = $_SESSION['user']->nome_usuario;
            }
            
            $this->load->view($this->template, $this->dados);
        }
        //**********************************************************************

        /**
         * verifica_login()
         * 
         * Verifica se a página solicitada necessita de login efetuado. Se o 
         * usuário não tiver efetuado o login, o redireciona para a página 
         * principal, para que possa efetuar o mesmo
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param       Bool $requer_autenticacao É utilizada para controlar as 
         *              páginas que necessitam de login
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
	/** End of File MY_Controller.php **/
    /** Location ./application/core/MY_Controller.php **/