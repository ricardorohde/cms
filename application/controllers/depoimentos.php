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
	 * Depoimentos
	 * 
	 * Classe desenvolvida para gerenciar os depoimentos que foram inseridos pelo
	 * público no site
	 * 
	 * @package		Controllers
	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version     v1.0.0
	 * @since		17/09/2014
	 */
	class Depoimentos extends MY_Controller
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
			
			//Realiza o LOAD do model necessário para operações
			$this->load->model('depoimentos_model', 'depoimentos');
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
			$this->load->view('paginas/depoimentos');
		}
		//**********************************************************************
		
		/**
		 * buscar()
		 * 
		 * Função desenvolvida para buscar os ddepoimentos cadastrados, além de
		 * realizar a paginação
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $offset Recebe o offset que será usado na consulta 
	 	 * 				sql
		 */
		function buscar($offset = 0)
		{
			//Variável que recebe o limite da consulta sql
			$limite = 20;
			
			//Recebe os valores da função que busca os dados no BD
			$this->dados['depoimentos'] = $this->depoimentos->get($limite, $offset);
			
			if(!$this->dados['depoimentos'] && $offset > 0)
			{
				$offset = $offset - $limite;
			}
			
			//Configurações relativas à paginação
			$config['base_url']		= app_baseurl().'depoimentos/buscar';
			$config['per_page']		= $limite;
			$config['total_rows']	= $this->depoimentos->contar();
			
			//Inicializa a paginação
			$this->pagination->initialize($config);
			
			//Recebe os links e cria um verificador que será passado ao Javascript
			$this->dados['paginacao']	= $this->pagination->create_links();
			$this->dados['verificador']	= $offset;
			
			//Carrega a view
			$this->load->view('paginas/paginados/depoimentos', $this->dados);
		}
		//**********************************************************************
		
		/**
		 * executa_acao()
		 * 
		 * Função desenvolvida para ativar, inativar ou excluir um depoimento
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @return		bool Retorna TRUE em caso de sucesso ou FALSE em caso de
	 	 * 				falhas
		 */
		function executa_acao()
		{
			$id 	= $this->input->post('id');
			$acao	= $this->input->post('acao');
			
			switch ($acao)
			{
				case 'inativar':
					$dados = array('status' => 0);
					echo $this->depoimentos->update($dados, $id);
					break;
				case 'ativar':
					$dados = array('status' => 1);
					echo $this->depoimentos->update($dados, $id);
					break;
				case 'excluir':
					echo $this->depoimentos->delete($id);
					break;
			}
		}
		//**********************************************************************
	}
	/** End of File depoimentos.php **/
	/** Location ./application/controllers/depoimentos.php **/