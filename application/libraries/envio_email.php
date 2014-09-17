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
     * Envio_email
     * 
     * Classe desenvolvida para chamar e inicializar a classe PHPMailer
     * 
     * @package		Libraries
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.1.0
     * @since		16/09/2014
     */
    class Envio_email {
        
        /**
         * load_mailer()
         * 
         * Função desenvolvida para chamar a classe PHPMailer
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return      Retorna uma instância da classe chamada
         */
        function load_mailer()
        {
            $CI = & get_instance();
            
            include_once APPPATH.'/third_party/phpmailer/PHPMailerAutoload.php';
            
            return new PHPMailer();
        }
        //**********************************************************************
    }
    /** End of File email.php **/
    /** Location ./application/libraries/email.php **/