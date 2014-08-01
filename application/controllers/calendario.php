<?php
    class Calendario extends MY_Controller
    {
        /*
         * Contrução da classe
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
        }
        //----------------------------------------------------------------------
        
        /*
         * Função principal da classe
         */
        function index()
        {
            $this->load->view('paginas/calendario');
        }
    }
?>