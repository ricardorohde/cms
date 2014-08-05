<?php

    /**
     * contato_model.php
     * 
     * Arquivo que contém a classe contato_model
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version     v0.5.0
     */
    
    /**
     * contato_model.
     * 
     * Classe desenvolvida para gerenciar as operações com a tabela contato
     * 
     * @package     CI_Model
     * @subpackage  MY_Model
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
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
         * @var         string _tabela  Contém o nome da tabela
         * @var         string _primary Contém a chave primaria da tabela
         */
        public function __construct()
        {
            parent::__construct();
            $this->_tabela  = 'contato';
            $this->_primary = 'id';
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
            return $this->BD->count_all_results($this->_tabela);
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
            $dados['status'] = '0';
            $this->BD->where(array('id' => $id));
            
            return $this->BD->update($this->_tabela, $dados);
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
            $this->BD->where('id', $id);
            return $this->BD->delete($this->_tabela);
        }
        //**********************************************************************
    }
    /** End of File contato_model.php **/
    /** Location ./application/models/contato_model.php **/