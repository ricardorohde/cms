<!-- Header da página -->
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-clipboard"></i> Avisos Cadastrados
        </h1>
    </div>
</div>
<!--*************************************************************************-->

<!-- Div que receberá o conteúdo via ajax -->
<div id="todos_avisos"></div>
<!--*************************************************************************-->

<script type="text/javascript">
    
    /** Define esta variável como global **/
    var offset = '';
    
    /** Início do jquery **/
    $(document).ready(function(){
        
        /** Chama a funçao que busca os avisos cadastrados **/
        busca_avisos();
    });
    
    /**
     * busca_avisos()
     * 
     * Funçao que busca os avisos cadastrados
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     */
    function busca_avisos()
    {
        url = '<?php echo app_baseurl().'avisos/avisos_cadastrados/busca_cadastrados/'?>'+offset;
        
        loadAjax(url, $('#todos_avisos'));
    }
    //**************************************************************************
    
    /**
     * Função que previne o evento padrão da paginação e faz o load do mesmo via
     * ajax
     */
    $(document).on("click", ".pagination li a", function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        loadAjax(href, $('#todos_avisos'));
    });
    
    /**
     * excluir()
     * 
     * Função desenvolvida para exclusão de um aviso
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @param       {int} id Contém o ID da mensagem que será apagada
     */
    function excluir(id)
    {   
        $.SmartMessageBox({
            title: "<i class='fa fa-times txt-color-red'></i> Atenção",
            content: "Você está prestes a apagar um aviso. Deseja continuar?",
            buttons: "[Sim][Não]"
        }, function(e){
            if(e == "Não")
            {
                return false;
            }
            else
            {
                $.post('<?php echo app_baseurl().'avisos/avisos_cadastrados/apagar_aviso'?>', {id: id}, function(e){
                    if(e == 1)
                    {
                        busca_avisos();
                        msg_sucesso('Aviso excluido');
                    }
                    else
                    {
                        msg_erro('Não foi possível excluir. Tente novamente');
                    }
                }).fail(function(){
                    msg_erro('Ocorreu um erro. Tente novamente');
                });
            }
        });
    }
    //**************************************************************************
    
    /**
     * inativar()
     * 
     * Função desenvolvida para inativar avisos
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @param       {int} id Contém o ID do aviso que será inativado
     */
     function inativar(id)
     {
        $.post('<?php echo app_baseurl().'avisos/avisos_cadastrados/inativar_aviso'?>', {id: id}, function(e){
            if(e == 1)
            {
                busca_avisos();
                msg_sucesso('Aviso Inativado');
            }
            else
            {
                msg_erro('Não foi possível inativar. Tente novamente');
            }
        }).fail(function(){
            msg_erro('Ocorreu um erro. Tente novamente');
        });
     }
     //*************************************************************************
     
     /**
     * ativar()
     * 
     * Função desenvolvida para ativar avisos
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @param       {int} id Contém o ID do aviso que será ativado
     */
     function ativar(id)
     {
        $.post('<?php echo app_baseurl().'avisos/avisos_cadastrados/ativar_aviso'?>', {id: id}, function(e){
            if(e == 1)
            {
                busca_avisos();
                msg_sucesso('Aviso ativado');
            }
            else
            {
                msg_erro('Não foi possível ativar. Tente novamente');
            }
        }).fail(function(){
            msg_erro('Ocorreu um erro. Tente novamente');
        });
     }
</script>