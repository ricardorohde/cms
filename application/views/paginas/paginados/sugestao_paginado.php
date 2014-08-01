<?php
    if(!isset($sugestoes))
    {
        echo '
            <div class="alert alert-success span12">
                <strong>Atenção!</strong> Não existem mensagens em aberto
            </div>
        ';
    }
    else
    {
        foreach ($sugestoes as $row)
        {
?>
            <div class="speech-bubble-left hidden-phone">&nbsp;</div>
            <div class="comment-text">
                <p>
                    <strong>Nome: </strong><?php echo $row->nome_sugestao?><br />
                    <strong>E-mail: </strong><?php echo $row->email_sugestao?><br />
					<strong>Data de Contato: </strong><?php echo date('d/m/Y h:m', strtotime($row->data))?><br />
                    <strong>Mensagem: </strong><?php echo $row->mensagem_sugestao?>
                </p>
            </div>
            <div class="comment-controls pull-right btn-group">
				<?php
					if(isset($row->email_sugestao))
					{
				?>
						<a class="btn btn-mini email" href="<?php echo app_baseUrl().'enviar_email/index/sugestao/'.$row->id?>">
							<span>Enviar um email</span>
							<i class="fam-email"></i>
						</a>
				<?php	
					}
				?>
                <a class="btn btn-mini lido" href="<?php echo $verificador; ?>" id="<?php echo $row->id; ?>">
                    <span>Marcar como Lida</span>
                    <i class="fam-email-open"></i>
                </a>
            </div>
            <br /><br />
            <div class="squiggly-border"></div>
<?php
        }
        
        echo $paginacao;
    }
?>