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
	 * Usuarios
	 * 
	 * Classe desenvolvida para gerenciamento de usuarios
	 * 
	 * @package		Models
	 * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version		v1.1.0
	 * @since		16/09/2014
	 */
    class Usuarios extends MY_Model
    {
        /**
         * __construct()
         * 
         * Construção da classe usuários
         * 
         * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
         */
        public function __construct()
        {
            parent::__construct();
            
            $this->_tabela = 'usuarios';
        }
        //**********************************************************************

        /**
         * autenticar()
         * 
         * Função desenvolvida para autenticação
         * 
         * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		string $login Contém o Login do usuário
	 	 * @param		string $senha Contém a senha do usuáiro
	 	 * @return		array Retorna um array com os dados do usuário
         */
        public function autenticar($login, $senha)
        {
            
            $login = mysql_real_escape_string($login);
            $senha = $senha;

            $this->BD->where('email', $login);
            $this->BD->where('senha', $senha);
            $query = $this->BD->get($this->_tabela);

            if ($query->num_rows() > 0)
            {
                $arraydeusuarios = NULL;
                foreach ($query->result() as $row)
                {
                    $arraydeusuarios = $row;
                }
                return $arraydeusuarios;
            }
            else
            {
                return FALSE;   
            }
        }
        //**********************************************************************

        /**
         * busca_id()
         * 
         * Função desenvolvida para buscar um id no banco de dados
         * 
         * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		string $email Contém o Email que será usado para buscar
	 	 * 				o ID do usuário
	 	 * @return		int Retorna o ID do usuário
         */
        function busca_id($email)
        {
            $this->BD->select('id');
            $this->BD->where('email', $email);
            $this->BD->where('status', 1);
            $query = $this->BD->get($this->_tabela);
            
            if ($query->num_rows() > 0)
            {
                foreach ($query->result() as $row)
                {
                    $id_usuario = $row->id;
                }
                return $id_usuario;
            }
            else
            {
                return 0;
            }
        }
        //**********************************************************************
        
        /**
         * busca_email()
         * 
         * Função desenvolvida para buscar um email, de acordo o id
         * 
         * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $id Contém o ID do usuário a ser buscado
	 	 * @return		string Retorna o Email do usuário
         */
        function busca_email($id)
        {
            $this->BD->select('email');
            $this->BD->where(array('id' => $id, 'status' => 1));
            $query = $this->BD->get($this->_tabela);
            
            if ($query->num_rows() > 0)
            {
                foreach ($query->result() as $row)
                {
                    $email = $row->email;
                }
                return $email;
            }
            else
            {
                return 0;
            }
        }
        //**********************************************************************

        /**
         * redefinir_senha()
         * 
         * Função criada para redefinir a senha de um usuário
         * 
         * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		array $dados Contém a senha que será atualizada
	 	 * @return		bool Retorna TRUE se salvar e FALSE se não salvar
         */
        function redefinir_senha($dados)
        {
            $this->_data 		= array('senha' => $dados['senha']);
            $this->_primaria	= $dados['id'];
            
            return parent::update();
        }
        //**********************************************************************

        /**
         * nome_usuario()
         * 
         * Função que realiza a busca do nome de usuário
         * 
         * @author 		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 	 * @access		Public
	 	 * @param		int $id Contém o ID do usuário que terá o nome buscado
	 	 * @return		string Retorna o nome do usuário
         */
        function nome_usuario($id)
        {
            $this->BD->where(array('id' => $id));
            $query = $this->BD->get($this->_tabela);
            
            if($query->num_rows() > 0)
            {
                foreach ($query->result() as $row)
                {
                    $user = $row->nome_usuario;
                    return $user;
                }
            }
            else
            {
                return "";
            }
        }
        //**********************************************************************
        
        /**
         * get()
         * 
         * Função desenvolvida para buscar os usuários cadastrados no sistema
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		mixed	$parametro Recebe um parâmetro que será executado
         * 				na consulta sql
         * @return		array	Retorna um array com os usuários cadastrados
         */
        function get($parametro = NULL)
        {
        	if(isset($parametro))
        	{
        		$this->BD->where($parametro);
        	}
        	
        	return $this->BD->get($this->_tabela)->result();
        }
        //**********************************************************************
        
        /**
         * insert()
         * 
         * Função desenvolvida para inserção de dados na tabela
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		array	$data	Contém os dados que serão inseridos
         * @return		bool	Retorna 1 se salvar e 0 se não salvar
         */
		function insert($data)
		{
			$this->_data = $data;
			
			return parent::save();
		}
		//**********************************************************************
		
		/**
		 * update()
		 * 
		 * Função desenvolvida para realizar operações de atualização de dados
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @param		array	$data	Contém os dados que serão atualizados
		 * @param		int		$int	Contém a chave primária do registro a 
		 * 				ser atualizado
		 * @return		bool	Retorna TRUE se atualizar e FALSE se não atualizar	
		 */
		function update($data, $id)
		{
			$this->_data 		= $data;
			$this->_primaria	= $id;
			
			return parent::update();
		}
		//**********************************************************************
		
		/**
		 * delete()
		 * 
		 * Função desenvolvida para excluir um registro
		 * 
		 * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
		 * @access		Public
		 * @param		int		$id	Contém o ID do registro a ser excluido
		 * @return		bool	Retorna TRUE se excluir e FALSE se não excluir
		 */
		function delete($id)
		{
			$this->_primaria = $id;
			
			return parent::delete();
		}
		//**********************************************************************
    }
    /** End of File usuarios.php **/
    /** Location ./application/models/usuarios.php **/