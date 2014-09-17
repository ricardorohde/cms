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
	 * Barracas_model
	 * 
	 * Classe desenvolvida para gerenciar as transações com a tabela barracas
	 * 
	 * @package		Models
	 * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version		v1.2.0
	 * @since		16/09/2014
	 */
    class Barracas_model extends MY_Model
    {
        /**
         * __construct()
         * 
         * Realiza a construção da classe
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
         */
        public function __construct()
        {
            parent::__construct();
            
            $this->_tabela = 'barracas';
        }
        //**********************************************************************

        /**
         * lista_barracas()
         * 
         * Função que realiza a busca das barracas e prepara para paginação
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $limite Recebe o limite da consulta sql
	 	 * @param		int $offset Recebe o offset da consulta sql
	 	 * @return		array Retorna um array de barracas
         */
        function lista_barracas($limite, $offset)
        {
            $this->BD->limit($limite, $offset);
            $this->BD->select('barracas.id, numero_barraca, localizacao, titulo_barraca, descricao, valor, valor_fim_semana');
            $this->BD->join('descricao', 'descricao.id = barracas.id_descricao');
            $this->BD->join('valores', 'valores.id = descricao.id_valores');
            $this->BD->order_by('titulo_barraca');
            
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************

        /**
         * conta_barracas()
         * 
         * Função que conta as barracas cadastradas
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @return		int Retorna o número de barracas cadastradas no BD
         */
        function conta_barracas()
        {
            return parent::count();
        }
        //**********************************************************************

        /**
         * salvar_barracas()
         * 
         * Função desenvolvida para salvar uma nova barraca na base de dados
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		array $dados Contém os dados que serão salvos
	 	 * @return		bool Retorna TRUE se salvar e FALSE se não salvar
         */
        function salvar_barraca($dados)
        {
            $this->_data = array(
                'numero_barraca'	=> $dados['numero_barraca'],
                'id_descricao' 		=> $dados['id_descricao'],
                'localizacao' 		=> $dados['localizacao']
            );
            
            return parent::save();
        }
        //**********************************************************************

        /**
         * excluir_barraca()
         * 
         * Função desenvolvida para excluir uma barraca da base de dados
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $id Contém o ID do registro a ser excluido
	 	 * @return		bool Retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir_barraca($id)
        {
            $this->_primaria = $id;
            
            return parent::delete();
        }
        //**********************************************************************
        
        /**
         * buscar_barraca()
         * 
         * Função desenvolvida para buscar uma barraca cadastrada no sistema
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $id Contém o ID do Registro a ser buscado
         * @return		array Retorna um array com os dados da barraca
         */
        function buscar_barraca($id)
        {
        	$this->BD->where('id', $id);
        	
        	return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * update()
         * 
         * Função desenvolvida para atualizar os dados de uma barraca
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		array $dados 	Contém os dados a serem atualizados
         * @var			array $data		Faz a associação entre os campos da tabela
         * 				e os dados
         * @return		bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function update($dados)
        {
        	$this->_data = array(
        		'numero_barraca'	=> $dados['numero_barraca'],
        		'id_descricao'		=> $dados['id_descricao'],
        		'localizacao'		=> $dados['localizacao']
        	);
        	
        	$this->_primaria = $dados['id'];
        	
        	return parent::update();
        }
        //**********************************************************************
    }
    /** End of File barracas_model.php **/
    /** Location ./application/models/barracas_model.php **/