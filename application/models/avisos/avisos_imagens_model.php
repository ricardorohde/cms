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
	 * Avisos_imagens_model
	 * 
	 * Classe desenvolvida para gerenciar as transações com a tabela avisos_imagens
	 * 
	 * @package		Models
	 * @subpackage	Avisos
	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.0.0
     * @since		16/09/2014
	 */
	class Avisos_imagens_model extends MY_Model
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
			parent::__construct();
			
			$this->_tabela = 'avisos_imagens';
		}
		//**********************************************************************
		
		/**
		 * buscar()
		 * 
		 * Função desenvolvida para buscar os avisos cadastrados
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @param		int $id		Recebe o ID do registro a ser buscado
		 * @param		int $limite Define o limite da consulta sql
		 * @param		int $offset Define o offset da consulta sql
		 * @return		array Retorna um array de avisos
		 */
		function buscar($id = NULL, $limite = NULL, $offset = NULL)
		{
			if($id)
			{
				$this->BD->where('id', $id);
				return $this->BD->get($this->_tabela)->result();
			}
			else
			{
				$this->BD->limit($limite, $offset);
				$this->BD->order_by('id', 'desc');
					
				return $this->BD->get($this->_tabela)->result();
			}
		}
		//**********************************************************************

		/**
		 * contar()
		 * 
		 * Função desenvolvida para contar os registros da tabela
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @return		int Retorna o número de registros na tabela
		 */
		function contar()
		{
			return parent::count();
		}
		//**********************************************************************
		
		/**
		 * salvar()
		 * 
		 * Função desenvolvida para salvar um novo aviso
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @param		array 	$dados Contém os dados que serão salvos
		 * @return		bool	Retorna TRUE se salvar e FALSE se não salvar
		 */
		function salvar($dados)
		{
			$this->_data = array(
				'imagem'			=> $dados['imagem'],
				'data_expiracao'	=> $dados['data_expiracao'],
				'status'			=> 1
			);
			
			return parent::save();
		}
		//**********************************************************************
		
		/**
		 * update()
		 * 
		 * Função desenvolvida para realizar alterações em registros cadastrados
		 * na base
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @param		int 	$id 	Contém o ID do registro a ser modificado
		 * @param		array	$dados	Contém os dados a serem atualizados
		 * @return		bool	Retorna TRUE se atualizar e FALSE se não atualizar
		 */
		function update($id, $dados)
		{
			$this->_primaria	= $id;
			$this->_data		= $dados;
			
			return parent::update();
		}
		//**********************************************************************
		
		/**
		 * delete()
		 * 
		 * Função desenvolvida para apagar um registro da base de dados
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @param		int $id Contém o ID do registro a ser excluido
		 * @return		bool Retorna TRUE se apagar e FALSE se não apagar
		 */
		function delete($id)
		{
			$this->_primaria = $id;
			
			return parent::delete();
		}
		//**********************************************************************
	}
 	/** End of File avisos_imagens_model.php **/
	/** Location ./application/models/avisos/avisos_imagens_model.php **/