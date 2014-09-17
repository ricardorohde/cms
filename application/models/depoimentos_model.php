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
	 * Depoimentos_model
	 * 
	 * Classe desenvolvida para gerenciar as transações com a tabela 'depoimentos'
	 * 
	 * @package		Models
	 * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version		v1.0.0
	 * @since		17/09/2014
	 */
	class Depoimentos_model extends MY_Model
	{
		/**
		 * __construct()
		 * 
		 * Realiza a construção da classe
		 * 
		 * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public 
		 */
		public function __construct()
		{
			parent::__construct();
			
			$this->_tabela = 'depoimentos';
		}
		//**********************************************************************
		
		/**
		 * get()
		 * 
		 * Função que realiza a busca dos depoimentos cadastrados no BD
		 * 
		 * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $limite Contém o limite da consulta sql
	 	 * @param		int $offset Contém o offset da consulta sql
	 	 * @return		array Retorna um array de depoimentos
		 */
		function get($limite, $offset)
		{
			$this->BD->limit($limite, $offset);
			
			return $this->BD->get($this->_tabela)->result();
		}
		//**********************************************************************
		
		/**
		 * contar()
		 * 
		 * Função desenvolvida para contar a quantidade de depoimentos cadastrados
		 * 
		 * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @return		int Retorna o número de registros na tabela
		 */
		function contar()
		{
			return parent::count();
		}
		//**********************************************************************
		
		/**
		 * update()
		 * 
		 * Função desenvolvida para alterar o status dos depoimentos
		 * 
		 * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		array 	$dados	Contém os dados a serem atualizados
	 	 * @param		int		$id		Contém o ID do registro a ser atualizado
	 	 * @return		bool Retorna TRUE se atualizar e FALSE se não atualizar
		 */
		function update($dados, $id)
		{
			$this->_data		= $dados;
			$this->_primaria	= $id;
			
			return parent::update();
		}
		//**********************************************************************
		
		/**
		 * delete()
		 * 
		 * Função desenvolvida para excluir um depoimento
		 * 
		 * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int	$id	Contém o ID do registro a ser atualizado
	 	 * @return		bool Retorna TRUE se excluir e FALSE se não excluir
		 */
		function delete($id)
		{
			$this->_primaria = $id;
			
			return parent::delete();
		}
		//**********************************************************************
	}
	/** End of File depoimentos_model.php **/
	/** Location ./application/models/depoimentos_model.php **/