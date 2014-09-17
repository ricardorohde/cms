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
    
    if(!function_exists('app_baseurl'))
    {
    	/**
    	 * app_baseurl()
    	 * 
    	 * Função auxiliar que adiciona 'index.php?/' à url solicitada
    	 * 
    	 * @package		Helpers
    	 * @author		José Aparecido Rocha <cidjarc@gmail.com>
         * @access		Public
    	 * @return 		String
    	 */
        function app_baseurl()
        {
            return base_url().'index.php?/';
        }
        //**********************************************************************
    }
    /** End of File appbaseurl_helper.php **/
    /** Location ./application/helpers/appbaseurl_helper.php **/