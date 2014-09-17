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
     * Nova_noticia
     * 
     * Classe desenvolvida para a criação de uma nova notícia para o site
     * 
     * @package     Controllers
     * @subpackage  Noticias
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.2.0
     * @since		15/09/2014
     */
    class Nova_noticia extends MY_Controller
    {
        /**
         * __construct()
         * 
         * Realiza a construção da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         */
        public function __construct()
        {
            parent::__construct(TRUE);
            
            //Realiza o LOAD do model necessário
            $this->load->model('noticias_model', 'noticias');
        }
        //**********************************************************************

        /**
         * index()
         * 
         * Função principal da classe, responsável pela view inicial
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         */
        function index()
        {
            $this->load->view('/paginas/noticias/nova_noticia');
        }
        //**********************************************************************

        /**
         * salva_noticia()
         * 
         * Função que realiza o SAVE das informações preliminares da noticia
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		array Retorna um array com dódigos de erro
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
                $id_noticia = $this->noticias->salva_noticia($dados);
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