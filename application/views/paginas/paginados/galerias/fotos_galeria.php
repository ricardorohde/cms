<?php
    if (!$fotos)
    {
        echo 'Nenhuma foto encontrada';
    } else
    {
        $verificador = 0;
        foreach ($fotos as $row)
        {
            ?>
            <a class="excluir" id="<?php echo $row->id ?>" href="<?php echo $row->id_galeria ?>">
                <img class="noticia-imagem" src="../<?php echo $row->caminho_foto ?>" title="Clique para excluir esta foto">
            </a>
            <?php
        }
    }
?>