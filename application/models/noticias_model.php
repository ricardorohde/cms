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
	 * Noticias_model
	 * 
	 * Classe desenvolvida para gerenciar as operações com a tabela notícias
	 *
	 * @package		Models
	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version		v1.1.0
	 * @since		03/09/2014
	 */
    class Noticias_Model extends MY_Model
    {
        /**
         * __construct()
         * 
         * Realiza a construção da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
         */
        public function __construct()
        {
            parent::__construct();
            
            $this->_tabela = 'noticias';
        }
        //**********************************************************************
        
        /**
         * salva_noticia()
         * 
         * Função para salvar os dados preliminares da notícia
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		array $dados Contém os dados que serão salvos
         */
        function salva_noticia($dados)
        {
            $this->_data = array(
                'titulo_noticia' 	=> $dados['titulo_noticia'],
                'resumo_noticia' 	=> $dados['resumo_noticia'],
                'imagem_noticia' 	=> $dados['imagem_noticia'],
				'tipo_noticia' 		=> $dados['tipo_noticia'],
				'posicionamento'	=> $dados['posicionamento'],
                'corpo_noticia' 	=> $dados['corpo_noticia'],
                'autor' 			=> $dados['usuario']
            );
            
            return parent::save();
        }
        //**********************************************************************
        
        /**
         * lista_noticias()
         * 
         * Função que faz a listagem das noticias, de acordo com o limite
         * e o offset que foi passado na função index para fazer a paginação
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $limite Recebe o limite da consulta sql
	 	 * @param		int $offset Recebe o offset da consulta sql
	 	 * @return		array Retorna um array de noticias cadastradas
         */
        function lista_noticias($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->order_by('data', 'desc');
            
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * conta_noticias()
         * 
         * Função que busca e conta as notícias cadastradas com status = 1(ativas)
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @return		int Retorna o número de notícias cadastradas
         */
        function conta_noticias()
        {
            $this->BD->where(array('status' => 1));
            
            return parent::count();
        }
        //**********************************************************************
        
        /**
         * inativar_noticia()
         * 
         * Função desenvolvida para inativar uma determinada noticia
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $id Recebe o ID da notícia a ser inativada
	 	 * @return		bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function inativar_noticia($id)
        {
            $this->_data 		= array('status' => '0');
            $this->_primaria	= $id;
            
            return parent::update();
        }
        //**********************************************************************
		
		/**
		 * ativar_noticia()
		 * 
         * Função desenvolvida para reativar uma determinada noticia
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $id Contém o ID da notícia a ser inativada
	 	 * @return		bool Retorna TRUE se ativar e FALSE se inativar
         */
        function ativar_noticia($id)
        {
            $this->_data 		= array('status' => '1');
            $this->_primaria	= $id;
            
            return parent::update();
        }
        //**********************************************************************
		
		/**
		 * excluir_noticia()
		 * 
         * Função desenvolvida para excluir uma determinada noticia
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $id Contém o ID da notícia a ser apagada
	 	 * @return		bool Retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir_noticia($id)
        {
        	$this->_primaria = $id;
        	
        	return parent::delete();
        }
        //**********************************************************************
        
        /**
         * busca_noticiaId()
         * 
         * Função que busca uma notícia para edição
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $id Contém o ID da notícia a ser buscada
	 	 * @return		arra Retorna um array com os dados da notícia
         */
        function busca_noticiaId($id)
        {
            $this->BD->where(array('id' => $id));
            
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * atualiza_noticia()
         * 
         * Função desenvolvida para salvar as alterações que foram realizadas na
         * reedição da notícia
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		array $dados Contém os dados da notícia a serem 
	 	 * 				atualizados
	 	 * @return		bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function atualiza_noticia($dados)
        {
            $this->_data = array(
                'titulo_noticia' 	=> $dados['titulo_noticia'],
                'resumo_noticia' 	=> $dados['resumo_noticia'],
                'imagem_noticia' 	=> $dados['imagem_noticia'],
				'tipo_noticia' 		=> $dados['tipo_noticia'],
				'posicionamento'	=> $dados['posicionamento'],
                'corpo_noticia' 	=> $dados['corpo_noticia'],
                'autor' 			=> $dados['usuario']
            );
            $this->_primaria = $dados['id'];
            
            return parent::update();
        }
        //**********************************************************************
    }
    /** End of File Noticias_model.php **/
    /** Location ./application/models/noticias_model.php **/