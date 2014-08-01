<?php
    /**
     * @name temas.php
     * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.1
     * @return mixed
     * @uses Módulo responsável pelas transações de temas no site, envolvendo a
     * tabela 'PERSONALIZACAO'
     */
    class Temas_model extends MY_Model
    {
        /**
         * @name Construção da Classe
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @version 1.0.1
         */
        public function __construct()
        {
            parent::__construct();
            $this->_tabela = 'personalizacao';
            $this->_primary = 'id';
        }
        //----------------------------------------------------------------------
        
        /**
         * @name busca_temas()
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @package models/temas_model.php
         * @uses Função desenvolvida para buscar os temas já salvos. Recebe 
         * limite e offset para que seja feita uma busca com paginação
         * @return array - em caso de houver dados no BD
         *         NULL  - em caso de não houver nada
         */
        function busca_temas($limite, $offset)
        {
            $this->BD->select("*");
            $this->BD->limit($limite, $offset);
            $this->BD->order_by('id', 'desc');
            $query = $this->BD->get($this->_tabela);
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
            else
            {
                return NULL;
            }
        }
        //----------------------------------------------------------------------
        
        /**
         * @name contar_temas()
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @package models/temas_model.php
         * @uses Função criada para contar os temas cadastrados no BD
         * @return integer retorna a contagem dos registros
         */
        function contar_temas()
        {
            return $this->BD->count_all_results($this->_tabela);
        }
        //----------------------------------------------------------------------
        
        /**
         * @name salvar_tema()
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @package models/temas_model.php
         * @uses Função desenvolvida para salvar um novo tema no banco de dados
         * @return integer
         */
        function salvar_tema($dados)
        {
            $data = array(
                'imagem_fundo' => $dados['imagem_background'],
                'cor_principal'     => $dados['cor_principal'],
                'imagem_banner'     => $dados['imagem_banner'],
                'data_inicio'       => $dados['data_inicio'],
                'data_expiracao'    => $dados['data_expiracao'],
                'status'            => 1
            );
            return $this->BD->insert($this->_tabela, $data);
        }
        //----------------------------------------------------------------------
        
        /**
         * @name excluir_tema()
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @package models/temas_model.php
         * @uses A função é utilizada para excluir do banco de dados um tema pre
         * viamente salvo
         * @return integer
         */
        function excluir_tema($id)
        {
            $this->BD->where('id', $id);
            return $this->BD->delete($this->_tabela);
        }
        //----------------------------------------------------------------------
        
        /**
         * @name buscaTemaId()
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @package models/temas_model
         * @uses A função é utilizada para buscar um tema previamente cadastrado
         * para que possa ser editado
         */
        function buscaTemaId($id)
        {
            $this->BD->where('id', $id);
            $query = $this->BD->get($this->_tabela);
            return $query->result();
        }
        //----------------------------------------------------------------------
        
        /**
         * @name salvar_edicaoTema();
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @package models/temas_model
         * @uses A função é utilizada para atualizar um tema que já foi 
         * previamente salvo
         * @return integer
         */
        function salvar_edicaoTema($dados)
        {
            $data = array(
                'imagem_fundo'      => $dados['imagem_background'],
                'imagem_banner'     => $dados['imagem_banner'],
                'cor_principal'     => $dados['cor_principal'],
                'data_inicio'       => $dados['data_inicio'],
                'data_expiracao'    => $dados['data_expiracao']
            );
            $this->BD->where('id', $dados['id']);
            return $this->BD->update($this->_tabela, $data);
        }
        //----------------------------------------------------------------------
        
        /**
         * @name marcar()
         * @author Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @package models/temas_model.php
         * @uses A função é utilizada para marcar um tema como ativo ou inativo
         * @return integer
         */
        function marcar($dados)
        {
            $data = array(
                'status' => $dados['status']
            );
            $this->BD->where('id', $dados['id']);
            return $this->BD->update($this->_tabela, $data);
        }
        //----------------------------------------------------------------------
    }
?>