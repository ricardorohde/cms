<?php
    /**
     * A classe Presidentes_model é responsável pelas transações ocorridas na 
     * tabela ex-presidentes
     */
    class Presidentes_model extends MY_Model
    {
        /**
         * Instanciação da classe
         */
        public function __construct()
        {
            parent::__construct();
            $this->_tabela = 'ex-presidentes';
            $this->_primary = 'id';
        }
        //----------------------------------------------------------------------
        
        /**
         * Função desenvolvida para salvar um novo presidente na base de dados
         */
        function salvar($dados)
        {
            $data = array(
                'nome'              => $dados['nome'],
                'inicio_mandato'    => $dados['inicio_mandato'],
                'fim_mandato'       => $dados['fim_mandato'],
                'foto'              => $dados['foto'],
                'status'            => $dados['status']
            );
            
            return $this->BD->insert($this->_tabela, $data);
        }
        //----------------------------------------------------------------------
        
        /**
         * Função desenvolvida para buscar os presidentes cadastrados na base de
         * dados
         */
        function buscar($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->select('*');
            $this->BD->order_by('inicio_mandato', 'desc');
            $query = $this->BD->get($this->_tabela);
            return $query->result();
        }
        //----------------------------------------------------------------------
        
        /**
         * Função desenvolvida para contar a quantidade de presidentes 
         * cadastrados
         */
        function conta_presidentes()
        {
            return $this->BD->count_all_results($this->_tabela);
        }
        /**********************************************************************/
        
        /**
         * @name        excluir()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para excluir um ex presidente
         * @param       int $id Contém o ID do presidente a ser excluído
         * @return      bool    Retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir($id)
        {
            $this->BD->where($this->_primary, $id);
            return $this->BD->delete($this->_tabela);
        }
    }
?>