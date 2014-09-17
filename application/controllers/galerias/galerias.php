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
     * Galerias
     * 
     * Esta classe prove a criação de novas galerias fotográficas, sendo que as 
     * aparecerão dinamicamente no site. A intenção deste módulo é promover a 
     * fácil utilização para criação e edição de galerias de fotos.
     * 
     * @package     Controllers
     * @subpackage  Galerias
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version     v1.3.0
     * @since		15/09/2014
     */
    class Galerias extends MY_Controller
    {
        /**
         * __construct()
         * 
         * Contrução da Classe Galerias
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        public function __construct()
        {
            parent::__construct(TRUE);
            
            /** Realiza o LOAD domodel responsável pela galeria **/
            $this->load->model('galerias_model');
        }
        //**********************************************************************
        
        /**
         * index()
         * 
         * Função principal do controller
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function index()
        {
            $this->view 	= 'galerias/galerias';
            $this->titulo 	= 'Todas as Galerias';
            
            $this->LoadView();
        }
        //**********************************************************************
        
        /**
         * salvar_galeria()
         * 
         * Função desenvolvida para salvar os dados preliminares da galeria
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool retorna 1 se salvar e 0 se não salvar
         */
        function salvar_galeria()
        {   
            $dados['nome_galeria']      = $this->input->post('nome_galeria');            
            $dados['data_realizacao']   = $this->input->post('data');
            
            echo $this->galerias_model->salva_galeria($dados);
        }
        //**********************************************************************
        
        /**
         * busca_galerias()
         * 
         * Função que exibe as galerias cadastradas
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function busca_galerias()
        {
            $this->dados['galerias'] = $this->galerias_model->busca_galerias();
            
            $this->load->view('paginas/paginados/galerias/galerias', $this->dados);
        }
        //**********************************************************************
    }
    /** End of File galerias.php**/
    /** Location ./application/controllers/galerias/galerias.php **/