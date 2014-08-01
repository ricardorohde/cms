<?php
    
    /**
     * Contato.php
     * 
     * @package     MY_Controller
     * @subpackage  Contato
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    Classe desenvolvida para realizar a gerência das mensagens
     *              que são enviadas pelo formulário do site
     */
    class Contato extends MY_Controller
    {
        /**
         * __construct()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Construção da classe de Contato
         * @param       bool $requer_autenticacao Se for setado com TRUE, indica
         *              que, para acessar a classe, é necessário fazer login
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            $this->load->model('contato_model');
        }
        //**********************************************************************


        /**
         * index()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função principal da classe
         */
        function index()
        {
            $this->load->view('paginas/contato/contato');
        }
        //**********************************************************************

        /**
         * marcar()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função que fará a marcação da mensagem de contato, caso 
         *              a mesma seja acionada
         */
        function marcar()
        {
            $id_contato = $this->input->post('id');
            $marcado = $this->contato_model->marcar_lido($id_contato);
            if($marcado == 1)
            {
                echo "Mensagem marcada como Lida";
            }
            else
            {
                echo "Ocorreu um erro - Tente novamente";
            }
        }
        //**********************************************************************


        /**
         * buscar_contatos()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função que faz a busca das mensagens que ainda não foram
         *              lidas e cria a paginação para navegação do usuário
         * @param       int $offset Define o offset que será usado na consulta sql
         */
        function buscar_contatos($offset = 0)
        {
            /** Define o limite da busca **/
            $limite = 7;
            
            /** Recebe as mensagens que estão cadastradas **/
            $this->dados['contatos'] = $this->contato_model->lista_contatos($limite, $offset);
            
            if(!$this->dados['contatos'] and $offset > 0)
            {
                $offset                     = $offset - 7;
                $this->dados['contatos']    = $this->contato_model->lista_contatos($limite, $offset);
            }
            
            /** Configurações da paginação **/
            $config['uri_segment']  = 4;
            $config['base_url']     = app_baseUrl() . 'contato/contato/buscar_contatos';
            $config['per_page']     = $limite;
            $config['total_rows']   = $this->contato_model->conta_contatos();

            /** 
             * Realiza a criação do links e salva o offset em uma variável. Este
             * valor será usado na página onde as notícias serão exibidas
             **/
            $this->pagination->initialize($config);
            
            $this->dados['paginacao']   = $this->pagination->create_links();
            $this->dados['verificador'] = $offset;

            $this->load->view('paginas/paginados/contato/contato_paginado', $this->dados);
        }
        //**********************************************************************

        /**
         * verifica_mensagem()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função que busca uma mensagem clicada
         */
        function verificar_mensagem($id)
        {
            $this->dados['mensagem'] = $this->busca_mensagem($id);
            
            $this->load->view('paginas/contato/abrir_mensagem', $this->dados);
        }
        //**********************************************************************
        
        /**
         * responder_mensagem()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para responder uma mesagem
         */
        function responder_mensagem()
        {
            $id = $this->uri->segment(4);
            $this->dados['mensagem'] = $this->busca_mensagem($id);
            $this->load->view('paginas/contato/responder_mensagem', $this->dados);
        }
        //**********************************************************************
        
        /**
         * busca_mensagem()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para buscar uma mensagem de acordo o ID passado
         * @param       int $id Contém o ID da mensagem que será buscada
         * @return      array   Retorna um array contendo os dados da mensagem buscada
         * @access      private
         */
        private function busca_mensagem($id)
        {
            return $this->contato_model->buscar_contato($id);
        }
        //**********************************************************************
    }
    /** End of File contato.php **/
    /** Location ./application/controllers/contato **/