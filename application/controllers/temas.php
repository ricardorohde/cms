<?php
    /**
     * @name temas.php
     * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.1
     * @return mixed
     */
    class Temas extends MY_Controller
    {

        /**
         * @name Construção da Classe
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @version 1.0.1
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            $this->load->model('temas_model');
            $this->dados['nome'] = $_SESSION['user']->nome_completo;
        }
        //----------------------------------------------------------------------

        /**
         * @name index()
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @uses Usado para chamar as visões e os dados que serão utilizados na
         * visão chamada
         */
        function index()
        {
            $this->load->view('paginas/temas');
        }
        //----------------------------------------------------------------------
        
        /**
         * @name busca_temas()
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @uses Usado para buscar temas já cadastrados no banco de dados
         * @return array retorna um array de dados, vindo do banco de dados
         */
        function busca_temas($offset = 0)
        {
            
            $limite = 10;
            $this->dados['temas']   = $this->temas_model->busca_temas($limite, $offset);
            
            
            $config['base_url']     = app_baseurl().'temas/busca_temas';
            $config['per_page']     = $limite;
            $config['total_rows']   = $this->temas_model->contar_temas();
            
            $this->pagination->initialize($config);
            $this->dados['paginacao']   = $this->pagination->create_links();
            $this->dados['verificador'] = $offset;
            
            $this->load->view('paginas/paginados/temas', $this->dados);
        }
        //----------------------------------------------------------------------
        
        /*
         * @name salvar_tema()
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @uses Usado para cadastrar um novo tema no site
         * @return integer
         */
        function salvar_tema()
        {
            $dados['imagem_background'] = $this->input->post('imagem_background');
            $dados['imagem_banner']     = $this->input->post('imagem_banner');
            $dados['cor_principal']     = $this->input->post('cor_principal');
            $dados['data_inicio']       = $this->input->post('data_inicio');
            $dados['data_expiracao']    = $this->input->post('data_expiracao');
            
            $resposta = $this->temas_model->salvar_tema($dados);
            echo $resposta;
        }
        //----------------------------------------------------------------------
        
        /**
         * @name excluir_tema()
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @uses A função é utilizada para excluir do banco de dados um tema pre
         * viamente salvo
         * @return integer
         */
        function excluir_tema()
        {
            $id = $this->input->post('id');
            
            echo $this->temas_model->excluir_tema($id);
        }
        //----------------------------------------------------------------------
        
        /**
         * @name editar_tema()
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @uses A função é utilizada para edição de um tema que já foi salvo
         * previamente no sistema
         */
        function editar_tema()
        {   
            $this->dados['tema'] = $this->temas_model->buscaTemaId($this->uri->segment(3)); 
            $this->view          = 'popup/editar_temas';
            $this->template      = 'template/popup';
            
            $this->LoadView();
        }
        //----------------------------------------------------------------------
        
        /**
         * @name salvar_edicaoTema()
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @uses A função é utilizada para salvar as alterações realizas em um 
         * tema
         * @return integer
         */
        function salvar_edicaoTema()
        {
            $dados['imagem_background']     = $this->input->post('imagem_background');
            $dados['imagem_banner']         = $this->input->post('imagem_banner');
            $dados['cor_principal']         = $this->input->post('cor_principal');
            $dados['data_inicio']           = $this->input->post('data_inicio');
            $dados['data_expiracao']        = $this->input->post('data_expiracao');
            $dados['id']                    = $this->input->post('id');
            
            echo $this->temas_model->salvar_edicaoTema($dados);
        }
        //----------------------------------------------------------------------
        
        /**
         * @name marcar()
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @package controllers/temas.php
         * @uses A função é utilizada para marcar um tema como ativo ou inativo
         * @return integer
         */
        function marcar()
        {
            $tipo        = $this->input->post('tipo');
            $dados['id'] = $this->input->post('id');
            
            if($tipo == 1)
            {
                $dados['status'] = 0;
            }
            elseif($tipo == 0)
            {
                $dados['status'] = 1;
            }
            
            echo $this->temas_model->marcar($dados);
        }
    }
?>