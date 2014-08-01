<?php
    /**
     * @package     MY_Model
     * @subpackage  Avisos_model
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    Classe desenvolvida para gerenciar as transações com a tabela
     *              avisos
     */
    class Avisos_model extends MY_Model
    {
        /**
         * @name        __construct()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Realiza a construção da classe
         * @param       string  $this->_primaria    Indica o campo de chave primaria da tabela
         * @param       string  $this->_tabela      Indica qual a tabela que iremos trabalhar
         */
        public function __construct()
        {
            parent::__construct();
            
            $this->_tabela      = 'avisos';
            $this->_primaria    = 'id';
        }
        /**********************************************************************/
        
        /**
         * @name        salvar()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para salvar um novo aviso
         * @param       array   $dados  Contém os dados que serão salvos
         * @param       array   $data   Associa os campos da tabela com os dados
         * @return      bool    Retorna TRUE se salvar e FALSE se não salvar
         */
        function salvar($dados)
        {
            $data = array(
                'mensagem'          => $dados['mensagem'],
                'data_expiracao'    => $dados['data_expiracao']
            );
            
            return $this->BD->insert($this->_tabela, $data);
        }
        /**********************************************************************/
        
        /**
         * @name        busca_avisos()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Funçao desenvolvida para realizar a busca dos avisos cadastrados
         * @param       int     $offset Define o offset da pesquisa
         * @param       int     $limite Define o limite da pesquisa
         * @return      array   retorna um array de avisos                
         */
        function busca_avisos($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->order_by('id', 'desc');
            
            $query = $this->BD->get($this->_tabela);
            return $query->result();
        }
        /**********************************************************************/
        
        /**
         * @name        contar_avisos()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Funçao que conta os avisos cadastrados
         * @return      int Retorna a quantidade de avisos cadastrados
         */
        function contar_avisos()
        {
            return $this->BD->count_all_results($this->_tabela);
        }
    }
?>