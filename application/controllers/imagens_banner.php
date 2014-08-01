<?php
    class Imagens_banner extends MY_Controller
    {
        /*
         * Construção da classe
         */
        public function __construct($requer_autenticacao = TRUE)
        {
            parent::__construct($requer_autenticacao);
            $this->dados['nome'] = $_SESSION['user']->nome_completo;
            $this->load->model('menu_principal');
            $this->load->model('banner_model');
        }
        //----------------------------------------------------------------------
        
        /*
         * Função principal do controller
         */
        function index()
        {
            $this->menu = $this->menu_principal->montar_menu($_SESSION['user']->id);
            $this->view = 'imagens_banner';
            $this->titulo = 'Imagens do Banner Principal';
            
            $this->dados['banner'] = $this->banner_model->busca_banner();

            $this->LoadView();
        }
        //----------------------------------------------------------------------
        
        /*
         * Função utilizada para excluir uma foto
         */
        function excluir_banner()
        {
            $id = $this->input->post('id');
            
            $verifica = $this->banner_model->excluir($id);
            if($verifica == 0)
            {
                echo $verifica;
            }
            else
            {
                echo 1;
            }
        }
        //----------------------------------------------------------------------

        /*
         * Função para salvar uma nova imagem de banner
         */
        function upload()        
        {
            $upload_path = '../img/fotos_cidade';
            if(!is_dir($upload_path))
            {
                mkdir($upload_path, 0777);
            }
            
            $this->load->library('upload');
            $arquivos = count($_FILES['fotos']['name']);
            
            for($i = 0; $i < $arquivos; $i++)
            {
                $_FILES['userfile']['name'] = $_FILES['fotos']['name'][$i];
                $_FILES['userfile']['type'] = $_FILES['fotos']['type'][$i];                
                $_FILES['userfile']['tmp_name'] = $_FILES['fotos']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $_FILES['fotos']['error'][$i];
                $_FILES['userfile']['size'] = $_FILES['fotos']['size'][$i];
                
                $config['file_name'] = $_FILES['userfile']['name'];
                $config['allowed_types'] = 'jpg|jpeg';
                $config['max_size'] = 10000;
                $config['overwrite'] = false;
                $config['upload_path'] = $upload_path.'/';
                
                $this->upload->initialize($config);
                if ( ! $this->upload->do_upload())
                {
                    $erro = array('erro' => $this->upload->display_errors());
                    foreach ($erro as $row)
                    {
                        echo $row;
                    }
                }
                else
                {
                    $exclude = array('../');
                    $dados['caminho_foto'] = str_replace($exclude, "", $config['upload_path']);
                    $dados['caminho_foto'] .= $config['file_name'];
                    
                    $banner = $this->banner_model->salvar($dados);
                    if($banner == 0)
                    {
                        echo 'Não foi possível salvar a imagem';
                    }
                    else
                    {   
                        $verificador = $this->redimensionar_imagem($dados);
                        if($verificador != true)
                        {
                            echo 'Erro no processamento da imagem';
                        }
                    }
                }

            }
            redirect(app_baseurl().'imagens_banner');
        }
        //----------------------------------------------------------------------
        
        /*
         * Função para redimensionar a imagem
         */
        function redimensionar_imagem($dados)
        {
            $this->load->library('image_lib');
            
            $config['image_library'] = 'GD2';
            $config['maintain_ratio'] = FALSE;
            $config['heigth'] = 400;
            $config['create_thumb'] = false;
            $config['quality'] = "80%";
            $config['source_image'] = '../'.$dados['caminho_foto'];
            
            
            $this->image_lib->initialize($config);
            
            if (!$this->image_lib->resize())
            {
                echo $this->image_lib->display_errors();
            }
            else
            {
                return true;
            }
        }
        //----------------------------------------------------------------------
        
        
    }
?>
