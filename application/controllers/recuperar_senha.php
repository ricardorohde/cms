<?php
    class Recuperar_Senha extends MY_Controller
    {

        //Construção da classe
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct(FALSE);
            $this->template = 'template/login';
            $this->load->model('usuarios');
        }

        //----------------------------------------------------------------------
        //função principal do controller
        function index()
        {
            $this->titulo = 'Esqueceu sua senha?';
            $this->view = 'recuperar_senha';
            $this->LoadView();
        }

        //----------------------------------------------------------------------
        //Função utilizada para criar o CAPTCHA
        function captcha()
        {
            global $sequencia_chapta;
            $this->load->helper('captcha');
            $_SESSION['captcha'] = $gerador['word'] = substr(md5(time()), 0, 5);
            $gerador['img_path'] = './img/captcha/';
            $gerador['img_url'] = base_url() . '/img/captcha/';
            $gerador['font_path'] = './fonts/captcha.TTF';
            $gerador['image_width'] = 230;
            $gerador['image_height'] = 50;
            $gerador['expiration'] = 120;
            $captcha = create_captcha($gerador);
            echo $captcha['image'];
        }

        //----------------------------------------------------------------------

        /* Função que recebe os valores do formulário e os processa para que 
         * possa enviar as informações por e-mail
         */
        function verificar()
        {
            $email = $this->input->post('email');
            $captcha = $this->input->post('captcha');
            if ($_SESSION['captcha'] == $captcha)
            {
                $resposta = $this->usuarios->busca_id($email);
                if ($resposta != 0)
                {
                    $resposta = base64_encode($resposta);
                    require_once './phpmailer/PHPMailerAutoload.php';
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
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = "mail.pentaurea.com.br";
                    $mail->SMTPAuth = true;
                    $mail->Username = "pentaurea@pentaurea.com.br";
                    $mail->Password = "PnTa@1956";
                    $mail->SMTPSecure = '';
                    $mail->From = "pentaurea@pentaurea.com.br";
                    $mail->FromName = 'Suporte Técnico - Pentáurea Clube';
                    $mail->addAddress($email);
                    $mail->isHTML(true);
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

        //----------------------------------------------------------------------

        /*
         * Função utilizada para redefinir senha
         */
        function nova_senha()
        {
            $this->dados['id_usuario'] = base64_decode($this->uri->segment(3));
            $this->dados['email'] = $this->usuarios->busca_email($this->dados['id_usuario']);
            $this->view = 'nova_senha';
            $this->titulo = 'Alterar senha de usuário';
            $this->LoadView();
        }

        //----------------------------------------------------------------------

        /*
         * Função desenvolvida para alterar a senha do usuário na tela inicial
         */
        function altera_senha()
        {
            $id = $dados['id'] = $this->input->post('id_usuario');
            $dados['senha'] = md5($this->input->post('senha'));
            $captcha = $this->input->post('captcha');
            if ($_SESSION['captcha'] == $captcha)
            {
                $resposta = $this->usuarios->redefinir_senha($dados);
                if ($resposta == 0)
                {
                    echo 1; //Não foi possível redefinir a senha
                }
                else
                {
                    $resposta = $this->busca_nomeUsuario($id);
                    echo $resposta;
                }
            }
            else
            {
                echo 0; //Erro no captcha
            }
        }

        //----------------------------------------------------------------------

        /*
         * Função utilizada pa buscar o nome de usuário
         */
        function busca_nomeUsuario($id)
        {
            $user = $this->usuarios->nome_usuario($id);
            if ($user != "")
            {
                $_SESSION['user'] = $user;
                return 3; //Sucesso no login
            }
            else
            {
                return 2; //senha redefinida mas não foi possível redirecionar
            }
        }

    }
?>