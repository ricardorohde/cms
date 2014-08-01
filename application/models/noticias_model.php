<?php
    class Noticias_Model extends MY_Model
    {
        /*
         * Construção da classe-------------------------------------------------
         */
        public function __construct()
        {
            parent::__construct();
            $this->_tabela = 'noticias';
            $this->_primary = 'id';
        }
        //----------------------------------------------------------------------
        
        /*
         * Função para salvar os dados preliminares da notícia------------------
         */
        function salva_noticia($dados)
        {
            $data = array(
                'titulo_noticia' => $dados['titulo_noticia'],
                'resumo_noticia' => $dados['resumo_noticia'],
                'imagem_noticia' => $dados['imagem_noticia'],
				'tipo_noticia' => $dados['tipo_noticia'],
				'posicionamento' => $dados['posicionamento'],
                'corpo_noticia' => $dados['corpo_noticia'],
                'autor' => $dados['usuario']
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
         * Função que faz a listagem das noticias, de acordo com o limite
         * e o offset que foi passado na função index para fazer a paginação
         */
        function lista_noticias($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->select('*');
            $this->BD->order_by('data', 'desc');
            $query = $this->BD->get($this->_tabela);
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que busca e conta as notícias cadastradas com status = 1(ativas)
         */
        function conta_noticias()
        {
            $this->BD->where(array('status' => 1));
            return $this->BD->count_all_results($this->_tabela);
        }
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para inativar uma determinada noticia
         */
        function inativar_noticia($id)
        {
            $dados['status'] = '0';
            $this->BD->where(array('id' => $id));
            $query = $this->BD->update($this->_tabela, $dados);
            return $query;
        }
        //----------------------------------------------------------------------
		
		/*
         * Função desenvolvida para reativar uma determinada noticia
         */
        function ativar_noticia($id)
        {
            $dados['status'] = '1';
            $this->BD->where(array('id' => $id));
            $query = $this->BD->update($this->_tabela, $dados);
            return $query;
        }
        //----------------------------------------------------------------------
		
		/*
         * Função desenvolvida para excluir uma determinada noticia
         */
        function excluir_noticia($id)
        {
            $this->BD->where('id', $id);
            $query = $this->BD->delete($this->_tabela);
            return $query;
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que busca uma notícia para edição
         */
        function busca_noticiaId($id)
        {
            $this->BD->select('*');
            $this->BD->where(array('id' => $id));
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
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para salvar as alterações que foram realizadas na
         * redição da notícia
         */
        function atualiza_noticia($dados)
        {
            $data = array(
                'titulo_noticia' => $dados['titulo_noticia'],
                'resumo_noticia' => $dados['resumo_noticia'],
                'imagem_noticia' => $dados['imagem_noticia'],
				'tipo_noticia' => $dados['tipo_noticia'],
				'posicionamento' => $dados['posicionamento'],
                'corpo_noticia' => $dados['corpo_noticia'],
                'autor' => $dados['usuario']
            );
            $this->BD->where(array('id' => $dados['id']));
            $query = $this->BD->update($this->_tabela, $data);
            if($query == 1)
            {
                return $query;
            }
            else
            {
                return false;
            }
        }
    }
?>