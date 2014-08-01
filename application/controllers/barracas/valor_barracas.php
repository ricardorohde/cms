<?php
    class Valor_barracas extends MY_Controller
    {
        /*
         * Construção da classe
        */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            $this->load->model('menu_principal');
            $this->dados['nome'] = $_SESSION['user']->nome_completo;
            $this->menu = $this->menu_principal->montar_menu($_SESSION['user']->id);
			$this->load->model('valores_model');
            
        }
        //----------------------------------------------------------------------
        
        /*
         * Função principal do controller
        */
        function index()
        {
            $this->view = 'valor_barracas';
            $this->titulo = 'Valor das Barracas';
            
            $this->LoadView();
        }
        //----------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para realizar a Paginação dos valores cadastrados
		*/
		function busca_valores()
		{
			$this->dados['valores'] = $this->valores_model->busca_valores();
			$this->load->view('paginas/paginados/valores_paginados', $this->dados);
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função para salvar novos valores no banco de dados
		*/
		function salvar_valor()
		{
			$dados['valor'] = $this->input->post('valor');
			$dados['valor_fim_semana'] = $this->input->post('valor_fim_semana');
			
			$resposta = $this->valores_model->salvar_valor($dados);
			if($resposta == 0)
			{
				echo "E00"; //Erro relativo ao não salvamento
			}
			else
			{
				echo "E01"; //Relativo ao salvamento
			}	
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função para excluir um valor do banco de dados
		*/
		function excluir_valor()
		{
			$id = $this->input->post('id');
			
			$resposta = $this->valores_model->excluir_valor($id);
			if($resposta == 0)
			{
				echo "E00";//Erro 0 - Não excluído
			}
			else
			{
				echo "E01";//Evento 1 - Excluído
			}
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função que busca um valor para ser trocado
		*/
		function buscar_valor()
		{
			$id = $this->input->post('id');
			
			$resposta = $this->valores_model->busca_valor($id);
			
			echo json_encode($resposta);
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para alterar um valor de uma barraca
		*/
		function altera_valor()
		{
			$dados['valor'] = $this->input->post('valor');
			$dados['valor_fim_semana'] = $this->input->post('valor_fim_semana');
			$dados['id'] = $this->input->post('id_valor');
			
			
			
			if($dados['valor'] == "" && $dados['valor_fim_semana'] == "")
			{
				echo "E0P"; //Erro 0 - Preenchimento;
			}
			else
			{
				$resposta = $this->valores_model->altera_valor($dados);
				if($resposta == 1)
				{
					echo "E01"; //Evento 01 - Salvo com sucesso
				}
				else
				{
					echo "E0N"; //Erro 0 - Não valor não foi atualizado
				}
			}
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para povoar um combo com os valores das barracas
		*/
		function valores_combo()
		{
			$valores = $this->valores_model->busca_valores();
			foreach($valores as $row)
			{
				echo '<option value="'.$row->id.'">Diária: '.$row->valor.' - Fim de Semana: '.$row->valor_fim_semana.'</option>';
			}
		}
        //----------------------------------------------------------------------
    }

?>