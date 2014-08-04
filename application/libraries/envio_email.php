<?php

    /**
     * envio_email.php
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @abstract    Classe desenvolvida para chamar e inicializar a classe 
     *              PHPMailer
     */
    class Envio_email {
        
        /**
         * load_mailer()
         * 
         * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
         * @abstract    Função desenvolvida para chamar a classe PHPMailer
         * @return      Retorna uma instância da classe chamada
         */
        function load_mailer()
        {
            $CI = & get_instance();
            
            include_once APPPATH.'/third_party/phpmailer/PHPMailerAutoload.php';
            
            return new PHPMailer();
        }
        //**********************************************************************
    }
    /** End of File email.php **/
    /** Location ./application/libraries/email.php **/