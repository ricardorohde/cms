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
     * Presidentes_model
     * 
     * Classe responsável pelas transações ocorridas na tabela ex-presidentes
     * 
     * @package		Models
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version		v1.1.0
	 * @since		16/09/2014
     */
    class Presidentes_model extends MY_Model
    {
        /**
         * __construct()
         * 
         * Realiza a construção da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
         */
        public function __construct()
        {
            parent::__construct();
            
            $this->_tabela = 'ex-presidentes';
        }
        //**********************************************************************
        
        /**
         * salvar()
         * 
         * Função desenvolvida para salvar um novo presidente na base de dados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		array $dados Contém os dados que serão salvos
	 	 * @return		bool Retorna TRUE se salvar e FALSE se não salvar
         */
        function salvar($dados)
        {
            $this->_data = array(
                'nome'              => $dados['nome'],
                'inicio_mandato'    => $dados['inicio_mandato'],
                'fim_mandato'       => $dados['fim_mandato'],
                'foto'              => $dados['foto']
            );
            
            return parent::save();
        }
        //**********************************************************************
        
        /**
         * buscar()
         * 
         * Função desenvolvida para buscar os presidentes cadastrados na base de
         * dados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $limite Recebe o limite da consulta sql
	 	 * @param		int $offset	Recebe o offset da consulta sql
	 	 * @return		array Retorna um array com os presidentes cadastrados
         */
        function buscar($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->order_by('inicio_mandato', 'desc');
            
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * contar_presidentes()
         * 
         * Função desenvolvida para contar a quantidade de presidentes 
         * cadastrados
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @return		int Retorna a quantidade de presidentes cadastrados
         */
        function conta_presidentes()
        {
            return parent::count();
        }
        //**********************************************************************
        
        /**
         * excluir()
         * 
         * Função desenvolvida para excluir um ex presidente
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param       int $id Contém o ID do presidente a ser excluído
         * @return      bool Retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir($id)
        {
        	$this->_primaria = $id;
        	
            return parent::delete();
        }
        //**********************************************************************
        
        /**
         * buscar_byId()
         * 
         * Função desenvolvida para buscar os dados de um presidente pelo ID da
         * gravação.
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $id Contém o ID do registro a ser buscado
         * @return		array Retorna um array contendo o registro do presidente
         * 				buscado
         */
        function buscar_byId($id)
        {
        	$this->BD->where('id', $id);
        	
        	return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * atualizar()
         * 
         * Função desenvolvida para salvar as alterações feitas no cadastro de
         * um presidente
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		array $dados Contém os dados que serão atualizados
         * @return		
         */
        function atualizar($dados)
        {
        	$this->_data = array(
        		'nome'				=> $dados['nome'],
        		'inicio_mandato'	=> $dados['inicio_mandato'],
        		'fim_mandato'		=> $dados['fim_mandato'],
        		'foto'				=> $dados['foto']
        	);
        	
        	$this->_primaria = $dados['id'];
        	
        	return parent::update();
        }
        //**********************************************************************
    }
	/** End of File presidentes_model.php **/
    /** Location ./application/models/presidentes_model.php **/