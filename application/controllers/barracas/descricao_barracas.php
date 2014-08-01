<?php
	class Descricao_barracas extends MY_Controller
	{
		/*
		 * Construção da classe
		*/
		public function __construct($requer_autenticacao = TRUE)
		{
			parent::__construct($requer_autenticacao);
			$this->dados['nome'] = $_SESSION['user']->nome_completo;
			$this->load->model('descricao_model');
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função principal do controller
		*/
		function index()
		{
			$this->load->model('menu_principal');
			$this->menu = $this->menu_principal->montar_menu($_SESSION['user']->id);
			$this->view = 'descricao_barracas';
			$this->titulo = 'Descrição das Barracas';
			
			$this->LoadView();
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para buscar as descrições das barracas
		*/
		function busca_descricoes()
		{
			$this->dados['descricoes'] = $this->descricao_model->busca_descricoes();
			$this->load->view('paginas/paginados/descricoes_paginados', $this->dados);
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para salvar a descrição das barracas
		*/
		function salvar_descricao()
		{
			$dados['sigla'] = $this->input->post('sigla');
			$dados['titulo_barraca'] = $this->input->post('titulo_barraca');
			$dados['descricao'] = $this->input->post('descricao');
            $dados['id_valores'] = $this->input->post('id_valores');
			
			$resposta = $this->descricao_model->salvar_descricao($dados);
			if($resposta == 0)
			{
				echo "E0"; // Erro 0 - Não salvou
			}
			else
			{
				echo "E1"; // Evento 1 - Salvo com sucesso
			}
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função para excluir uma função
		*/
		function excluir()
		{
			$id = $this->input->post('id');
			$resposta = $this->descricao_model->excluir($id);
			if($resposta == 0)
			{
				echo "E0"; // Erro 0 - Não salvou
			}
			else
			{
				echo "E1"; // Evento 1 - Salvo com sucesso
			}
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para alterar uma descrição
		*/
		function altera_descricao()
		{
			$id = $this->uri->segment(3);
			$this->dados['descricao'] = $this->descricao_model->busca_byId($id);
			$this->view = 'popup/editar_descricao';
			$this->template = 'template/permissao';
			$this->titulo = 'Editar descricao de barracas - MasterAdmin';
			
            $this->LoadView();
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função que atualiza os dados de uma descrição já salva
		*/
		function atualizar_descricao()
		{
			$dados['sigla'] = $this->input->post('sigla');
			$dados['titulo_barraca'] = $this->input->post('titulo_barraca');
			$dados['descricao'] = $this->input->post('descricao');
			$dados['id'] = $this->input->post('id');
			
			$resposta = $this->descricao_model->atualizar_descricao($dados);
			if($resposta == 0)
			{
				echo "E0"; // Erro 0 - Não salvou
			}
			else
			{
				echo "E1"; // Evento 1 - Salvo com sucesso
			}
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para buscar as descrições das barracas e povoar comobox
		 * para cadastrar nova barraca
		*/
		function descricao_combo()
		{
			$descricoes = $this->descricao_model->busca_descricoes();
            echo '<option value="" data-week="" data-weekend="">Selecione uma opção...</option>';
			foreach($descricoes as $row)
			{
				echo '
                    <option value="'.$row->id.'" data-week="'.$row->valor.'" data-weekend="'.$row->valor_fim_semana.'">
                        '.$row->titulo_barraca.'
                    </option>';
			}
		}
		//----------------------------------------------------------------------
	}
?>