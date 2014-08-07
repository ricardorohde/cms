<?php
    /**
     * configuracoes_email.php
     * 
     * Arquivo que contém a classe configuracoes_email
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version     v1.0.0
     */
    class Configuracoes_email extends MY_Controller
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
            parent::__construct(TRUE);
            
            $this->load->model('email_model');
        }
        //**********************************************************************
        
        /**
         * index()
         * 
         * Função principal da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function index()
        {
            $this->load->view('paginas/config/configuracoes_email');
        }
        //**********************************************************************
        
        /**
         * buscar_config()
         * 
         * Realiza a busca das configurações de email
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function buscar_config()
        {
            $this->dados['config'] = $this->email_model->buscar();
            
            $this->load->view('paginas/paginados/config/config_email', $this->dados);
        }
        //**********************************************************************
    }
    /** End of File configuracoes_email.php **/
    /** Location ./application/controllers/config/configuracoes_email.php **/