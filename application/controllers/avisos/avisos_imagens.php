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
	 * avisos_imagens
	 * 
	 * Classe desenvolvida para CRUD de avisos com imagens, ao invéz do aviso
	 * convencional de texto
	 * 
	 * @package		Controllers
	 * @subpackage	Avisos
	 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version		v1.0.0
	 * @since		07/10/2014
	 */
	class Avisos_imagens extends MY_Controller
	{
		/**
		 * __construct()
		 * 
		 * Realiza a construção da classe
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 */
		public function __construct()
		{
			parent::__construct(TRUE);
			
			/** Realiza o LOAD do model necessário **/
			$this->load->model('avisos/avisos_imagens_model', 'avisos_imagens');
		}
		//**********************************************************************
		
		/**
		 * index()
		 * 
		 * Função inicial da classe, responsável pela view inicial
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 */
		function index()
		{
			$this->load->view('paginas/avisos/avisos_imagens');
		}
		//**********************************************************************
		
		/**
		 * buscar()
		 * 
		 * Função desenvolvida para buscar os avisos cadastrados
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @param		int $offset Recebe o offset que será usado no sql
		 */
		function buscar($offset = 0)
		{
			// Recebe o limite da consulta sql
			$limite = 20;
			
			// Recebe os dados da consulta
			$this->dados['avisos'] = $this->avisos_imagens->buscar(NULL, $limite, $offset);
			
			// Verifica se o offset é maior que zero e se a consulta retorna valor
			if(!$this->dados['avisos'] AND $offset > 0)
			{
				$offset = $offset - $limite;
				$this->dados['avisos'] = $this->avisos_imagens->buscar(NULL, $limite, $offset);
			}
			
			// Configurações de paginação
			$config['uri_segment']	= 4;
			$config['base_url']     = app_baseurl().'avisos/avisos_imagens/buscar';
			$config['per_page']     = $limite;
			$config['total_rows']	= $this->avisos_imagens->contar();
			
			//Inicializa a paginação
			$this->pagination->initialize($config);
			$this->dados['paginacao'] 	= $this->pagination->create_links();
			$this->dados['offset']		= $offset;

			$this->load->view('paginas/paginados/avisos/avisos_imagens', $this->dados);
		}
		//**********************************************************************
		
		/**
		 * salvar_aviso()
		 * 
		 * Função desenvolvida para salvar um novo aviso
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @return		bool Retorna TRUE se salvar e FALSE se não salvar
		 */
		function salvar_aviso()
		{
			$dados['imagem']			= $this->input->post('imagem');
			$dados['data_expiracao']	= $this->input->post('data_expiracao');
			
			echo $this->avisos_imagens->salvar($dados);
		}
		//**********************************************************************
		
		/**
		 * executa_acao()
		 * 
		 * Função desenvolvida para executar ações pertinentes, como ativar, 
		 * inativar ou excluir um aviso
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @return		bool Retorna TRUE se executar corretamente e FALSE se 
		 * 				não executar com esperado
		 */
		function executa_acao()
		{
			$id 	= $this->input->post('id');
			$acao	= $this->input->post('acao');
			
			switch ($acao)
			{
				case 'ativar':
					$dados = array('status' => 1);
					echo $this->avisos_imagens->update($id, $dados);
					break;
				case 'inativar':
					$dados = array('status' => 0);
					echo $this->avisos_imagens->update($id, $dados);
					break;
				case 'excluir':
					echo $this->avisos_imagens->delete($id);
					break;
			}
		}
		//**********************************************************************
		
		/**
		 * editar()
		 * 
		 * Função desenvolvida para buscar os dados para edição
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 */
		function editar()
		{
			$this->dados['aviso'] = $this->avisos_imagens->buscar($this->input->post('id'));
			
			
			$this->load->view('paginas/editores/avisos/avisos_imagens', $this->dados);
		}
		//**********************************************************************
		
		/**
		 * salvar_edicao()
		 * 
		 * Função desenvolvida para atualizar os dados de um aviso cadastrado
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @return		bool Retorna TRUE se atualizar e FALSE se não atualizar
		 */
		function salvar_edicao()
		{
			$id = $this->input->post('id');
			
			$dados = array(
				'data_expiracao'	=> $this->input->post('data_expiracao'),
				'imagem'			=> $this->input->post('imagem')
			);
			
			echo $this->avisos_imagens->update($id, $dados);
		}
		//**********************************************************************
	}
	/** End of File avisos_imagens.php **/
	/** Location ./application/controllers/avisos/avisos_imagens.php **/