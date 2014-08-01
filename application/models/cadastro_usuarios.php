<?php
    class Cadastro_usuarios extends MY_Model
    {
        /*
         * Construção da classe
        */
        public function __construct()
        {
            parent::__construct();
            $this->_tabela = 'usuarios';
            $this->_primary = 'id';
        }
        //----------------------------------------------------------------------
        
        /*
         * Função criada para cadastrar os dados de um novo usuário
        */
        function cadastrar($dados)
        {
            $data = array(
                'nome_completo' => $dados['nome_completo'],
                'nome_usuario' => $dados['nome_usuario'],
                'senha' => $dados['senha']
            );
            $query = $this->BD->insert($this->_tabela, $data);
            return $query;
        }
        //----------------------------------------------------------------------
        
        /*
         * Função criada para listar todos os usuários
         */
        function lista_usuarios($limite, $offset)
        {   
            $this->BD->limit($limite, $offset);
            $this->BD->select('*');
            $query = $this->BD->get($this->_tabela);
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
            else
            {
                return false;
            }
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que busca e conta as notícias cadastradas com status = 1(ativas)
         */
        function conta_usuarios()
        {
            return $this->BD->count_all_results($this->_tabela);
        }
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para desativar um usuário
         */
        function inativar_usuario($id)
        {
            $data = array(
                'status' => 0
            );
            $this->BD->where(array('id' => $id));
            $query = $this->BD->update($this->_tabela, $data);
            return $query;
        }
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para reativar uma conta de usuário
         */
        function ativar_usuario($id)
        {
            $data = array(
                'status' => 1
            );
            $this->BD->where(array('id' => $id));
            $query = $this->BD->update($this->_tabela, $data);
            return $query;
        }
        //----------------------------------------------------------------------
        
        /*
         * Realiza a busca das permissões cadastradas
         */
        function busca_permissoes($id)
        {
            $this->BD->select('*');
            $this->BD->where(array('id' => $id));
            $query = $this->BD->get('menu_permissoes');
            if($query->num_rows > 0)
            {
                return $query;
            }
            else
            {
                return false;
            }
        }
		//----------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para excluir um usuário da base de dados
		*/
		function excluir_usuario($id)
		{
			$this->BD->where('id', $id);
			$query = $this->BD->delete($this->_tabela);
			if($query == 1)
			{
				$this->BD->where('id_usuario', $id);
				$query = $this->BD->delete('menu_permissoes');
			}
			return $query;
		}
        //----------------------------------------------------------------------
    }
?>