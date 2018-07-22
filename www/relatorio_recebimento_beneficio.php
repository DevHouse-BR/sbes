<?
	require("includes/funcoes_layout.php");
	
	require("includes/conectar_mysql.php");
	
	/*$DOMICILIO = $_REQUEST["DOMICILIO"];
	$PESSOA = $_REQUEST["PESSOA"];
	
		
	if(strlen($PESSOA)>0){
		$query = "SELECT NOM_PESSOA, NUM_CPF_PESSOA FROM pessoa_1 WHERE PESSOA=" . $PESSOA;
		$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		$registro = mysql_fetch_assoc($result);
		$info_pessoa = "Nome:&nbsp;" . $registro["NOM_PESSOA"] . "&nbsp;&nbsp;&nbsp;CPF:&nbsp;" . $registro["NUM_CPF_PESSOA"];
	}
	else{
		$query = "SELECT * FROM domicilio_1 WHERE DOMICILIO=" . $DOMICILIO;
		$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		$registro = mysql_fetch_assoc($result);
		$COD_DOMICILIAR = $registro["COD_DOMICILIAR"];
	}*/
	
	
	inicia_pagina();
	if($_SESSION["assistente_social"] == "s") monta_menu_abas("assistente");
	elseif($_SESSION["secretario"] == "s") monta_menu_abas("secretario");
	inicia_tabela_conteudo();
	?>
	<script language="JavaScript" src="includes/calendar1.js"></script>
	<script language="JavaScript" src="includes/data.js"></script>
	<table width="100%">
		<tr>
			<td width="50"><a href="home.php"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<? /* if(strlen($PESSOA)>0){ ?>
				<td class="conteudo"><? monta_titulo_secao($info_pessoa); ?></td>
			<? }
			else { ?>
			<td class="conteudo"><? monta_titulo_secao("Código&nbsp;Domiciliar:&nbsp;" . $COD_DOMICILIAR); ?></td>
			<? } */ ?>
			<td></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<div>
		<? inicia_quadro_escuro('width="100%"', 'Relatório de Benefícios'); ?>
			<form action="gera_relatorio_recebimento_beneficio.php" method="post" target="_blank" onSubmit="return valida_form();">
			<table width="100%" cellspacing="6" border="0">
				<tr>
					<td valign="top" colspan="2">
						<fieldset>
							<legend class="conteudo_quadro_branco">Intervalo de Datas</legend>
							<table border="0">
								<tr>
									<td class="label">De:</td>
									<td><input type="text" name="de" value="<? if(strlen(trim($_REQUEST["de"]))>0) echo($_REQUEST["de"]); else echo("01/01/1900"); ?>" size="20" class="caixa_texto" onKeypress="return ajustar_data(this,event);"></td>
									<td><a tabindex="-1" href="javascript: cal1.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de início"></a></td>
									<td>&nbsp;&nbsp;&nbsp;</td>
									<td class="label">Até:</td>
									<td><input type="text" name="ate" value="<? if(strlen(trim($_REQUEST["ate"]))>0) echo($_REQUEST["de"]); else echo("01/01/9999"); ?>" size="20" class="caixa_texto" onKeypress="return ajustar_data(this,event);"></td>
									<td><a tabindex="-1" href="javascript: cal2.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de término"></a></td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td valign="top" colspan="2">
						<fieldset>
							<legend class="conteudo_quadro_branco">Filtros</legend>
							<table width="100%" border="0">
								<tr>
									<td width="75%" align="left">
										<select multiple class="caixa_texto_gr" style="width:100%; height: 100px;" name="filtros[]">
										</select>
										<a href="Javascript: remove_filtro();" class="link_remove"><img border="0" id="img_menos" src="imagens/menos_out.gif" onMouseOver="this.src='imagens/menos_over.gif';" onMouseOut="this.src='imagens/menos_out.gif';"></a>&nbsp;<a href="Javascript: remove_filtro();" class="link_remove" onMouseOver="img_menos.src='imagens/menos_over.gif';" onMouseOut="img_menos.src='imagens/menos_out.gif';">Remove os filtros selecionados</a></td>
									</td>
									<td valign="top">
										<table width="100%">
											<tr>
												<td width="12"><a href="Javascript: adiciona_filtro(1);" class="link_relatorio"><img border="0" id="img_domicilios" src="imagens/mais_out.gif" onMouseOver="this.src='imagens/mais_over.gif';" onMouseOut="this.src='imagens/mais_out.gif';"></a></td>
												<td><a href="Javascript: adiciona_filtro(1);" class="link_relatorio" onMouseOver="img_domicilios.src='imagens/mais_over.gif';" onMouseOut="img_domicilios.src='imagens/mais_out.gif';">Domicílios</a></td>
											</tr>
											<tr>
												<td><a href="Javascript: adiciona_filtro(2);" class="link_relatorio"><img border="0" id="img_usuarios" src="imagens/mais_out.gif" onMouseOver="this.src='imagens/mais_over.gif';" onMouseOut="this.src='imagens/mais_out.gif';"></a></td>
												<td><a href="Javascript: adiciona_filtro(2);" class="link_relatorio" onMouseOver="img_usuarios.src='imagens/mais_over.gif';" onMouseOut="img_usuarios.src='imagens/mais_out.gif';">Usuários</a></td>
											</tr>
											<tr>
												<td><a href="Javascript: adiciona_filtro(3);" class="link_relatorio"><img border="0" id="img_bairros" src="imagens/mais_out.gif" onMouseOver="this.src='imagens/mais_over.gif';" onMouseOut="this.src='imagens/mais_out.gif';"></a></td>
												<td><a href="Javascript: adiciona_filtro(3);" class="link_relatorio" onMouseOver="img_bairros.src='imagens/mais_over.gif';" onMouseOut="img_bairros.src='imagens/mais_out.gif';">Bairros</a></td>
											</tr>
											<tr>
												<td><a href="Javascript: adiciona_filtro(4);" class="link_relatorio"><img border="0" id="img_sistema" src="imagens/mais_out.gif" onMouseOver="this.src='imagens/mais_over.gif';" onMouseOut="this.src='imagens/mais_out.gif';"></a></td>
												<td><a href="Javascript: adiciona_filtro(4);" class="link_relatorio" onMouseOver="img_sistema.src='imagens/mais_over.gif';" onMouseOut="img_sistema.src='imagens/mais_out.gif';">Usuários do Sistema</a></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td width="80%">
						<fieldset>
							<legend class="conteudo_quadro_branco">Classificação</legend>
							<select class="caixa_texto_gr" style="width:100%; height: 100px;" name="classificacao">
								<option value="domicilios">Domicilios</option>
								<option value="usuarios">Usuários</option>
								<option value="bairros">Bairros</option>
								<option value="usuarios_sistema">Usuários do Sistema</option>
							</select>
						</fieldset>
					</td>
					<td width="20%">
						<fieldset>
							<legend class="conteudo_quadro_branco">Finalizar</legend>
							<input type="submit" value="Gerar Relatório" class="botao_aqua">
						</fieldset>
					</td>
				</tr>
			</table>
			</form>
		<? termina_quadro_escuro(); ?>
	</div>
	<script language="javascript">
		document.forms[0].elements[0].focus();
		var cal1 = new calendar1(document.forms[0].elements['de']);
		cal1.year_scroll = true;
		cal1.time_comp = false;
		var cal2 = new calendar1(document.forms[0].elements['ate']);
		cal2.year_scroll = true;
		cal2.time_comp = false;
		
		function adiciona_filtro(filtro){
			switch (filtro){
				case 1:
					void window.open('zoom_domicilios.php', '_blank', 'width=360,height=390,status=no,resizable=yes,top=20,left=460');
					break;
				case 2:
					void window.open('zoom_pessoas.php', '_blank', 'width=360,height=390,status=no,resizable=yes,top=20,left=460');
					break;
				case 3:
					void window.open('zoom_bairros.php', '_blank', 'width=360,height=390,status=no,resizable=yes,top=20,left=460');
					break;
				case 4:
					void window.open('zoom_usuario_sistema.php?modo=relatorio', '_blank', 'width=360,height=390,status=no,resizable=yes,top=20,left=460');
					break;
			}
		}
		function remove_filtro(){
			var f = document.forms[0];
			var filtros = document.forms[0].elements['filtros[]'];
			for(var i = 0; i < filtros.options.length; i++){
				if(filtros.options[i].selected){
					filtros.options.remove(i);
					i = -1;
				}
			}
		}
		function valida_form(){
			var f = document.forms[0];
			var filtros = document.forms[0].elements['filtros[]'];
			for(var i = 0; i < filtros.options.length; i++){
				filtros.options[i].selected = true;
			}
			return true;
		}
	</script>
	<? termina_pagina();
	require("includes/desconectar_mysql.php");
	?>
