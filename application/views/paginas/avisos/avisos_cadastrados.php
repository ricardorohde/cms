<!-- Header da página -->
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-clipboard"></i> Avisos Cadastrados
        </h1>
    </div>
</div>
<!--*************************************************************************-->


<!-- Widget do conteudo -->
<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12">
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                
                <!-- Header do widget -->
                <header>
                    <span class="widget-icon"> 
                        <i class="fa fa-clipboard txt-color-darken"></i> 
                    </span>
                    <h2>Todos os avisos cadastrados</h2>
                </header>
                <!--*********************************************************-->
                
                <!-- Corpo do widget -->
                <div class="no-padding">
                    <div class="widget-body">
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in no-padding-bottom">
                                <div id="todos_avisos"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--*********************************************************-->
                
            </div>
        </article>
    </div>
</section>
<!--*************************************************************************-->

<script type="text/javascript">
    /** Início do jquery **/
    $(document).ready(function(){
        
        /** Chama a funçao que busca os avisos cadastrados **/
        busca_avisos();
    });
    
    /** Funçao que busca os avisos cadastrados **/
    function busca_avisos()
    {
        $.get('<?php echo app_baseurl().'avisos/avisos_cadastrados/busca_cadastrados'?>', function(e){
            $('#todos_avisos').html(e);
        });
    }
</script>