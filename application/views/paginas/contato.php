<script type="text/javascript">
    var offset = 0;
    var pasta = 'entrada';

    $("#entrada, #lidas, #excluidas").click(function() {
        $(".inbox-menu-lg > li").each(function() {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
    });


    $(document).on("click", ".pagination li a", function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        $('#inbox-content > .table-wrap').load(href).fadeIn('slow');
    });

    /*
     
     $(document).on("click", ".lido", function(e) {
     e.preventDefault();
     id = $(this).attr("id");
     pagina = $(this).attr("href");
     $.ajax({
     url: "<?php echo app_baseurl() . 'contato/marcar' ?>",
     type: "POST",
     data: {id: id},
     dataType: "html",
     success: function(sucesso) {
     $("#sucesso").html(
     notificacao('success', sucesso),
     fecha_notificacao(),
     buscar(pagina)
     );
     },
     error: function(erro) {
     $("#erro").html(
     notificacao('error', 'Ocorreu um erro. Tente Mais tarde'),
     fecha_notificacao()
     );
     }
     });
     });*/

    function buscar(pasta)
    {

        $.get("<?php echo app_baseUrl() . 'contato/buscar_contatos/' ?>" + pasta + "/" + offset, function(b) {
            $('#inbox-content > .table-wrap').html(b);
        });
        $("#entrada").addClass('active');
    }

    function buscar_lidas(offset)
    {
        $.get("<?php echo app_baseurl() . 'contato/buscar_lidas/' ?>" + offset, function(lidas) {
            $('#inbox-content > .table-wrap').html(lidas);
        });
    }

    setInterval(function() {
        buscar();
    }, 300000);
    window.onload(buscar());
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
    <div class="table-wrap custom-scroll">
    </div>
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

    //Função que move uma mensagem para a pasta Lidas
    function mover_lidas()
    {

    }

    //Função que move uma mensagem para a pasta Caixa de entrada
    function mover_caixaEntrada()
    {

    }

    //Função desenvolvida para excluir definitivamente uma mensagem
    function excluir_definitivo()
    {

    }

    /*
     * função desenvolvida para voltar para a mensagem, quando se está em 
     * "Responder a mensagem"
     */
    function voltar_mensagem()
    {

    }
</script>