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
     * Avisos_model
     * 
     * Classe desenvolvida para gerenciar as transações com a tabela avisos
     * 
     * @package     Models
     * @subpackage  Avisos
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.1.0
     * @since		16/09/2014
     */
    class Avisos_model extends MY_Model
    {
        /**
         * __construct()
         * 
         * Realiza a construção da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        public function __construct()
        {
            parent::__construct();
            
            $this->_tabela = 'avisos';
        }
        //**********************************************************************
        
        /**
         * salvar()
         * 
         * Função desenvolvida para salvar um novo aviso
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       array   $dados  Contém os dados que serão salvos
         * @return      bool    Retorna TRUE se salvar e FALSE se não salvar
         */
        function salvar($dados)
        {
            $this->_data = array(
                'mensagem'          => $dados['mensagem'],
                'data_expiracao'    => $dados['data_expiracao']
            );
            
            return parent::save();
        }
        //**********************************************************************
        
        /**
         * busca_avisos()
         * 
         * Funçao desenvolvida para realizar a busca dos avisos cadastrados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int     $limite Define o limite da pesquisa
         * @param       int     $offset Define o offset da pesquisa
         * @return      array   retorna um array de avisos                
         */
        function busca_avisos($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->order_by('id', 'desc');
            
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * contar_avisos()
         * 
         * Funçao que conta os avisos cadastrados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      int Retorna a quantidade de avisos cadastrados
         */
        function contar_avisos()
        {
        	return parent::count();
        }
        //**********************************************************************
        
        /**
         * apagar()
         * 
         * Função desenvolvida para apagar um aviso
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $id Contém o ID do aviso a ser excluido
         * @return      bool Retorna TRUE se apagar e FALSE se não apagar
         */
        function apagar($id)
        {
        	$this->_primaria = $id;
            
        	return parent::delete();
        }
        //**********************************************************************
        
        /**
         * inativar()
         * 
         * Função desenvolvida para inativar um aviso
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $id Contém o ID do aviso a ser inativado
         * @return      bool Retorna TRUE se inativar e FALSE se não inativar
         */
        function inativar($id)
        {
            /** Realiza a associação entre campos da tabela e dados **/
            $this->_data		= array('status' => 0);
            $this->_primaria 	= $id;
            
            return parent::update();
        }
        //**********************************************************************
        
        /**
         * ativar()
         * 
         * Função desenvolvida para ativar um aviso
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $id Contém o ID do aviso a ser ativado
         * @return      bool Retorna TRUE se ativar e FALSE se não ativar
         */
        function ativar($id)
        {
            /** Realiza a associação entre campos da tabela e dados **/
            $this->_data		= array('status' => 1);
            $this->_primaria 	= $id;
            
            return parent::update();
        }
        //**********************************************************************
        
        /**
         * buscar()
         * 
         * Função desenvolvida para buscar um aviso
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $id Contém o ID do aviso a ser buscado
         * @return      array Retorna um array contendo os dados do aviso
         */
        function buscar($id)
        {
            $this->BD->where('id', $id);
            
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * atualizar()
         * 
         * Função desenvolvida para atualizar um aviso
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       array $dados Contém os dados que serão atualizados
         * @return      bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function atualizar($dados)
        {
            /** Faz a associação entre os campos e os dados **/
            $this->_data = array(
                'data_expiracao'    =>$dados['data_expiracao'],
                'mensagem'          =>$dados['mensagem']
            );
            $this->_primaria = $dados['id'];
            
            return parent::update();
        }
        //**********************************************************************
    }
    /** End of File avisos_model.php **/
    /** Location ./application/models/avisos/avisos_model.php **/