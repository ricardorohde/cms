<?php
    /**
     * @package     MY_Controller
     * @subpackage  barracas
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    Classe desenvolvida para gerência das barracas
     */
	class Barracas extends MY_Controller
	{
		/*
		 * Contrução da classe
		*/
		public function __construct($requer_autenticacao = TRUE)
		{
			parent::__construct($requer_autenticacao);
			$this->dados['nome'] = $_SESSION['user']->nome_completo;
			$this->load->model('barracas_model');
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função principal do controller
		*/
		function index()
		{
			$this->load->model('menu_principal');
			$this->menu = $this->menu_principal->montar_menu($_SESSION['user']->id);
			$this->view = 'barracas';
			$this->titulo = 'Cadastro de Barracas';
			$this->LoadView();
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função que busca as barracas cadastradas e realiza a paginação
		*/
		function busca_barracas($offset = 0)
		{
			$limite = 10;
			$this->dados['barracas'] = $this->barracas_model->lista_barracas($limite, $offset);
			if(!$this->dados['barracas'] and $offset > 0)
			{
				$offset = $offset - 10;
				$this->dados['barracas'] = $this->barracas_model->lista_barracas($limite, $offset);
			}
			$config['base_url'] = app_baseUrl().'barracas/busca_barracas';
			$config['per_page'] = $limite;
			$config['total_rows'] = $this->barracas_model->conta_barracas();
			
			$this->pagination->initialize($config);
			$this->dados['paginacao'] = $this->pagination->create_links();
			$this->dados['verificador'] = $offset;
			
			$this->load->view('paginas/paginados/barraca_paginada', $this->dados);
		}
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para salvar uma barraca
         */
        function salvar_barraca()
        {
            $dados['numero_barraca'] = $this->input->post('numero_barraca');
            $dados['id_descricao'] = $this->input->post('id_descricao');
            $dados['localizacao'] = $this->input->post('localizacao');
            
            $resposta = $this->barracas_model->salvar_barraca($dados);
            if($resposta == 0)
            {
                echo "E0"; //Erro 0 - Não salvou a barraca
            }
            elseif($resposta == 1)
            {
                echo "E1"; //Evento 1 - Salvou a barraca
            }
            else
            {
                echo "UE"; //Unknow Error - Erro desconhecido
            }
        }
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para excluir uma barraca da base de dados
         */
        function excluir_barraca()
        {
            $id = $this->input->post('id');
            $resposta = $this->barracas_model->excluir_barraca($id);
            if($resposta == 0)
            {
                echo "E0"; //Erro 0 - Não excluiu a barraca
            }
            elseif($resposta == 1)
            {
                echo "E1"; //Evento 1 - Excluiu a barraca
            }
            else
            {
                echo "UE"; //Unknow Error - Erro desconhecido
            }
        }
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para alterar o valor de uma barraca
         */
        function altera_barraca()
        {
            $id = $this->uri->segment(3);
            $this->view = 'popup/editar_barracas';
            $this->template = 'template/permissao';
			$this->titulo = 'Editar descricao de barracas - MasterAdmin';
			
            $this->LoadView();
        }
    }
?>