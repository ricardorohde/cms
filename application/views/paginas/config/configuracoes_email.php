

<!-- Div que receberá os valores via ajax -->
<div id="configuracao_email"></div>
<!--*************************************************************************-->

<script type="text/javascript">
    url = '<?php echo app_baseurl().'config/configuracoes_email/buscar_config'?>';
    
    loadAjax(url, $('#configuracao_email'));
</script>