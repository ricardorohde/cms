<?php
	class Descricao_model extends MY_Model
	{
        /*
		 * Construção da classe
		 */
		public function __construct()
		{
			parent::__construct();
			$this->_tabela = 'descricao';
			$this->_id = 'id';
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função que faz a busca das descrições já cadastradas
		 */
		function busca_descricoes()
		{
			$this->BD->select('descricao.id, sigla, titulo_barraca, descricao, valor, valor_fim_semana');
            $this->BD->join('valores', 'valores.id = descricao.id_valores');
			$query = $this->BD->get($this->_tabela);
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função que salva na base de dados uma nova descrição
		*/
		function salvar_descricao($dados)
		{
			$data = array(
				'sigla' => $dados['sigla'],
				'titulo_barraca' => $dados['titulo_barraca'],
				'descricao' => $dados['descricao'],
                'id_valores' => $dados['id_valores']
			);
			$query = $this->BD->insert($this->_tabela, $data);
			return $query;
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função para excluir uma função
		*/
		function excluir($id)
		{
			$this->BD->where('id', $id);
			$query = $this->BD->delete($this->_tabela);
			return $query;
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função que faz a busca das descrições já cadastradas
		*/
		function busca_byId($id)
		{
			$this->BD->select('*');
			$this->BD->where('id', $id);
			$query = $this->BD->get($this->_tabela);
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função que atualiza uma descrição cadastrada
		*/
		function atualizar_descricao($dados)
		{
			$data = array(
				'sigla' => $dados['sigla'],
				'titulo_barraca' => $dados['titulo_barraca'],
				'descricao' => $dados['descricao']
			);
			$this->BD->where('id', $dados['id']);
			$query = $this->BD->update($this->_tabela, $data);
			return $query;
		}
		//----------------------------------------------------------------------
	}
?>