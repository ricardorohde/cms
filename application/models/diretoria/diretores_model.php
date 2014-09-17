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
     * Diretores_model
     * 
     * Model desenvolvido para gerenciar as transações envolvendo a tabela de 
     * diretores
     * 
     * @package     Models
     * @subpackage	Diretoria
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @access		Public
     * @version		v1.3.0
     */
    class Diretores_model extends MY_Model
    {
        /**
         * @name        - __construct()
         * @author      - Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    - Realiza a contrução da classe
         */
        public function __construct()
        {
            parent::__construct();

            $this->_tabela = 'diretores';
        }
        //**********************************************************************
        
        /**
         * busca_diretores()
         * 
         * Função desenvolvida para buscar os diretores de acordo com o ID da 
         * diretoria. Também é utilizada para pesquisar diretores avulsos, 
         * através do ID do diretor
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public 
         * @param		int|null $id_diretoria	Contém o ID da diretoria na qual
         * 				os diretores estão cadastrados
         * @param		int|null $id_diretor	Contém o ID do diretor a ser 
         * 				buscado
         * @return		array Retorna um array de registros de diretores
         */
        function busca_diretores($id_diretoria = NULL, $id_diretor = NULL)
        {
        	if($id_diretor != NULL)
        	{
        		$this->BD->where('id', $id_diretor);
        		
        		return $this->BD->get($this->_tabela)->result();
        	}
        	
        	if($id_diretoria != NULL)
        	{
        		$this->BD->select('diretores.id, diretores.nome_diretor, diretores.cargo, diretores.foto, diretorias.ano_inicio, diretorias.ano_final');
        		$this->BD->from('diretores, diretorias');
        		$this->BD->where(array('diretores.id_diretoria' => $id_diretoria, 'diretorias.id' => $id_diretoria));
        		
        		return $this->BD->get()->result();
        	}
        }
        //**********************************************************************
        
        /**
         * salvar_diretor()
         * 
         * Função desenvolvida para salvar um novo diretor
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		bool Retorna TRUE se salvar e FALSE se não salvar 
         */
        function salvar_diretor($dados)
        {
            $this->_data = array(
                'nome_diretor'  => $dados['nome_diretor'],
                'cargo'         => $dados['cargo'],
                'foto'          => $dados['foto'],
                'id_diretoria'  => $dados['id_diretoria']
            );
            
            return parent::save();
        }
        //**********************************************************************
        
        /**
         * contar_byDiretoria()
         * 
         * Realiza a contagem dos diretores cadastrados no sistema para uma
         * determinada diretoria
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int	$id	Contém o id da diretoria na qual estão inseridos
         * 				os diretores
         * @return		int Retorna o número de diretores cadastrados
         */
        function contar_byDiretoria($id)
        {
        	$this->BD->where('id_diretoria', $id);
        	
        	parent::count();
        }
        //**********************************************************************
        
        /**
         * excluir_diretoresDiretorias()
         * 
         * Função desenvolvida para excluir diretores pelo ID de uma diretoria
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $id Contém o ID da diretoria que foi excluida
         * @return		bool Retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir_diretoresDiretorias($id)
        {
        	$this->BD->where('id_diretoria', $id);
        	
        	return $this->BD->delete($this->_tabela);
        }
        //**********************************************************************
        
        /**
         * excluir()
         * 
         * Função desenvolvida para apagar um diretor da base de dados
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		int $id		Contém o ID do diretor a ser excluido
         * @param		bool Retorna TRUE se apagar e FALSE se não apagar
         */
        function excluir($id)
        {
        	$this->_primaria = $id;
        	
        	return parent::delete();
        }
        //**********************************************************************
        
        /**
         * update()
         * 
         * Função desenvolvida para atualizar os dados cadastrados de um diretor
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @param		array	$dados	Contém os dados a serem atualizados
         * @return		bool	Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function update($dados)
        {
        	$this->_data = array(
        		'nome_diretor'	=> $dados['nome_diretor'],
        		'cargo'			=> $dados['cargo'],
        		'foto'			=> $dados['foto'],
        		'id_diretoria'	=> $dados['id_diretoria']
        	);
        	
        	$this->_primaria = $dados['id'];
        	
        	return parent::update();
        }
        //**********************************************************************
    }
	/** End of File diretores_model.php **/
    /** Location ./application/models/diretoria/diretores_model.php **/