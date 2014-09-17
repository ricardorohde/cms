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
	 * Diretoria
	 *
	 * Classe desenvolvida para gerenciar as transações envolvendo os diretores
	 * da instituição
	 *
	 * @package		Controllers
	 * @subpackage	Diretoria
	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version     v1.2.0
	 * @since		15/09/2014
	 */
    class Diretoria extends MY_Controller
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
            
            /** Chamada do model responsável **/
            $this->load->model('diretoria/diretoria_model', 'diretoria');
            $this->load->model('diretoria/diretores_model', 'diretores');
        }
        //**********************************************************************

        /**
         * index()
         * 
         * Função desenvolvida para chamar a tela de cadastro das diretorias
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         */
        function index() {
            $this->load->view('paginas/diretoria/diretoria');
        }
        //**********************************************************************
        
        /**
         * busca_diretorias()
         * 
         * Função desenvolvida para buscar as diretorias cadastradas
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $offset Contém o offset que será usado no sql
         */
        function busca_diretorias($offset = 0)
        {
            /** Indica o limite de resultados **/
            $limite = 20;
            
            /** Variável recebe as diretorias cadastradas **/
            $this->dados['diretorias'] = $this->diretoria->busca_diretorias($limite, $offset);
            
            /** Configurações para a paginação **/
            $config['uri_segment']  = 4;
            $config['base_url']     = app_baseurl().'diretoria/diretoria/busca_diretorias';
            $config['per_page']     = $limite;
            $config['total_rows']   = $this->diretoria->conta_diretorias();
            
            /** Inicializa a paginação a insere numa variavel **/
            $this->pagination->initialize($config);
            $this->dados['paginacao'] = $this->pagination->create_links();
            
            /** Chama a visão e insere os dados **/
            $this->load->view('paginas/paginados/diretoria/diretoria', $this->dados);
        }
        //**********************************************************************
        
        /**
         * salvar_diretoria()
         * 
         * Função desenvolvida para salvar uma nova diretoria
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		bool Retorna TRUE se salvar e FALSE se não salvar 
         */
        function salvar_diretoria()
        {
            /** Recebimento dos dados via POST **/
            $dados['ano_inicio']  = $this->input->post('ano_inicio');
            $dados['ano_final']   = $this->input->post('ano_final');
            $dados['observacoes'] = $this->input->post('observacoes');
            
            echo $this->diretoria->salvar_diretoria($dados);
        }
        //**********************************************************************
        
        /**
         * verificar_diretores()
         * 
         * Função desenvolvida para verificar se existe diretores cadastrados
         * para uma diretoria
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		int Retorna a quantidade de diretores cadastrados para 
         * 				uma diretoria
         */
        function verificar_diretores()
        {
        	$id = $this->input->post('id');
        	
        	echo $this->diretores->contar_byDiretoria($id);
        }
        //**********************************************************************
        
        /**
         * excluir()
         * 
         * Função desenvolvida para excluir uma diretoria
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		bool Retorna para a interface TRUE se excluir ou FALSE
         * 				se não excluir
         */
        function excluir()
        {
        	$id 		= $this->input->post('id');
        	$excluir	= $this->input->post('excluir_diretores');

        	echo $this->diretoria->delete($id);
        	
        	if(isset($excluir) && $excluir == 1)
        	{
        		$this->diretores->excluir_diretoresDiretorias($id);
        	}
        }
        //**********************************************************************
        
        /**
         * editar_diretoria()
         * 
         * Função desenvolvida para realizar a edição de uma diretoria
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $id Contém o ID da diretoria a ser editada
         */
        function editar_diretoria($id)
        {
			$this->dados['diretoria'] = $this->diretoria->buscar_byId($id);

			$this->template = 'template/popup';
			$this->view		= 'popup/editar_diretoria';
			
			$this->LoadView();
        }
        //**********************************************************************
        
        /**
         * salvarEdicao()
         * 
         * Função desenvolvida para atualizar os dados de uma diretoria 
         * cadastrada
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function salvarEdicao()
        {
        	$dados['id']			= $this->input->post('id');
        	$dados['ano_inicio']	= $this->input->post('ano_inicio');
        	$dados['ano_final']		= $this->input->post('ano_final');
        	$dados['observacoes']	= $this->input->post('observacoes');
        	
        	echo $this->diretoria->atualizar($dados);
        }
        //**********************************************************************
    }
	/** End of File diretoria.php **/
    /** Location ./application/controllers/diretoria/diretoria.php **/