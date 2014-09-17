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
     * Diretoria_model
     * 
     * Classe desenvolvida para comandar as transações de BD com a tabela diretorias
     * 
     * @package		Models
     * @subpackage	Diretoria
     * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.2.0
     * @since		16/09/2014
     */
    class Diretoria_model extends MY_Model
    {
        /**
         * __construct()
         * 
         * Realiza a construção da classe
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         */
        public function __construct() {
            parent::__construct();
            
            $this->_tabela = 'diretorias';
        }
        //**********************************************************************
        
        /**
         * busca_diretorias()
         * 
         * Função desenvolvida para realizar a busca das diretorias cadastradas
         * na base de dados. Realiza a busca realizando paginação através do 
         * limite e offset
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $limite Recebe o limite da consulta sql
         * @param		int $offset Recebe o offset da consulta sql 
         * @return      array Retorna uma array de diretorias
         */
        function busca_diretorias($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->order_by('ano_inicio', 'desc');
            
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * conta_diretorias()
         * 
         * Função desenvolvida para contar a quantidade de diretorias cadastradas.
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return      int Retorna o numero de galerias cadastradas
         */
        function conta_diretorias()
        {
            return parent::count();
        }
        //**********************************************************************
        
        /**
         * salvar_diretoria()
         * 
         * Função desenvolvida para salvar os dados de uma nova diretoria. 
         * Estes dados tem que ser passados como parâmetro.
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return      Bool retorna verdadeiro se salvou ou falso se não salvou
         */
        function salvar_diretoria($dados)
        {
            $this->_data = array(
                'ano_inicio'    => $dados['ano_inicio'],
                'ano_final'     => $dados['ano_final'],
                'observacoes'   => $dados['observacoes']
            );
            return parent::save();
        }
        //**********************************************************************
        
        /**
         * diretorias_combo()
         * 
         * Função desenvolvida para buscar as diretorias cadastradas para 
         * inserir em um combobox
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return      array Retorna um array de diretorias
         */
        function diretorias_combo()
        {
            $this->BD->select('id, ano_inicio, ano_final');
            $this->BD->order_by('ano_inicio', 'desc');
            
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * delete()
         * 
         * Função desenvolvida para apagar uma diretoria
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $id	Contém o ID do registro a ser excluido
         * @return		bool Retorna TRUE se apagar e FALSE se não apagar
         */
        function delete($id)
        {
        	$this->_primaria = $id;
        	
        	return parent::delete();
        }
        //**********************************************************************
        
        /**
         * buscar_byId()
         * 
         * Função desenvolvida para buscar uma diretoria pelo ID
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $id Contém o ID da diretoria a ser buscado
         * @return		array Retorna um array contendo os dados de uma diretoria
         */
        function buscar_byId($id)
        {
        	$this->BD->where('id', $id);
        	
        	return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * atualiza()
         * 
         * Função desenvolvida para atualizar os dados de uma diretoria
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		array	$dados	Contém os dados que serão atualizados
         * @return		bool	Retorna TRUE se atualizar e FALSE se não 
         * 				atualizar
         */
        function atualizar($dados)
        {
        	$this->_data = array(
        		'ano_inicio'	=> $dados['ano_inicio'],
        		'ano_final'		=> $dados['ano_final'],
        		'observacoes'	=> $dados['observacoes']
        	);
        	
        	$this->_primaria = $dados['id'];
        	
        	return parent::update();
        }
        //**********************************************************************
    }
	/** End of File diretoria_model.php **/
    /** Location ./application/models/diretoria/diretoria_model.php **/