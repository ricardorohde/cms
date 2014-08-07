<?php
    /**
     * email_model.php
     * 
     * Arquico que contém a classe email_model
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version     v1.0.0
     */
    
    /**
     * email_model
     * 
     * Classe desenvolvida para gerenciar as operações com a tabela email
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     */
    class Email_model extends MY_Model
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
            
            /** Definição do nome da tabela e da chave primária **/
            $this->_tabela      = 'email';
            $this->_primaria    = 'id';
        }
        //**********************************************************************
        
        /**
         * buscar()
         * 
         * Função desenvolvida para buscar as configurações salvas
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function buscar()
        {
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
    }
    /** End of File email_model.php **/
    /** Location ./application/models/email_model.php **/