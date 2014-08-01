<?php
	class Valores_model extends MY_Model
	{
		/*
		 * Contrutor da classe
		*/
		public function __construct()
		{
			parent::__construct();
			$this->_tabela = 'valores';
			$this->_primary = 'id';
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função que busca todos os valores cadastrados
		*/
		function busca_valores()
		{
			$this->BD->select('*');
			$query = $this->BD->get($this->_tabela);
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para salvar um valor no banco de dados
		*/
		function salvar_valor($dados)
		{
			$data = array(
				'valor' => $dados['valor'],
				'valor_fim_semana' => $dados['valor_fim_semana']
			);
			$query = $this->BD->insert($this->_tabela, $data);
			return $query;
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para excluir um valor do banco de dados
		*/
		function excluir_valor($id)
		{
			$this->BD->where(array('id' => $id));
			$query = $this->BD->delete($this->_tabela);
			return $query;
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função para buscar um valor para ser editado
		*/
		function busca_valor($id)
		{
			$this->BD->select('*');
			$this->BD->where(array('id' => $id));
			$query = $this->BD->get($this->_tabela);
			return $query->result();
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para alterar um valor de uma barraca
		*/
		function altera_valor($dados)
		{
			$data = array(
				'valor' => $dados['valor'],
				'valor_fim_semana' => $dados['valor_fim_semana']
			);
			$this->BD->where('id', $dados['id']);
			$query = $this->BD->update($this->_tabela, $data);
			return $query;
		}
		//----------------------------------------------------------------------
	}
?>