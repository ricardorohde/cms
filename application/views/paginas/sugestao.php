<script type="text/javascript">
    var offset = 0;
    
    $(document).ready(function(){
        $("#navigation-contato").addClass('active');
        
        $(document).on("click", ".pagination li a", function(e) {
            e.preventDefault();
            var href = $(this).attr("href");
            $("#sugestao").load(href);
        });
        
        $(document).on("click", ".lido", function(e){
            e.preventDefault();
            id = $(this).attr("id");
            pagina = $(this).attr("href");
            $.ajax({
                url: "<?php echo app_baseurl().'sugestao/marcar'?>",
                type: "POST",
                data: {id: id},
                dataType: "html",
                success: function(sucesso){
                    $("#sucesso").html(
                        notificacao('success', sucesso),
                        fecha_notificacao(),
                        buscar(pagina)
                    );
                },
                error: function(erro){
                    $("#erro").html(
                        notificacao('error', 'Ocorreu um erro. Tente Mais tarde'),
                        fecha_notificacao()
                    );
                }
            });
        });
    });
    
    function buscar(offset)
    {
        $.get("<?php echo app_baseUrl().'sugestao/buscar_sugestoes/' ?>" + offset, function(b) {
            $("#sugestao").html(b);
        });
    }
    
    setInterval(function(){buscar()}, 30000);
    window.onload(buscar());
</script>
<div class="row-fluid">
    <div class="span12">
        <h4 class="title">Formulário de Sugestões do Site</h4>
        <div class="squiggly-border"></div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12 comment-wrapper" id="sugestao">
    </div>
</div>
<div id="sucesso"></div>
<div id="erro"></div>