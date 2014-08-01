<?php

    /**
     * @package     MY_Conntroller
     * @subpackage  Novo_aviso
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    Classe desenvolvida para gerenciar os avisos
     */
    class Novo_aviso extends MY_Controller
    {
        /**
         * @name        __construct
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Realiza a construção do controller
         * @param       bool    $requer_autenticacao    Se TRUE, indica que é necessário
         *              login para acessar a classe
         */
        function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);

            $this->load->model('avisos/avisos_model');
        }
        /*         * ******************************************************************* */
        /**
         * @name        index()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função principal da classe
         */
        function index()
        {
            $this->load->view('paginas/avisos/novo_aviso');
        }
        /*         * ******************************************************************* */
        /**
         * @name        salvar_aviso()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para salvar o aviso
         * @param       array   $dados  Recebe os dados do aviso
         * @param       string  $tamanho_string Recebe a mensagem e verifica se 
         *              existe alguma palavra. Retira todas as tags HTML para
         *              verificação.
         * @return      0   Retorna 0 se não houver palavras na mensagem
         * @return      1   Retorna 1 se o aviso for salvo
         * @return      2   Retorna 2 se o aviso não for salvo
         */
        function salvar_aviso()
        {
            $dados['mensagem'] = $this->input->post('mensagem');
            $dados['data_expiracao'] = $this->input->post('data_expiracao');

            if($this->avisos_model->salvar($dados) == 1)
            {
                echo 1;
            }
            else
            {
                echo 2;
            }
        }
    }
?>