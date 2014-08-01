<?php

    class Contato_Model extends MY_Model
    {

        /**
         * Construção da classe
         */
        public function __construct()
        {
            parent::__construct();
            $this->_tabela = 'contato';
            $this->_primary = 'id';
        }
        //----------------------------------------------------------------------

        /**
         * Função que faz a listagem dos contatos, de acordo com o limite
         * e o offset que foi passado na função index para fazer a paginação
         */
        function lista_contatos($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->select('*');
            $this->BD->order_by('data', 'desc');
            $query = $this->BD->get($this->_tabela);
            if ($query->num_rows() > 0)
            {
                return $query->result();
            }
        }
        //----------------------------------------------------------------------

        /**
         * Função que busca e conta as mensagens da tabela contato que estão 
         * ativas (Status == 1)
         */
        function conta_contatos()
        {
            return $this->BD->count_all_results($this->_tabela);
        }

        //----------------------------------------------------------------------
        //Função que atualiza os registros da tabela contato
        function marcar_lido($id)
        {
            $dados['status'] = '0';
            $this->BD->where(array('id' => $id));
            $query = $this->BD->update($this->_tabela, $dados);
            return $query;
        }

        //----------------------------------------------------------------------

        /*
         * Função desenvolvida para buscar uma tupla específica de contatos a 
         * partir de um id
         */
        function buscar_contato($id)
        {
            $this->BD->select("*");
            $this->BD->where(array("id" => $id));
            $query = $this->BD->get($this->_tabela);
            if ($query->num_rows() > 0)
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