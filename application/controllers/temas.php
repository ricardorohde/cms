<?php
    
    /**
     * temas
     * 
     * Classe desenvolvida para criar temas para o site
     * 
     * @package     CI_Controller
     * @subpackage  MY_Controller
     * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.1
     */
    class Temas extends MY_Controller
    {

        /**
         * __construct()
         * 
         * Realiza a construção da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            
            $this->load->model('temas_model');
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
            $this->load->view('paginas/temas');
        }
        //**********************************************************************
        
        /**
         * busca_temas()
         * 
         * Usado para buscar temas já cadastrados no banco de dados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $offset Contém o ofsset que será usado na consulta sql
         * @return      array retorna um array de dados, vindo do banco de dados
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
        //**********************************************************************
        
        /**
         * salvar_tema()
         * 
         * Usado para cadastrar um novo tema no site
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se salvar e FALSE se não salvar
         */
        function salvar_tema()
        {
            $dados['imagem_background'] = $this->input->post('imagem_background');
            $dados['imagem_banner']     = $this->input->post('imagem_banner');
            $dados['cor_principal']     = $this->input->post('cor_principal');
            $dados['data_inicio']       = $this->input->post('data_inicio');
            $dados['data_expiracao']    = $this->input->post('data_expiracao');
            
            echo $this->temas_model->salvar_tema($dados);
        }
        //**********************************************************************
        
        /**
         * excluir_tema()
         * 
         * A função é utilizada para excluir do banco de dados um tema previamente salvo
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se apagar e FALSE se não apagar
         */
        function excluir_tema()
        {
            $id = $this->input->post('id');
            
            echo $this->temas_model->excluir_tema($id);
        }
        //**********************************************************************
        
        /**
         * editar_tema()
         * 
         * A função é utilizada para edição de um tema que já foi salvo
         * previamente no sistema
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function editar_tema()
        {   
            $this->dados['tema'] = $this->temas_model->buscaTemaId($this->uri->segment(3)); 
            $this->view          = 'popup/editar_temas';
            $this->template      = 'template/popup';
            
            $this->LoadView();
        }
        //**********************************************************************
        
        /**
         * salvar_edicaoTema()
         * 
         * A função é utilizada para salvar as alterações realizas em um tema
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se atualizar e FALSE se não atualizar
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
        //**********************************************************************
        
        /**
         * marcar()
         * 
         * A função é utilizada para marcar um tema como ativo ou inativo
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se marcar e FALSE se não marcar
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
        //**********************************************************************
    }
    /** End of File temas.php **/
    /** Location ./application/controllers/temas.php **/