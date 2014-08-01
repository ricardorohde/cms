<?php
    /**
     * @package     MY_Controller
     * @subpackage  mensagem_diaria
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    Classe desenvolvida para gerenciar as transações das Mensagens diárias
     */
    class Mensagem_diaria extends MY_Controller
    {
        /**
         * @name        __contruct()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para contrução da classe
         * @param       bool $requer_autenticacao, se TRUE, indica que para acessar a página é necessário estar logado
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            
            $this->load->model('mensagens_model');
        }
        /**********************************************************************/
        
        /**
         * @name        index()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função principal do controller, que chamará a visão para o usuário
         */
        function index()
        {
            $this->load->view('paginas/mensagem_diaria');
        }
        /**********************************************************************/
        
        /**
         * @name        salvar_mensagem()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função que passara a nova mensagem para a função salvar.
         * @param       string $dados['mensagem'] recebe a mensagem que foi digitada e passada via post
         * @param       string $dados['autor'] recebe o autor que foi digitado e passado via post
         * @return      integer retorna 1 se salvar a mensagem e 0 se não salvar
         */
        function salvar_mensagem()
        {
            $dados['mensagem']  = $this->input->post('mensagem');
            $dados['autor']     = $this->input->post('autor');
            
            echo $this->mensagens_model->salvar($dados);
        }
        /**********************************************************************/
        
        /**
         * @name        busca_mensagens()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Fução desenvolvida para buscar as mensagens cadastradas
         * @param       int $offset define o ofsset da pesquisa sql
         * @param       int $limite define o limite da pesquisa sql
         */
        function busca_mensagens($offset = 0)
        {
            $limite = 20;
            
            $this->dados['mensagens'] = $this->mensagens_model->buscar($limite, $offset);
            
            if(!$this->dados['mensagens'] and $offset > 0)
            {
                $offset = $offset - $limite;
                $this->dados['mensagens'] = $this->mensagens_model->buscar($limite, $offset);
            }
            
            /** Configurações da paginação **/
            $config['base_url']     = app_baseurl().'mensagem_diaria/busca_mensagens';
            $config['per_page']     = $limite;
            $config['total_rows']   = $this->mensagens_model->contar_mensagens();
            
            $this->pagination->initialize($config);
            
            $this->dados['paginacao'] = $this->pagination->create_links();
            
            $this->load->view('paginas/paginados/mensagens', $this->dados);
        }
        /**********************************************************************/
        
        /**
         * @name        excluir_mensagem()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para receber um id de uma noticia e passar para uma função no model excluir
         * @param       int $id recebe o id da mensagem passado por post
         * @return      bool retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir_mensagem()
        {
            $id = $this->input->post('id');
            
            if($this->mensagens_model->excluir($id) == 1)
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        }
    }
?>