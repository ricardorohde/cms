<?php
    /**
     * @package     MY_Conntroller
     * @subpackage  Avisos_cadastrados
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    Classe desenvolvida para gerenciar os avisos cadastrados
     */
    class Avisos_cadastrados extends MY_Controller
    {
        /**
         * @name        __construct
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Realiza a construção da classe
         * @param       bool    $requer_autenticacao    Se TRUE, é necessário estar
         *              logado para acessar a classe
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            $this->load->model('avisos/avisos_model');
        }
        /**********************************************************************/
        
        /**
         * @name        index()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função principal da Classe
         */
        function index()
        {
            $this->load->view('paginas/avisos/avisos_cadastrados');
        }
        /**********************************************************************/
        
        /**
         * @name        busca_cadastrados()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Funçao desenvolvida para buscar os avisos cadastrados
         * 
         * @param       int     $offset                 Define o offset da pesquisa
         * @param       int     $limite                 Define o limite da pesquisa
         * @param       array   $this->dados['avisos']  Recebe os avisos da função de busca
         */
        function busca_cadastrados($offset = 0)
        {
            $limite = 20;
            
            $this->dados['avisos'] = $this->avisos_model->busca_avisos($limite, $offset);
            
            if(!$this->dados['avisos'] && $offset > 0)
            {
                $offset = $offset - $limite;
                $this->dados['avisos'] = $this->avisos_model->busca_avisos($limite, $offset);
            }
            
            /** Configurações para a paginação **/
            $config['base_url']     = app_baseurl().'painel/avisos_cadastrados/busca_cadastrados';
            $config['per_page']     = $limite;
            $config['uri_segment']  = 4;
            $config['total_rows']   = $this->avisos_model->contar_avisos();
            
            /** Inicalização da paginação **/
            $this->pagination->initialize($config);
            $this->dados['paginacao'] = $this->pagination->create_links();
            
            $this->load->view('paginas/paginados/avisos/avisos_cadastrados', $this->dados);
        }
    }
?>