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
    if(url == undefined || url == "")
    {
        alert('Erro ao recuperar a url solicitada');
        return false;
    }
    
    if(container == undefined || container == "")
    {
        alert("Elemento esperado não encontrado");
        return false;
    }
    
    container.html('<h4><i class="fa fa-cog fa-spin"></i> Carregando...</h4>');
    $.get(url, function(e){
        container.html(e);
        drawBreadCrumb();
    }).fail(function(){
        container.html('<h4 class="ajax-loading-error"><i class="fa fa-warning txt-color-orangeDark"></i> Erro 404! Arquivo ou página não encontrada.</h4>');
        drawBreadCrumb();
    });
}
//******************************************************************************