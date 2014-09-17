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
	 * Descricao_model
	 * 
	 * Classe desenvolvida para gerenciar as transações envolvendo a tabela
	 * descricao
	 *
	 * @package		Models
	 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version		v1.1.0
	 * @since		16/09/2014
	 */
	class Descricao_model extends MY_Model
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
			
			$this->_tabela = 'descricao';
		}
		//**********************************************************************
		
		/**
		 * busca_descricoes()
		 * 
		 * Função que faz a busca das descrições já cadastradas
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @return		array Retorna um array de descrições
		 */
		function busca_descricoes()
		{
			$this->BD->select('descricao.id, sigla, titulo_barraca, descricao, valor, valor_fim_semana');
            $this->BD->join('valores', 'valores.id = descricao.id_valores');
			
            return $this->BD->get($this->_tabela)->result();
		}
		//**********************************************************************
		
		/**
		 * salvar_descricao()
		 * 
		 * Função que salva na base de dados uma nova descrição
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		array $dados Contém os dados que serão salvos
	 	 * @return		bool Retorna TRUE se salvar e FALSE se não salvar
		 */
		function salvar_descricao($dados)
		{
			$this->_data = array(
				'sigla' 			=> $dados['sigla'],
				'titulo_barraca' 	=> $dados['titulo_barraca'],
				'descricao' 		=> $dados['descricao'],
                'id_valores' 		=> $dados['id_valores']
			);
			
			return parent::save();
		}
		//**********************************************************************
		
		/**
		 * excluir()
		 * 
		 * Função para excluir uma descrição cadastrada
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $id Contém o ID do registro a ser eliminado
	 	 * @return		bool Retorna TRUE se excluir e FALSE se não excluir
		 */
		function excluir($id)
		{
			$this->_primaria = $id;
			
			return parent::delete();
		}
		//**********************************************************************
		
		/**
		 * busca_biyId
		 * 
		 * Função que faz a busca das descrições já cadastradas
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $id Contém o ID do registro a ser buscado
	 	 * @return		array Retorna um array com a descrição buscada
		 */
		function busca_byId($id)
		{
			$this->BD->where('id', $id);
			
			return $this->BD->get($this->_tabela)->result();
		}
		//----------------------------------------------------------------------
		
		/**
		 * atualizar_descricao()
		 * 
		 * Função que atualiza uma descrição cadastrada
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		array $dados Contém os dados a serem atualizados
		 */
		function atualizar_descricao($dados)
		{
			$this->_data = array(
				'sigla' 			=> $dados['sigla'],
				'titulo_barraca' 	=> $dados['titulo_barraca'],
				'id_valores'		=> $dados['id_valores'],
				'descricao' 		=> $dados['descricao']
			);
			
			$this->_primaria = $dados['id'];
			
			return parent::update();
		}
		//**********************************************************************
	}
	/** End of File descricao_model.php **/
	/** Location ./application/models/descricao_model.php **/