<?php
    
    /**
     * Galerias.php
     * 
     * Esta classe prove a criação de novas galerias fotográficas, sendo que as 
     * aparecerão dinamicamente no site. A intenção deste módulo é promover a 
     * fácil utilização para criação e edição de galerias de fotos.
     * 
     * @package     CI_Controller
     * @subpackage  MY_Controller
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version     v1.2.0
     */
    class Galerias extends MY_Controller
    {
        /**
         * __construct()
         * 
         * Contrução da Classe Galerias
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            
            /** Carrega model responsável pela galeria **/
            $this->load->model('galerias_model');
        }
        //**********************************************************************
        
        /**
         * index()
         * 
         * Função principal do controller
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function index()
        {
            $this->view = 'galerias/galerias';
            $this->titulo = 'Todas as Galerias';
            
            $this->LoadView();
        }
        //**********************************************************************
        
        /**
         * salvar_galeria()
         * 
         * Função desenvolvida para salvar os dados preliminares da galeria
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool retorna 1 se salvar e 0 se não salvar
         */
        function salvar_galeria()
        {   
            $dados['nome_galeria']      = $this->input->post('nome_galeria');            
            $dados['data_realizacao']   = $this->input->post('data');
            
            echo $this->galerias_model->salva_galeria($dados);
        }
        //**********************************************************************
        
        /**
         * busca_galerias()
         * 
         * Função que exibe as galerias cadastradas
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function busca_galerias()
        {
            $this->dados['galerias'] = $this->galerias_model->busca_galerias();
            
            $this->load->view('paginas/paginados/galerias/galerias', $this->dados);
        }
        //**********************************************************************
    }
    /** End of File galerias.php**/
    /** Location ./application/controllers/galerias/galerias.php **/