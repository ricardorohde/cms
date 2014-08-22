<?php
    /**
     * configuracoes_email.php
     * 
     * Arquivo que contém a classe configuracoes_email
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version     v1.1.0
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
        
        /**
         * salvar()
         * 
         * Função desenvolvida para salvar/ atualizar as configurações de envio
         * de email
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         */
        function salvar()
        {
        	$dados['id'] 			= $this->input->post('id');
        	$dados['smtp_host'] 	= $this->input->post('smtp_host');
        	$dados['smtp_port'] 	= $this->input->post('smtp_port');
        	$dados['smtp_userName'] = $this->input->post('smtp_userName');
        	$dados['smtp_password'] = $this->input->post('smtp_password');
        	$dados['smtp_password'] = $this->input->post('smtp_secure');
        	$dados['smtp_from'] 	= $this->input->post('smtp_from');
        	$dados['smtp_fromName'] = $this->input->post('smtp_fromName');
        	
        	if ($this->email_model->processar($dados) == 1)
        	{
        		echo 1;
        	}
        	else
        	{
        		echo 0;
        	}
        }
        //**********************************************************************
    }
    /** End of File configuracoes_email.php **/
    /** Location ./application/controllers/config/configuracoes_email.php **/