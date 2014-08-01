<?php
    /*
     * Funções para galeria - Masterkey Informática
     * 
     * Esta função foi desenvolvida para criar uma nova galeria
     */

    class Nova_galeria extends MY_Controller
    {
        /*
         * Construção da classe
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            $this->load->model('galerias_model');
            
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que faz o início e chamada de dados e visões
         */
        function index()
        {
            $this->view = 'nova_galeria';
            $this->titulo = 'Criação de Nova Galeria';
            
            $this->LoadView();
        }
        //----------------------------------------------------------------------
        
        /*
         * Função desenvolvida para criar uma nova galeria
         */
        function cria_novaGaleria()
        {
            $this->dados['nome_galeria'] = $this->input->post('nome_galeria');
            $this->dados['data'] = $this->input->post('data_realizacao');
            $id_galeria = $this->galerias_model->salva_galeria($this->dados);
            if($id_galeria == NULL)
            {
                $id_galeria = 0;
                echo $id_galeria;
            }
            else
            {
                echo $id_galeria;
            }
        }
        //----------------------------------------------------------------------
    }
?>