<script src="js/tiny/tinymce.min.js" type="text/javascript"></script>
<script>
    $("#navigation-configuracoes").addClass('active');
    tinymce.init({ 
        selector: "textarea.edit",
        convert_urls: false,
        language: "pt_BR",
        content_css: "css/bootstrap_twitter.css, css/pentaurea.css",
        theme: "modern", 
        width: 780, 
        height: 300, 
        filemanager_title: "MasterAdmin - Gerenciador de Arquivos", 
        plugins: [ "advlist autolink link image lists charmap print preview hr anchor pagebreak", "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", "table contextmenu directionality emoticons paste textcolor filemanager" ], 
        image_advtab: true,
        toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code" 
    });
</script>
<div class="row-fluid">
    <div class="span12">
        <h4 class="title">Texto - Página "A Cidade"</h4>
        <div class="squiggly-border"></div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
            <?php
                if(!$texto_links)
                { ?>
                    <form name="salvar_textoLinks" method='post' action="<?php echo app_baseurl().'links/salvar_links'; ?>">
                        <textarea class="edit" name="corpo_links"></textarea>
                        <button id="salvar" class="btn-primary" type="submit">Salvar</button>
                    </form>
                <?php }
                else
                {
                    foreach($texto_links as $row)
                    { ?>
                        <form name="salvar_textoLinks" method='post' action="<?php echo app_baseurl().'links/update_links'; ?>">
                            <input type="hidden" name="id_texto" value="<?php echo $row->id?>">
                            <textarea class="edit" name="corpo_links"><?php echo $row->texto_descricao?></textarea>
                            <button id="salvar" class="btn-primary" type="submit">Salvar</button>
                        </form>
                   <?php }
                }
            ?>
    </div>
</div>