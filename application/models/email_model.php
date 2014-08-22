<?php
    /**
     * email_model.php
     * 
     * Arquico que contém a classe email_model
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version     v1.1.0
     */
    
    /**
     * email_model
     * 
     * Classe desenvolvida para gerenciar as operações com a tabela email
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
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
            $this->_primaria    = 'id';
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
        	//Faz a associação entre os dados e os campos da tabela
        	$data 	= array(
        			'smtp_host'		=> $dados['smtp_host'],
        			'smtp_port'		=> $dados['smtp_port'],
        			'smtp_userName'	=> $dados['smtp_userName'],
        			'smtp_password'	=> $dados['smtp_password'],
        			'smtp_password'	=> $dados['smtp_password'],
        			'smtp_from'		=> $dados['smtp_from'],
        			'smtp_fromName'	=> $dados['smtp_fromName'],
        	);
        	
        	return $this->BD->insert($this->_tabela, $data);
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
        	//Faz a associação entre os dados e os campos da tabela
        	$data 	= array(
        			'smtp_host'		=> $dados['smtp_host'],
        			'smtp_port'		=> $dados['smtp_port'],
        			'smtp_userName'	=> $dados['smtp_userName'],
        			'smtp_password'	=> $dados['smtp_password'],
        			'smtp_password'	=> $dados['smtp_password'],
        			'smtp_from'		=> $dados['smtp_from'],
        			'smtp_fromName'	=> $dados['smtp_fromName'],
        	);
        	
        	$this->BD->where('id', $dados['id']);
        	return $this->BD->update($this->_tabela, $data);
        }
    }
    /** End of File email_model.php **/
    /** Location ./application/models/email_model.php **/