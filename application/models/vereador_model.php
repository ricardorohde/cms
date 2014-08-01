<?php
    class Vereador_model extends MY_Model
    {
        /*
         * Função desenvolvida para construir a classe
         */
        public function __construct()
        {
            parent::__construct();
            $this->_tabela = 'vereadores';
            $this->_primary = 'id';
        }
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para salvar os dados do vereador 
         */
        function salva_vereador($dados)
        {
            $data = array(
                'nome_vereador' => $dados['nome_vereador'],
                'legenda' => $dados['legenda'],
                'foto' => $dados['foto']
            );
            
            $query = $this->BD->insert($this->_tabela, $data);
            if(!$query)
            {
                return FALSE;
            }
            else
            {
                return $query;
            }
        }
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para atualizar os dados de um vereador
         */
        function atualiza_vereador($dados)
        {
            $data = array(
                'nome_vereador' => $dados['nome_vereador'],
                'legenda' => $dados['legenda'],
                'foto' => $dados['foto']
            );
            
            $this->BD->where(array('id' => $dados['id']));
            $query = $this->BD->update($this->_tabela, $data);
            if(!$query)
            {
                return FALSE;
            }
            else
            {
                return $query;
            }
        }
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para realizar a busca de todos vereadores ativos
         * (status = 1), para realizar a paginação de conteúdo
         */
        function lista_vereadores($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->select('*');
            $this->BD->where(array('status' => 1));
            $this->BD->order_by('id');
            $query = $this->BD->get($this->_tabela);
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
        }
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para contar a quantidade de vereadores ativos
         * (status = 1)
         */
        function conta_vereadores()
        {
            $this->BD->where(array('status' => 1));
            return $this->BD->count_all_results($this->_tabela);
        }
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para buscar dados do vereador ativo (status = 1)
         * e de acordo com a id passada como parâmatro
         */
        function busca_vereadorId($id)
        {
            $this->BD->select('*');
            $this->BD->where(array('id' => $id, 'status' => 1));
            $query = $this->BD->get($this->_tabela);
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
        }
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para marcar o vereador como inativo (status = 0)
         */
        function inativar_vereador($id)
        {
            $data = array(
                'status' => 0
            );
            $this->BD->where(array('id' => $id));
            $query = $this->BD->update($this->_tabela, $data);
            return $query;
        }
        //----------------------------------------------------------------------
    }
?>
