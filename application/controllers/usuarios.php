<?php

    class Usuarios extends MY_Controller
    {
        /*
         * Construçao da classe Usuarios
         */

        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            $this->dados['nome'] = $_SESSION['user']->nome_completo;
            $this->load->model('cadastro_usuarios');
            $this->load->model('menu_principal');
        }

        //----------------------------------------------------------------------

        /*
         * Classe principal do Controller
         */
        function index()
        {
            $this->menu = $this->menu_principal->montar_menu($_SESSION['user']->id);
            $this->view = 'usuarios';
            $this->titulo = 'Usuários do Sistema';

            $this->LoadView();
        }

        //----------------------------------------------------------------------

        /*
         * Função criada para salvar um novo usuário
         */
        function salva_usuario()
        {
            $dados['nome_completo'] = $this->input->post('nome_completo');
            $dados['nome_usuario'] = $this->input->post('nome_usuario');
            $dados['senha'] = md5($this->input->post('senha'));

            $usuario = $this->cadastro_usuarios->cadastrar($dados);
            if ($usuario == 0)
            {
                echo $usuario;
            }
            else
            {
                echo $usuario;
            }
        }

        //----------------------------------------------------------------------

        /*
         * Função que realiza a busca dos usuários
         */
        function buscar_usuarios($offset = 0)
        {
            $limite = 20;
            $this->dados['usuarios'] = $this->cadastro_usuarios->lista_usuarios($limite, $offset);
            if (!$this->dados['usuarios'] and $offset > 0)
            {
                $offset = $offset - 7;
                $this->dados['usuarios'] = $this->cadastro_usuarios->lista_usuarios($limite, $offset);
            }
            $config['base_url'] = app_baseUrl() . 'usuarios/buscar_usuarios';
            $config['per_page'] = $limite;
            $config['total_rows'] = $this->cadastro_usuarios->conta_usuarios();

            $this->pagination->initialize($config);
            $this->dados['paginacao'] = $this->pagination->create_links();
            $this->dados['verificador'] = $offset;
            $this->load->view('paginas/paginados/usuarios_paginados', $this->dados);
        }

        //-----------------------------------------------------------------------

        /*
         * Função desenvolvida para ativar um usuário
         */
        function inativar()
        {
            $id = $this->input->post('id');
            $marcado = $this->cadastro_usuarios->inativar_usuario($id);
            if ($marcado == 1)
            {
                echo "Usuário marcado como inativo";
            }
            else
            {
                echo "Não Foi possível realizar esta ação. Tente novamente";
            }
        }

        //-----------------------------------------------------------------------

        /*
         * Função desenvolvida para reativar uma conta de usuário
         */
        function ativar()
        {
            $id = $this->input->post('id');
            $marcado = $this->cadastro_usuarios->ativar_usuario($id);
            if ($marcado == 1)
            {
                echo "Usuário marcado como ativo";
            }
            else
            {
                echo "Não Foi possível realizar esta ação. Tente novamente";
            }
        }

        //-----------------------------------------------------------------------

        /*
         * Função desenvolvida para excluir um usuário da base de dados
         */
        function excluir_usuario()
        {
            $id = $this->input->post('id');
            $resposta = $this->cadastro_usuarios->excluir_usuario($id);
            if ($resposta == 0)
            {
                echo "E0"; //Erro 0 - Não excluído
            }
            else
            {
                echo "E1"; //Evento 1 - Excluído com sucesso
            }
        }

        //-----------------------------------------------------------------------
    }

?>