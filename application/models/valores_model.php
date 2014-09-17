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
	 * Valores_model
	 * 
	 * Classe desenvolvida para gerenciar as transações com a tabela valores
	 * 
	 * @package		Models
	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version		v1.1.0
	 * @since		16/09/2014
	 *
	 */
	class Valores_model extends MY_Model
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
			parent::__construct();
			
			$this->_tabela = 'valores';
		}
		//**********************************************************************
		
		/**
		 * busca_valores()
		 * 
		 * Função que busca todos os valores cadastrados
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @return		array Retorna um array de valores
		 */
		function busca_valores()
		{
			$this->BD->order_by('valor');
			
			return $this->BD->get($this->_tabela)->result();
		}
		//**********************************************************************
		
		/**
		 * salvar_valor()
		 *  
		 * Função desenvolvida para salvar um valor no banco de dados
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		array $dados Contém os dados que serão salvos
	 	 * @return		bool Retorna TRUE se salvar e FALSE se não salvar
		 */
		function salvar_valor($dados)
		{
			$this->_data = array(
				'valor' => $dados['valor'],
				'valor_fim_semana' => $dados['valor_fim_semana']
			);
			
			return parent::save();
		}
		//**********************************************************************
		
		/**
		 * excluir_valor()
		 *  
		 * Função desenvolvida para excluir um valor do banco de dados
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $id Contém o ID do registro a ser excluido
		 */
		function excluir_valor($id)
		{
			$this->_primaria = $id;
			
			return parent::delete();
		}
		//**********************************************************************
		
		/**
		 * buscar_valor
		 * 
		 * Função para buscar um valor para ser editado
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $id Contém o ID do registro a ser buscado
	 	 * @return		array Retorna um array com os valores do registro 
	 	 * 				selecionado
	 	 * 
		 */
		function busca_valor($id)
		{
			$this->BD->where(array('id' => $id));
			
			return $this->BD->get($this->_tabela)->result();
		}
		//**********************************************************************
		
		/**
		 * altera_valor()
		 * 
		 * Função desenvolvida para alterar um valor de uma barraca
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		array $dados Contém os dados que serão atualizados
	 	 * @return		bool Retorna TRUE se atualizar e FALSE se não atualizar
		 */
		function altera_valor($dados)
		{
			$this->_data = array(
				'valor' => $dados['valor'],
				'valor_fim_semana' => $dados['valor_fim_semana']
			);
			$this->_primaria = $dados['id'];
			
			return parent::update();
		}
		//**********************************************************************
	}
	/** End of File valores_model.php **/
	/** Location ./application/models/valores_model.php **/