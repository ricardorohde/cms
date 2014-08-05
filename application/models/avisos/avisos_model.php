<?php
    
    /**
     * avisos_model
     * 
     * Classe desenvolvida para gerenciar as transações com a tabela avisos
     * 
     * @package     CI_Model
     * @subpackage  MY_Model
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
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
            
            $this->_tabela      = 'avisos';
            $this->_primaria    = 'id';
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
            $data = array(
                'mensagem'          => $dados['mensagem'],
                'data_expiracao'    => $dados['data_expiracao']
            );
            
            return $this->BD->insert($this->_tabela, $data);
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
            return $this->BD->count_all_results($this->_tabela);
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
            $this->BD->where('id', $id);
            
            return $this->BD->delete($this->_tabela);
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
            $data = array('status' => 0);
            
            $this->BD->where('id', $id);
            
            return $this->BD->update($this->_tabela, $data);
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
            $data = array('status' => 1);
            
            $this->BD->where('id', $id);
            
            return $this->BD->update($this->_tabela, $data);
        }
        //**********************************************************************
    }
    /** End of File avisos_model.php **/
    /** Location ./application/models/avisos/avisos_model.php **/