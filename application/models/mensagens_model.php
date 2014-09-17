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
     * Mensagens_model
     * 
     * Classe desenvolvida para gerenciar as transações envolvendo as mensagens
     * diárias
     * 
     * @package     Models
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.1.0
     * @since		16/09/2014
     */
    class Mensagens_model extends MY_Model
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
            
            $this->_tabela      = 'mensagem_diaria';
        }
        //**********************************************************************
        
        /**
         * salvar()
         * 
         * Função desenvolvida para salvar uma nova mensagem no BD
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param       array $dados contem os dados do autor e da mensagem
         * @return      bool retorna TRUE se salvar e FALSE se não salvar
         */
        function salvar($dados)
        {   
            $this->_data = array(
                'mensagem'  => $dados['mensagem'],
                'autor'     => $dados['autor']
            );
            
            return parent::save();
        }
        //**********************************************************************
        
        /**
         * buscar()
         * 
         * Função desenvolvida para buscar as mensagens cadastradas
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param       int $limite define o limite da pesquisa
         * @param       int $offset define o offset da pesquisa
         */
        function buscar($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * contar_mensagens()
         * 
         * Função que conta a quantidade de mensagens cadastradas
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return      int retorna o número de mensagens cadastradas
         */
        function contar_mensagens()
        {
            return parent::count();
        }
        //**********************************************************************
        
        /**
         * excluir()
         * 
         * Função desenvolvida para excluir uma mensagem, passando o id da 
         * mensagem como parametro.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param       int $id id da noticia que deseja excluir
         * @return      bool retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir($id)
        {
        	$this->_primaria = $id;

            return parent::delete();
        }
        //**********************************************************************
        
        /**
         * marcar()
         * 
         * Função desenvolvida para marcar uma mensagem como ativa ou inativa
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       array $dados Contém os dados que serão atualizados
         * @return      bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function marcar($dados)
        {
            if($dados['acao'] == 'inativar')
            {
                $this->_data = array('status' => 0);
            }
            else
            {
                $this->_data = array('status' => 1);
            }
            
            $this->_primaria = $dados['id'];
            
            return parent::update();
        }
        //**********************************************************************
        
        /**
         * buscar_mensagem()
         * 
         * 
         * Função desenvolvida para buscar uma mensagem para que a mesma possa 
         * ser editada.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $id Contém o ID da mensagem a ser buscada
         * @return      array Retorna um array com os dados da mensagem
         */
        function buscar_mensagem($id)
        {
            $this->BD->where('id', $id);
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * atualizar()
         * 
         * Função desenvolvida para atualizar uma mensagem cadastrada
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       array $dados Contém os dados que serão atualizados
         * @return      bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function atualizar($dados)
        {
            /** Associa os campos da tabela aos dados **/
            $this->_data = array(
                'autor'     => $dados['autor'],
                'mensagem'  => $dados['mensagem']
            );
            
            $this->_primaria = $dados['id'];
            return parent::update();
        }
        //**********************************************************************
    }
    /** End of File mensagens_model.php **/
    /** Location ./application/models/mensagens_model.php **/