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
     * @version		v1.2.1
     * @since		16/10/2014
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

            /**
             * Realiza a troca da barra padrão do windows e retira o host do 
             * endereço da imagem 
             **/
            $exclude	= array("\\", "//".$_SERVER['HTTP_HOST']);
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
            $dados['imagem_noticia'] = "//" . $_SERVER['HTTP_HOST'] . $dados['imagem_noticia'];
            
            // Realiza o save da notícia e verifica se a mesma foi salva
			$resultado = $this->noticias->salva_noticia($dados);
            ($resultado == 0 || $resultado == FALSE) ? $retorno_salvar = 0 : $retorno_salvar = 1;
            
            // Imprime o valor em formato JSON
            echo json_encode(array('r_imagem' => $retorno_imagem, 'r_salvar' => $retorno_salvar));
        }
        //**********************************************************************
    }
    
    /** End of File nova_noticia.php **/
    /** Location ./application/controllers/noticias/nova_noticia.php **/