<?php
    class Sugestoes_Model extends MY_Model
    {
        /*
         * Construção da Casse e definições de tabela
         */
        public function __construct()
        {
            parent::__construct();
            $this->_tabela = 'sugestao';
            $this->_primary = 'id';
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que realiza a busca e faz a listagem das sugestões salvas,
         * estando estas com status de ativa (status = 1)
         */
        function lista_sugestoes($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->select('*');
            $this->BD->where(array('status' => 1));
            $this->BD->order_by('data', 'desc');
            $query = $this->BD->get($this->_tabela);
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que busca e conta as mensagens da tabela sugestao que estão 
         * ativas (Status == 1)
         */
        function conta_sugestoes()
        {
            $this->BD->where(array('status' => 1));
            return $this->BD->count_all_results($this->_tabela);
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que atualiza os registros da tabela sugestão
         */
        function marcar_lido($id_sugestao)
        {
            $dados['status'] = '0';
            $this->BD->where(array('id' => $id_sugestao));
            $query = $this->BD->update($this->_tabela, $dados);
            return $query;
        }
        //----------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para buscar uma tupla específica de sugestoes a partir de um id
		 */
		function buscar_sugestao($id)
		{
			$this->BD->select("*");
			$this->BD->where(array("id" => $id));
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
    }
?>
