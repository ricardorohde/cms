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
	 * redimensiona_imagem_library
	 * 
	 * Classe desenvolvida para realizar redimensionamento de imagens
	 * 
	 * @package		Libraries
	 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version		v1.0.0
	 * @since		06/10/2014
	 */
	class Redimensiona_imagem_library extends CI_Controller
	{
		/**
		 * redimensionar()
		 * 
		 * Função desenvolvida para promover o redimensionamento da imagem
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @param		string 	$source_imagem	Contém o caminho da imagem
		 * @param		int 	$width			Contém o width da nova imagem
		 * @param		int		$height			Contém o height da nova imagem
		 * @return		String Retorna uma mensagem para o usuário
		 */
		function redimensionar($source_imagem, $width, $height)
		{
			// Recebe uma instância do CodeIgniter
			$CI = &get_instance();
			
			// Carrega a library de manipulação de imagem
			$this->load->library('image_lib');
			
			// Configurações do redimensionamento
			$config['image_library']    = 'GD2';
			$config['maintain_ratio']   = FALSE;
			$config['create_thumb']     = FALSE;
			$config['width']    		= $width;
			$config['height']   		= $height;
			$config['quality']			= "75%";
			$config['source_image']		= ".." . $source_imagem;
			
			// Inicializa a classe `image_lib`
			$this->image_lib->initialize($config);
			
			return (!$this->image_lib->resize()) ? "A imagem não foi redimensionada" : "A imagem foi redimensionada";
		}
		//**********************************************************************
	}
	/** End of File redimensiona_imagem_library.php **/
	/** Location ./application/libraries/redimensiona_imagem_library.php **/