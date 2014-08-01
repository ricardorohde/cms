<?php
    /**
     * @package     - models/diretoria/diretores_model
     * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    - Model desenvolvido para gerenciar as transações envolvendo
     *                a tabela de diretores
     */
    class Diretores_model extends MY_Model
    {
        /**
         * @name        - __construct()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Realiza a contrução da classe
         */
        public function __construct()
        {
            parent::__construct();
            
            /** Indica o nome da tabela **/
            $this->_tabela = 'diretores';
            
            /** Indica a chave primaria da tabela **/
            $this->_primary = 'id';
        }
        //**********************************************************************
        
        /**
         * @name        - busca_diretores()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Função desenvolvida para buscar os diretores de acordo
         *                com o ID da diretoria
         */
        function busca_diretores($id_diretoria)
        {
            $this->BD->select('diretores.id, diretores.nome_diretor, diretores.cargo, diretores.foto, diretorias.ano_inicio, diretorias.ano_final');
            $this->BD->from('diretores, diretorias');
            $this->BD->where(array('diretores.id_diretoria' => $id_diretoria, 'diretorias.id' => $id_diretoria));
            $query = $this->BD->get();
            return $query->result();
        }
        //**********************************************************************
        
        /**
         * @name        - salvar_diretor()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Função desenvolvida para salvar um novo diretor
         */
        function salvar_diretor($dados)
        {
            $data = array(
                'nome_diretor'  => $dados['nome_diretor'],
                'cargo'         => $dados['cargo'],
                'foto'          => $dados['foto'],
                'id_diretoria'  => $dados['id_diretoria']
            );
            return $this->BD->insert($this->_tabela, $data);
        }
    }
?>