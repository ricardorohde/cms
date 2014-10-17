<script type="text/javascript">
    /** Carrega o script que faz a impressão de elementos avulsos **/
    loadScript('./js/PrintElement/jquery.printelement.min.js');
    
    /** Variável que define qual a página que estamos lendo no momento **/
    var offset = 0;
    
    /** Define a url da leitura da mensagem **/
    var url_lerMensagem = '';

    /** Chama a Função de busca de mensagens cadastradas **/
    buscar();
    
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
     //*************************************************************************

     $("#excluir_definitivo").click(function(e) {
         e.preventDefault();

         var valor = Array();
         
         $(":checked").each(function() {
             valor.push($(this).val());
         });

         alertify.confirm('Deseja excluir estas mensagens?', function(e){
             if(e)
             {
            	 $.ajax({
                     url: "<?php echo app_baseurl().'contato/contato/excluir_mensagem' ?>",
                     type: "POST",
                     data: {id: valor},
                     dataType: "html",
                     success: function(sucesso)
                     {
                         if(sucesso == 1)
                         {
                             msg_sucesso('Mensagens excluidas');
                             buscar();
                             contarMarcados();
                         }
                         else
                         {
                             msg_erro('Não foi possível excluir');
                         }
                     }
                 });
             }
         });
     });
</script>
<div class="inbox-nav-bar no-content-padding">
    <h1 class="page-title txt-color-blueDark hidden-tablet">
        <i class="fa fa-fw fa-inbox"></i> Mensagens
    </h1>
    <div class="inbox-checkbox-triggered">
        <div class="btn-group">
            <a id="excluir_definitivo" href="javascript:void(0);" rel="tooltip" data-placement="bottom" data-original-title="Apagar Definitivamente" class="btn btn-default">
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