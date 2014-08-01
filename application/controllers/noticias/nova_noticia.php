<?php

    /**
     * nova_noticia
     * 
     * @package     MY_Controller
     * @subpackage  Nova_noticia
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    Classe desenvolvida para a criação de uma nova notícia para
     *              o site
     */
    class Nova_noticia extends MY_Controller
    {
        /**
         * __construct()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Construção da classe de login
         * @param       bool $requer_autenticacao Se esta variável foi setada como
         *              TRUE, indica que, para acessar esta classe é necessário
         *              fazer login
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            $this->load->model('noticias_model');
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
            $this->load->view('/paginas/noticias/nova_noticia', $this->dados);
        }
        //**********************************************************************

        /**
         * salva_noticia()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função que realiza o SAVE das informações preliminares 
         *              da noticia
         */
        function salva_noticia()
        {
            $dados['titulo_noticia']    = $this->input->post('titulo_noticia');
            $dados['resumo_noticia']    = $this->input->post('resumo_noticia');
            $dados['imagem_noticia']    = $this->input->post('imagem_noticia');
            $dados['tipo_noticia']      = $this->input->post('tipo_noticia');
            $dados['posicionamento']    = $this->input->post('posicionamento');
            $dados['corpo_noticia']     = $this->input->post('corpo_noticia');
            $dados['usuario']           = $this->input->post('usuario');

            /** Trocando a barra, caso venha padrão do windows **/
            $exclude = array("\\");
            $dados['imagem_noticia'] = str_replace($exclude, "/", $dados['imagem_noticia']);

            /** Exclui o HOST, para que a imagem de capa possa ser redimencionada **/
            $exclude = array("http://".$_SERVER['HTTP_HOST']);
            $dados['imagem_noticia'] = str_replace($exclude, "", $dados['imagem_noticia']);

            /** Carrega a library para manipulação de imagem e seta as configurações para esta manipulação **/
            $this->load->library('image_lib');
            
            $config['image_library']    = 'GD2';
            $config['maintain_ratio']   = FALSE;
            $config['create_thumb']     = FALSE;
            
            if($dados['posicionamento'] == 1)
            {
                $config['width']    = 640;
                $config['height']   = 480;
            }
            elseif($dados['posicionamento'] == 2)
            {
                $config['width']    = 200;
                $config['height']   = 100;
            }
            
            $config['quality']         = "75%";
            $config['source_image']    = ".." . $dados['imagem_noticia'];

            $this->image_lib->initialize($config);
            
            if(!$this->image_lib->resize())
            {
                $retorno = array('erro_imagem' => 2);
            }
            else
            {
                $dados['imagem_noticia'] = "http://" . $_SERVER['HTTP_HOST'] . $dados['imagem_noticia'];
                $id_noticia = $this->noticias_model->salva_noticia($dados);
                if($id_noticia == 0 || $id_noticia == FALSE)
                {
                    $retorno = array('erro_salvamento' => 0);
                }
                else
                {
                    $retorno = array('sucesso' => 1);
                }
            }
            echo json_encode($retorno);
        }
        //**********************************************************************
    }
    
    /** End of File nova_noticia.php **/
    /** Location ./application/controllers/noticias/nova_noticia.php **/