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
     * Painel
     * 
     * A classe Painel é responsável pela visão inicial de todo o sistema, onde
     * aparecem os elementos estáticos, como o menu
     * 
     * @package     Controllers
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.0.0
     * @since		15/09/2014
     */
    class Painel extends MY_Controller
    {
        /**
         * construct()
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
         * Função principal da classe, que vai mostrar o painel do site
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public    
         */
        function index()
        {
            $this->view = 'painel';
            $this->LoadView();
        }
        //**********************************************************************
    }
	/** End of File painel.php **/
    /** Location ./application/controllers/painel.php **/