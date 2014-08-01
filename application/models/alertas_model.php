<?php

    /*
     * Este modelo tem como objetivo contar alguns dados que são mostrados na
     * parte superior do site
     */
    class Alertas_Model extends MY_Model
    {
        /*
         * Consrução da Classe
         */
        public function __construct()
        {
            parent::__construct();
            $this->_primary = 'id';
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que conta os contatos em abetro
         */
        function contar_contatos()
        {
            $this->BD->where(array('status' => 1));
            return $this->BD->count_all_results('contato');
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que conta os sugestoes em abetro
         */
        function contar_sugestoes()
        {
            $this->BD->where(array('status' => 1));
            return $this->BD->count_all_results('sugestao');
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que conta as notícias ativas
         */
        function contar_noticias()
        {
            $this->BD->where(array('status' => 1));
            return $this->BD->count_all_results('noticias');
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que conta os usuários ativos
         */
        function contar_usuarios()
        {
            $this->BD->where(array('status' => 1));
            return $this->BD->count_all_results('usuarios');
        }
        //----------------------------------------------------------------------
        
        /*
         * Função que conta as galerias criadas
         */
        function contar_galerias()
        {
            return $this->BD->count_all_results('galeria');
        }
        //----------------------------------------------------------------------
        
        
    }
?>