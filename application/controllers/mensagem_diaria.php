<?php
    
    /**
     * mensagem_diaria
     * 
     * Classe desenvolvida para gerenciar as transações das Mensagens diárias
     * 
     * @package     CI_Controller
     * @subpackage  MY_Controller
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version     v1.0.0
     */
    class Mensagem_diaria extends MY_Controller
    {
        /**
         * __contruct()
         * 
         * Função desenvolvida para contrução da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        public function __construct()
        {
            parent::__construct(TRUE);
            
            $this->load->model('mensagens_model');
        }
        //**********************************************************************
        
        /**
         * index()
         * 
         * Função principal do controller, que chamará a visão para o usuário
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function index()
        {
            $this->load->view('paginas/mensagem_diaria');
        }
        //**********************************************************************
        
        /**
         * salvar_mensagem()
         * 
         * Função que passara a nova mensagem para a função salvar.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       string $dados['mensagem']   recebe a mensagem que foi digitada e passada via post
         * @param       string $dados['autor']      recebe o autor que foi digitado e passado via post
         * @return      integer retorna 1 se salvar a mensagem e 0 se não salvar
         */
        function salvar_mensagem()
        {
            $dados['mensagem']  = $this->input->post('mensagem');
            $dados['autor']     = $this->input->post('autor');
            
            echo $this->mensagens_model->salvar($dados);
        }
        //**********************************************************************
        
        /**
         * busca_mensagens()
         * 
         * Fução desenvolvida para buscar as mensagens cadastradas
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
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
        //**********************************************************************
        
        /**
         * excluir_mensagem()
         * 
         * Função desenvolvida para receber um id de uma noticia e passar para 
         * uma função no model excluir.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
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
        //**********************************************************************
        
        /**
         * marcar_mensagem()
         * 
         * Função desenvolvida para marcar uma mensagem como ativa ou inativa
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se marcar e FALSE se não marcar
         */
        function marcar_mensagem()
        {
            $dados['acao']  = $this->input->post('acao');
            $dados['id']    = $this->input->post('id');
            
            echo $this->mensagens_model->marcar($dados);
        }
        //**********************************************************************
        
        /**
         * editar()
         * 
         * Função desenvolvida para edição de uma mensagem diária
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $id Contém o ID da mensagem que será editada
         */
        function editar($id)
        {
            $this->dados['mensagem'] = $this->mensagens_model->buscar_mensagem($id);
            
            $this->view     = 'popup/editar_mensagem';
            $this->template = 'template/popup';
            
            $this->LoadView();
        }
        //**********************************************************************
        
        /**
         * salvar_alteracao()
         * 
         * Função desenvolvida para salvar alterações realizadas em uma mensagem
         * diária.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function salvar_alteracao()
        {
            $dados['id']        = $this->input->post('id');
            $dados['autor']     = $this->input->post('autor');
            $dados['mensagem']  = $this->input->post('mensagem');
            
            echo $this->mensagens_model->atualizar($dados);
        }
        //**********************************************************************
    }
    /** End of File mensagem_diaria.php **/
    /** Location ./application/controllers/mensagem_diaria.php **/