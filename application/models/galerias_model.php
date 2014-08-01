<?php
   
    /*
     * Este model é ultilizado para realizar a pesquisa das galerias cadastradas
    */
    class Galerias_model extends MY_Model
    {
        /*
         * Função que realiza a construção da classe
         */
        public function __construct() {
            parent::__construct();
            $this->_tabela = 'galeria';
            $this->_primary = 'id';
        }
        //---------------------------------------------------------------------
              
        /*
         * Função que faz a busca de todas as galerias cadastradas, tendo estas
         * o status = 1 (status de ativo)
         */
        function busca_galerias()
        {
            $this->BD->select('*');
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
        //--------------------------------------------------------------------- 
         
        /*
         * Função desenvolvida para salvar a galeria preliminarmente (Passo 
         * numero 1 do formulário)
         */
        function salva_galeria($dados)
        {
            $data = array(
				'nome_galeria' => $dados['nome_galeria'], 
                'data_realizacao' => $dados['data_realizacao']
            );
            $query = $this->BD->insert($this->_tabela, $data);
            if(!$query)
            {
                return FALSE;
            }
            else
            {
                $this->BD->select('id');
                $this->BD->where(array('nome_galeria' => $dados['nome_galeria']));
                $this->BD->where(array('data_realizacao' => $dados['data_realizacao']));
                $query = $this->BD->get($this->_tabela);
                if(!$query)
                {
                    return FALSE;
                }
                else
                {
                    foreach($query->result() as $row)
                    {
                        $id = $row->id;
                    }
                    return $id;
                }
            }
        }
        //---------------------------------------------------------------------
         
        /*
         * Função para salvar no banco de dados o nome das imagens que foram 
         * feitas o upload
         */
        function salvar_imagens($dados)
        {
            $data = array(
                'id_galeria' => $dados['id_galeria'],
                'caminho_foto' => $dados['caminho_foto']
            );
            $query = $this->BD->insert('fotos', $data);
            if(!$query)
            {
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        //---------------------------------------------------------------------
         
        /*
         * Função desenvolvida para definir a capa da galeria
         */
        function salva_imagemCapa($dados)
        {
            $data = array(
                'capa_galeria' => $dados['capa_galeria'],
				'miniatura' => $dados['capa_galeria']
            );
            $this->BD->where(array('id' => $dados['id_galeria']));
            $query = $this->BD->update($this->_tabela, $data);
            if(!$query)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        //---------------------------------------------------------------------
         
        /*
         * função que busca e torna o nome da galeria
         */
        function busca_nomeGaleria($id)
        {
            $this->BD->select('nome_galeria');
            $this->BD->where(array('id' => $id));
            $query = $this->BD->get($this->_tabela);
            if($query->num_rows() > 0)
            {
                foreach ($query->result() as $row)
                {
                    $nome_galeria = $row->nome_galeria;
                }
                return $nome_galeria;
            }
        }
        //---------------------------------------------------------------------
          
        /*
         * Função utilizada para buscas as fotos da galeria
         */
        function busca_fotos($id)
        {
            $this->BD->select('*');
            $this->BD->where(array('id_galeria' => $id));
            $query = $this->BD->get('fotos');
            return $query->result();    
        }
        //---------------------------------------------------------------------
         
        /*
         * Função para excluir a fotografia do banco
         */
        function excluir($id)
        {
            $query = $this->BD->delete('fotos', array('id' => $id));
            return $query;
        }
        //---------------------------------------------------------------------
         
        /*
         * Função desenvolvida para buscar um nome de galeria de acordo com seu
         * id
         */
        function busca_nome($id)
        {
            $this->BD->select('nome_galeria');
            $this->BD->where(array('id' => $id));
            $query = $this->BD->get($this->_tabela);
            return $query->result();
        }
		//---------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para buscar imagem para ser excluída
		*/
		function busca_imagem($id)
		{
			$this->BD->select('caminho_foto');
			$this->BD->where('id', $id);
			$query = $this->BD->get('fotos');
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
				{
					return $row->caminho_foto;
				}
			}
			else
			{
				return false();
			}
		}
		//---------------------------------------------------------------------
		
		/*
         * Função que salva uma nova capa de galeria, quando uma imagem é
         * excluída
        */
        function nova_capa($id_galeria)
        {
            $this->BD->select('caminho_foto');
            $this->BD->where(array('id_galeria' => $id_galeria));
            $this->BD->order_by('id','random');
            $this->BD->limit(1);
            $query = $this->BD->get('fotos');    
            foreach ($query->result() as $row)
            {
                $data = Array(
                    'capa_galeria' => $row->caminho_foto,
					'miniatura' => $row->caminho_foto
                );
                $this->BD->where(array('id' => $id_galeria));
                $query = $this->BD->update($this->_tabela, $data);
                return $query;
            }     
        }
        //---------------------------------------------------------------------
		
		/*
         * Função que exclui todas as fotos de uma galeria
        */
        function excluir_todasFotos($dados)
        {
            $query = $this->BD->delete('fotos', array('id_galeria' => $dados['id_galeria']));
            return $query;
        }
        //---------------------------------------------------------------------
         
        /*
         * Função que exclui a galeria do banco de dados
        */
        function exclui_galeria($dados)
        {
            $query = $this->BD->delete($this->_tabela, array('id' => $dados['id_galeria']));
            return $query;
        }
        //---------------------------------------------------------------------
    }
?>