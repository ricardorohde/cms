<link href="./js/wdcalendar/css/dailog.css" rel="stylesheet" type="text/css" />
<link href="./js/wdcalendar/css/calendar.css" rel="stylesheet" type="text/css" />
<link href="./js/wdcalendar/css/dp.css" rel="stylesheet" type="text/css" />
<link href="./js/wdcalendar/css/alert.css" rel="stylesheet" type="text/css" />
<link href="./js/wdcalendar/css/main.css" rel="stylesheet" type="text/css" />

<script src="./js/wdcalendar/src/Plugins/Common.js" type="text/javascript"></script>
<script src="./js/wdcalendar/src/Plugins/datepicker_lang_PT.js" type="text/javascript"></script>
<script src="./js/wdcalendar/src/Plugins/jquery.datepicker.js" type="text/javascript"></script>
<script src="./js/wdcalendar/src/Plugins/jquery.alert.js" type="text/javascript"></script>
<script src="./js/wdcalendar/src/Plugins/jquery.ifrmdailog.js" defer="defer" type="text/javascript"></script>
<script src="./js/wdcalendar/src/Plugins/wdCalendar_lang_PT.js" type="text/javascript"></script>
<script src="./js/wdcalendar/src/Plugins/jquery.calendar.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var view = "month";
        var DATA_FEED_URL = "./js/wdcalendar/php/datafeed.php";
        var op = {
            view: view,
            theme: 3,
            showday: new Date(),
            EditCmdhandler: Edit,
            DeleteCmdhandler: Delete,
            ViewCmdhandler: View,
            onWeekOrMonthToDay: wtd,
            onBeforeRequestData: cal_beforerequest,
            onAfterRequestData: cal_afterrequest,
            onRequestDataError: cal_onerror,
            autoload: true,
            url: DATA_FEED_URL + "?method=list",
            quickAddUrl: DATA_FEED_URL + "?method=add",
            quickUpdateUrl: DATA_FEED_URL + "?method=update",
            quickDeleteUrl: DATA_FEED_URL + "?method=remove"
        };

        var $dv = $("#calhead");
        var _MH = document.documentElement.clientHeight;
        var dvH = $dv.height() + 2;
        op.height = _MH - dvH;
        op.eventItems = [];

        var p = $("#gridcontainer").bcalendar(op).BcalGetOp();
        if (p && p.datestrshow) {
            $("#txtdatetimeshow").text(p.datestrshow);
        }
        $("#caltoolbar").noSelect();

        $("#hdtxtshow").datepicker({picker: "#txtdatetimeshow", showtarget: $("#txtdatetimeshow"),
            onReturn: function(r) {
                var p = $("#gridcontainer").gotoDate(r).BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            }
        });
        function cal_beforerequest(type)
        {
            var t = "Carregando dados...";
            switch (type)
            {
                case 1:
                    t = "Carregando dados...";
                    break;
                case 2:
                case 3:
                case 4:
                    t = "A requisição está sendo processada ...";
                    break;
            }
            $("#errorpannel").hide();
            $("#loadingpannel").html(t).show();
        }
        function cal_afterrequest(type)
        {
            switch (type)
            {
                case 1:
                    $("#loadingpannel").hide();
                    break;
                case 2:
                case 3:
                case 4:
                    $("#loadingpannel").html("Sucesso!");
                    window.setTimeout(function() {
                        $("#loadingpannel").hide();
                    }, 2000);
                    break;
            }

        }
        function cal_onerror(type, data)
        {
            $("#errorpannel").show();
        }
        function Edit(data)
        {
            var eurl = "./js/wdcalendar/edit.php?id={0}&start={2}&end={3}&isallday={4}&title={1}";
            if (data)
            {
                var url = StrFormat(eurl, data);
                OpenModelWindow(url, {width: 600, height: 400, caption: "Gerenciador de Eventos", onclose: function() {
                        $("#gridcontainer").reload();
                    }});
            }
        }
        function View(data)
        {
            var str = "";
            $.each(data, function(i, item) {
                str += "[" + i + "]: " + item + "\n";
            });
            alert(str);
        }
        function Delete(data, callback)
        {

            $.alerts.okButton = "Ok";
            $.alerts.cancelButton = "Cancelar";
            hiConfirm("Deletar este evento", 'Confirm', function(r) {
                r && callback(0);
            });
        }
        function wtd(p)
        {
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);
            }
            $("#caltoolbar div.fcurrent").each(function() {
                $(this).removeClass("fcurrent");
            });
            $("#showdaybtn").addClass("fcurrent");
        }
        //to show day view
        $("#showdaybtn").click(function(e) {
            //document.location.href="#day";
            $("#caltoolbar div.fcurrent").each(function() {
                $(this).removeClass("fcurrent");
            });
            $(this).addClass("fcurrent");
            var p = $("#gridcontainer").swtichView("day").BcalGetOp();
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);
            }
        });
        //to show week view
        $("#showweekbtn").click(function(e) {
            //document.location.href="#week";
            $("#caltoolbar div.fcurrent").each(function() {
                $(this).removeClass("fcurrent");
            });
            $(this).addClass("fcurrent");
            var p = $("#gridcontainer").swtichView("week").BcalGetOp();
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);
            }
        });
        //to show month view
        $("#showmonthbtn").click(function(e) {
            //document.location.href="#month";
            $("#caltoolbar div.fcurrent").each(function() {
                $(this).removeClass("fcurrent");
            });
            $(this).addClass("fcurrent");
            var p = $("#gridcontainer").swtichView("month").BcalGetOp();
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);
            }
        });

        $("#showreflashbtn").click(function(e) {
            $("#gridcontainer").reload();
        });

        //go to today
        $("#showtodaybtn").click(function(e) {
            var p = $("#gridcontainer").gotoDate().BcalGetOp();
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);
            }
        });
        //previous date range
        $("#sfprevbtn").click(function(e) {
            var p = $("#gridcontainer").previousRange().BcalGetOp();
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);
            }
        });
        //next date range
        $("#sfnextbtn").click(function(e) {
            var p = $("#gridcontainer").nextRange().BcalGetOp();
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);
            }
        });
    });
