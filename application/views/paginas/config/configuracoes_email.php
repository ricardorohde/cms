<!-- Div que receberá os valores via ajax -->
<div id="configuracao_email"></div>
<!--*************************************************************************-->

<script type="text/javascript">
	//Url da função que busca os dados do email
    var url = '<?php echo app_baseurl().'config/configuracoes_email/buscar_config'?>';

    //Chamada da função que busca as configurações cadastradas
    buscar();


    /**
     * buscar()
     *
     * Função desenvolvida para buscar as configurações
     */
	function buscar()
	{
		loadAjax(url, $('#configuracao_email'));		
	}
</script>