<?php

    class Usuarios extends MY_Model
    {
        /*
         * Construção da classe usuários----------------------------------------
         */

        public function __construct()
        {
            parent::__construct();
            $this->_tabela = 'usuarios';
            $this->_primary = 'id';
        }

        //----------------------------------------------------------------------

        /*
         * Função para autenticação---------------------------------------------
         */
        public function autenticar($login, $senha)
        {
            
            $login = mysql_real_escape_string($login);
            $senha = md5($senha);

            $this->BD->where('email', $login);
            $this->BD->where('senha', $senha);
            $query = $this->BD->get($this->_tabela);

            if ($query->num_rows() > 0)
            {
                $arraydeusuarios = NULL;
                foreach ($query->result() as $row)
                {
                    $arraydeusuarios = $row;
                }
                return $arraydeusuarios;
            }
            else
            {
                return FALSE;   
            }
        }

        //----------------------------------------------------------------------

        /*
         * Função desenvolvida para buscar um id no banco de dados
         */
        function busca_id($email)
        {
            $this->BD->select('id');
            $this->BD->where('email', $email);
            $this->BD->where('status', 1);
            $query = $this->BD->get($this->_tabela);
            if ($query->num_rows() > 0)
            {
                foreach ($query->result() as $row)
                {
                    $id_usuario = $row->id;
                }
                return $id_usuario;
            }
            else
            {
                return 0;
            }
        }

        //----------------------------------------------------------------------
        //Função desenvolvida para buscar um email, de acordo o id
        function busca_email($id)
        {
            $this->BD->select('email');
            $this->BD->where(array('id' => $id, 'status' => 1));
            $query = $this->BD->get($this->_tabela);
            if ($query->num_rows() > 0)
            {
                foreach ($query->result() as $row)
                {
                    $email = $row->email;
                }
                return $email;
            }
            else
            {
                return 0;
            }
        }

        //----------------------------------------------------------------------

        /*
         * Função criada para redefinir a senha de um usuário
         */
        function redefinir_senha($dados)
        {
            $data = array(
                'senha' => $dados['senha']
            );
            $this->BD->where($data);
            $query = $this->BD->update($this->_tabela, $data);
            if ($query == 1)
            {
                return 1; //Redefiniu a senha
            }
            else
            {
                return 0; //Não redefiniu a senha
            }
        }

        //----------------------------------------------------------------------

        /*
         * Função que realiza a busca do nome de usuário
         */
        function nome_usuario($id)
        {
            $this->BD->where(array('id' => $id));
            $query = $this->BD->get($this->_tabela);
            if($query->num_rows() > 0)
            {
                foreach ($query->result() as $row)
                {
                    $user = $row->nome_usuario;
                    return $user;
                }
            }
            else
            {
                return "";
            }
            
        }

    }

?>