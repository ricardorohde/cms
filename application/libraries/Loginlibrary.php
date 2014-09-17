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
	 * Loginlibrary
	 *
	 * Classe para realização do Login
	 *
	 * @package		Libraries
	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version     v1.0.1
	 * @since		16/09/2014
	 */
	class Loginlibrary extends CI_Controller
	{
		/**
		 * FazerLogin()
		 * 
		 * Função desenvolvida para realizar a autenticação do usuário do sistema
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		string $login Recebe o login do usuário
	 	 * @param		string $senha Recebe a senha do usuário
	 	 * @return		bool Retorna TRUE se fazer o login e FALSE se não fazer
		 */
		function FazerLogin($login, $senha)
		{
			$CI = &get_instance();
			
			$this->load->model('usuarios');
			
			if ($login || $senha)
			{
				$usuario = $this->usuarios->autenticar($login, $senha);
				if ($usuario)
				{
					$_SESSION['user'] = $usuario;
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
		}
		//**********************************************************************
	}
	/** End of File LoginLibrary.php **/
	/** Location ./application/libraries/LoginLibrariy.php **/