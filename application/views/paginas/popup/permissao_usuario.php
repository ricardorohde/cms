<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("a.retirar_permissao").each(function(e) {
            var id = $(this).attr("id");
            $(":checkbox.adicionar_permissao").each(function(x) {
                var valor = $(this).val();
                if (id == valor)
                {
                    $(this).parent(".checkbox").hide();
                }
            });
        });

        //Função desenvolvida para habilitar ou desabilitar o botão de salvar
        var contarMarcados = function() {
            var n = $("input:checked").length;
            if (n == 0)
            {
                document.getElementById("adicionar").disabled = true;
            }
            else
            {
                document.getElementById("adicionar").disabled = false;
            }
        };
        contarMarcados();
        $("input[type=checkbox]").on("click", contarMarcados);
    });
</script>
<?php
    if(!$permissoes)
    {
        echo '
			<div class="alert alert-warning">
				<h4>Não foram definidas permissões para este usuário</h4>
			</div>
		';
    }
    else
    {
        echo '
			<div class="alert alert-info">
				<h3>Permissões Definidas</h3>
			</div>
		';
        foreach($permissoes as $row)
        {
            if($row->id_menu == 1)
            {
                echo "Página de Contatos <a class='retirar_permissao' id='" . $row->id_menu . "' href='" . app_baseurl() . 'setar_permissoes/retira_permissao/' . $row->id . '/' . $id . "'>Retirar Permissão</a><br />";
            }
            elseif($row->id_menu == 2)
            {
                echo "Página de Notícias <a class='retirar_permissao' id='" . $row->id_menu . "' href='" . app_baseurl() . 'setar_permissoes/retira_permissao/' . $row->id . '/' . $id . "'>Retirar Permissão</a><br />";
            }
            elseif($row->id_menu == 3)
            {
                echo "Página de Vereadores <a class='retirar_permissao' id='" . $row->id_menu . "' href='" . app_baseurl() . 'setar_permissoes/retira_permissao/' . $row->id . '/' . $id . "'>Retirar Permissão</a><br />";
            }
            elseif($row->id_menu == 4)
            {
                echo "Página de Galerias <a class='retirar_permissao' id='" . $row->id_menu . "' href='" . app_baseurl() . 'setar_permissoes/retira_permissao/' . $row->id . '/' . $id . "'>Retirar Permissão</a><br />";
            }
            elseif($row->id_menu == 5)
            {
                echo "Página de Notícias <a class='retirar_permissao' id='" . $row->id_menu . "' href='" . app_baseurl() . 'setar_permissoes/retira_permissao/' . $row->id . '/' . $id . "'>Retirar Permissão</a><br />";
            }
            elseif($row->id_menu == 6)
            {
                echo "Página de Dados da Câmara <a class='retirar_permissao' id='" . $row->id_menu . "' href='" . app_baseurl() . 'setar_permissoes/retira_permissao/' . $row->id . '/' . $id . "'>Retirar Permissão</a><br />";
            }
            elseif($row->id_menu == 7)
            {
                echo "Página de Configurações <a class='retirar_permissao' id='" . $row->id_menu . "' href='" . app_baseurl() . 'setar_permissoes/retira_permissao/' . $row->id . '/' . $id . "'>Retirar Permissão</a><br />";
            }
        }
    }
?>
<h3>Definir Permissões para usuario</h3>
<form name="permissoes" class="form-horizontal" method="post" action="<?php echo app_baseurl() . 'setar_permissoes/salvar_permissao' ?>">
    <?php
        if(!$permissoes)
        {
            echo '
				<label class="checkbox">
					<input class="checkbox" type="checkbox" name="permissao[]" value="1"> Página de Contatos (visualiza as mensagens digitadas no formulário do site)
				</label>
				<label class="checkbox">
					<input type="checkbox" name="permissao[]" value="2"> Página de Notícias (Tem acesso à criação e edição de noticias)
				</label>
				<label class="checkbox">
					<input type="checkbox" name="permissao[]" value="3"> Página de Vereadores (Tem acesso ao cadastro e edição de Vereadores)
				</label>
				<label class="checkbox">
					<input type="checkbox" name="permissao[]" value="4"> Página de Galerias (Tem acesso à criação e edição de galerias)
				</label>
				<label class="checkbox">
					<input type="checkbox" name="permissao[]" value="5"> Página de Dados da Câmara (Tem acesso à criação e edição dos Dados da Câmara)
				</label>
				<label class="checkbox">
					<input type="checkbox" name="permissao[]" value="6"> Página de Usuários (Tem acesso ao cadastro e alteração de usuários)
				</label>
				<label class="checkbox">
					<input type="checkbox" name="permissao[]" value="7"> Página de Configurações (Tem acesso à criação e edição de textos
					para página da  Câmara, cidade, links úteis, imagens do banner e configurações da conta do usuário)
				</label>
			';
        }
        else
        {
            ?>
            <label class="checkbox">
                <input class="adicionar_permissao" type="checkbox" name="permissao[]" value="1"> Página de Contatos (visualiza as mensagens digitadas no formulário do site)
            </label>
            <label class="checkbox">
                <input class="adicionar_permissao" type="checkbox" name="permissao[]" value="2"> Página de Notícias (Tem acesso à criação e edição de noticias)
            </label>
            <label class="checkbox">
                <input class="adicionar_permissao" type="checkbox" name="permissao[]" value="3"> Página de Vereadores (Tem acesso ao cadastro e edição de Vereadores)
            </label>
            <label class="checkbox">
                <input class="adicionar_permissao" type="checkbox" name="permissao[]" value="4"> Página de Galerias (Tem acesso à criação e edição de galerias)
            </label>
            <label class="checkbox">
                <input class="adicionar_permissao" type="checkbox" name="permissao[]" value="5"> Página de Dados da Câmara (Tem acesso à criação e edição dos Dados da Câmara)
            </label>
            <label class="checkbox">
                <input class="adicionar_permissao" type="checkbox" name="permissao[]" value="6"> Página de Usuários (Tem acesso ao cadastro e alteração de usuários)
            </label>
            <label class="checkbox">
                <input class="adicionar_permissao" type="checkbox" name="permissao[]" value="7"> Página de Configurações (Tem acesso à criação e edição de textos
                para página da  Câmara, cidade, links úteis, imagens do banner e configurações da conta do usuário)
            </label>
            <?php
        }
    ?>

    <input type="hidden" name="id_usuario" value="<?php echo $id ?>">
    <br /><br />
    <input class="btn btn-info" id="adicionar" type="submit" name="submit" value="Adicionar as permissões" disabled="disabled">
    <div></div>
</form>