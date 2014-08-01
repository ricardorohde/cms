<?php

    class Setar_permissoes extends MY_Controller
    {
        /*
         * Construtor da classe
         */

        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            $this->load->model('menu_principal');
        }

        //----------------------------------------------------------------------

        /*
         * Função Principal do controller
         */
        function index($id)
        {
            $id = $this->uri->segment(3);
            $this->dados['id'] = $id;
            $this->dados['permissoes'] = $this->menu_principal->permissoes($id);
            $this->view = 'popup/permissao_usuario';
            $this->template = 'template/permissao';
            $this->titulo = 'Permissões de Usuário - MasterAdmin';

            $this->LoadView();
        }

        //----------------------------------------------------------------------

        /*
         * Função desenvolvida para retirar permissoes de um usuario
         */
        function retira_permissao()
        {
            $id_permissao = $this->uri->segment(3);
            $id_usuario = $this->uri->segment(4);
            $retirar = $this->menu_principal->retira_permissao($id_permissao);
            if($retirar == 0)
            {
                return false;
            }
            else
            {
                redirect(app_baseurl() . 'setar_permissoes/index/' . $id_usuario);
            }
        }

        //----------------------------------------------------------------------

        /*
         * Função desenvolvida para salvar as permissões para os usuários
         */
        function salvar_permissao()
        {
            $dados['permissoes'] = $this->input->post('permissao');
            $dados['id_usuario'] = $this->input->post('id_usuario');

            $permissoes = count($dados['permissoes']);
            for($i = 0; $i < $permissoes; $i++)
            {
                $dados['id_menu'] = $dados['permissoes'][$i];
                $resposta = $this->menu_principal->salvar_permissao($dados);
                if($resposta == 0)
                {
                    echo "Ocorreu um erro ao salvar os dados";
                }
            }
            redirect(app_baseurl() . 'setar_permissoes/index/' . $dados['id_usuario']);
        }

        //----------------------------------------------------------------------
    }

?>