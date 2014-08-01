<?php
    
    /**
     * Galerias.php
     * 
     * @package     MY_Controller
     * @subpackage  galerias
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    Esta classe prove a criação de novas galerias fotográficas, sendo que as 
     *              aparecerão dinamicamente no site. A intenção deste módulo é promover a 
     *              fácil utilização para criação e edição de galerias de fotos
     */
    class Galerias extends MY_Controller
    {
        /**
         * __construct()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Contrução da Classe Galerias
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
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Esta função é utilizada para chamar os dados preliminares
         *              da visão - galerias
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
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para salvar os dados preliminares da galeria
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
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função que exibe as galerias cadastradas
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