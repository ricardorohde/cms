<?php
    if ($temas == NULL)
    {
        ?>
        <div class="alert alert-block alert-info">
            <h4 class="alert-heading">
                Atenção
            </h4>
            <p>
                Você ainda não cadastrou nenhum tema para o site.
            </p>
        </div>
        <?php
    }
    else
    {
        ?>
        <section id="widget-grid">
            <div class="row">
                <article class="col-sm-12">
                    <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                        <header>
                            <span class="widget-icon">
                                <i class="fa fa-desktop txt-color-darken"></i>
                            </span>
                            <h2>Temas do Site</h2>
                        </header>
                        <div class="no-padding">
                            <div class="widget-body">
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade active in no-padding-bottom">
                                        <div class="row no-space">
                                            <table class="table table-condensed table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Cor</th>
                                                        <th>Data Inicial</th>
                                                        <th>Data Final</th>
                                                        <th>Imagem</th>
                                                        <th>Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($temas as $row)
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $row->id; ?>
                                                            </td>
                                                            <td style="background-color: <?php echo $row->cor_principal; ?>">
                                                            </td>
                                                            <td>
                                                                <?php echo date('d/m/Y', strtotime($row->data_inicio)); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo date('d/m/Y', strtotime($row->data_expiracao)); ?>
                                                            </td>
                                                            <td>
                                                                <a href="#" rel="tooltip" data-original-title="<img width='180' src='<?php echo $row->imagem_banner; ?>'>" data-html="true">
                                                                    <?php echo $row->imagem_banner; ?>
                                                            </td>
                                                            <td>
                                                                <a href="<?php echo app_baseurl() . 'temas/editar_tema/' . $row->id ?>" rel="tooltip" title="Alterar" onclick="return abrirPopup(this.href, 640, 480)">
                                                                    <i class="fam-pencil"></i>
                                                                </a>
                                                                <a class="excluir" href="#" rel="tooltip" title="Excluir" data-id="<?php echo $row->id; ?>">
                                                                    <i class="fam-cross"></i>
                                                                </a>
                                                                <?php
                                                                if ($row->status == 1)
                                                                {
                                                                    ?>
                                                                    <a class="marcar" href="#" rel="tooltip" title="Inativar" data-id='<?php echo $row->id ?>' data-status='<?php echo $row->status ?>'>
                                                                        <i class="fam-exclamation"></i>
                                                                    </a>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <a class="marcar" href="#" rel="tooltip" title="Ativar" data-id='<?php echo $row->id ?>' data-status='<?php echo $row->status ?>'>
                                                                        <i class="fam-accept"></i>
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
        <?php
    }
?>
<script type="text/javascript">
    /*
     * Função global do sistema
     */
    pageSetUp();

    /*
     * Função desenvolvida para excluir um tema
     */
    $(".excluir").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        alertify.confirm("Deseja excluir este tema? Esta ação não pode ser desfeita", function(click) {
            if (click)
            {
                $.ajax({
                    url: "<?php echo app_baseurl() . 'temas/excluir_tema' ?>",
                    type: "POST",
                    data: {id: id},
                    dataType: "html",
                    success: function(sucesso)
                    {
                        if (sucesso == 1)
                        {
                            $.smallBox({
                                title: "<i class='fa fa-check'></i> Sucesso",
                                content: "<strong>O tema foi excluído.</strong>",
                                iconSmall: "fa fa-thumbs-up bounce animated",
                                color: "#5CB811",
                                timeout: 5000
                            });
                            buscar_temas();
                        }
                        else
                        {
                            $.smallBox({
                                title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                                content: "<strong>Não foi possível remover o novo tema.</strong>",
                                color: "#FE1A00",
                                iconSmall: "fa fa-thumbs-down bounce animated",
                                timeout: 5000
                            });
                        }
                    },
                    error: function()
                    {
                        $.smallBox({
                            title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                            content: "<strong>Ocorreu um erro. Tente novamente</strong>",
                            color: "#FE1A00",
                            iconSmall: "fa fa-thumbs-down bounce animated",
                            timeout: 5000
                        });
                    }
                });
            }
        });
    });

    /*
     * Função desenvolvida para abrir a janela popup que será usada na edução do
     * tema
     */
    function abrirPopup(url, w, h)
    {
        var newW = w + 100;
        var newH = h + 100;
        var left = (screen.width - newW) / 2;
        var top = (screen.height - newH) / 2;
        var newwindow = window.open(url, 'name', 'width=' + newW + ',height=' + newH + ',left=' + left + ',top=' + top);
        newwindow.resizeTo(newW, newH);
        newwindow.moveTo(left, top);
        newwindow.focus();
        return false;
    }

    /*
     * Função desenvolvida para desativar uma função
     */
    $(".marcar").click(function(e) {
        e.preventDefault();
        tipo = $(this).data('status');
        id = $(this).data('id');
        $.ajax({
            url: "<?php echo app_baseurl() . 'temas/marcar' ?>",
            type: "POST",
            data: {tipo: tipo, id: id},
            dataType: "html",
            success: function(sucesso)
            {
                if (sucesso == 1)
                {
                    $.smallBox({
                        title: "<i class='fa fa-check'></i> Sucesso",
                        content: "<strong>Modificação de status realizada.</strong>",
                        iconSmall: "fa fa-thumbs-up bounce animated",
                        color: "#5CB811",
                        timeout: 5000
                    });
                    buscar_temas();
                }
                else
                {
                    $.smallBox({
                        title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                        content: "<strong>Não foi possível modificar o status.</strong>",
                        color: "#FE1A00",
                        iconSmall: "fa fa-thumbs-down bounce animated",
                        timeout: 5000
                    });
                }
            },
            error: function()
            {
                $.smallBox({
                    title: "<i class='glyphicon glyphicon-remove'></i> Erro",
                    content: "<strong>Ocorreu um erro. Tente novamente</strong>",
                    color: "#FE1A00",
                    iconSmall: "fa fa-thumbs-down bounce animated",
                    timeout: 5000
                });
            }
        });
    });
</script>