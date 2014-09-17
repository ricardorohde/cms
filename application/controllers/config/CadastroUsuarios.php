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
	 * CadastroUsuarios
	 * 
	 * Classe desenvolvida para gerenciar os usuários do sistema
	 * 
	 * @package		Controllers
	 * @subpackage	Config
	 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version		v1.0
	 * @since		08/09/2014
	 */
	class CadastroUsuarios extends MY_Controller
	{
		/**
		 * __construct()
		 * 
		 * Realiza a construção da classe
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 */
		public function __construct()
		{
			parent::__construct(TRUE);
			
			//Carrega o model correspondente
			$this->load->model('usuarios');
		}
		//**********************************************************************
		
		/**
		 * index()
		 * 
		 * Função principal da classe, responsável pela visão inicial do sistema
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 */
		function index()
		{
			$this->load->view('paginas/config/CadastroUsuarios');
		}
		//**********************************************************************
		
		/**
		 * buscar()
		 * 
		 * Função desenvolvida para buscar os usuários cadastrados
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 */
		function buscar()
		{
			$this->dados['usuarios'] = $this->usuarios->get();
			
			$this->load->view('paginas/paginados/config/listar_usuarios', $this->dados);
		}
		//**********************************************************************
		
		/**
		 * salvar()
		 * 
		 * Função desenvolvida para salvar um novo usuário no sistema
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @return		bool	Retorna 1 se salvar e 0 se não salvar
		 */
		function salvar()
		{
			//Faz a associação entre os dados e os campos da tabela
			$data = array(
				'nome_completo'	=> mysql_real_escape_string($this->input->post('nome_completo')),
				'nome_usuario'	=> mysql_real_escape_string($this->input->post('nome_usuario')),
				'email'			=> mysql_real_escape_string($this->input->post('email')),
				'senha'			=> md5(mysql_real_escape_string($this->input->post('senha'))),
				'status'		=> 1
			);
			
			echo $this->usuarios->insert($data);
		}
		//**********************************************************************
		
		/**
		 * mudarStatus()
		 * 
		 * Função desenvolvida para alterar o status do usuário
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @return		bool	Retorna TRUE se atualizar e FALSE se não atualizar
		 */
		function mudarStatus()
		{
			$acao	= $this->input->post('acao');
			$id		= $this->input->post('id');
			
			switch ($acao)
			{
				case 'excluir':
					echo $this->excluirUsuario($id);
					break;
				case 'inativar':
					$data = array('status' => 0);
					echo $this->usuarios->update($data, $id);
					break;
				case 'ativar':
					$data = array('status' => 1);
					echo $this->usuarios->update($data, $id);
					break;
				default:
					echo 'Erro na passagem do parâmetro';
			}
		}
		//**********************************************************************
		
		/**
		 * excluirUsuario()
		 * 
		 * Função desenvolvida para excluir um usuário
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Private
		 * @param		int $id	Contém o ID do registro a ser apagado
		 * @return		bool	Retorna TRUE se apagar e FALSE se não apagar 
		 */
		private function excluirUsuario($id)
		{
			return $this->usuarios->delete($id);
		}
		//**********************************************************************
		
		/**
		 * editar()
		 * 
		 * Função desenvolvida para editar um usuário cadastrado
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @param		int $id	Contém o ID do registro a ser buscado
		 * @var			array $where Recebe a cláusula WHERE que será executada
		 * 				no sql
		 */
		function editar($id = NULL)
		{
			if(isset($id))
			{
				$where = array('id' => $id);
				
				$this->dados['usuario'] = $this->usuarios->get($where);
				
				$this->template		= 'template/popup';
				$this->LoadView();
			}
		}
		//**********************************************************************
	}
	/** End of File cadastroUsuarios.php **/
	/** location ./application/controllers/config/cadastroUsuarios.php **/