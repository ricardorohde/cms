<?php
    /**
     * avisos_cadastrados
     * 
     * Classe desenvolvida para gerenciar os avisos cadastrados.
     * 
     * @package     CI_Controller
     * @subpackage  MY_Conntroller
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version     v0.1.1
     * @todo        Função para edição dos avisos cadastrados
     */
    class Avisos_cadastrados extends MY_Controller
    {
        /**
         * __construct()
         * 
         * Realiza a construção da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       bool $requer_autenticacao Se TRUE, é necessário estar
         *              logado para acessar a classe
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            $this->load->model('avisos/avisos_model', 'avisos');
        }
        //**********************************************************************
        
        /**
         * index()
         * 
         * Função principal da Classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function index()
        {
            $this->load->view('paginas/avisos/avisos_cadastrados');
        }
        //**********************************************************************
        
        /**
         * busca_cadastrados()
         * 
         * Funçao desenvolvida para buscar os avisos cadastrados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $offset Define o offset da pesquisa
         */
        function busca_cadastrados($offset = 0)
        {
            $limite = 20;
            
            $this->dados['avisos'] = $this->avisos->busca_avisos($limite, $offset);
            
            if(!$this->dados['avisos'] && $offset > 0)
            {
                $offset = $offset - $limite;
                $this->dados['avisos'] = $this->avisos->busca_avisos($limite, $offset);
            }
            
            /** Configurações para a paginação **/
            $config['base_url']     = app_baseurl().'painel/avisos_cadastrados/busca_cadastrados';
            $config['per_page']     = $limite;
            $config['uri_segment']  = 4;
            $config['total_rows']   = $this->avisos->contar_avisos();
            
            /** Inicalização da paginação **/
            $this->pagination->initialize($config);
            $this->dados['paginacao']   = $this->pagination->create_links();
            $this->dados['offset']      = $offset;
            
            $this->load->view('paginas/paginados/avisos/avisos_cadastrados', $this->dados);
        }
        //**********************************************************************
        
        /**
         * apagar_aviso()
         * 
         * Função desenvolvida para apagar os avisos cadastrados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se apagar e FALSE se não apagar
         */
        function apagar_aviso()
        {
            $id = $this->input->post('id');
            
            echo $this->avisos->apagar($id);
        }
        //**********************************************************************
        
        /**
         * inativar_aviso()
         * 
         * Função desenvolvida para inativar os avisos cadastrados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se inativar e FALSE se não inativar
         */
        function inativar_aviso()
        {
            $id = $this->input->post('id');
            
            echo $this->avisos->inativar($id);
        }
        //**********************************************************************
        
        /**
         * ativar_aviso()
         * 
         * Função desenvolvida para ativar os avisos cadastrados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se ativar e FALSE se não ativar
         */
        function ativar_aviso()
        {
            $id = $this->input->post('id');
            
            echo $this->avisos->ativar($id);
        }
        //**********************************************************************
    }
    /** End of File avisos_cadastrados.php **/
    /** Location ./application/controllers/avisos/avisos_cadastrados.php **/