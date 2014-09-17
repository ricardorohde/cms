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
	 * Descricao_barracas
	 * 
	 * Classe desenvolvida para gerenciar as descrições das barracas cadastradas
	 * 
	 * @package		Controllers
	 * @subpackage	Barracas
	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.3.0
	 * @since		11/09/2014
	 */
	class Descricao_barracas extends MY_Controller
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
			
			//Realiza o LOAD do model necessário para as operações
			$this->load->model('descricao_model', 'descricao');
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
			$this->load->view('paginas/barracas/descricao_barracas');
		}
		//**********************************************************************
		
		/**
		 * busca_descricoes()
		 * 
		 * Função desenvolvida para buscar as descrições das barracas
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
		 */
		function busca_descricoes()
		{
			$this->dados['descricoes'] = $this->descricao->busca_descricoes();
			
			$this->load->view('paginas/paginados/barracas/descricoes_paginados', $this->dados);
		}
		//**********************************************************************
		
		/**
		 * salvar_descricao()
		 *  
		 * Função desenvolvida para salvar a descrição das barracas
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @var			array $dados Recebe os dados que serão salvos
     	 * @return		bool Retorna TRUE se salvar e FALSE se não salvar
		 */
		function salvar_descricao()
		{
			$dados['sigla'] 			= mysql_real_escape_string($this->input->post('sigla'));
			$dados['titulo_barraca']	= mysql_real_escape_string($this->input->post('titulo_barraca'));
			$dados['descricao'] 		= mysql_real_escape_string($this->input->post('descricao'));
            $dados['id_valores'] 		= mysql_real_escape_string($this->input->post('id_valores'));
			
			echo $this->descricao->salvar_descricao($dados);
		}
		//**********************************************************************
		
		/**
		 * excluir()
		 * 
		 * Função desenvolvida para excluir uma descrição de barraca
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @var			int $id Recebe o ID do registro a ser excluido
     	 * @return		bool Retorna TRUE se excluir e FALSE se não excluir
		 */
		function excluir()
		{
			$id = $this->input->post('id');
			
			echo $this->descricao->excluir($id);
		}
		//**********************************************************************
		
		/**
		 * altera_descricao()
		 * 
		 * Função desenvolvida para alterar uma descrição
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @param		int $id Recebe o ID da descrição a ser buscada
		 */
		function altera_descricao($id = NULL)
		{
			$this->dados['descricao']	= $this->descricao->busca_byId($id);
			
			$this->view 				= 'popup/barracas/editar_descricao';
			$this->template 			= 'template/popup';
			$this->titulo 				= 'Editar descricao de barracas - MasterAdmin';
			
            $this->LoadView();
		}
		//**********************************************************************
		
		/**
		 * atualizar_descricao()
		 * 
		 * Função que atualiza os dados de uma descrição já salva
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @var			array $dados Recebe os dados que serão atualizados
     	 * @return		bool Retorna TRUE se atualizar e FALSE se não atualizar
		 */
		function atualizar_descricao()
		{
			$dados['sigla'] 			= $this->input->post('sigla');
			$dados['titulo_barraca'] 	= $this->input->post('titulo_barraca');
			$dados['id_valores']		= mysql_real_escape_string($this->input->post('id_valores'));
			$dados['descricao'] 		= $this->input->post('descricao');
			$dados['id'] 				= $this->input->post('id');
			
			echo $this->descricao->atualizar_descricao($dados);
		}
		//**********************************************************************
		
		/**
		 * descricao_combo()
		 * 
		 * Função desenvolvida para buscar as descrições das barracas e povoar combobox
		 * para cadastrar nova barraca
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @var			array $descricoes Recebe as descrições cadastradas no BD
     	 * @return		string Retorna uma string com os dados para preencherem
     	 * 				o combobox 
		 */
		function descricao_combo()
		{
			$descricoes = $this->descricao->busca_descricoes();
			
            echo '<option value="" data-week="" data-weekend="">Selecione uma opção...</option>';
            
			foreach($descricoes as $row)
			{
				echo '
                    <option value="'.$row->id.'" data-week="'.$row->valor.'" data-weekend="'.$row->valor_fim_semana.'">
                        '.$row->titulo_barraca.'
                    </option>';
			}
		}
		//**********************************************************************
	}
	/** End of File descricao_barracas.php **/
	/** Location ./application/controllers/barracas/descricao_barracas.php **/