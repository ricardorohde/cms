<?php
    
    /**
     * Opcoes_galerias
     * 
     * @package     MY_Controller
     * @subpackage  opcoes_galerias
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    Classe desenvolvida para aplicar determinadas configurações
     *              a uma determinada galeria
     */
    class Opcoes_galerias extends MY_Controller
    {
        /**
         * __construct()
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Construtor da classe
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            $this->load->model('galerias_model');
        }
        //**********************************************************************

        /**
         * index()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função principal do controller
         */
        function index()
        {
            $id_galeria     = $this->uri->segment(4);
            
            /** Seleciona a visão e o titulo da página **/
            $this->view     = 'paginas/galerias/opcoes_galerias';
            $this->titulo   = 'Galerias - Opções';

            $this->dados['id_galeria']  = $id_galeria;

            $this->load->view($this->view, $this->dados);
        }
        //**********************************************************************

        /**
         * buscar_fotos()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função que busca as imagens para exibição
         * @param       int $id_galeria Contém o id da galeria que buscaremos as
         *              fotos
         * @return      array   Retorna um array contendo o endereço das fotos
         * @access      public
         */
        function buscar_fotos($id_galeria)
        {
            $this->dados['fotos'] = $this->galerias_model->busca_fotos($id_galeria);
            
            $this->load->view('paginas/paginados/galerias/fotos_galeria', $this->dados);
        }
        //**********************************************************************

        /**
         * excluir_foto()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função utilizada para excluir uma foto. Se a imagem for
         *              excluida do BD, exclui a foto do disco. Se excluir a foto
         *              do disco, define uma nova capa para a galeria
         * @return      bool Retorna 1 se excluir a foto e 0 se não excluir
         */
        function excluir_foto()
        {
            $id         = $this->input->post('id');
            $id_galeria = $this->input->post('id_galeria');

            $dados['imagem'] = $this->galerias_model->busca_imagem($id);

            $verifica = $this->galerias_model->excluir($id);
            
            if($verifica == 0)
            {
                echo $verifica;
            }
            else
            {
                if(!unlink("../".$dados['imagem']))
                {
                    echo 0;
                }
                else
                {
                    $capa_galeria = $this->galerias_model->nova_capa($id_galeria);
                    if($capa_galeria == 0)
                    {
                        echo 2;
                    }
                    else
                    {
                        echo 1;
                    }
                }
            }
        }
        //**********************************************************************

        /**
         * excluir_galeria()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para excluir uma galeria inteira. 
         *              Esta exclusão inclui a exclusão das fotos no banco de dados
         *              e no disco também
         * @return      bool Retorna TRUE se excluir e FALSE se não excluir
         */
        function excluir_galeria()
        {
            $dados['id_galeria'] = $this->input->post('id_galeria');

            //Recebe o nome da galeria e para deletar a pasta
            $nome_galeria = $this->galerias_model->busca_nomeGaleria($dados['id_galeria']);
            $nome_galeria = str_replace(" ", "_", $nome_galeria);
            $path_galeria = '../img/galerias/'.$nome_galeria;

            $fotos = $this->galerias_model->excluir_todasFotos($dados);
            if($fotos > 0)
            {
                $galeria = $this->galerias_model->exclui_galeria($dados);
                if($galeria > 0)
                {
                    if(is_dir($path_galeria))
                    {
                        $d = opendir($path_galeria.'/');
                        $i = 0;
                        $nome = readdir($d);
                        while($nome != false)
                        {
                            if(!is_dir($nome))
                            {
                                $arquivos[$i] = $nome;
                                unlink($path_galeria.'/'.$arquivos[$i]);
                                $i++;
                            }
                            $nome = readdir($d);
                        }
                        $scan = scandir($path_galeria);
                        if(count($scan) > 2)
                        {
                            echo 2; //Não foi possível excluir os arquivos do disco
                        }
                        else
                        {
                            if(rmdir($path_galeria))
                            {
                                echo 3; //Sucesso na exclusão
                            }
                            else
                            {
                                echo 4; // não possível excluir a pasta
                            }
                        }
                    }
                }
                else
                {
                    echo 1; // Não foi possível a Galeria
                }
            }
            else
            {
                echo 0; //Não foi possível excluir as fotos do banco de dados
            }
        }
        //**********************************************************************

        /**
         * upload()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para upload de imagem. Verifica se
         *              existe uma pasta com o nome da galeria. Caso não haja,
         *              cria a mesma. Durante o upload das imagens, as mesmas são
         *              redimencionadas para o tamanho de 640x480, com qualidade
         *              de 75%
         */
        function upload()
        {
            /** seta o arquivo php.ini para permitir grandes quantidades de arquivos **/
            ini_set('upload_max_filesize', '100M');
            ini_set('post_max_size', '1024M');
            ini_set('max_input_time', '300');
            ini_set('max_file_uploads', '40');
            ini_set('max_execution_time', '300');
            
            /** Recebe o ID da galeria **/
            $dados['id_galeria'] = $this->input->post('id_galeria');

            /** Recebe o nome da galeria e cria um diretório para o upload **/
            $nome_galeria = $this->galerias_model->busca_nomeGaleria($dados['id_galeria']);
            $nome_galeria = str_replace(" ", "_", $nome_galeria);

            $upload_path = '../img/galerias/'.$nome_galeria.'/';

            if(!is_dir($upload_path))
            {
                mkdir($upload_path, 0777);
            }

            $this->load->library('upload');

            $arquivos = count($_FILES['fotos']['name']);

            for($i = 0; $i < $arquivos; $i++)
            {
                $_FILES['userfile']['name']     = $_FILES['fotos']['name'][$i];
                $_FILES['userfile']['type']     = $_FILES['fotos']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $_FILES['fotos']['tmp_name'][$i];
                $_FILES['userfile']['error']    = $_FILES['fotos']['error'][$i];
                $_FILES['userfile']['size']     = $_FILES['fotos']['size'][$i];

                $config['file_name']        = $_FILES['userfile']['name'];
                $config['allowed_types']    = 'jpg|jpeg';
                $config['max_size']         = 100000;
                $config['overwrite']        = false;
                $config['upload_path']      = $upload_path;

                $this->upload->initialize($config);
                if(!$this->upload->do_upload())
                {
                    $erro = array('erro' => $this->upload->display_errors());
                    foreach($erro as $row)
                    {
                        echo $row;
                    }
                }
                else
                {
                    $exclude = array('../');
                    $dados['caminho_foto'] = str_replace($exclude, "", $config['upload_path']);
                    $dados['caminho_foto'] .= $config['file_name'];

                    if($i == 0)
                    {
                        $dados['capa_galeria'] = $dados['caminho_foto'];
                        $capa_galeria = $this->galerias_model->salva_imagemCapa($dados);
                    }
                    
                    $galeria = $this->galerias_model->salvar_imagens($dados);
                    if($galeria == FALSE)
                    {
                        echo 'Não foi possível salvar a imagem';
                    }
                    else
                    {
                        $verificador = $this->redimensionar_imagem($dados);
                    }
                }
            }
            echo app_baseUrl().'painel#index.php?/opcoes_galerias/index/'.$dados['id_galeria'];
        }
        //**********************************************************************

        /**
         * redimensionar_imagens()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função para redimensionar a imagem que foi feita o upload
         * @access      private
         */
        private function redimensionar_imagem($dados)
        {
            $this->load->library('image_lib');

            $config['image_library']    = 'GD2';
            $config['maintain_ratio']   = FALSE;
            $config['create_thumb']     = FALSE;
            $config['width']            = 640;
            $config['height']           = 480;
            $config['quality']          = "75%";
            $config['source_image']     = '../'.$dados['caminho_foto'];


            $this->image_lib->initialize($config);

            if(!$this->image_lib->resize())
            {
                echo $this->image_lib->display_errors();
            }
            else
            {
                return true;
            }
        }
        //**********************************************************************
    }

    /** End of file opcoes_galerias.php **/
    /** location ./application/controllers/opcoes_galerias.php **/