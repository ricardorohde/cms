<?php

    /**
     * noticias_cadastradas
     * 
     * @package     MY_Controller
     * @subpackage  Noticias_cadastradas
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    Classe desenvolvida para gerenciar as noticias cadastradas
     */
    class Noticias_cadastradas extends MY_Controller
    {
        /**
         * __contruct()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Construção da classe
         * @param       bool $requer_autenticacao Se esta variável estiver setada
         *              como TRUE, mostra que, para acessar este controller é 
         *              necessário fazer login no sistema
         * @access      public
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
         * @abstract    Função Principal da classe
         */
        function index()
        {
            $this->view     = 'noticias/noticias_cadastradas';
            $this->titulo   = 'Notícias Cadastradas';

            $this->LoadView();
        }
        //----------------------------------------------------------------------

        /**
         * busca_noticias()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função que realiza a busca das notícias cadastradas e 
         *              realiza a paginação para a visão do usuário;
         * @param       int $offset Indica o offset da pesquisa sql
         */
        function busca_noticias($offset = 0)
        {
            /** Indica o limite da pesquisa sql **/
            $limite = 20;
            
            /** Recebe as notícias cadastradas no BD **/
            $this->dados['noticias'] = $this->noticias_model->lista_noticias($limite, $offset);
            
            if (!$this->dados['noticias'] and $offset > 0)
            {
                $offset = $offset - 20;
                $this->dados['noticias'] = $this->noticias_model->lista_noticias($limite, $offset);
            }

            /** Configurações da paginação **/
            $config['uri_segment']  = 4;
            $config['base_url']     = app_baseUrl() . 'noticias/noticias_cadastradas/busca_noticias';
            $config['per_page']     = $limite;
            $config['total_rows']   = $this->noticias_model->conta_noticias();

            $this->pagination->initialize($config);
            
            /** Recebe os links da paginação e define um verificador, que será usado no ajax da view **/
            $this->dados['paginacao']   = $this->pagination->create_links();
            $this->dados['verificador'] = $offset;

            $this->load->view('paginas/paginados/noticias/noticia_paginada', $this->dados);
        }
        //**********************************************************************

        /**
         * inativar()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para inativar uma noticia
         */
        function inativar()
        {
            $id = $this->input->post('id');
            
            $marcado = $this->noticias_model->inativar_noticia($id);
            if ($marcado == 1)
            {
                echo "Notícia Marcada como Inativa";
            }
            else
            {
                echo "Não Foi possível realizar esta ação. Tente novamente";
            }
        }
        //**********************************************************************

        /**
         * ativar()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para inativar uma noticia
         */
        function ativar()
        {
            $id = $this->input->post('id');
            $marcado = $this->noticias_model->ativar_noticia($id);
            if ($marcado == 1)
            {
                echo "Notícia Marcada como Ativa";
            }
            else
            {
                echo "Não Foi possível realizar esta ação. Tente novamente";
            }
        }
        //**********************************************************************

        /**
         * excluir()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para excluir uma noticia
         */
        function excluir()
        {
            $id = $this->input->post('id');
            $marcado = $this->noticias_model->excluir_noticia($id);
            if ($marcado == 1)
            {
                echo "Notícia excluída";
            }
            else
            {
                echo "Não Foi possível realizar esta ação. Tente novamente";
            }
        }
        //**********************************************************************

        /**
         * editar()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para editar uma determinada notícia
         */
        function editar()
        {   
            /** Recebe o ID da notícia, passado no url **/
            $id_noticia = $this->uri->segment(4);
            
            $this->dados['noticia'] = $this->noticias_model->busca_noticiaId($id_noticia);
            $this->view = 'paginas/editores/noticias/noticia_edicao';
            $this->titulo = 'Edição de Notícia';
            $this->load->view($this->view, $this->dados);
        }
        //**********************************************************************

        /**
         * atualiza_noticia()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para salvar alterações no corpo da Notícia
         */
        function atualiza_noticia()
        {
            /** Dados da notícia **/
            $dados['id']                = $this->input->post('id');
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

            /** Retira o endereço do HOST, para poder redimensionar a imagem **/
            $exclude = array("http://" . $_SERVER['HTTP_HOST']);
            $dados['imagem_noticia'] = str_replace($exclude, "", $dados['imagem_noticia']);

            /** 
             * Chamada da library que realiza o redimensionamento e passa algumas
             * configurações como parâmetro
             **/
            $this->load->library('image_lib');
            $config['image_library']    = 'GD2';
            $config['maintain_ratio']   = FALSE;
            $config['create_thumb']     = FALSE;
            
            if ($dados['posicionamento'] == 1)
            {
                $config['width']        = 640;
                $config['height']       = 480;
            }
            elseif ($dados['posicionamento'] == 2)
            {
                $config['width']        = 200;
                $config['height']       = 100;
            }
            $config['quality']          = "75%";
            $config['source_image']     = ".." . $dados['imagem_noticia'];

            $this->image_lib->initialize($config);
            if (!$this->image_lib->resize())
            {
                $retorno = array('erro_imagem' => 2);
            }
            else
            {
                $dados['imagem_noticia'] = "http://" . $_SERVER['HTTP_HOST'] . $dados['imagem_noticia'];
                $id_noticia = $this->noticias_model->atualiza_noticia($dados);
                if ($id_noticia == 0 || $id_noticia == FALSE)
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
    
    /** End of File noticias_cadastradas.php **/
    /** Location ./application/controllers/noticias/noticias_cadastradas.php **/