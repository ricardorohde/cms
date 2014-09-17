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
	 * Calendario
	 *
	 * Classe desenvolvida para exibição da interface do calendário
	 *
	 * @package		Controllers
	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version     v1.1.0
	 * @since		15/09/2014
	 */
    class Calendario extends MY_Controller
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
            parent::__construct(TRUE);
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
            $this->load->view('paginas/calendario');
        }
        //**********************************************************************
    }
    /** End of File Calendário.php **/
    /** Location ./application/controllers/calendario.php **/