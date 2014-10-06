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
            
            echo ($this->noticias->inativar_noticia($id)) ? "Notícia Marcada como Inativa" : "Não Foi possível realizar esta ação. Tente novamente";
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
			
            echo ($this->noticias->ativar_noticia($id)) ? "Notícia Marcada como Ativa" : "Não Foi possível realizar esta ação. Tente novamente";;
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
            
			echo ($this->noticias->excluir_noticia($id)) ? "Notícia excluída" : "Não Foi possível realizar esta ação. Tente novamente";
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
            /** Dados da notícia **/
            $dados['id']                = $this->input->post('id');
            $dados['titulo_noticia']    = $this->input->post('titulo_noticia');
            $dados['resumo_noticia']    = $this->input->post('resumo_noticia');
            $dados['imagem_noticia']    = $this->input->post('imagem_noticia');
            $dados['tipo_noticia']      = $this->input->post('tipo_noticia');
            $dados['posicionamento']    = $this->input->post('posicionamento');
            $dados['corpo_noticia']     = $this->input->post('corpo_noticia');
            $dados['usuario']           = $this->input->post('usuario');

            /**
             * Realiza a troca da barra padrão do windows e retira o host do 
             * endereço da imagem 
             **/
            $exclude	= array("\\", "http://".$_SERVER['HTTP_HOST']);
            $replace	= array("/", "");
            $dados['imagem_noticia'] = str_replace($exclude, $replace, $dados['imagem_noticia']);

            // Define o tamanho da imagem paseado no posicionamento da mesma
            if($dados['posicionamento'] == 1)
            {
                $width	= 640;
                $height = 480;
            }
            elseif($dados['posicionamento'] == 2)
            {
                $width	= 200;
                $height	= 100;
            }
			
			// Realiza o redimensionamento da imagem
            $this->load->library('redimensiona_imagem_library');
            $retorno_imagem = $this->redimensiona_imagem_library->redimensionar($dados['imagem_noticia'], $width, $height);
			
			// Retorna com o host para a string original do endereço da imagem
            $dados['imagem_noticia'] = "http://" . $_SERVER['HTTP_HOST'] . $dados['imagem_noticia'];
			
			// Realiza o save da notícia e verifica se a mesma foi salva
			$resultado = $this->noticias->atualiza_noticia($dados);
            ($resultado == 0 || $resultado == FALSE) ? $retorno_salvar = 0 : $retorno_salvar = 1;
			
			// Imprime o valor em formato JSON
            echo json_encode(array('r_imagem' => $retorno_imagem, 'r_salvar' => $retorno_salvar));
        }
        //**********************************************************************
    }
    /** End of File noticias_cadastradas.php **/
    /** Location ./application/controllers/noticias/noticias_cadastradas.php **/