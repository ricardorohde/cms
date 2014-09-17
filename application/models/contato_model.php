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
     * Contato_model
     * 
     * Classe desenvolvida para gerenciar as operações com a tabela contato
     * 
     * @package     Models
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.1.0
     * @since		16/09/2014
     */
    class Contato_Model extends MY_Model
    {
        /**
         * __construct().
         * 
         * Realiza a construção da classe.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        public function __construct()
        {
            parent::__construct();
            
            $this->_tabela  = 'contato';
        }
        //**********************************************************************

        /**
         * lista_contatos().
         * 
         * Função que faz a listagem dos contatos, de acordo com o limite
         * e o offset que foi passado na função index para fazer a paginação.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       string  $limite Contém o limite da busca sql
         * @param       string  $offset Contém o offset da busca sql
         * @return      array   Retorna um array de mensagens
         */
        function lista_contatos($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->select('*');
            $this->BD->order_by('data', 'desc');
            
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************

        /**
         * conta_contatos().
         * 
         * Função que busca e conta as mensagens da tabela contato.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      int Retorna o número de mensagens cadastradas no sistema
         */
        function conta_contatos()
        {
            return parent::count();
        }
        //**********************************************************************
        
        /**
         * marcar_lido().
         * 
         * Função que atualiza os registros da tabela contato.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $id Contém o ID da mensagem a ser alterada
         * @return      bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function marcar_lido($id)
        {
        	$this->_data		= array('status' => 0);
            $this->_primaria 	= $id;
            
            return parent::update();
        }
        //**********************************************************************

        /**
         * buscar_contato().
         * 
         * Função desenvolvida para buscar uma tupla específica de contatos a 
         * partir de um id.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $id Contém o ID da mensagem a ser buscada
         * @return      array   Retorna um array contendo os dados da mensagem
         */
        function buscar_contato($id)
        {
            $this->BD->where(array("id" => $id));
            
            return $this->BD->get($this->_tabela)->result();            
        }
        //**********************************************************************
        
        /**
         * excluir().
         * 
         * Função desenvolvida para excluir mensagens, de acordo com o $id 
         * passado pelo usuário.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $id Contém o ID da mensagem a ser excluida
         * @return      bool Retorna TRUE se apagar e FALSE se não apagar
         */
        function excluir($id)
        {
            $this->_primaria = $id;
            
            return parent::delete();
        }
        //**********************************************************************
    }
    /** End of File contato_model.php **/
    /** Location ./application/models/contato_model.php **/