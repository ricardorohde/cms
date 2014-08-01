<?php
    /**
     * A classe Presidentes é responsável por salvar e Editar informações sobre
     * os ex-presidentes do Pentáurea Clube
     */
    class Presidentes extends MY_Controller
    {
        /**
         * Construção da classe
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            $this->load->model('presidentes_model');
        }
        //----------------------------------------------------------------------
        
        /*
         * Função principal do controller, onde, inicialmente, serão chamadas as
         * visões
         */
        function index()
        {
            $this->load->view('paginas/presidentes');
        }
        //----------------------------------------------------------------------
        
        /**
         * Função desenvolvida para salvar um presidente na base de dados
         */
        function salvar_presidente()
        {
            $dados['nome']              = $this->input->post('nome');
            $dados['inicio_mandato']    = $this->input->post('inicio_mandato');
            $dados['fim_mandato']       = $this->input->post('fim_mandato');
            $dados['foto']              = $this->input->post('foto');
            $dados['status']            = 1;
            
            $resposta = $this->presidentes_model->salvar($dados);
            
            if($resposta == 1)
            {
                
                if($this->atualiza_miniatura($dados['foto']))
                {
                    /** Imprime 1 em caso de sucesso **/
                    echo 1;
                }
                else
                {
                    /** Imprime 2 no caso da imagem não redimensionar **/
                    echo 2;
                }
            }
            else
            {
                /** imprime 0 se não salvar no BD **/
                echo 0;
            }
            
        }
        //----------------------------------------------------------------------
        
        /**
         * Função desenvolvida para buscar todos os presidentes cadastrados
         */
        function buscar($offset = 0)
        {
            $limite = 15;
            $this->dados['presidentes'] = $this->presidentes_model->buscar($limite, $offset);
            
            if(!$this->dados['presidentes'] and $offset > 0)
            {
                $offset = $offset - $limite;
                $this->dados['presidentes'] = $this->presidentes_model->buscar($limite, $offset);
            }
            
            $config['base_url'] = app_baseurl().'presidentes/buscar';
            $config['per_page'] = $limite;
            $config['total_rows'] = $this->presidentes_model->conta_presidentes();
            
            $this->pagination->initialize($config);
            
            $this->dados['paginacao'] = $this->pagination->create_links();
            $this->dados['verificador'] = $offset;
            
            $this->load->view('paginas/paginados/presidentes_paginado', $this->dados);
        }
        //----------------------------------------------------------------------
        
        /**
         * @name        atualiza_miniatura()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Funçao desenvolvida para criar thumbnails das fotos dos
         *              presidentes
         * @param       string  $foto  contem o caminho da foto
         * @return      bool Retorna TRUE se redimensionar e FALSE se não
         */
        function atualiza_miniatura ($foto)
        {
            $site = array("http://".$_SERVER['HTTP_HOST'], '/2014/mvc');
            /** Retira as barras padrao pela invertidas **/
            $foto  = str_replace("\\", "/", $foto);
            
            /** Retira o dominio do site **/
            $foto  = str_replace($site, "", $foto);
            
            /** Carrega a Lib de manipulação de imagens **/
            $this->load->library('image_lib');
            
            /** Configurações para a nova imagem **/
            $config['image_library']    = 'GD2';
            $config['maintain_ratio']   = FALSE;
            $config['create_thumb']     = FALSE;
            $config['width']            = 640;
            $config['height']           = 480;
            $config['quality']          = '80%';
            $config['source_image']     = '..'.$foto;
            
            /** Inicializa a library de imagem **/
            $this->image_lib->initialize($config);
            
            if(!$this->image_lib->resize())
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        /**********************************************************************/
        
        /**
         * @name        excluir()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Funçao desenvolvida para apagar um presidente da base
         */
        function excluir()
        {
            $id = $this->input->post('id');
            
            $resposta   = $this->presidentes_model->excluir($id);
            
            if($resposta == 1)
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        }
    }
?>