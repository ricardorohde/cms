<?php
    if(!isset($contatos) || $contatos == NULL)
    {
        ?>
        <div class="alert alert-block alert-info">
        	<h4 class="alert-heading"><strong>:)</strong></h4>
            <p>Não existem mensagens cadastradas</p>
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
    offset = <?php echo $verificador; ?>

    $("#inbox-table input[type='checkbox']").change(function() {
        $(this).closest('tr').toggleClass("highlight", this.checked);
    });

    $(".deletebutton").click(function() {
        var valor = Array();
        $(":checked").each(function() {
            valor.push($(this).val());
        });
        $.SmartMessageBox({
            title: "<i class='fa fa-times txt-color-red'></i> Atenção",
            content: "Deseja excluir estas mensagens? <small>(a ação não pode ser desfeita)</small>",
            buttons: "[Sim][Não]"
        }, function(e) {
            if (e == "Sim")
            {
                $.ajax({
                    url: "<?php echo app_baseurl().'contato/contato/excluir_mensagem' ?>",
                    type: "POST",
                    cache: false,
                    data: {id: valor},
                    dataType: "html",
                    success: function(sucesso) {
                        if(sucesso == 1)
                        {
                            msg_sucesso('Mensagens excluidas');
                            buscar();
                            contarMarcados();
                        }
                        else
                        {
                            msg_erro('Não foi possível excluir');
                        }
                    },
                    error: function()
                    {
                        msg_erro('Ocorreu um erro. tente novamente');
                    }
                });
            }
            else
            {
                return false;
            }
        });
    });

    /** Função desenvolvida para verificar se existem checkbox marcadas **/
    function contarMarcados() {
        var n = $("input:checked").length;
        if (n === 0)
        {
            $("#excluir_definitivo").addClass('disabled');
        }
        else
        {
            $("#excluir_definitivo").removeClass('disabled');
        }
    }
    //**************************************************************************
    contarMarcados();
    $("input[type=checkbox]").on("click", contarMarcados);

    /**
     * Função desenvolvida para que o administrador do sistema possa ler as 
     * mensagens que foram enviadas
     **/
    $("#inbox-table .inbox-data-message, #inbox-table .inbox-data-from").click(function() {
        id_mensagem = $(this).data('valor');
        
        url_lerMensagem = "<?php echo app_baseUrl() . 'contato/contato/verificar_mensagem/' ?>" + id_mensagem;
        
        marcar_lida(id_mensagem);
        loadAjax(url_lerMensagem, $('#mensagens'));
    });
</script>