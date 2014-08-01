<?php
    /**
     * @package     - diretoria/diretoria
     * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    - Controller desenvolvido para gerenciar as transações envol
     *                os diretores da instituição
     */
    class Diretoria extends MY_Controller {

        /**
         * @name        - __construct()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Realiza a construção da classe
         */
        public function __construct($requer_autenticacao = TRUE) {
            parent::__construct($requer_autenticacao);
            
            /** Chamada do model responsável **/
            $this->load->model('diretoria/diretoria_model');
        }
        //**********************************************************************

        /**
         * @name        - index()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Função desenvolvida para chamar a tela de cadastro das
         *                diretorias
         */
        function index() {
            $this->load->view('paginas/diretoria/diretoria');
        }
        //**********************************************************************
        
        /**
         * @name        - busca_diretorias()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Função desenvolvida para buscar as diretorias 
         *                cadastradas
         */
        function busca_diretorias($offset = 0)
        {
            /** Indica o limite de resultados **/
            $limite = 20;
            
            /** Variável recebe as diretorias cadastradas **/
            $this->dados['diretorias'] = $this->diretoria_model->busca_diretorias($limite, $offset);
            
            /** Configurações para a paginação **/
            $config['uri_segment']  = 4;
            $config['base_url']     = app_baseurl().'diretoria/diretoria/busca_diretorias';
            $config['per_page']     = $limite;
            $config['total_rows']   = $this->diretoria_model->conta_diretorias();
            
            /** Inicializa a paginação a insere numa variavel **/
            $this->pagination->initialize($config);
            $this->dados['paginacao'] = $this->pagination->create_links();
            
            /** Chama a visão e insere os dados **/
            $this->load->view('paginas/paginados/diretoria/diretoria', $this->dados);
        }
        //**********************************************************************
        
        /**
         * @name        - salvar_diretoria()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Função desenvolvida para salvar uma nova diretoria
         */
        function salvar_diretoria()
        {
            /** Recebimento dos dados via POST **/
            $dados['ano_inicio']  = $this->input->post('ano_inicio');
            $dados['ano_final']   = $this->input->post('ano_final');
            $dados['observacoes'] = $this->input->post('observacoes');
            
            /** Recebe o Callback se a função salvou ou não **/
            $resposta = $this->diretoria_model->salvar_diretoria($dados);
            
            if($resposta == 1)
            {
                echo $resposta;
            }
            else
            {
                echo 0;
            }
        }
    }
?>