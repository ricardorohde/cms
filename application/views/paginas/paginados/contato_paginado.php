<?php
    if(!isset($contatos))
    {
        ?>
        <div class="alert alert-success">
            <strong>Atenção!</strong> Não existem mensagens em aberto
        </div>
        <?php
    }
    else
    {
        ?>
        <table id="inbox-table" class="table table-striped table-hover">
            <tbody>
                <?php
                foreach($contatos as $row)
                {
                    ?>
                    <tr class="<?php if($row->status == 1){echo 'unread';} ?> ler">
                        <td class="inbox-table-icon">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="checar" class="checkbox style-2" value="<?php echo $row->id; ?>" />
                                    <span></span>
                                </label>
                            </div>
                        </td>
                        <td class="inbox-data-from hidden-xs hidden-sm" data-valor="<?php echo $row->id?>">
                            <div>
                                <?php echo $row->nome_contato; ?>
                            </div>
                        </td>
                        <td class="inbox-data-message" data-valor="<?php echo $row->id?>">
                            <div>
                                <span>

                                    <?php
                                    if($row->situacao_contato == 'socio')
                                    {
                                        echo '<span class="label bg-color-teal">Sócio</span>';
                                    }
                                    else
                                    {
                                        echo '<span class="label bg-color-orange">Não sócio</span>';
                                    }
                                    ?>
                                </span>
                                <?php echo substr($row->mensagem_contato, 0, 40) . '...' ?>
                            </div>
                        </td>
                        <td class="inbox-data-date hidden-xs">
                            <div>
                                <small><?php echo date('d/m/Y h:m', strtotime($row->data)); ?></small>
                            </div>
                        </td>
                    </tr>
            <?php
        }
        ?>
            </tbody>
        </table>
        <?php
        echo $paginacao;
    }
?>
<script>
    var offset = <?php echo $verificador; ?>

    $("#inbox-table input[type='checkbox']").change(function() {
        $(this).closest('tr').toggleClass("highlight", this.checked);
    });

    $(".deletebutton").click(function() {
        var valor = Array();
        $(":checked").each(function() {
            valor.push($(this).val());
        });
        $.SmartMessageBox({
            title: "<i class='fa fa-warning txt-color-orangeDark'></i> Deseja realmente excluir?",
            content: 'Esta ação não poderá ser desfeita',
            buttons: '[Não][Sim]'
        }, function(confirmar) {
            if (confirmar == "Sim")
            {
                $.ajax({
                    url: "<?php echo app_baseurl().'contato/teste' ?>",
                    type: "POST",
                    cache: false,
                    data: {valor: valor},
                    dataType: "html",
                    success: function(sucesso) {
                        alert(sucesso);
                    }
                });
                $('#inbox-table td input:checkbox:checked').parents("tr").rowslide();
            }
        });
    });

    var contarMarcados = function() {
        var n = $("input:checked").length;
        if (n === 0)
        {
            $("#excluir_definitivo").addClass('disabled');
            $("#mover_lidas").addClass('disabled');
            $("#mover_excluidas").addClass('disabled');
        }
        else
        {
            $("#excluir_definitivo").removeClass('disabled');
            $("#mover_lidas").removeClass('disabled');
            $("#mover_excluidas").removeClass('disabled');
        }
    };
    contarMarcados();
    $("input[type=checkbox]").on("click", contarMarcados);

    $("#inbox-table .inbox-data-message, #inbox-table .inbox-data-from").click(function() {
        id_mensagem = $(this).data('valor');
        $.get("<?php echo app_baseUrl() . 'contato/verificar_mensagem/' ?>" + id_mensagem, function(b) {
            $('#inbox-content > .table-wrap').html(b);
        });
    });
</script>