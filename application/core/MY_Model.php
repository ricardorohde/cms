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
	 * MY_Model
	 *
	 * Subclasse modular padrão do sistema. Todas as variáveis protegidas que
	 * serão utilizadas pelos models são definidas aqui. Todos os models devem
	 * extender esta classe
	 *
	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @package		Core
	 * @version		v1.2.0
	 * @since		03/09/2014
	 */
    class MY_Model extends CI_Model
    {
    	/**
    	 * Variável que recebe o banco de dados que será trabalhado
    	 *
    	 * @var	string
    	 */
        protected $BD;
        
        /**
         * Variável que recebe a tabela na qual irá trabalhar
         *
         * @var	string
         */
        protected $_tabela;
        
        /**
         * Variável que recebe a chave primária do registro que se será 
         * trabalhando
         *
         * @var	int
         */
        protected $_primaria;
        
        /**
         * Variável que será usada principalmente para criar um array associativo
         * para inserir ou atualizar os dados de uma tabela
         * 
         * @var array
         */
        protected $_data;

        /**
         * __contruct()
         * 
         * Realiza a construção da classe. Verifica ainda a constant 'ENVIRONMENT', 
         * definido no arquivo index.php. Caso a constant seja marcada como
         * 'production' ou 'testing', seleciona um determinado banco de dados.
         * 
         * Caso a constante seja marcada como 'developement', seleciona o banco
         * de dados local
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         */
        public function __construct()
        {
            parent::__construct();
            if(ENVIRONMENT == 'production' || ENVIRONMENT == 'testing')
            {
            	$this->BD = $this->load->database('production', TRUE);
            }
            else
            {
            	$this->BD = $this->load->database('default', TRUE);
            }
        }
        //**********************************************************************
        
        /**
         * save()
         * 
         * Função desenvolvida para salvar elementos no banco de dados
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		bool Retorna TRUE se salvar e FALSE se não salvar
         */
        function save()
        {
        	return $this->BD->insert($this->_tabela, $this->_data);
        }
        //**********************************************************************
        
        /**
         * update()
         * 
         * Função desenvolvida para realizar atualizações no banco de dados
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		bool Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function update()
        {
        	$this->BD->where('id', $this->_primaria);
        	return $this->BD->update($this->_tabela, $this->_data);
        }
        //**********************************************************************
        
        /**
         * delete()
         * 
         * Função desenvolvida para excluir um registro do banco de dados
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		bool Retorna TRUE se excluir e FALSE se não excluir
         */
        function delete()
        {
        	$this->BD->where('id', $this->_primaria);
        	return $this->BD->delete($this->_tabela);
        }
        //**********************************************************************
        
        /**
         * count()
         * 
         * Função que realiza a contagem dos registros de uma tabela
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		int Retorna a contagem de registros de uma tabela
         */
        function count()
        {
        	return $this->BD->count_all_results($this->_tabela);
        }
        //**********************************************************************
    }
    /** End of File MY_Model.php **/
    /** Location ./application/core/MY_Model.php **/