<script type="text/javascript">
    
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

    function buscar()
    {
        url = "<?php echo app_baseUrl() . 'contato/contato/buscar_contatos/' ?>"+offset;
        container = $('#mensagens');
        
        loadAjax(url, container);
    }
    //**************************************************************************
    
    function imprimir(elemento)
    {
        elemento.printElement();
    }
    //**************************************************************************

    setInterval(function() {
        buscar();
    }, 300000);
</script>
<div class="inbox-nav-bar no-content-padding">
    <h1 class="page-title txt-color-blueDark hidden-tablet">
        <i class="fa fa-fw fa-inbox"></i> Mensagens
    </h1>
    <div class="inbox-checkbox-triggered">
        <div class="btn-group">
            <a id="excluir_definitivo" href="javascript:void(0);" rel="tooltip" data-placement="bottom" data-original-title="Apagar Definitivamente" class="deletebutton btn btn-default"><strong><i class="fa fa-ban fa-lg"></i></strong></a>
            <a id="mover_lidas" href="javascript:void(0);" rel="tooltip" data-placement="bottom" data-original-title="Mover p/ lidas" class="deletebutton btn btn-default"><strong><i class="fa fa-eye fa-lg"></i></strong></a>
        </div>
    </div>
</div>

<div id="inbox-content" class="inbox-body no-content-padding">
    <!-- Div onde as mensagens serão inseridas via ajax -->
    <div class="table-wrap custom-scroll" id="mensagens"></div>
    <!--*********************************************************************-->
</div>

<script type="text/javascript">
    tableHeightSize();
    
    $(window).resize(function() {
        tableHeightSize();
    });
    
    function tableHeightSize() {
        var tableHeight = $(window).height() - 212;
        $('.table-wrap').css('height', tableHeight + 'px');
    }
</script>