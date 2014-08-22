/*-----------------------------------------------------------------------------+
 * AJAX.JS                                                                     |
 +-----------------------------------------------------------------------------+
 *
 * Arquivo desenvolvido para tratar diversas requisições ajax no decorrer da 
 * execução do sistema
 */

/**
 * loadAjax()
 * 
 * Função desenvolvida para buscar as principais páginas do sistema via ajax
 * 
 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @param       {string} url        Contém a url que será carregada
 * @param       {string} container  Contém o elemento DOM que receberá a resposta
 */
function loadAjax(url, container)
{
    if (url == undefined || url == "")
    {
        alert('Erro ao recuperar a url solicitada');
        return false;
    }

    if (container == undefined || container == "")
    {
        alert("Elemento esperado não encontrado");
        return false;
    }

    container.html('<h4><i class="fa fa-cog fa-spin"></i> Carregando...</h4>');
    $.get(url, function(e) {
        container.html(e);
        drawBreadCrumb();
    }).fail(function() {
        container.html('<h4 class="ajax-loading-error"><i class="fa fa-warning txt-color-orangeDark"></i> Erro 404! Arquivo ou página não encontrada.</h4>');
        drawBreadCrumb();
    });
}
//******************************************************************************

/**
 * msg_sucesso()
 * 
 * Função desenvolvida para exibir mensagens de sucesso no sistema
 * 
 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @param       {string} msg Contém a mensagem que será exibida
 */
function msg_sucesso(msg)
{
    $.smallBox({
        title: "<i class='fa fa-check'></i> Sucesso",
        content: "<strong>" + msg + "</strong>",
        iconSmall: "fa fa-thumbs-down bounce animated",
        color: "#5CB811",
        timeout: 5000
    });
}
//******************************************************************************

/**
 * msg_erro()
 * 
 * Função desenvolvida para exibição de mensagens de erro no sistema
 * 
 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @param       {string} msg Contém a mensagem que será exibida
 */
function msg_erro(msg)
{
    $.smallBox({
        title: "<i class='glyphicon glyphicon-remove'></i> Erro",
        content: "<strong>"+ msg +"</strong>",
        color: "#FE1A00",
        iconSmall: "fa fa-thumbs-down bounce animated",
        timeout: 5000
    });
}
//******************************************************************************

/**
 * limpar_campos()
 * 
 * Função desenvolvida para limpar campos de formulários
 * 
 * @author      Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @param       {string} form O nome do formulário que se deseja limpar
 */
function limpar_campos(form)
{
    form.find("input, textarea, radio, select, checkbox").val("");
}
//******************************************************************************

/**
 * abrirPopup()
 * 
 * Função desenvolvida para abrir uma janela popup, geralmente usada para edição
 * de dados
 * 
 * @param {type} url    Contém a url que será aberta
 * @param {type} w      Contém o width da página
 * @param {type} h      Contém o heigth da página
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
//******************************************************************************

/**
 * show_loading()
 * 
 * Função desenvolvida para exibir o elemento Loading
 * 
 * @author	:	Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 */
function show_loading()
{
	$('.carregando').fadeIn('fast');
}
//******************************************************************************

/**
 * hide_loading()
 * 
 * Função desenvolvida para esconder o elemento Loading
 * 
 * @author	:	Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 */
function hide_loading()
{
	$('.carregando').fadeOut('slow');
}