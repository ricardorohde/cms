<?php
    class Camara_model extends MY_Model
    {
        /*
         * Construtor da classe
         */
        public function __construct()
        {
            parent::__construct();
            $this->_tabela = 'camara';
            $this->_primary = 'id';
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que salva os dados da câmara
         */
        function salvar_dados($dados)
        {
            $data = array(
                'nome_camara' => $dados['nome_camara'],
                'endereco' => $dados['endereco'],
                'telefone' => $dados['telefone'],
                'horario_funcionamento' => $dados['horario_funcionamento'],
                'horario_reunioes' => $dados['horario_reunioes']
            );
            $query = $this->BD->insert($this->_tabela, $data);
            if(!$query)
            {
                return false;
            }
            else
            {
                return $query;
            }
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que realiza a busca dos dados da câmara
         */
        function buscar_dadosCamara()
        {
            $this->BD->select('*');
            $query = $this->BD->get($this->_tabela);
            if(!$query)
            {
                return false;
            }
            else
            {
                return $query->result();
            }
        }
        //______________________________________________________________________
        
        /*
         * Função que atualiza os dados da câmara
         */
        function atualiza_dados($dados)
        {
            $data = array(
                'nome_camara' => $dados['nome_camara'],
                'endereco' => $dados['endereco'],
                'telefone' => $dados['telefone'],
                'horario_funcionamento' => $dados['horario_funcionamento'],
                'horario_reunioes' => $dados['horario_reunioes']
            );
            $this->BD->where = array('id' => $dados['id']);
            $query = $this->BD->update($this->_tabela, $data);
            if(!$query)
            {
                return false;
            }
            else
            {
                return $query;
            }
        }
        //----------------------------------------------------------------------
    }
?>
