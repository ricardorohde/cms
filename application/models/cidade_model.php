<?php

    class Cidade_model extends MY_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->_tabela = 'descricao_cidade';
            $this->_primary = 'id';
        }
        
        function busca_descricao($dados)
        {
            $this->BD->select('*');
            $this->BD->where(array('tipo' => $dados));
            $query = $this->BD->get($this->_tabela);
            if($query)
            {
               return $query->result(); 
            }
        }
        
        function salvar_cidade($dados)
        {
            $data = array(
                'texto_descricao' => $dados['corpo_cidade'],
                'tipo' => 1
            );
            
            
            $query = $this->BD->insert($this->_tabela, $data);
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        function update_cidade($dados)
        {
            $data = array(
                'texto_descricao' => $dados['corpo_cidade']
            );
            $this->BD->where(array('id' => $dados['id']));
            $query = $this->BD->update($this->_tabela, $data);
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        function salvar_camara($dados)
        {
            $data = array(
                'texto_descricao' => $dados['corpo_camara'],
                'tipo' => 2
            );
            
            
            $query = $this->BD->insert($this->_tabela, $data);
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        function update_camara($dados)
        {
            $data = array(
                'texto_descricao' => $dados['corpo_camara']
            );
            $this->BD->where(array('id' => $dados['id']));
            $query = $this->BD->update($this->_tabela, $data);
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        function salvar_links($dados)
        {
            $data = array(
                'texto_descricao' => $dados['corpo_links'],
                'tipo' => 3
            );
            
            
            $query = $this->BD->insert($this->_tabela, $data);
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        function update_links($dados)
        {
            $data = array(
                'texto_descricao' => $dados['corpo_links']
            );
            $this->BD->where(array('id' => $dados['id']));
            $query = $this->BD->update($this->_tabela, $data);
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        
    }
?>
