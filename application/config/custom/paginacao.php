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
	 * -------------------------------------------------------------------
	 * PAGINACAO
	 * -------------------------------------------------------------------
	 * Este arquivo é utilizado para guardar as configurações principais
	 * que serão utilizadas na paginação de diversas buscas no decorrer da
	 * execução do sistema
	 *
	 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @package		Config
	 * @subpackage	Custom
	 * @version		v1.0.0
	 * @since		15/09/2014
	 */

	/**
	 * Variáveis que recebem os elementos html que serão exibidos no montar da
	 * paginação
	 * 
	 * @var	array
	 */
	$config['full_tag_open']	= '<ul class="pagination">';
	$config['full_tag_close'] 	= '</ul>';
	$config['first_link'] 		= 'Primeiro';
	$config['first_tag_open'] 	= '<li>';
	$config['first_tag_close'] 	= '</li>';
	$config['last_link']	 	= 'Último';
	$config['last_tag_open'] 	= '<li>';
	$config['last_tag_close'] 	= '</li>';
	$config['next_link'] 		= 'Próximo &rarr;';
	$config['next_tag_open'] 	= '<li>';
	$config['next_tag_close'] 	= '</li>';
	$config['prev_link'] 		= '&larr; Anterior';
	$config['prev_tag_open'] 	= '<li>';
	$config['prev_tag_close'] 	= '</li>';
	$config['cur_tag_open'] 	= '<li class="active"><a>';
	$config['cur_tag_close'] 	= '</a></li>';
	$config['num_tag_open'] 	= '<li>';
	$config['num_tag_close'] 	= '</li>';