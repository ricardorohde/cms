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
     * Configuracoes_email.php
     * 
     * Arquivo que contém a classe configuracoes_email
     * 
     * @package     Controllers
     * @subpackage  Config
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version     v1.2.0
     * @since		15/09/2014
     */
    class Configuracoes_email extends MY_Controller
    {
        /**
         * __construct()
         * 
         * Realiza a construção da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        public function __construct()
        {
            parent::__construct(TRUE);
            
            //Realiza o LOAD do model necessário
            $this->load->model('email_model', 'email');
        }
        //**********************************************************************
        
        /**
         * index()
         * 
         * Função principal da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function index()
        {
            $this->load->view('paginas/config/configuracoes_email');
        }
        //**********************************************************************
        
        /**
         * buscar_config()
         * 
         * Realiza a busca das configurações de email
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function buscar_config()
        {
            $this->dados['config'] = $this->email->buscar();
            
            $this->load->view('paginas/paginados/config/config_email', $this->dados);
        }
        //**********************************************************************
        
        /**
         * salvar()
         * 
         * Função desenvolvida para salvar/ atualizar as configurações de envio
         * de email
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         */
        function salvar()
        {
        	$dados['id'] 			= $this->input->post('id');
        	$dados['smtp_host'] 	= $this->input->post('smtp_host');
        	$dados['smtp_port'] 	= $this->input->post('smtp_port');
        	$dados['smtp_userName'] = $this->input->post('smtp_userName');
        	$dados['smtp_password'] = $this->input->post('smtp_password');
        	$dados['smtp_secure']	= $this->input->post('smtp_secure');
        	$dados['smtp_from'] 	= $this->input->post('smtp_from');
        	$dados['smtp_fromName'] = $this->input->post('smtp_fromName');
        	
        	if ($this->email->processar($dados) == 1)
        	{
        		echo 1;
        	}
        	else
        	{
        		echo 0;
        	}
        }
        //**********************************************************************
    }
    /** End of File configuracoes_email.php **/
    /** Location ./application/controllers/config/configuracoes_email.php **/