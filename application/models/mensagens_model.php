<?php
    /**
     * @package     MY_Model
     * @subpackage  mensagens_model
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    Classe desenvolvida para gerenciar as transações envolvendo as mensagens diárias
     */
    class Mensagens_model extends MY_Model
    {
        /**
         * @name        __construct()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Realiza a construção da classe
         * @param       string $this->_tabela indica a tabela que iremos trabalhar
         * @param       string $this->_primary qual é o campo tido como chave primária
         */
        public function __construct()
        {
            parent::__construct();
            $this->_tabela      = 'mensagem_diaria';
            $this->_primaria    = 'id';
        }
        /**********************************************************************/
        
        /**
         * @name        salvar()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para salvar uma nova mensagem no BD
         * @param       array $dados contem os dados do autor e da mensagem
         * @param       array $data concatena os campos do BD com a variável acima
         * @return      bool retorna TRUE se salvar e FALSE se não salvar
         */
        function salvar($dados)
        {
            $data = array(
                'mensagem'  => $dados['mensagem'],
                'autor'     => $dados['autor']
            );
            return $this->BD->insert($this->_tabela, $data);
        }
        /**********************************************************************/
        
        /**
         * @name        buscar()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    função desenvolvida para buscar as mensagens cadastradas
         * @param       int $limite define o limite da pesquisa
         * @param       int $offset define o offset da pesquisa
         */
        function buscar($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $query = $this->BD->get($this->_tabela);
            return $query->result();
        }
        /**********************************************************************/
        
        /**
         * @name        contar_mensagens()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função que conta a quantidade de mensagens cadastradas
         * @return      int retorna o número de mensagens cadastradas
         */
        function contar_mensagens()
        {
            return $this->BD->count_all_results($this->_tabela);
        }
        /**********************************************************************/
        
        /**
         * @name        excluir()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para excluir uma mensagem, passando o id da mensagem como parametro.
         * @param       int $id id da noticia que deseja excluir
         * @return      bool retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir($id)
        {
            $this->BD->where('id', $id);
            return $this->BD->delete($this->_tabela);
        }
    }
?>