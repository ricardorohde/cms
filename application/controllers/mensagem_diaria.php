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
     * Mensagem_diaria
     * 
     * Classe desenvolvida para gerenciar as transações das Mensagens diárias
     * 
     * @package     Controllers
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version     v1.1.0
     * @since		15/09/2014
     */
    class Mensagem_diaria extends MY_Controller
    {
        /**
         * __contruct()
         * 
         * Função desenvolvida para contrução da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        public function __construct()
        {
            parent::__construct(TRUE);
            
            /** Realiza o LOAD do model necessário **/
            $this->load->model('mensagens_model', 'mensagens');
        }
        //**********************************************************************
        
        /**
         * index()
         * 
         * Função principal do controller, que chamará a visão para o usuário
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function index()
        {
            $this->load->view('paginas/mensagem_diaria');
        }
        //**********************************************************************
        
        /**
         * salvar_mensagem()
         * 
         * Função que passara a nova mensagem para a função salvar.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       string $dados['mensagem']   recebe a mensagem que foi digitada e passada via post
         * @param       string $dados['autor']      recebe o autor que foi digitado e passado via post
         * @return      bool retorna TRUE se salvar a mensagem e FALSE se não salvar
         */
        function salvar_mensagem()
        {
            $dados['mensagem']  = $this->input->post('mensagem');
            $dados['autor']     = $this->input->post('autor');
            
            echo $this->mensagens->salvar($dados);
        }
        //**********************************************************************
        
        /**
         * busca_mensagens()
         * 
         * Fução desenvolvida para buscar as mensagens cadastradas
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $offset define o ofsset da pesquisa sql
         */
        function busca_mensagens($offset = 0)
        {
        	//Recebe o limite da consulta sql
            $limite = 20;
            
            //Recebe os dados vindos do banco de dados
            $this->dados['mensagens'] = $this->mensagens->buscar($limite, $offset);
            
            if(!$this->dados['mensagens'] and $offset > 0)
            {
                $offset = $offset - $limite;
                $this->dados['mensagens'] = $this->mensagens->buscar($limite, $offset);
            }
            
            /** Configurações da paginação **/
            $config['base_url']     = app_baseurl().'mensagem_diaria/busca_mensagens';
            $config['per_page']     = $limite;
            $config['total_rows']   = $this->mensagens->contar_mensagens();
            
            $this->pagination->initialize($config);
            
            $this->dados['paginacao'] = $this->pagination->create_links();
            
            $this->load->view('paginas/paginados/mensagens', $this->dados);
        }
        //**********************************************************************
        
        /**
         * excluir_mensagem()
         * 
         * Função desenvolvida para receber um id de uma noticia e passar para 
         * uma função no model excluir.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir_mensagem()
        {
            $id = $this->input->post('id');
            
            echo $this->mensagens->excluir($id);
        }
        //**********************************************************************
        
        /**
         * marcar_mensagem()
         * 
         * Função desenvolvida para marcar uma mensagem como ativa ou inativa
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se marcar e FALSE se não marcar
         */
        function marcar_mensagem()
        {
            $dados['acao']  = $this->input->post('acao');
            $dados['id']    = $this->input->post('id');
            
            echo $this->mensagens->marcar($dados);
        }
        //**********************************************************************
        
        /**
         * editar()
         * 
         * Função desenvolvida para edição de uma mensagem diária
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @param       int $id Contém o ID da mensagem que será editada
         */
        function editar($id = NULL)
        {
            $this->dados['mensagem'] = $this->mensagens->buscar_mensagem($id);
            
            $this->view     = 'popup/editar_mensagem';
            $this->template = 'template/popup';
            
            $this->LoadView();
        }
        //**********************************************************************
        
        /**
         * salvar_alteracao()
         * 
         * Função desenvolvida para salvar alterações realizadas em uma mensagem
         * diária.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         * @return      bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function salvar_alteracao()
        {
            $dados['id']        = $this->input->post('id');
            $dados['autor']     = $this->input->post('autor');
            $dados['mensagem']  = $this->input->post('mensagem');
            
            echo $this->mensagens->atualizar($dados);
        }
        //**********************************************************************
    }
    /** End of File mensagem_diaria.php **/
    /** Location ./application/controllers/mensagem_diaria.php **/