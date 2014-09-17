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
	 * Recuperar_senha
	 *
	 * Classe desenvolvida para recuperar a senha do usuário
	 *
	 * @package		Controllers
	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version     v1.2.0
	 * @since		15/09/2014
	 */
    class Recuperar_Senha extends MY_Controller
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
            parent::__construct(FALSE);
            
            $this->template = 'template/login';
            
            /** Realiza o LOAD do model correspondente **/
            $this->load->model('usuarios');
        }
        //**********************************************************************
        
        /**
         * index()
         * 
         * Função principal da classe, responsavel pela view inicial
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
         */
        function index()
        {
            $this->titulo	= 'Esqueceu sua senha?';
            $this->view 	= 'recuperar_senha';
            
            $this->LoadView();
        }
        //**********************************************************************
        
        /**
         * captcha()
         * 
         * Função utilizada para criar o CAPTCHA
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @return		mixed Retorna uma imagem captcha
         */
        function captcha()
        {
            global $sequencia_chapta;
            
            $this->load->helper('captcha');
            
            $_SESSION['captcha'] 		= $gerador['word'] = substr(md5(time()), 0, 5);
            $gerador['img_path'] 		= './img/captcha/';
            $gerador['img_url'] 		= base_url() . '/img/captcha/';
            $gerador['font_path'] 		= '';
            $gerador['image_width'] 	= 230;
            $gerador['image_height']	= 50;
            $gerador['expiration'] 		= 120;
            
            $captcha = create_captcha($gerador);
            echo $captcha['image'];
        }
        //**********************************************************************

        /**
         * verificar()
         * 
         * Função que recebe os valores do formulário e os processa para que 
         * possa enviar as informações por e-mail
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @return		int Retorna um número como código de erro
         */
        function verificar()
        {
            $email 		= $this->input->post('email');
            $captcha 	= $this->input->post('captcha');
            
            if ($_SESSION['captcha'] == $captcha)
            {
                $resposta = $this->usuarios->busca_id($email);
                
                if ($resposta != 0)
                {
                	$resposta = base64_encode($resposta);
                	
                    $mensagem = '
                        <!DOCTYPE html>
                        <html lang="pt-br">
                            <head>
                                <meta charset="utf-8">
                            </head>
                            <body>
                                <p>
                                    Como você esqueceu sua senha do gerenciador 
                                    de conteúdo do Pentáurea Clube, clique no link
                                    abaixo para redefinição de senha.
                                    <br/>
                                    Caso você não tenha acesso ao sistema, favor
                                    desconsiderar este e-mail.
                                <p>
                                <a href="' . app_baseUrl() . 'recuperar_senha/nova_senha/' . $resposta . '">
                                    Clique aqui para redefinir sua senha
                                </a>
                                <br />
                                <p>
                                    Atenciosamente
                                    <br />
                                    <strong>Núcleo de Tecnologia - Pentáurea Clube</strong>
                                </p>
                            </body>
                        </html>
                    ';
                    
                    $this->load->library('envio_email');
                     
                    $config_email 	= $this->buscar_configEmail();
                    $mail 			= $this->envio_email->load_mailer();
                    
                    $mail->isSMTP();
		            $mail->isHTML(true);
		            $mail->SMTPAuth     = true;
		            $mail->Host         = $config_email['smtp_host'];
		            $mail->Port         = $config_email['smtp_port'];
		            $mail->Username     = $config_email['smtp_userName'];
		            $mail->Password     = $config_email['smtp_password'];
		            $mail->SMTPSecure   = $config_email['smtp_secure'];
		            $mail->From         = $config_email['smtp_from'];
		            $mail->FromName     = $config_email['smtp_fromName'];
                    
		            $mail->addAddress($email);
                    $mail->Subject = 'Alteração de Senha';
                    $mail->Body = $mensagem;
                    if (!$mail->send())
                    {
                        echo 2; //Erro 2 - Não foi possível enviar os dados para o contato
                    }
                    else
                    {
                        echo 3; //Evento 1 - Email enviado com sucesso
                    }
                }
                else
                {
                    echo 1; //Erro 1 - Não há e-mail correspondente na base de dados
                }
            }
            else
            {
                echo 0; //Erro 0 - Captcha inválido
            }
        }
        //**********************************************************************

        /**
         * nova_senha()
         * 
         * Função utilizada para redefinir senha
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		string $id_usuario Recebe o ID do usuário Criptografado
         */
        function nova_senha($id_usuario = NULL)
        {
            $this->dados['id_usuario'] 	= base64_decode($id_usuario);
            $this->dados['email'] 		= $this->usuarios->busca_email($this->dados['id_usuario']);
            
            $this->view 	= 'nova_senha';
            $this->titulo 	= 'Alterar senha de usuário';
            
            $this->LoadView();
        }
        //**********************************************************************

        /**
         * altera_senha()
         * 
         * Função desenvolvida para alterar a senha do usuário na tela inicial
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @return		mixed Retorna o Nome de usuário ou código de erro
         */
        function altera_senha()
        {
            $dados['id']	= $this->input->post('id_usuario');
            $dados['email']	= $this->input->post('email');
            $dados['senha']	= md5($this->input->post('senha'));
            $captcha 		= $this->input->post('captcha');
            
            if ($_SESSION['captcha'] == $captcha)
            {
                $resposta = $this->usuarios->redefinir_senha($dados);
                if ($resposta == 0)
                {
                	//Não foi possível redefinir a senha
                    echo 1; 
                }
                else
                {
                	$this->load->library('loginlibrary');
                	$resposta = $this->loginlibrary->FazerLogin($dados['email'], $dados['senha']);
                    
                	//Imprime 3 em caso de sucesso e 2 em caso de falha no login
                	echo ($resposta == 1) ? 3 : 2;
                }
            }
            else
            {
            	//Erro no captcha
                echo 0; 
            }
        }
        //**********************************************************************
		
        /**
         * buscar_configEmail()
         *
         * Função desenvolvida para buscar as configurações de email salvas no
         * banco de dados.
         *
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      Private
         * @return      array Retorna um array contendo as configurações de email
         */
        private function buscar_configEmail()
        {
        	$this->load->model('email_model');
        
        	$config = $this->email_model->buscar();
        
        	foreach ($config as $row)
        	{
        		$email['smtp_host']     = $row->smtp_host;
        		$email['smtp_port']     = $row->smtp_port;
        		$email['smtp_userName'] = $row->smtp_userName;
        		$email['smtp_password'] = $row->smtp_password;
        		$email['smtp_secure']   = $row->smtp_secure;
        		$email['smtp_from']     = $row->smtp_from;
        		$email['smtp_fromName'] = $row->smtp_fromName;
        	}
        
        	return $email;
        }
        //**********************************************************************
    }
    /** End of File recuperar_senha.php **/
    /** location ./application/controllers/recupera_senha.php **/