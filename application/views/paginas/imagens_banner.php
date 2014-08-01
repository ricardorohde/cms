<style>
    .thumb {
        height: 105px;
        border: 1px solid #000;
        margin: 10px 5px 0 0;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        
        $("#navigation-configuracoes").addClass('active');
        
        $(document).on("click", ".excluir", function(e){
           e.preventDefault();
           var confirmacao = confirm("deseja realmente Excluir esta foto?");
           if(confirmacao == false)
           {
               return false;
           }
           else
           {
                id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo app_baseurl().'imagens_banner/excluir_banner'?>",
                    type: "POST",
                    data: {id: id},
                    dataType: "html",
                    success: function(sucesso){
                            $("#sucesso").html(
                                    verifica_exclusao(sucesso)
                            );
                   },
                   error: function(erro)
                   {
                       $("#erro").html(
                           notificacao('error', 'Não foi possível excluir')
                       );
                   }
                });
           }
       });
        
    });
    
    function verifica_exclusao(sucesso)
    {
        if(sucesso === 0)
        {
            notificacao('error', 'Não foi possível excluir');
            fecha_notificacao();
        }
        else
        {
            location.href = '<?php echo app_baseurl().'imagens_banner'?>';
        }
    }
    
    /*function buscar(offset)
    {
        $.get("<?php echo app_baseUrl().'imagens_banner/buscar_imagens' ?>", function(b) {
            $("#imagens_atuais").html(b);
        });
    }*/
    
    //setInterval(function(){buscar()}, 60000);
    //window.onload(buscar());
</script>
<div class="row-fluid">
    <div class="span12">
        <h4 class="title">Imagens Do banner</h4>
        <div class="squiggly-border"></div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <?php
            if(!$banner)
            {
                echo 'Nenhuma foto encontrada';
            }
            else
            {
                $verificador = 0;
                foreach ($banner as $row)
                {
        ?>          <a class="excluir" id="<?php echo $row->id?>" href="#">
                        <img class="img-rounded" src="../<?php echo $row->foto?>" width="200" height="200" title="Clique para excluir esta foto">
                    </a>
                    <?php 
                        $verificador++;
                        if($verificador == 5)
                        {
                            echo '<br /><br />';
                        }
                    ?>
        <?php   }
            }
        ?>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <h4 class="title">Adicionar Fotos Banner</h4>
        <div class="squiggly-border"></div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <form id="formNova_galeria" name="nova_galeria" action="<?php echo app_baseurl() . 'imagens_banner/upload' ?>" method="post" enctype="multipart/form-data">
            <input type="file" id="fotos" name="fotos[]" multiple/>
            <input type="submit" value="Fazer upload">
            <br /><br />
        </form>
        <output id="list"></output>
    </div>
</div>
<div id="sucesso"></div>
<div id="erro"></div>

<script type="text/javascript">
    function handleFileSelect(evt)
    {
        var fotos = evt.target.files;
        for (var i = 0, f; f = fotos[i]; i++)
        {
            if (!f.type.match('image.*'))
            {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function(theFile)
            {
                return function(e)
                {
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb img-rounded" src="', e.target.result,
                    '" title="', escape(theFile.name), '"/>'].join('');
                    document.getElementById('list').insertBefore(span, null);
                };
            })(f);
            reader.readAsDataURL(f);
        }
        fecha_notificacao();
    }
    document.getElementById('fotos').addEventListener('change', handleFileSelect, false);
</script>