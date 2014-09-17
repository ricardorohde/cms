<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-fw fa-user"></i> Edição de Diretor
        </h1>
    </div>
</div>
<?php
	if(!$diretor)
	{
		?>
		<div class="alert alert-block alert-danger">
            <h4 class="alert-heading">:(</h4>
            <p>
                Não foi possível resgatar o aviso
            </p>
        </div>
		<?php
	}
	else
	{
		?>
		<section id="widget-grid" class="">
			<div class="row">
				<article class="col-sm-12 col-md-12 col-lg-12">
					<div class="jarviswidget jarviswidget-color-darken">
						<header>
                            <span class="widget-icon">
                                <i class="fa fa-user"></i>
                            </span>
                            <h2>Editar um diretor cadastrado</h2>
                        </header>
                        <div>
                        	<div class="widget-body no-padding">
                        		<?php
                        			foreach($diretor as $row)
                        			{
										?>
										<form id="atualizar_diretor" class="smart-form">
											<input type="hidden" id="id" value="<?php echo $row->id?>">
											<input type="hidden" id="id_diretoria" value="<?php echo $row->id_diretoria?>">
						                    <fieldset>
						                        <section>
						                            <div class="row">
						                                <div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
						                                    <label class="input">
						                                        <input id="nome_diretor" type="text" placeholder="Nome do diretor" required value="<?php echo $row->nome_diretor ?>">
						                                    </label>
						                                </div>
						                            </div>
						                        </section>
						
						                        <section>
						                            <div class="row">
						                                <div class="col col-md-6 col-lg-6 col-sm-6 col-xs-6">
						                                    <label class="label">
						                                    </label>
						                                    <label class="select">
						                                        <select id="select_diretoria" required>
						                                            <option>Selecione uma diretoria</option>
						                                        </select>
						                                    </label>
						                                </div>
						                                <div class="col col-md-6 col-lg-6 col-sm-6 col-xs-6">
						                                    <label class="label">
						                                    </label>
						                                    <label class="input">
						                                        <input id="cargo" type="text" class="form-control" placeholder="Cargo" required="" value="<?php echo $row->cargo?>">
						                                    </label>
						                                </div>
						                            </div>
						                        </section>
						
						                        <section>
						                            <div class="row">
						                                <div class="col col-md-12 col-lg-12 col-sm-12 col-xs-12">
						                                    <label class="input">
						                                        <a class="iframe-btn" href="./js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=fotografia&lang=pt_BR&fldr=diretores">
						                                            <i class="icon-append fa fa-picture-o"></i>
						                                        </a>
						                                        <input id="fotografia" type="text" class="form-control" placeholder="Clique ao lado p/ escolher a fotografia..." required="" value="<?php echo $row->foto?>">
						                                    </label>
						                                </div>
						                            </div>
						                        </section>
						                    </fieldset>
						
						                    <footer>
						                        <button type="submit" class="btn btn-default">
						                            <i class="fam-disk"></i> 
						                            Atualizar diretor
						                        </button>
						                        <button onclick="window.close()" type="button" class="btn btn-default">
						                            <i class="fam-cross"></i> 
						                            Cancelar
						                        </button>
						                    </footer>
						                </form>
										<?php
									}
                        		?>
                        	</div>
                        </div>
					</div>
				</article>
			</div>
		</section>
		<?php
	}
?>
<script src="./js/app.js"></script>
<script src="./js/ajax.js"></script>
<script src="./js/libs/jquery-ui-1.10.3.min.js"></script>
<script src="./js/bootstrap/bootstrap.min.js"></script>
<script src="./js/notification/SmartNotification.min.js"></script>
<script src="./js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
<script src="./js/blockUI.js"></script>
<script src="./js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="./js/fancybox/jquery.fancybox.js" type="text/javascript"></script>
<script src="./js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script type="text/javascript">
	//Chamada da função que preenche a combobox com as diretorias
	busca_diretorias();
	
	/**
	 * Script desenvolvido para abrir a fancybox com o gerenciador de arquivos
	 */
	$('.iframe-btn').fancybox({
	    'height': 800,
	    'width': 900,
	    'type': 'iframe',
	    'autoScale': false,
	    'autoSize': false
	});
	
	/** 
	 * buscar_diretorias()
	 * 
	 * Função dsenvolvida para buscar as diretorias cadastradas
	 *
	 * @author	:	Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access	:	Public
	 */
	function busca_diretorias()
	{
	    $.get('<?php echo app_baseurl() . 'diretoria/diretores/diretorias_combo' ?>', function(e) {
	    	$('#select_diretoria').html(e);
	    }).done(function(){
		    $('#select_diretoria').find('option').each(function(){
			    if($(this).val() == $('#id_diretoria').val())
			    {
					$(this).prop('selected', true);
				}
			});
		});
	}
	//**************************************************************************

	//Função desenvolvida para atualizar os dados do diretor
	$('#atualizar_diretor').submit(function(e){
		e.preventDefault();

		id				= $('#id').val();
		nome_diretor	= $('#nome_diretor').val();
		id_diretoria	= $('#select_diretoria').val();
		cargo			= $('#cargo').val();
		foto			= $('#fotografia').val();

		$.ajax({
			url: '<?php echo app_baseurl().'diretoria/diretores/atualizar'?>',
			type: 'POST',
			data: {id: id, nome_diretor: nome_diretor, id_diretoria: id_diretoria, cargo: cargo, foto: foto},
			dataType: 'html',
			success: function(e)
			{
				if(e == 1)
				{
					msg_sucesso('Diretor atualizado');
					window.opener.busca_diretores(id_diretoria);
					setTimeout(function() {window.close();}, 1000);
				}
				else
				{
					msr_erro('Não foi possível atualizar, Tente novamente');
				}
			}
		});
	});
</script>