<link href="js/fancybox/jquery.fancybox.css" rel="stylesheet" media="all" />
<script src="js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="js/fancybox/jquery.fancybox.js" type="text/javascript"></script>

<script>
    $(document).ready(function(){
        $('.iframe-btn').fancybox({
                width: '900px',
                height: '600px',
                type: 'iframe',
                autoScale: true
            });
    });
</script>

<?php
    if(!$banner || $banner == 0)
    { 
?>
        <h4>Nenhuma Galeria Cadastrada</h4>
        <form class="form-horizontal" method="post" action="<?php echo app_baseurl().'imagens_banner/salvar_banner'?>">
            <div class='control-group'>
                <label class="control-label">1ª Foto</label>
                <div class='controls'>
                    <div class="input-append">
                        <input type="text" id="foto1" name="foto[]">
                        <a id="busca_foto" class="btn iframe-btn" href="js/tiny/plugins/filemanager/dialog.php?type=1&fldr=fotos_cidade&editor=mce_0&field_id=foto1&lang=pt_br">Buscar Foto</a>
                    </div>
                </div>
            </div>
            <div class='control-group'>
                <label class="control-label">2ª Foto</label>
                <div class='controls'>
                    <div class="input-append">
                        <input type="text" id="foto2" name="foto[]">
                        <a id="busca_foto" class="btn iframe-btn" href="js/tiny/plugins/filemanager/dialog.php?type=1&fldr=fotos_cidade&editor=mce_0&field_id=foto2&lang=pt_br">Buscar Foto</a>
                    </div>
                </div>
            </div>
            <div class='control-group'>
                <label class="control-label">3ª Foto</label>
                <div class='controls'>
                    <div class="input-append">
                        <input type="text" id="foto3" name="foto[]">
                        <a id="busca_foto" class="btn iframe-btn" href="js/tiny/plugins/filemanager/dialog.php?type=1&fldr=fotos_cidade&editor=mce_0&field_id=foto3&lang=pt_br">Buscar Foto</a>
                    </div>
                </div>
            </div>
            <div class='control-group'>
                <label class="control-label">4ª Foto</label>
                <div class='controls'>
                    <div class="input-append">
                        <input type="text" id="foto4" name="foto[]">
                        <a id="busca_foto" class="btn iframe-btn" href="js/tiny/plugins/filemanager/dialog.php?type=1&fldr=fotos_cidade&editor=mce_0&field_id=foto4&lang=pt_br">Buscar Foto</a>
                    </div>
                </div>
            </div>
            <div class='control-group'>
                <div class='controls'>
                    <button class="btn btn-success" type="submit">Salvar</button>
                </div>
            </div>
        </form>
<?php 

    }
    else
    { 
?>
            <form class="form-horizontal" method="post" action="<?php echo app_baseurl().'imagens_banner/atualiza_banner'?>">
<?php
        $verificador = 1;
        foreach ($banner as $row)
        {      
?>
            <img class="img-rounded" width="200" height="200" src="<?php echo $row->foto; ?>">
            <div class='control-group'>
                <label><?php echo $verificador?>ª Foto</label>
                <div>
                    <div class="input-append">
                        <input type="hidden" name="id_foto[]" value="<?php echo $row->id?>">
                        <input type="text" id="foto<?php echo $verificador?>" name="foto[]" value="<?php echo $row->foto?>">
                        <a id="busca_foto" class="btn iframe-btn" href="js/tiny/plugins/filemanager/dialog.php?type=1&fldr=fotos_cidade&editor=mce_0&field_id=foto<?php echo $verificador?>&lang=pt_br">Trocar Foto</a>
                    </div>
                </div>
            </div>
            
<?php
        $verificador++;
        }
?>
                <div class='control-group'>
                    <div class='controls'>
                        <button class="btn btn-success" type="submit">Atualizar Galeria</button>
                    </div>
                </div>
            </form>
<?php
    }
?>