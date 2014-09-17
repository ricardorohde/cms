<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Content Manegement System
	 * 
	 * Sistema desenvolvido para facilitar a inserção e atualização de dados no
	 * site do Pentáurea Clube
	 * 
	 * @package		CMS
	 * @author		Masterkey Informática
	 * @copyright	Copyright (c) 2010 - 2014, Masterkey Informática LTDA
	 */
   
    /**
     * Galerias_model
     * 
     * Classe desenvolvida para gerenciar as galerias de fotos
     * 
     * @package		Models
     * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.1.0
     * @since		16/09/2014
     */
    class Galerias_model extends MY_Model
    {
        /**
         * __construct()
         * 
         * Realiza a construção da classe
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
         */
        public function __construct()
        {
            parent::__construct();
            
            $this->_tabela = 'galeria';
        }
        //**********************************************************************

        /**
         * busca_galerias()
         * 
         * Função que faz a busca de todas as galerias cadastradas, tendo estas
         * o status = 1 (status de ativo)
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @return		array Retorna um array de galerias cadastradas
         */
        function busca_galerias()
        {
            return $this->BD->get($this->_tabela)->result();
        }
        //********************************************************************** 
         
        /**
         * salva_galeria
         * 
         * Função desenvolvida para salvar uma nova galeria
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @param		array $dados Contém os dados que serão salvos
     	 * @return		int Retorna o ID da nova galeria cadastrada
         */
        function salva_galeria($dados)
        {
            $this->_data = array(
				'nome_galeria' 		=> $dados['nome_galeria'], 
                'data_realizacao' 	=> $dados['data_realizacao']
            );
            
            $query = parent::save();
            
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
        //**********************************************************************
         
        /**
         * salvar_imagens()
         * 
         * Função para salvar no banco de dados o nome das imagens que foram 
         * feitas o upload
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @param		array $dados Contém os dados que serão salvos
     	 * @return		bool Retorna TRUE se salvar e FALSE se não salvar
         */
        function salvar_imagens($dados)
        {
            $data = array(
                'id_galeria'	=> $dados['id_galeria'],
                'caminho_foto'	=> $dados['caminho_foto']
            );
            
            return $this->BD->insert('fotos', $data);
        }
        //**********************************************************************
         
        /**
         * salva_imagemCapa
         * 
         * Função desenvolvida para definir a capa da galeria
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @param		array $dados Contém os dados que serão salvos
     	 * @return		bool Retorna TRUE se salvar e FALSE se não salvar
         */
        function salva_imagemCapa($dados)
        {
            $this->_data = array(
                'capa_galeria'	=> $dados['capa_galeria'],
				'miniatura' 	=> $dados['capa_galeria']
            );
            
            $this->_primaria = $dados['id_galeria'];
            
            return parent::update();
        }
        //**********************************************************************
         
        /**
         * busca_nomeGaleria()
         * 
         * Função que busca e torna o nome da galeria
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @param		int $id Contém o ID da galeria que terá o nome buscado
     	 * @return		string Retorna o nome da galeria
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
        //**********************************************************************
          
        /**
         * busca_fotos
         * 
         * Função utilizada para buscas as fotos da galeria
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @param		int $id Contém o ID da galeria que terá as fotos buscadas
     	 * @return		array Retorna um array contendo o endereço das fotos 
         */
        function busca_fotos($id)
        {
            $this->BD->where(array('id_galeria' => $id));

            return $this->BD->get('fotos')->result();
        }
        //**********************************************************************
         
        /**
         * excluir()
         * 
         * Função para excluir a fotografia do banco
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @param		int $id Contém o ID da foto a ser excluida
     	 * @return		bool Retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir($id)
        {
            return $this->BD->delete('fotos', array('id' => $id));
        }
        //**********************************************************************
		
		/**
		 * busca_imagem()
		 * 
		 * Função desenvolvida para buscar imagem para ser excluída
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @param		int $id Contém o ID da foto a ser buscada
     	 * @return		string Retorna o caminho da foto
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
				return false;
			}
		}
		//**********************************************************************
		
		/**
		 * nova_capa()
		 * 
         * Função que salva uma nova capa de galeria, quando uma imagem é
         * excluída. A seleção da nova foto é feita de maneira randômica
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @param		int $id_galeria Contém o ID da galeria que será inserida
     	 * 				a nova capa
     	 * @return		bool Retorna TRUE se salvar a capa e FALSE se não salvar
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
                    'capa_galeria'	=> $row->caminho_foto,
					'miniatura' 	=> $row->caminho_foto
                );
                $this->BD->where(array('id' => $id_galeria));
                return $this->BD->update($this->_tabela, $data);
            }     
        }
        //**********************************************************************
		
		/**
		 * excluir_todasFotos()
		 * 
         * Função que exclui todas as fotos de uma galeria
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @param		array $dados Contém as informações necessárias para
     	 * 				exclusão das fotos
     	 * @return		bool Retorna TRUE se excluir e FALSE se não excluir 
         */
        function excluir_todasFotos($dados)
        {
            return $this->BD->delete('fotos', array('id_galeria' => $dados['id_galeria']));
        }
        //**********************************************************************
         
        /**
         * excluir_galeria()
         * 
         * Função que exclui a galeria do banco de dados
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @param		array $dados Contém os dados necessários para a exclusão
     	 * 				da galeria
     	 * @return		bool Retorna TRUE se excluir e FALSE se não excluir
         */
        function exclui_galeria($dados)
        {
        	$this->_primaria = $dados['id_galeria'];
        	
        	return parent::delete();
        }
        //**********************************************************************
    }
    /** End of File galerias_model.php **/
    /** Location ./application/models/galerias_model.php **/