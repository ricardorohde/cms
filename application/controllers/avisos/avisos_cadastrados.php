<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Content Manegement System
	 * 
	 * Sistema desenvolvido para facilitar a inserção e atualização de dados no
	 * site do Pentáurea Clube
	 * 
	 * @package		CMS
	 * @author		Masterkey Informática
	 * @copyright	Copyright (c) 2010 - 2014, Masterkey Informática LTDA
	 */
    
    /**
     * avisos_cadastrados
     * 
     * Classe desenvolvida para gerenciar os avisos cadastrados.
     * 
     * @package     Controllers
     * @subpackage  Avisos
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version     v1.1.0
     * @since		15/09/2014
     */
    class Avisos_cadastrados extends MY_Controller
    {
        /**
         * __construct()
         * 
         * Realiza a construção da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        public function __construct()
        {
            parent::__construct(TRUE);
            
            //Realiza o LOAD do model necessário
            $this->load->model('avisos/avisos_model', 'avisos');
        }
        //**********************************************************************
        
        /**
         * index()
         * 
         * Função principal da Classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function index()
        {
            $this->load->view('paginas/avisos/avisos_cadastrados');
        }
        //**********************************************************************
        
        /**
         * busca_cadastrados()
         * 
         * Funçao desenvolvida para buscar os avisos cadastrados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $offset Define o offset da pesquisa
         */
        function busca_cadastrados($offset = 0)
        {
        	/** Definie o Limite da pesquisa **/
            $limite = 20;
            
            /** Recebe os avisos cadastrados **/
            $this->dados['avisos'] = $this->avisos->busca_avisos($limite, $offset);
            
            if(!$this->dados['avisos'] && $offset > 0)
            {
                $offset = $offset - $limite;
                $this->dados['avisos'] = $this->avisos->busca_avisos($limite, $offset);
            }
            
            /** Configurações para a paginação **/
            $config['base_url']     = app_baseurl().'painel/avisos_cadastrados/busca_cadastrados';
            $config['per_page']     = $limite;
            $config['uri_segment']  = 4;
            $config['total_rows']   = $this->avisos->contar_avisos();
            
            /** Inicalização da paginação **/
            $this->pagination->initialize($config);
            $this->dados['paginacao']   = $this->pagination->create_links();
            $this->dados['offset']      = $offset;
            
            $this->load->view('paginas/paginados/avisos/avisos_cadastrados', $this->dados);
        }
        //**********************************************************************
        
        /**
         * apagar_aviso()
         * 
         * Função desenvolvida para apagar os avisos cadastrados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se apagar e FALSE se não apagar
         */
        function apagar_aviso()
        {
            $id = $this->input->post('id');
            
            echo $this->avisos->apagar($id);
        }
        //**********************************************************************
        
        /**
         * inativar_aviso()
         * 
         * Função desenvolvida para inativar os avisos cadastrados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se inativar e FALSE se não inativar
         */
        function inativar_aviso()
        {
            $id = $this->input->post('id');
            
            echo $this->avisos->inativar($id);
        }
        //**********************************************************************
        
        /**
         * ativar_aviso()
         * 
         * Função desenvolvida para ativar os avisos cadastrados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se ativar e FALSE se não ativar
         */
        function ativar_aviso()
        {
            $id = $this->input->post('id');
            
            echo $this->avisos->ativar($id);
        }
        //**********************************************************************
        
        /**
         * salvar_aviso()
         * 
         * Função desenvolvida para salvar o aviso
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
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
            $dados['mensagem']          = $this->input->post('mensagem');
            $dados['data_expiracao']    = $this->input->post('data_expiracao');

            if($this->avisos->salvar($dados) == 1)
            {
                echo 1;
            }
            else
            {
                echo 2;
            }
        }
        //**********************************************************************
        
        /**
         * editar_aviso()
         * 
         * Função desenvolvida para editar um aviso cadastrado.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $id Contém o ID do aviso a ser editado
         */
        function editar_aviso($id)
        {
            $this->dados['aviso']   = $this->avisos->buscar($id);
            $this->template         = 'template/popup';
            $this->view             = 'popup/editar_avisos';
            
            $this->LoadView();
        }
        //**********************************************************************
        
        /**
         * atualizar_aviso()
         * 
         * Função desenvolvida para fazer a atualização de um aviso
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function atualizar_aviso()
        {
            $dados['id']                = $this->input->post('id');
            $dados['data_expiracao']    = $this->input->post('data_expiracao');
            $dados['mensagem']          = $this->input->post('mensagem');
            
            echo $this->avisos->atualizar($dados);
        }
        //**********************************************************************
    }
    /** End of File avisos_cadastrados.php **/
    /** Location ./application/controllers/avisos/avisos_cadastrados.php **/