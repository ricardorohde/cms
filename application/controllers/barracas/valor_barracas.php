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
	 * Valor_barracas
	 * 
	 * Classe desenvolvida para gerenciar os valores das barracas
	 * 
	 * @package		Controllers
	 * @subpackage	Barracas
	 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.3.0
     * @since		12/09/2014
	 */
    class Valor_barracas extends MY_Controller
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
			$this->load->model('valores_model', 'valores');
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
            $this->load->view('paginas/barracas/valor_barracas');
        }
        //**********************************************************************
		
		/**
		 * busca_valores()
		 * 
		 * Função desenvolvida para buscar os valores cadastrados
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @var			array $dados Recebe os valores que serão exibidos
		 */
		function busca_valores()
		{
			$this->dados['valores'] = $this->valores->busca_valores();
			
			$this->load->view('paginas/paginados/valores_paginados', $this->dados);
		}
		//**********************************************************************
		
		/**
		 * salvar_valor()
		 * 
		 * Função para salvar novos valores no banco de dados
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @var			array $dados Recebe os dados que serão salvos
     	 * @return		bool Retorna TRUE se salvar e FALSE se não salvar
		 */
		function salvar_valor()
		{
			$dados['valor'] 			= $this->input->post('valor');
			$dados['valor_fim_semana']	= $this->input->post('valor_fim_semana');
			
			echo $this->valores->salvar_valor($dados);
		}
		//**********************************************************************
		
		/**
		 * excluir_valor()
		 * 
		 * Função para excluir um valor do banco de dados
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @var			int $id Contém o ID do registro a ser excluido
     	 * @return		bool Retorna TRUE se excluir e FALSE se não excluir
		 */
		function excluir_valor()
		{
			$id = $this->input->post('id');
			
			echo $this->valores->excluir_valor($id);
		}
		//**********************************************************************
		
		/**
		 * buscar_valor()
		 * 
		 * Função que busca um valor para ser trocado
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @var			int 	$id 		Contém o ID do registro a ser buscado
     	 * @var			array	$resposta	Recebe os dados do valor buscado
     	 * @return		array	Retorna um array de valores
		 */
		function buscar_valor()
		{
			$id = $this->input->post('id');
			
			$this->dados['valores'] = $this->valores->busca_valor($id);
			
			$this->load->view('paginas/popup/barracas/editar_valor', $this->dados);
		}
		//**********************************************************************
		
		/**
		 * altera_valor()
		 *  
		 * Função desenvolvida para alterar um valor de uma barraca
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @var			array 	$dados Recebe os dados que serão atualizados
     	 * @return		bool	Retorna TRUE se atualizar e FALSE se não atualizar
		 */
		function altera_valor()
		{
			$dados['valor'] 			= mysql_real_escape_string($this->input->post('valor'));
			$dados['valor_fim_semana'] 	= mysql_real_escape_string($this->input->post('valor_fim_semana'));
			$dados['id'] 				= mysql_real_escape_string($this->input->post('id_valor'));
			
			echo $this->valores->altera_valor($dados);
		}
		//**********************************************************************
		
		/**
		 * valores_combo()
		 * 
		 * Função desenvolvida para povoar um combo com os valores das barracas
		 * 
		 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     	 * @access		Public
     	 * @var			array	$valores Recebe os valores cadastrados
     	 * @return		string	Retorna uma string que preencherá o combobox
		 */
		function valores_combo()
		{
			$valores = $this->valores->busca_valores();
			
			echo "<option value=''>Selecione uma opção...</option>";
			
			foreach($valores as $row)
			{
				echo '<option value="'.$row->id.'">Diária: '.$row->valor.' - Fim de Semana: '.$row->valor_fim_semana.'</option>';
			}
		}
        //**********************************************************************
    }
    /** End of File valor_barracas.php **/
    /** Location ./application/controllers/barracas/valor_barracas.php **/