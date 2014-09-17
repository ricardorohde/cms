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
     * Temas
     * 
     * Classe responsável por gerenciar as transações com a tabela 
     * 'personalizacao'
     * 
     * @package		Models
     * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version 	v1.1.0
     * @since		16/09/2014
     */
    class Temas_model extends MY_Model
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
            
            $this->_tabela = 'personalizacao';
        }
        //**********************************************************************
        
        /**
         * busca_temas()
         * 
         * Função desenvolvida para buscar os temas já salvos
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $limite Recebe o limite da consulta sql
         * @param		int $offset Recebe o offset da consulta sql
         * @return 		array Retorna um array de temas cadastrados
         */
        function busca_temas($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->order_by('id', 'desc');
            
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * contar_temas()
         * 
         * Função criada para contar os temas cadastrados no BD
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return 		int Retorna a contagem dos registros
         */
        function contar_temas()
        {
            return parent::count();
        }
        //**********************************************************************
        
        /**
         * salvar_tema()
         * 
         * Função desenvolvida para salvar um novo tema no banco de dados
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		array $dados Contém os dados a serem salvos
         * @return		bool Retorna TRUE se salvar e FALSE se não salvar
         */
        function salvar_tema($dados)
        {
            $this->_data = array(
                'imagem_fundo' 		=> $dados['imagem_background'],
                'cor_principal'     => $dados['cor_principal'],
                'imagem_banner'     => $dados['imagem_banner'],
                'data_inicio'       => $dados['data_inicio'],
                'data_expiracao'    => $dados['data_expiracao'],
                'status'            => 1
            );
            
            return parent::save();
        }
        //**********************************************************************
        
        /**
         * excluir_tema()
         * 
         * A função é utilizada para excluir do banco de dados um tema
         * previamente salvo
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $id Contém o ID do registro a ser excluido
         * @return		bool Retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir_tema($id)
        {
            $this->_primaria = $id;
            
            return parent::delete();
        }
        //**********************************************************************
        
        /**
         * buscaTemaId()
         * 
         * A função é utilizada para buscar um tema previamente cadastrado
         * para que possa ser editado
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $id Contém o ID do tema a ser buscado
         * @return		array Retorna um array com os dados do tema buscado
         */
        function buscaTemaId($id)
        {
            $this->BD->where('id', $id);
            
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * salvar_edicaoTema()
         * 
         * A função é utilizada para atualizar um tema que já foi 
         * previamente salvo
         * 
         * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		array $dados Contém os dados que serão atualizados
         * @return		bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function salvar_edicaoTema($dados)
        {
            $this->_data = array(
                'imagem_fundo'      => $dados['imagem_background'],
                'imagem_banner'     => $dados['imagem_banner'],
                'cor_principal'     => $dados['cor_principal'],
                'data_inicio'       => $dados['data_inicio'],
                'data_expiracao'    => $dados['data_expiracao']
            );
            
            $this->_primaria = $dados['id'];
            
            return parent::update();
        }
        //**********************************************************************
        
        /**
         * marcar()
         * 
         * A função é utilizada para marcar um tema como ativo ou inativo
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		array $dados Contém os dados a serem atualizados
         * @return		bool Retorna TRUE  se atualizar e FALSE se não atualizar
         */
        function marcar($dados)
        {
            $this->_data 		= array('status' => $dados['status']);
            $this->_primaria 	= $dados['id'];
            
            return parent::update();
        }
        //**********************************************************************
    }
	/** End of File temas_model.php **/
    /** Location ./application/models/temas_model.php **/