</script>


<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-calendar"></i> Calendário de Eventos
        </h1>
    </div>
</div>
<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12">
            <div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                <header>
                    <span class="widget-icon"> 
                        <i class="fa fa-calendar txt-color-darken"></i> 
                    </span>
                    <h2>Meus Eventos</h2>
                </header>
                <div class="no-padding">
                    <div class="widget-body">
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in no-padding-bottom" id="s1">
                                <div class="row no-space">
                                    <div id="calhead" style="padding-left:1px;padding-right:1px;">        
                                        <div class="cHead">
                                            <div class="ftitle">Calendário de Eventos</div>
                                            <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;">Carregando dados...</div>
                                            <div id="errorpannel" class="ptogtitle loaderror" style="display: none;">Desculpe. Não foi possível carregar os dados. Tente mais tarde</div>
                                        </div>
                                        <div id="caltoolbar" class="ctoolbar">
                                            
                                            <div id="showtodaybtn" class="fbutton">
                                                <div>
                                                    <span title='Clique para voltar para hoje' class="showtoday">Hoje</span>
                                                </div>
                                            </div>
                                            <div class="btnseparator"></div>
                                            <div id="showdaybtn" class="fbutton">
                                                <div>
                                                    <span title='Dia' class="showdayview">Dia</span>
                                                </div>
                                            </div>
                                            <div  id="showweekbtn" class="fbutton">
                                                <div>
                                                    <span title='Semana' class="showweekview">Semana</span>
                                                </div>
                                            </div>
                                            <div  id="showmonthbtn" class="fbutton fcurrent">
                                                <div>
                                                    <span title='Mês' class="showmonthview">Mês</span>
                                                </div>
                                            </div>
                                            <div class="btnseparator"></div>
                                            <div  id="showreflashbtn" class="fbutton">
                                                <div>
                                                    <span title='Atualizar' class="showdayflash">Atualizar</span>
                                                </div>
                                            </div>
                                            <div class="btnseparator"></div>
                                            <div id="sfprevbtn" title="Anterior"  class="fbutton">
                                                <span class="fprev"></span>
                                            </div>
                                            <div id="sfnextbtn" title="Próximo" class="fbutton">
                                                <span class="fnext"></span>
                                            </div>
                                            <div class="fshowdatep fbutton">
                                                <div>
                                                    <input type="hidden" name="txtshow" id="hdtxtshow" />
                                                    <span id="txtdatetimeshow">Carregando</span>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    <div style="padding:1px;">
                                        <div class="t1 chromeColor">&nbsp;</div>
                                        <div class="t2 chromeColor">&nbsp;</div>
                                        <div id="dvCalMain" class="calmain printborder">
                                            <div id="gridcontainer" style="overflow-y: visible;"></div>
                                        </div>
                                        <div class="t2 chromeColor">&nbsp;</div>
                                        <div class="t1 chromeColor">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>