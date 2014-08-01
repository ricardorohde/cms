<?php
    if(!isset($vereadores))
    {
        echo '
            <div class="alert alert-success span12">
                <strong>Atenção!</strong> Ainda não existes vereadores cadastrados
            </div>
        ';
    }
    else
    {
        foreach ($vereadores as $row)
        {
?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="span10">
                        <div class="span2 hidden-phone">
                            <div class="comment-image thumbnail">
                                <img src="<?php echo $row->foto; ?>" alt="<?php echo $row->nome_vereador ?>">
                            </div>
                        </div>
                        <div class="span8 comment-wrapper">
                            <div class="speech-bubble-left hidden-phone">&nbsp;</div>
                            <div class="comment-text">
                                <p>
                                    <strong>Nome: </strong><?php echo $row->nome_vereador ?><br />
                                    <strong>Partido: </strong><?php echo $row->legenda ?><br />
                                </p>
                            </div>
                            <div class="comment-controls pull-right btn-group">
                                <a class="btn btn-mini" href="<?php echo app_baseurl().'cadastro_vereador/index/'.$row->id ?>">
                                    <span>Editar</span>
                                    <i class="icon icon-pencil"></i>
                                </a>
                                <a href="<?php echo $verificador; ?>" id="<?php echo $row->id; ?>" class="excluir btn btn-mini">
                                    <span>Excluir</span>
                                    <i class="icon icon-ban-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
<?php
        }
        echo $paginacao;
    }
?>