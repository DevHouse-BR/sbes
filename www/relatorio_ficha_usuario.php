<?
	require("includes/funcoes_layout.php");
	
	$DOMICILIO = $_REQUEST["DOMICILIO"];
	$PESSOA = $_REQUEST["PESSOA"];
	
	inicia_pagina();
	monta_menu_abas("operador");
	inicia_tabela_conteudo();
	
	if($_REQUEST["DOMICILIO_BASICO"] == "on") carrega_vetor_domicilio_basico();
	if($_REQUEST["DOMICILIO_SE"] == "on") carrega_vetor_domicilio_se();
	if(($_REQUEST["DOMICILIO_BASICO"] == "on") || ($_REQUEST["DOMICILIO_SE"] == "on")) {
		carrega_labels_domicilio();
		if(strlen($DOMICILIO)>0) informacoes_domicilio($DOMICILIO);
	}
	if(strlen($PESSOA) > 0){ ?>
		<script language="javascript">
			function valida_form(){
				var f = document.forms[0];
				if((f.PESSOA_BASICO.checked) || (f.PESSOA_SE.checked)) return true;
				else{
					alert("Escolha ao menos um tipo de informação para o relatório.");
					return false;
				}
			}
		</script>
	<?
	}
	else { ?>
		<script language="javascript">
			function valida_form(){
				var f = document.forms[0];
				if((f.DOMICILIO_BASICO.checked) || (f.DOMICILIO_SE.checked)) return true;
				else{
					alert("Escolha ao menos um tipo de informação para o relatório.");
					return false;
				}
			}
		</script>
	<? } ?>
	<table width="100%">
		<tr>
			<td width="50"><a href="busca_usuario_familia.php?modo=relatorio_ficha_usuario"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<td class="conteudo_quadro_claro" valign="middle" style="padding-top: 12px;"><? monta_titulo_secao("Relatório de Ficha de Usuário"); ?></td>
			<td width="50"></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<form action="gera_relatorio_ficha_usuario.php" target="_blank" method="post" onSubmit="return valida_form();">
	<table width="100%">
		<tr>
			<? if(strlen($PESSOA) == 0){ ?>
				<td width="50%">
					<fieldset>
						<legend class="conteudo_quadro_branco"><b>Domicílio</b></legend>
						<table width="100%">
							<tr>
								<td width="10"><input type="checkbox" name="DOMICILIO_BASICO"<? if($_REQUEST["DOMICILIO_BASICO"] == "on") echo(" checked"); ?>></td>
								<td class="label" style="text-align:left;">Informações Básicas</td>
								<td width="10"><input type="checkbox" name="DOMICILIO_SE"<? if($_REQUEST["DOMICILIO_SE"] == "on") echo(" checked"); ?>></td>
								<td class="label" style="text-align:left;">Informações Sócio-Econômicas</td>
							</tr>
						</table>
					</fieldset>
				</td>
				<td width="50%">
					<fieldset>
						<legend class="conteudo_quadro_branco"><b>Pessoas do Domicílio</b></legend>
						<table width="100%">
							<tr>
								<td width="10"><input type="checkbox" name="DOMICILIO_PESSOA_BASICO"<? if($_REQUEST["PESSOA_BASICO"] == "on") echo(" checked"); ?>></td>
								<td class="label" style="text-align:left;">Informações Básicas</td>
								<td width="10"><input type="checkbox" name="DOMICILIO_PESSOA_SE"<? if($_REQUEST["PESSOA_SE"] == "on") echo(" checked"); ?>></td>
								<td class="label" style="text-align:left;">Informações Sócio-Econômicas</td>
							</tr>
						</table>
					</fieldset>
				</td>
			<? 	}
			else{ ?>
				<td width="50%">
					<fieldset>
						<legend class="conteudo_quadro_branco"><b>Pessoa</b></legend>
						<table width="100%">
							<tr>
								<td width="10"><input type="checkbox" name="PESSOA_BASICO"<? if($_REQUEST["PESSOA_BASICO"] == "on") echo(" checked"); ?>></td>
								<td class="label" style="text-align:left;">Informações Básicas</td>
								<td width="10"><input type="checkbox" name="PESSOA_SE"<? if($_REQUEST["PESSOA_SE"] == "on") echo(" checked"); ?>></td>
								<td class="label" style="text-align:left;">Informações Sócio-Econômicas</td>
							</tr>
						</table>
					</fieldset>
				</td>
			<? } ?>
		</tr>
		<tr>
			<td><input class="botao_aqua" type="submit" value="Emitir Relatório"></td>
			<td align="right"></td>
		</tr>
	</table>
		<input type="hidden" name="PESSOA" value="<?=$PESSOA?>">
		<input type="hidden" name="DOMICILIO" value="<?=$DOMICILIO?>">
	</form>
<?
termina_pagina();
?>
