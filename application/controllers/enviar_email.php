<?php
	/*
	 * Controller desenvolvido para enviar emails para os sócios
	 */
	 
	class Enviar_email extends MY_Controller
	{
		/*
		 * Construção da classe
		*/
		public function __construct($requer_autenticacao = TRUE)
		{
			parent::__construct($requer_autenticacao);
			$this->dados['nome'] = $_SESSION['user']->nome_completo;
			$this->load->model('menu_principal');
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função principal do controller
		*/
		function index()
		{
			$this->menu = $this->menu_principal->montar_menu($_SESSION['user']->id);
			$this->titulo = 'Enviar E-mail';
			$this->view = 'enviar_email';
			
			$this->dados['definicao'] = $this->uri->segment(3);
			if($this->dados['definicao'] == "contato")
			{
				$id = $this->uri->segment(4);
				$this->load->model('contato_model');
				
				$this->dados['dados_email'] = $this->contato_model->buscar_contato($id);
			}
			elseif($this->dados['definicao'] == "sugestao")
			{
				$id = $this->uri->segment(4);
				$this->load->model('sugestoes_model');
				$this->dados['dados_email'] = $this->sugestoes_model->buscar_sugestao($id);
			}
			$this->LoadView();
		}
		//----------------------------------------------------------------------
		
		/*
		 * Função desenvolvida para enviar o email para o sócio
		*/
		function enviar()
		{
			$mensagem = $this->input->post('mensagem');
			$nome_contato = $this->input->post('nome_contato');
			$email_contato = $this->input->post('email_contato');
			
			require './phpmailer/PHPMailerAutoload.php';
			
			$mensagem_completa = '
				<!DOCTYPE html>
				<html lang="pt-br">
					<head>
						<meta charset="utf-8">
					</head>
					<body>
						'.$mensagem.'
					</body>
				</html>
			';
			
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->Host = "smtp.live.com";
			$mail->SMTPAuth = true;
			$mail->Username = 'pentaureaclube@hotmail.com';
			$mail->Password = 'SECRETARIA';
			$mail->SMTPSecure = 'tls';
			
			$mail->From = 'pentaureaclube@hotmail.com';
			$mail->FromName = 'Central de Antendimento - Pentáurea Clube';
			$mail->addAddress($email_contato, $nome_contato);
			
			$mail->isHTML(true);
			
			$mail->Subject = 'Resposta - Pentáurea Clube';
			$mail->Body = $mensagem_completa;
			
			if(!$mail->send())
			{
				echo 'Ocorreu um erro ao enviar o E-mail <br /> Mailer Error: '.$mail->ErrorInfo;
			}
			else
			{
				echo 1;//Indica que o email foi enviado com sucesso
			}
		}
		//----------------------------------------------------------------------
	}
?>