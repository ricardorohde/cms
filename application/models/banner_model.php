<?php
    class Banner_model extends MY_Model
    {
        /*
         * Construtor da classe
         */
        public function __construct()
        {
            parent::__construct();
            $this->_tabela = 'fotos_carrossel';
            $this->_primary = 'id';
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que busca as imagens cadastradas
         */
        function busca_banner()
        {
            $this->BD->select('*');
            $query = $this->BD->get($this->_tabela);
            if(!$query)
            {
                return 0;
            }
            else
            {
                return $query->result();
            }
        }
        //----------------------------------------------------------------------
        
        /*
         * funçao para salvar o banner
         */
        function salvar($dados)
        {
            $data = array(
                'foto' => $dados['caminho_foto']
            );
            $query = $this->BD->insert($this->_tabela, $data);
            return $query;             
        }
        //----------------------------------------------------------------------
        
        /*
         * Funçao que exclui uma imagem do banner
         */
        function excluir($id)
         {
             $query = $this->BD->delete($this->_tabela, array('id' => $id));
             return $query;
         }
         //---------------------------------------------------------------------
       
    }
?>