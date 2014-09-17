<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Content Manegement System
	 * 
	 * Sistema desenvolvido para facilitar a inserção e atualização de dados no
	 * site do Pentáurea Clube
	 * 
	 * @package		CMS
	 * @author		Masterkey Informática
	 * @copyright	Copyright (c) 2010 - 2014, Masterkey Informática LTDA
	 */

    /**
     * Noticias_cadastradas
     * 
     * Classe desenvolvida para gerenciar as noticias cadastradas
     * 
     * @package     Controllers
     * @subpackage  Noticias
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		1.2.0
     * @since		15/09/2014
     */
    class Noticias_cadastradas extends MY_Controller
    {
        /**
         * __contruct()
         * 
         * Realiza a construção da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        public function __construct()
        {
            parent::__construct(TRUE);
            
            $this->load->model('noticias_model', 'noticias');
        }
        //**********************************************************************

        /**
         * index()
         * 
         * Função Principal da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         */
        function index()
        {
            $this->view     = 'noticias/noticias_cadastradas';
            $this->titulo   = 'Notícias Cadastradas';

            $this->LoadView();
        }
        //**********************************************************************

        /**
         * busca_noticias()
         * 
         * Função que realiza a busca das notícias cadastradas e realiza a 
         * paginação para a visão do usuário;
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param       int $offset Indica o offset da pesquisa sql
         */
        function busca_noticias($offset = 0)
        {
            /** Indica o limite da pesquisa sql **/
            $limite = 20;
            
            /** Recebe as notícias cadastradas no BD **/
            $this->dados['noticias'] = $this->noticias->lista_noticias($limite, $offset);
            
            if (!$this->dados['noticias'] and $offset > 0)
            {
                $offset = $offset - 20;
                $this->dados['noticias'] = $this->noticias->lista_noticias($limite, $offset);
            }

            /** Configurações da paginação **/
            $config['uri_segment']  = 4;
            $config['base_url']     = app_baseUrl() . 'noticias/noticias_cadastradas/busca_noticias';
            $config['per_page']     = $limite;
            $config['total_rows']   = $this->noticias->conta_noticias();

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
         * Função desenvolvida para inativar uma noticia
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		string Retorna uma mensagem de erro para o usuário
         */
        function inativar()
        {
            $id = $this->input->post('id');
            
            $marcado = $this->noticias->inativar_noticia($id);
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
         * Função desenvolvida para inativar uma noticia
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		string Retorna Uma mensagem de erro para o usuário
         */
        function ativar()
        {
            $id = $this->input->post('id');
            $marcado = $this->noticias->ativar_noticia($id);
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
         * Função desenvolvida para excluir uma noticia
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		string Retorna uma mensagem de erro para o usuário
         */
        function excluir()
        {
            $id = $this->input->post('id');
            $marcado = $this->noticias->excluir_noticia($id);
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
         * Função desenvolvida para editar uma determinada notícia
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $id_noticia Recebe o ID da notícia a ser editada
         */
        function editar($id_noticia = NULL)
        {
            $this->dados['noticia'] = $this->noticias->busca_noticiaId($id_noticia);
            $this->view 			= 'paginas/editores/noticias/noticia_edicao';
            $this->titulo 			= 'Edição de Notícia';
            
            $this->load->view($this->view, $this->dados);
        }
        //**********************************************************************

        /**
         * atualiza_noticia()
         * 
         * Função desenvolvida para salvar alterações no corpo da Notícia
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		array Retorna um array Json com códigos de erro
         */
        function atualiza_noticia()
        {
            /** Inicialização das variáveis que receberão as mensagens de erro **/
            $erro_imagem        = '';
            $erro_salvamento    = '';
            $sucesso            = '';
            
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
            
            if (!$this->image_lib->resize())
            {
                $erro_imagem = 2;
            }
                $dados['imagem_noticia'] = "http://" . $_SERVER['HTTP_HOST'] . $dados['imagem_noticia'];
                $id_noticia = $this->noticias->atualiza_noticia($dados);
                if ($id_noticia == 0 || $id_noticia == FALSE)
                {
                    $erro_salvamento = 0;
                    
                }
                else
                {
                    $sucesso = 1;
                }
            
            $retorno = array(
                'erro_imagem'       => $erro_imagem,
                'erro_salvamento'   => $erro_salvamento,
                'sucesso'           => $sucesso
            );
            
            echo json_encode($retorno);
        }
        //**********************************************************************
    }
    /** End of File noticias_cadastradas.php **/
    /** Location ./application/controllers/noticias/noticias_cadastradas.php **/