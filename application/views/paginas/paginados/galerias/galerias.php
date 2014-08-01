<?php
    if(!$galerias)
    {
        echo "Não há galerias cadastradas";
    }
    else
    {
        foreach ($galerias as $row)
        { 
?>         
            <div class="noticia-imagem">
                <a href="index.php?/painel#index.php?/galerias/opcoes_galerias/index/<?php echo $row->id; ?>">
                    <img class="img-rounded" src="../<?php echo $row->capa_galeria ;?>" width="200" alt="<?php echo $row->nome_galeria?>" title="<?php echo $row->nome_galeria?>">
                </a>
                <div class="noticia-caption">
                    <small><?php echo $row->nome_galeria?></small>
                </div>
            </div>
<?php 
        
        }
    }
?>