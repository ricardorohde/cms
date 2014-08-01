<?php

    class MY_Model extends CI_Model
    {
        /*
         * O Núcleo MY_Model é responsavel por algumas configurações relacionadas
         * às transações de Banco de dados
         */
        
        /*
         * Variáveis protegidas
         */

        protected $BD; //Indica o BD na qual estaremos trabalhando
        protected $_tabela; //Indica a Tabela na qual estaremos trabalhando no momento
        protected $_primaria; //Indica a chave primaria que estaremos trabalhando

        /*
         * Construção da classe. Na contrução desta classe, indicamos para a
         * variável BD qual é o banco de dados que trabalharemos, sendo que, 
         * neste caso, o banco de dados DEFAULT foi definido em
         * application/config/database.php
         */

        public function __construct()
        {
            parent::__construct();
            $this->BD = $this->load->database('default', TRUE);
        }

        //----------------------------------------------------------------------
    }
?>