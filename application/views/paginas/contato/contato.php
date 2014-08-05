<script type="text/javascript">
    /** Carrega o script que faz a impressão de elementos avulsos **/
    loadScript('./js/PrintElement/jquery.printelement.min.js');
    
    /** Variável que define qual a página que estamos lendo no momento **/
    var offset = 0;
    
    /** Define a url da leitura da mensagem **/
    var url_lerMensagem = '';

    /** Load do jQuery **/
    $(document).ready(function(){
        buscar();
    });
    
    $("#entrada, #lidas, #excluidas").click(function() {
        $(".inbox-menu-lg > li").each(function() {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
    });


    $(document).on("click", ".pagination li a", function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        loadAjax(href, $('#mensagens'));
    });

    /**
     * buscar()
     * 
     * Função desenvolvida para buscar as mensagens cadastradas
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     */
    function buscar()
    {
        url = "<?php echo app_baseUrl() . 'contato/contato/buscar_contatos/' ?>"+offset;
        container = $('#mensagens');
        
        loadAjax(url, container);
    }
    //**************************************************************************
    
    /**
     * imprimir()
     * 
     * Função desenvolvida para realizar impressões das mensagens
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @param       {string} Contém o elemento jQuery a ser impresso
     * @example     O elemento será passado na chamada da função desta maneira: $('#meu_elemento')
     */
    function imprimir(elemento)
    {
        elemento.printElement();
    }
    //**************************************************************************

    /** Define um intervalo para busca de mensagens **/
    setInterval(function() {
        buscar();
    }, 300000);
    //**************************************************************************
    
    /** As funções abaixo são relativas ao tamanho do viewport **/
    tableHeightSize();
    
    $(window).resize(function() {
        tableHeightSize();
    });
    
    function tableHeightSize() {
        var tableHeight = $(window).height() - 212;
        $('.table-wrap').css('height', tableHeight + 'px');
    }
    //**************************************************************************
    
    /**
     * excluir_mensagem()
     * 
     * Função desenvolvida para exclusão de uma mensagem
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @return      {bool} Retorna 1 se tiver excluido e 0 se não excluir
     */
    function excluir_mensagem()
    {
        var id_mensagem = $('#id_mensagem').val();
        
        $.SmartMessageBox({
            title: "<i class='fa fa-times txt-color-red'></i> Atenção",
            content: "Deseja excluir esta mensagem? <small>(a ação não pode ser desfeita)</small>",
            buttons: "[Sim][Não]"
        },function(e){
            if(e == "Não")
            {
                return false;
            }
            else
            {
                $.ajax({
                    url: "<?php echo app_baseurl().'contato/contato/excluir_mensagem' ?>",
                    type: "POST",
                    data: {id: id_mensagem},
                    dataType: "html",
                    success:function(sucesso)
                    {
                        if(sucesso == 1)
                        {
                            msg_sucesso('A mensagem foi excluida');
                            buscar();
                        }
                        else
                        {
                            msg_erro('Não foi possível excluir');
                        }
                    },
                    error: function()
                    {
                        msg_erro('Ocorreu um erro. Tente novamente');
                    }
                });
            }
        });
    }
    //**************************************************************************
    
    /**
     * marcar_lida()
     * 
     * Função desenvolvida para marcar uma mensagem como lida
     * 
     * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @param       {int} id_mensagem Contém o ID da mensagem a ser marcada
     */
     function marcar_lida(id_mensagem)
     {
         $.post('<?php echo app_baseurl().'contato/contato/ler'?>', {id: id_mensagem}).fail(function(){
             console.log('Ocorreu um erro ao acessar o recurso');
         });
     }
</script>
<div class="inbox-nav-bar no-content-padding">
    <h1 class="page-title txt-color-blueDark hidden-tablet">
        <i class="fa fa-fw fa-inbox"></i> Mensagens
    </h1>
    <div class="inbox-checkbox-triggered">
        <div class="btn-group">
            <a id="excluir_definitivo" href="javascript:void(0);" rel="tooltip" data-placement="bottom" data-original-title="Apagar Definitivamente" class="deletebutton btn btn-default">
                <strong><i class="fa fa-ban fa-lg"></i></strong>
            </a>
        </div>
    </div>
</div>

<div id="inbox-content" class="inbox-body no-content-padding">
    <!-- Div onde as mensagens serão inseridas via ajax -->
    <div class="table-wrap custom-scroll" id="mensagens"></div>
    <!--*********************************************************************-->
</div>