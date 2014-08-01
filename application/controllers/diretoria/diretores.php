<?php
    /**
     * @package     - controllers/diretoria/diretores
     * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    - Controller desenvolvido para gerenciar o cadastro e 
     *                exibição dos diretores
     */
    class Diretores extends MY_Controller
    {
        /**
         * @name        - __construct()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Realiza a construção da classe
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            
            /** Chamada do model responsável para esta classe **/
            $this->load->model('diretoria/diretores_model');
            
            /** Chama model de diretorias **/
            $this->load->model('diretoria/diretoria_model');
        }
        //**********************************************************************
        
        /**
         * @name        - index()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Função desenvolvida para chamar a tela de cadastro de
         *                diretores
         */
        function index()
        {
            $this->load->view('paginas/diretoria/diretores');
        }
        //**********************************************************************
        
        /**
         * @name        - diretorias_combo()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Função desenvolvida para preencher o combobox com as
         *                diretorias cadastradas
         * @return        Array - retorna um array contendo as diretorias 
         *                cadastradas
         */
        function diretorias_combo()
        {
            $diretorias = $this->diretoria_model->diretorias_combo();
            echo '<option value="">Selecione uma diretoria</option>';
            foreach ($diretorias as $row)
            {
                echo '
                    <option value="'.$row->id.'">
                        Diretoria '.$row->ano_inicio.' - '.$row->ano_final.'
                    </option>
                ';
            }
        }
        //**********************************************************************
        
        /**
         * @name        - busca_diretores()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Função desenvolvida para buscar os diretores de acordo
         *                com o id da diretoria.
         * @return      Array retorna um array de diretores
         */
        function busca_diretores($id_diretoria = 0)
        {
            /** realiza a busca e guarda na variável **/
            $this->dados['diretores'] = $this->diretores_model->busca_diretores($id_diretoria);
            
            /** Chama a visão e insere os dados **/
            $this->load->view('paginas/paginados/diretoria/diretores', $this->dados);
        }
        //**********************************************************************
        
        /**
         * @name        - salvar_diretor()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Função desenvolvida para salvar um novo diretor
         * @return      Boolean retorna verdadeiro se salvou ou falso se não
         */
        function salvar_diretor()
        {
            /** Recebe os dados passados por POST **/
            $dados['nome_diretor']  = $this->input->post('nome_diretor');
            $dados['cargo']         = $this->input->post('cargo');
            $dados['foto']          = $this->input->post('foto');
            $dados['id_diretoria']  = $this->input->post('id_diretoria');
            
            /** Passagem dos dados para a função que salva os dados **/
            $resposta = $this->diretores_model->salvar_diretor($dados);
            
            if($resposta == 0 || $resposta == "")
            {
                /** Imprime 0 em caso de erro **/
                echo 0;
            }
            else
            {
                /** Imprime 1 em caso de sucesso **/
                echo 1;
            }
        }
    }
?>