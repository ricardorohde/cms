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
	 * Presidentes
	 *
	 * Classe responsável por salvar e Editar informações sobre os 
	 * ex-presidentes do Pentáurea Clube
	 *
	 * @package		Controllers
	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version     v1.2.0
	 * @since		15/09/2014
	 */
    class Presidentes extends MY_Controller
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
            
            /** Realiza o LOAD do model necessário **/
            $this->load->model('presidentes_model', 'presidentes');
        }
        //**********************************************************************
        
        /**
         * index()
         * 
         * Função principal do controller, responsável pela view inicial
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
         */
        function index()
        {
            $this->load->view('paginas/presidentes');
        }
        //**********************************************************************
        
        /**
         * salvar_presidente()
         * 
         * Função desenvolvida para salvar um presidente na base de dados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @return		bool Retorna TRUE se salvar e FALSE se não salvar
         */
        function salvar_presidente()
        {
            $dados['nome']              = $this->input->post('nome');
            $dados['inicio_mandato']    = $this->input->post('inicio_mandato');
            $dados['fim_mandato']       = $this->input->post('fim_mandato');
            $dados['foto']              = $this->input->post('foto');
            
            $resposta = $this->presidentes->salvar($dados);
            
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
        //**********************************************************************
        
        /**
         * buscar()
         * 
         * Função desenvolvida para buscar todos os presidentes cadastrados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $offset Recebe o offset que será usado no sql
         */
        function buscar($offset = 0)
        {
        	//Recebe o limite da busca sql
            $limite = 15;
            
            //Recebe os dados do BD
            $this->dados['presidentes'] = $this->presidentes->buscar($limite, $offset);
            
            if(!$this->dados['presidentes'] and $offset > 0)
            {
                $offset = $offset - $limite;
                $this->dados['presidentes'] = $this->presidentes->buscar($limite, $offset);
            }
            
            //Configurações da paginação
            $config['base_url'] 	= app_baseurl().'presidentes/buscar';
            $config['per_page'] 	= $limite;
            $config['total_rows'] 	= $this->presidentes->conta_presidentes();
            
            $this->pagination->initialize($config);
            
            $this->dados['paginacao'] = $this->pagination->create_links();
            $this->dados['verificador'] = $offset;
            
            $this->load->view('paginas/paginados/presidentes_paginado', $this->dados);
        }
        //----------------------------------------------------------------------
        
        /**
         * atualiza_miniatura()
         * 
         * Funçao desenvolvida para criar thumbnails das fotos dos presidentes
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Private
         * @param       string  $foto  contem o caminho da foto
         * @return      bool Retorna TRUE se redimensionar e FALSE se não
         */
        private function atualiza_miniatura ($foto)
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
        //**********************************************************************
        
        /**
         * excluir()
         * 
         * Funçao desenvolvida para apagar um presidente da base
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		bool Retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir()
        {
            $id = $this->input->post('id');
            
            echo $this->presidentes->excluir($id);
        }
        //**********************************************************************
        
        /**
         * alterar_presidente()
         * 
         * Função desenvolvida para chamar o formulário de alteração dos dados 
         * de um presidente cadastrado
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $id Contém o ID do registro que será buscado para 
         * 				alteração
         */
        function alterar_presidente($id)
        {
			$this->dados['presidente'] = $this->presidentes->buscar_byId($id);
			
			$this->template	= 'template/popup';
			$this->view		= 'popup/editar_presidente';
			$this->titulo	= 'Editar presidente';
			
			$this->LoadView();
        }
        //**********************************************************************
        
        /**
         * alterar()
         * 
         * Função desenvolvida para alterar os dados de um presidente cadastrado
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		bool Return TRUE se alterar e FALSE se não alterar
         */
        function alterar()
        {
        	$dados['id'] 				= $this->input->post('id');
        	$dados['nome'] 				= $this->input->post('nome_presidente');
        	$dados['inicio_mandato']	= $this->input->post('inicio_mandato');
        	$dados['fim_mandato'] 		= $this->input->post('fim_mandato');
        	$dados['foto'] 				= $this->input->post('fotografia');
        	
        	if($this->presidentes->atualizar($dados) == 1)
        	{
        		$this->atualiza_miniatura($dados['foto']);
        		echo 1;
        	}
        	else
        	{
        		echo 0;
        	}
        }
        //**********************************************************************
    }
	/** End of File presidentes.php **/
    /** Location ./application/controllers/presidentes.php **/