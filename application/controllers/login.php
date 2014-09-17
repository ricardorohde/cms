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
	 * Login
	 *
	 * Classe responsável pelas operações de login
	 *
	 * @package		Controllers
	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version     v1.2.0
	 * @since		15/09/2014
	 */
    class Login extends MY_Controller
    {
    	/**
    	 * __construct()
    	 * 
    	 * Realiza a construção da classe
    	 * 
    	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
    	 */
		public function __construct()
        {
            parent::__construct(FALSE);
            
            //Realiza o LOAD do model responsável
            $this->load->model('usuarios');
        }
        //**********************************************************************

        /**
         * index()
         * 
         * Função principal da classe, responsável pela view inicial
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
         */
        function index()
        {
            $this->template	= 'template/login';
            $this->titulo	= 'MasterAdmin - Fazer Login';
            $this->view 	= 'login';
            
            $this->LoadView();
        }
        //**********************************************************************

        /**
         * logar()
         * 
         * Função desenvolvida para realizar o login. São passados 2 parâmetros
         * (login e senha). Nesta caso, os parâmetros são utilizados, por exemplo,
         * na recuperação de senha
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @return		int Retorna 1 se logar e 2 se não logar
         */
        function logar()
        {
        	
        	$login = $this->input->post('login');
        	$senha = md5($this->input->post('senha'));
        	
        	$this->load->library('loginlibrary');
        	
        	$resposta = $this->loginlibrary->FazerLogin($login, $senha);
        	
        	//Imprime 1 em caso de sucesso e 2 em caso de erro
        	echo ($resposta == TRUE) ?  1 : 2;
        }
        //**********************************************************************

        /**
         * logoff()
         * 
         * Realiza o logoff do usuário
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
         */
        function logout()
        {
            unset($_SESSION['user']);
            session_destroy();
            redirect(app_baseUrl());
        }
        //**********************************************************************
    }
    /** End of File Login.php **/
    /** Location ./application/controllers/login.php **/