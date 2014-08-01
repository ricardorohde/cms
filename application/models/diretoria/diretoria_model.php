<?php
    /**
     * @package     - models/diretoria/diretoria_model
     * @@author     - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    - Model desenvolvido para comandar as transações de BD com a
     *                tabela diretorias
     */
    class Diretoria_model extends MY_Model
    {
        /**
         * @name        - __construct()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Realiza a construção da classe
         */
        public function __construct() {
            parent::__construct();
            
            /** Indica o nome da tabela **/
            $this->_tabela = 'diretorias';
            
            /** Indica a chave primária da tabela **/
            $this->_primary = 'id';
        }
        //**********************************************************************
        
        /**
         * @name        - busca_diretorias()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Função desenvolvida para realizar a busca das 
         *                diretorias cadastradas na base de dados. Realiza a 
         *                busca realizando paginação através do limite e offset
         * @return      Array - retorna uma array de diretorias
         */
        function busca_diretorias($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->order_by('ano_inicio', 'desc');
            $query = $this->BD->get($this->_tabela);
            return $query->result();
        }
        //**********************************************************************
        
        /**
         * @name        - conta_diretorias()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Função desenvolvida para contar a quantidade de 
         *                diretorias cadastradas.
         * @return      Integer - retorna o numero de galerias cadastradas
         */
        function conta_diretorias()
        {
            return $this->BD->count_all_results($this->_tabela);
        }
        //**********************************************************************
        
        /**
         * @name        - salvar_diretoria($parametro)
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Função desenvolvida para salvar os dados de uma nova
         *                diretoria. Estes dados tem que ser passados como
         *                parâmetro.
         * @return      Bool retorna verdadeiro se salvou ou falso se não salvou
         */
        function salvar_diretoria($dados)
        {
            $data = array(
                'ano_inicio'    => $dados['ano_inicio'],
                'ano_final'     => $dados['ano_final'],
                'observacoes'   => $dados['observacoes']
            );
            return $this->BD->insert($this->_tabela, $data);
        }
        //**********************************************************************
        
        /**
         * @name        - diretorias_combo()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Função desenvolvida para buscar as diretorias 
         *                cadastradas para inserir em um combobox
         * @return        Array retorna um array de diretorias
         */
        function diretorias_combo()
        {
            $this->BD->select('id, ano_inicio, ano_final');
            $this->BD->order_by('ano_inicio', 'desc');
            $query = $this->BD->get($this->_tabela);
            return $query->result();
        }
        //**********************************************************************
    }
?>