<?php
    /**
     * contato.php
     * 
     * Arquivo que contém a classe contato
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version     v1.11.0
     */

    /**
     * Classe Contato.
     * 
     * Classe desenvolvida para realizar a gerência das mensagens que são 
     * enviadas pelo formulário do site.
     * 
     * @package     CI_Controller
     * @subpackage  MY_Controller
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     */
    class Contato extends MY_Controller {

        /**
         * __construct().
         * 
         * Construção da classe de Contato;
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       bool $requer_autenticacao Se for setado com TRUE, indica
         *              que, para acessar a classe, é necessário fazer login
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            
            $this->load->model('contato_model', 'contato');
        }
        //**********************************************************************

        /**
         * index()
         * 
         * Função principal da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function index()
        {
            $this->load->view('paginas/contato/contato');
        }
        //**********************************************************************

        /**
         * buscar_contatos()
         * 
         * Função que faz a busca das mensagens e cria a paginação para navegação do usuário
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $offset Define o offset que será usado na consulta sql
         */
        function buscar_contatos($offset = 0)
        {
            /** Define o limite da busca * */
            $limite = 7;

            /** Recebe as mensagens que estão cadastradas * */
            $this->dados['contatos'] = $this->contato->lista_contatos($limite, $offset);

            if (!$this->dados['contatos'] and $offset > 0)
            {
                $offset = $offset - 7;
                $this->dados['contatos'] = $this->contato->lista_contatos($limite, $offset);
            }

            /** Configurações da paginação * */
            $config['uri_segment']  = 4;
            $config['base_url']     = app_baseUrl() . 'contato/contato/buscar_contatos';
            $config['per_page']     = $limite;
            $config['total_rows']   = $this->contato->conta_contatos();

            /**
             * Realiza a criação do links e salva o offset em uma variável. Este
             * valor será usado na página onde as notícias serão exibidas
             * */
            $this->pagination->initialize($config);

            $this->dados['paginacao']   = $this->pagination->create_links();
            $this->dados['verificador'] = $offset;

            $this->load->view('paginas/paginados/contato/contato_paginado', $this->dados);
        }
        //**********************************************************************

        /**
         * verifica_mensagem()
         * 
         * Função que busca uma mensagem selecionada pelo administrador
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int     $id Contém o ID da mensagem a ser buscada
         */
        function verificar_mensagem($id)
        {
            $this->dados['mensagem'] = $this->busca_mensagem($id);

            $this->load->view('paginas/contato/abrir_mensagem', $this->dados);
        }
        //**********************************************************************

        /**
         * responder_mensagem()
         * 
         * Função desenvolvida para responder uma mesagem
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @var         int $id Contém o ID de uma mensagem
         * @var         array $this->dados['mensagem'] Contém uma mensagem que 
         *              será exibida ao administrador
         */
        function responder_mensagem()
        {
            $id = $this->uri->segment(4);
            $this->dados['mensagem'] = $this->busca_mensagem($id);
            
            $this->load->view('paginas/contato/responder_mensagem', $this->dados);
        }
        //**********************************************************************

        /**
         * busca_mensagem()
         * 
         * Função desenvolvida para buscar uma mensagem de acordo o ID passado
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $id Contém o ID da mensagem que será buscada
         * @return      array   Retorna um array contendo os dados da mensagem buscada
         * @access      private
         */
        private function busca_mensagem($id)
        {
            return $this->contato->buscar_contato($id);
        }
        //**********************************************************************

        /**
         * enviar_resposta()
         * 
         * Função desenvolvida para enviar a mensagem do usuário
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function enviar_resposta()
        {
            $mensagem   = $this->input->post('mensagem');
            $email      = $this->input->post('email');
            $nome       = $this->input->post('nome');
            
            /**
             * Recebe as configurações de envio de email
             */
            $config_email = $this->buscar_configEmail();
            
            /** 
             * Rotina desenvolvida para retirar o email do array que está 
             * inserido
             **/
            $x = count($email);
            
            for($i = 0; $i < $x; $i++)
            {
                $email = $email[$i];
            }

            $msg_completa = "
                <!DOCTYPE html>
                <html lang='pt-br'>
                    <head>
                        <meta charset='utf-8'>
                    </head>
                    <body>
                        $mensagem
                    </body>
                </html>
            ";
            
            $this->load->library('envio_email');
            
            $mail = $this->envio_email->load_mailer();
            
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
            
            $mail->addAddress($email, $nome);
            
            $mail->Subject  = 'Central de Antendimento - Pentáurea Clube';
            $mail->Body     = $msg_completa;
            
            if(!$mail->send())
            {
                echo 'Ocorreu um erro ao enviar o E-mail <br /> Mailer Error: '.$mail->ErrorInfo;
            }
            else
            {
                echo 1;
            }
        }
        //**********************************************************************
        
        /**
         * excluir_mensagem()
         * 
         * Função desenvolvida para excluir diversas mensagens
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool    Retorna TRUE se apagar e FALSE se não apagar
         * @var         string  $mensagens   Contém o ID das mensagens que foi passado por post
         * @var         int     $x           Recebe a quatidade de posições da var $mensagens
         * @var         int     $i           Utilizado para o loop
         * @var         bool    $resposta    Recebe TRUE ou FALSE da função que executa o SQL  
         * @var         bool    $nao_excluiu Recebe FALSE se a variável 
         */
        function excluir_mensagem()
        {
            $mensagens = $this->input->post('id');
            
            if (is_array($mensagens))
            {
                $x = count($mensagens);
            
                for($i = 0; $i < $x; $i++)
                {
                    $resposta = $this->contato->excluir($mensagens[$i]);

                    if($resposta != 1)
                    {
                        $nao_excluiu = FALSE;
                    }
                }

                if(!isset($nao_excluiu) || $nao_excluiu == FALSE)
                {
                    echo 1;
                }
                else
                {
                    echo 0;
                }
            }
            else
            {
                if($this->contato->excluir($mensagens) == 1)
                {
                    echo 1;
                }
                else
                {
                    echo 0;
                }
            }
        }
        //**********************************************************************
        
        /**
         * ler().
         * 
         * Função desenvolvida para marcar uma mensagem como lida
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @return      bool    Retorna TRUE se marcar e FALSE se não marcar
         */
        function ler()
        {
            $id = $this->input->post('id');
            
            echo $this->contato->marcar_lido($id);
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
    /** End of File contato.php **/
    /** Location ./application/controllers/contato **/