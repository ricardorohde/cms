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
	 * Diretores
	 *
	 * Classe desenvolvida para gerenciar os diretores da instituição
	 *
	 * @package		Controllers
	 * @subpackage	Diretoria
	 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access		Public
	 * @version     v1.3.0
	 * @since		17/09/2014
	 */
    class Diretores extends MY_Controller
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
            parent::__construct(TRUE);
            
            /** Realiza o LOAD dos models responsáveis **/
            $this->load->model('diretoria/diretores_model', 'diretores');
            $this->load->model('diretoria/diretoria_model', 'diretorias');
        }
        //**********************************************************************
        
        /**
         * index()
         * 
         * Função desenvolvida para chamar a tela de cadastro de diretores
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         */
        function index()
        {
            $this->load->view('paginas/diretoria/diretores');
        }
        //**********************************************************************
        
        /**
         * diretorias_combo()
         * 
         * Função desenvolvida para preencher o combobox com as diretorias 
         * cadastradas
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return     	Array - retorna um array contendo as diretorias cadastradas
         */
        function diretorias_combo()
        {
            $diretorias = $this->diretorias->diretorias_combo();
            echo '<option value="">Selecione uma diretoria</option>';
            foreach ($diretorias as $row)
            {
                echo '
                    <option value="'.$row->id.'">
                        Diretoria '.$row->ano_inicio.' - '.$row->ano_final.'
                    </option>
                ';
            }
        }
        //**********************************************************************
        
        /**
         * busca_diretores()
         * 
         * Função desenvolvida para buscar os diretores de acordo com o id da 
         * diretoria.
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return      Array retorna um array de diretores
         */
        function busca_diretores($id_diretoria = 0)
        {
            /** realiza a busca e guarda na variável **/
            $this->dados['diretores'] = $this->diretores->busca_diretores($id_diretoria);
            
            /** Chama a visão e insere os dados **/
            $this->load->view('paginas/paginados/diretoria/diretores', $this->dados);
        }
        //**********************************************************************
        
        /**
         * salvar_diretor()
         * 
         * Função desenvolvida para salvar um novo diretor
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public 
         * @return      Boolean retorna TRUE se salvou ou FALSE se não
         */
        function salvar_diretor()
        {
            /** Recebe os dados passados por POST **/
            $dados['nome_diretor']  = $this->input->post('nome_diretor');
            $dados['cargo']         = $this->input->post('cargo');
            $dados['foto']          = $this->input->post('foto');
            $dados['id_diretoria']  = $this->input->post('id_diretoria');
            
            echo $this->diretores->salvar_diretor($dados);
            
            $this->atualizar_miniatura($dados['foto']);
        }
        //**********************************************************************
        
        /**
         * excluirDiretor()
         * 
         * Função desenvolvida para excluir um diretor cadastrado
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		bool Retorna TRUE se apagar e FALSE se não apagar
         */
        function excluirDiretor()
        {
        	echo $this->diretores->excluir($this->input->post('id')); 
        }
        //**********************************************************************
        
        /**
         * alterar()
         * 
         * Função desenvolvida para exibição de formulário para alterar os dados
         * de um diretor
         * 
         * @author		Matheus Lopes Santos <fale_com_opez@hotmail.com>
         * @access		Public
         * @param		int $id Contém o ID do diretor a ser buscado 
         */
        function alterar($id)
        {
        	$this->dados['diretor'] = $this->diretores->busca_diretores(NULL,$id);
        	
        	$this->template = 'template/popup';
        	$this->view		= 'popup/editar_diretor';
        	$this->titulo	= 'Edição de Diretor';
        	
        	$this->LoadView();
        }
        //**********************************************************************
        
        /**
         * atualizar()
         * 
         * Função desenvolvida para atualizar os dados de um presidente
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Public
         * @return		bool	Retorna TRUE se atualizar e FALSE se não atualizar
         */
        function atualizar()
        {
        	$dados['id']			= $this->input->post('id');
        	$dados['nome_diretor']  = $this->input->post('nome_diretor');
        	$dados['cargo']         = $this->input->post('cargo');
        	$dados['foto']          = $this->input->post('foto');
        	$dados['id_diretoria']  = $this->input->post('id_diretoria');
        	
        	$this->atualizar_miniatura($dados['foto']);
        	
        	echo $this->diretores->update($dados);
        }
        //**********************************************************************
        
        /**
         * atualizar_miniatura()
         * 
         * Função desenvolvida para reduzir o tamanho das fotos dos membros da
         * diretoria
         * 
         * @author		Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @access		Private
         * @param		string $foto Recebe o caminho da foto a ser processada
         */
        private function atualizar_miniatura($foto)
        {
        	// Recebe o domínio do site para que seja excluido o endereço
        	$site = array('http://'.$_SERVER['HTTP_HOST']);
        	
        	// Retira as barras padrao pela invertidas
        	$foto  = str_replace("\\", "/", $foto);
        	
        	// Retira o dominio do site
        	$foto  = str_replace($site, "", $foto);
        	
        	// Carrega a Lib de manipulação de imagens
        	$this->load->library('image_lib');
        	
        	// Configurações para a nova imagem
        	$config['image_library']    = 'GD2';
        	$config['maintain_ratio']   = FALSE;
        	$config['create_thumb']     = FALSE;
        	$config['width']            = 640;
        	$config['height']           = 480;
        	$config['quality']          = '80%';
        	$config['source_image']     = '..'.$foto;
        	
        	// Inicializa a library de imagem
        	$this->image_lib->initialize($config);
        	
        	// Realiza o redimensionamento da imagem
        	$this->image_lib->resize();
        }
        //**********************************************************************
    }
    /** End of File diretores.php **/
    /** Location ./application/controllers/diretoria/diretores.php **/