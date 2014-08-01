<?php
    /**
     * @package     MY_Controller
     * @subpackage  painel
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    A classe Painel é responsável pela visão inicial de todo o sistema, onde aparecem os elementos 
     *              estáticos, como o menu
     */
    class Painel extends MY_Controller
    {
        /**
         * @name        __construct()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @param       bool $requer_autenticacao A variavel recebre TRUE se a página requisitada necessita de o 
         *              usuário fazer login
         * @abstract    Realiza a construção da classe
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
        }
        /**********************************************************************/

        /**
         * @name        index()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @param       string $this->view Variável que receba a visão que será carregada
         * @abstract    Função principal da classe, que vai mostrar o painel do site
         */
        function index()
        {
            $this->view = 'painel';
            $this->LoadView();
        }
        /**********************************************************************/
    }
?>