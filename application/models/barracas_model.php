<?php

    class Barracas_model extends MY_Model {
        /*
         * Construção da classe
         */

        public function __construct() {
            parent::__construct();
            $this->_tabela = 'barracas';
            $this->_primary = 'id';
        }

        //----------------------------------------------------------------------

        /*
         * Função que realiza a busca das barracas e prepara para paginação
         */
        function lista_barracas($limite, $offset) {
            $this->BD->limit($limite, $offset);
            $this->BD->select('barracas.id, numero_barraca, localizacao, titulo_barraca, descricao, valor, valor_fim_semana');
            $this->BD->join('descricao', 'descricao.id = barracas.id_descricao');
            $this->BD->join('valores', 'valores.id = descricao.id_valores');
            $this->BD->order_by('titulo_barraca');
            $query = $this->BD->get($this->_tabela);
            if ($query->num_rows() > 0) {
                return $query->result();
            }
        }

        //----------------------------------------------------------------------

        /*
         * Função que conta as barracas cadastradas
         */
        function conta_barracas() {
            return $this->BD->count_all_results($this->_tabela);
        }

        //----------------------------------------------------------------------

        /*
         * Função desenvolvida para salvar uma nova barraca na base de dados
         */
        function salvar_barraca($dados) {
            $data = array(
                'numero_barraca' => $dados['numero_barraca'],
                'id_descricao' => $dados['id_descricao'],
                'localizacao' => $dados['localizacao']
            );
            $query = $this->BD->insert($this->_tabela, $data);
            return $query;
        }

        //----------------------------------------------------------------------

        /*
         * Função desenvolvida para excluir uma barraca da base de dados
         */
        function excluir_barraca($id) {
            $this->BD->where('id', $id);
            $query = $this->BD->delete($this->_tabela);
            return $query;
        }

        //----------------------------------------------------------------------
    }

?>