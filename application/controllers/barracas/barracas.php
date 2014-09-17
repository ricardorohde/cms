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
     * Barracas
     * 
     * Classe desenvolvida para gerência das barracas
     * 
     * @package     Controllers
     * @subpackage  Barracas
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.3.0
     * @since		11/09/2014
     */
	class Barracas extends MY_Controller
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

			//Realiza o LOAD do model que será usado nas transações
			$this->load->model('barracas_model', 'barracas');
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
			$this->load->view('paginas/barracas/barracas');
		}
		//**********************************************************************
		
		/**
		 * busca_barracas()
		 * 
		 * Função que busca as barracas cadastradas e realiza a paginação para
		 * exibição
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @param		int $offset		Contém o offset que será usado no sql
     	 * @var			int $limite		Contém o limite que será usado no sql
     	 * @var			array $config	Contém as consfigurações que serão usadas
     	 * 				na paginação
		 */
		function busca_barracas($offset = 0)
		{
			/** Recebe o limite da pesquisa **/
			$limite = 10;
			
			/** Recebe as barracas cadastradas **/
			$this->dados['barracas'] = $this->barracas->lista_barracas($limite, $offset);
			
			if(!$this->dados['barracas'] and $offset > 0)
			{
				$offset = $offset - 10;
				
				$this->dados['barracas'] = $this->barracas->lista_barracas($limite, $offset);
			}
			
			/** Configurações de paginação **/
			$config['uri_segment']	= 4;
			$config['base_url'] 	= app_baseUrl().'barracas/barracas/busca_barracas';
			$config['per_page'] 	= $limite;
			$config['total_rows'] 	= $this->barracas->conta_barracas();
			
			$this->pagination->initialize($config);
			
			$this->dados['paginacao']	= $this->pagination->create_links();
			$this->dados['verificador'] = $offset;
			
			$this->load->view('paginas/paginados/barracas/barraca_paginada', $this->dados);
		}
        //**********************************************************************
        
        /**
         * salvar_barraca()
         * 
         * Função desenvolvida para salvar uma nova barraca
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @var			array Contém os dados que serão salvos no BD
     	 * @return		bool Retorna TRUE se salvar e FALSE se não salvar
         */
        function salvar_barraca()
        {
            $dados['numero_barraca']	= $this->input->post('numero_barraca');
            $dados['id_descricao'] 		= $this->input->post('id_descricao');
            $dados['localizacao'] 		= $this->input->post('localizacao');
            
            echo $this->barracas->salvar_barraca($dados);
        }
        //----------------------------------------------------------------------
        
        /**
         * excluir_barraca()
         * 
         * Função desenvolvida para excluir uma barraca da base de dados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @var			int $id Contém o ID do registro a ser excluido
     	 * @return		bool Retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir_barraca()
        {
            $id = $this->input->post('id');
            
            echo $this->barracas->excluir_barraca($id);
        }
        //----------------------------------------------------------------------
        
        /**
         * altera_barraca()
         * 
         * Função desenvolvida para alterar o valor de uma barraca
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @param		int $id Contém o ID do registro que se deseja alterar
         */
        function altera_barraca($id = NULL)
        {
            $this->view		= 'popup/barracas/editar_barracas';
            $this->template = 'template/popup';
			$this->titulo 	= 'Editar descricao de barracas - MasterAdmin';
			
			$this->dados['barraca'] = $this->barracas->buscar_barraca($id);
			
            $this->LoadView();
        }
        //**********************************************************************
        
        /**
         * atualizar_barraca()
         * 
         * Função desenvolvida para atualizar os dados de uma barraca
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @var			array $dados Contém os dados que serão atualizados
         * @return		bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function atualizar_barraca()
        {
        	$dados['id']				= mysql_real_escape_string($this->input->post('id'));
        	$dados['numero_barraca']	= mysql_real_escape_string($this->input->post('numero_barraca'));
        	$dados['id_descricao'] 		= mysql_real_escape_string($this->input->post('id_descricao'));
        	$dados['localizacao'] 		= mysql_real_escape_string($this->input->post('localizacao'));
        	
        	echo $this->barracas->update($dados);
        }
        //**********************************************************************
    }
    /** End of File barracas.php **/
    /** Location ./application/controllers/barracas/barracas.php **/