<script type="text/javascript">
    $(document).ready(function(){
       
    });
</script>
<?php

    if (!isset($usuarios))
    {
        echo '
            <div class="alert alert-success span12">
                <strong>Atenção!</strong> Não existem Usuários cadastrados
            </div>
        ';
    }
    else
    {
?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID do Usuário</th>
                    <th>Nome Completo</th>
                    <th>Nome de Usuário</th>
                    <th>Ações</th>
                    <th>Status</th>
                    <th>Permissões</th>
                </tr>
            </thead>
            <tbody>
<?php
    foreach ($usuarios as $row)
    {
?>
        <tr>
            <td><?php echo $row->id; ?></td>
            <td><?php echo $row->nome_completo; ?></td>
            <td><?php echo $row->nome_usuario; ?></td>
            <td>
                <div align="center">
                    <?php
                        if($row->status == 1)
                        {
                    ?>
                            <a rel="tooltip" data-placement="top" data-original-title="Marcar como Inativo" href="<?php echo $verificador; ?>" id="<?php echo $row->id; ?>" class="inativo">
                                <i class="fam-exclamation"></i>
                            </a>
                    <?php
                        }
                        else
                        {
                    ?>
                            <a rel="tooltip" data-placement="top" data-original-title="Marcar como Ativo" href="<?php echo $verificador; ?>" title="Marcar como Ativo" id="<?php echo $row->id; ?>" class="ativo">
                                <i class="fam-accept"></i>
                            </a>
                    <?php
                        }
                    ?>
					<a rel="tooltip" title="Excluir Usuário" href="<?php echo $verificador; ?>" id="<?php echo $row->id; ?>" class="excluir">
						<i class="fam-cross"></i>
					</a>
                </div>    
            </td>
            <td>
                <div align="center">
                    <?php
                        if($row->status == 1)
                        {
                            echo '<span class="label label-success">Ativo</span>';
                        }
                        else
                        {
                            echo '<span class="label label-warning">Inativo</span>';
                        }
                    ?>
                 </div>
            </td>
            <td>
                <a href="<?php echo app_baseurl().'setar_permissoes/index/'.$row->id?>" onclick="return abrirPopup(this.href, 640, 480)"><i class="fam-wrench"></i> Permissões</a>
            </td>
        </tr>
<?php
        }    
    }
?>
</tbody>
</table>
<?php
    echo $paginacao;
?>

<script>
    function abrirPopup(url,w,h)
    {
        var newW = w + 100;
        var newH = h + 100;
        var left = (screen.width-newW)/2;
        var top = (screen.height-newH)/2;
        var newwindow = window.open(url, 'name', 'width='+newW+',height='+newH+',left='+left+',top='+top);
        //newwindow.resizeTo(newW, newH);
        newwindow.moveTo(left, top);
        newwindow.focus();
        return false;
    }
</script>