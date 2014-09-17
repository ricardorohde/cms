<!-- Header da view. Possui botão que chama um modal para cadastro de novas mensagens -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-comments"></i> Depoimentos
        </h1>
    </div>
</div>
<!--*************************************************************************-->
<div class="row">
	<!-- Div onde os depoimentos serão inseridos via ajax -->
	<div id="depoimentos_cadastrados" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
	<!--*********************************************************************-->
</div>
<script type="text/javascript">
	//atribuição de valor à variável que auxiliará na busca dos dados
	var offset = 0;
	
	//Chamada da função que realiza a busca por depoimentos cadastrados
	buscar();

	/**
	 * buscar()
	 *
	 * Função desenvolvida para realizar a busca por depoimentos cadastrados no
	 * banco de dados
	 *
	 * @author	: Matheus Lopes Santos <fale_com_lopez@hotmail.com>
	 * @access	: Public
	 */
	function buscar()
	{
		url = '<?php echo app_baseurl().'depoimentos/buscar/'?>'+ offset;

		loadAjax(url, $('#depoimentos_cadastrados'));
	}
</script>