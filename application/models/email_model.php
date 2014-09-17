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
     * Email_model
     * 
     * Classe desenvolvida para gerenciar as operações com a tabela email
     * 
     * @package		Models
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.1.0
     * @since		16/09/2014
     */
    class Email_model extends MY_Model
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
            parent::__construct();
            
            /** Definição do nome da tabela e da chave primária **/
            $this->_tabela      = 'email';
        }
        //**********************************************************************
        
        /**
         * buscar()
         * 
         * Função desenvolvida para buscar as configurações salvas
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access      public
         */
        function buscar()
        {
            return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * processar()
         * 
         * Função desenvolvida para verificar se existe algum valor na chave
         * primária. Se existir, realiza update. Se não existir, realiza insert
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		array $dados Contém os dados que serão salvos
         * @return		bool Retorna o retorno dado pela função que será chamada
         */
        function processar($dados)
        {
			if($dados['id'] == "" || $dados['id'] == NULL)
			{
				return ($this->salvar($dados));
			}
			else
			{
				return ($this->atualizar($dados));				
			}
        }
        //**********************************************************************
        
        /**
         * salvar()
         * 
         * Função desenvolvida para salvar novos dados para as configurações de
         * envio de email
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Private
         * @param		array $dados Contém os dados que serão salvos
         * @return		bool Retorna TRUE se salvar e FALSE se não salvar
         */
        private function salvar($dados)
        {
        	$this->_data 	= array(
        		'smtp_host'		=> $dados['smtp_host'],
        		'smtp_port'		=> $dados['smtp_port'],
        		'smtp_userName'	=> $dados['smtp_userName'],
        		'smtp_password'	=> $dados['smtp_password'],
        		'smtp_password'	=> $dados['smtp_password'],
        		'smtp_from'		=> $dados['smtp_from'],
        		'smtp_fromName'	=> $dados['smtp_fromName'],
        	);
        	
        	return parent::save();
        }
        //**********************************************************************
        
        /**
         * atualizar()
         * 
         * Função desenvolvida para atualizar os dados de uma configuração que
         * foi salva
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Private
         * @param		array $dados Contém os dados que serão salvos
         * @return		bool Retorna TRUE se atualiza e FALSE se não atualizar
         */
        private function atualizar($dados)
        {
        	$this->_data 	= array(
        		'smtp_host'		=> $dados['smtp_host'],
        		'smtp_port'		=> $dados['smtp_port'],
        		'smtp_userName'	=> $dados['smtp_userName'],
        		'smtp_password'	=> $dados['smtp_password'],
        		'smtp_password'	=> $dados['smtp_password'],
        		'smtp_from'		=> $dados['smtp_from'],
        		'smtp_fromName'	=> $dados['smtp_fromName'],
        	);
        	
        	$this->_primaria = $dados['id'];
        	
        	return parent::update();
        }
    }
    /** End of File email_model.php **/
    /** Location ./application/models/email_model.php **/