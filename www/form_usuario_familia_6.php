<?
	require("includes/funcoes_layout.php");
	$DOMICILIO = $_REQUEST["DOMICILIO"];
	$PESSOA = $_REQUEST["PESSOA"];
	
	$NOM_PAIS_ORIGEM_PESSOA = "Brasil";
	$NOM_LOCALIDADE_NASC_PESSOA = "Joinville";
	$COD_UF_MUNIC_NASC_PESSOA = "SC";
	
	if(!empty($PESSOA)){
		require("includes/conectar_mysql.php");
		$query = "SELECT COUNT(*) FROM pessoa_2 WHERE PESSOA=" . $PESSOA;
		$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		$qtd = mysql_fetch_row($result);
		if($qtd[0]>0){
			$update = true;
			$query = "SELECT * FROM pessoa_2 WHERE PESSOA=" . $PESSOA;
			$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
			$registro = mysql_fetch_assoc($result);
			$COD_NACIONALIDADE_PESSOA = $registro["COD_NACIONALIDADE_PESSOA"];
			$NOM_PAIS_ORIGEM_PESSOA = $registro["NOM_PAIS_ORIGEM_PESSOA"];
			$DTA_CHEGADA_PAIS_PESSOA = $registro["DTA_CHEGADA_PAIS_PESSOA"];
			$COD_UF_MUNIC_NASC_PESSOA = $registro["COD_UF_MUNIC_NASC_PESSOA"];
			$NOM_LOCALIDADE_NASC_PESSOA = $registro["NOM_LOCALIDADE_NASC_PESSOA"];
			$NOM_COMPLETO_PAI_PESSOA = $registro["NOM_COMPLETO_PAI_PESSOA"];
			$NOM_COMPLETO_MAE_PESSOA = $registro["NOM_COMPLETO_MAE_PESSOA"];
			$COD_PAPEL_PESSOA = $registro["COD_PAPEL_PESSOA"];
			
			$DTA_CHEGADA_PAIS_PESSOA = split("-",$DTA_CHEGADA_PAIS_PESSOA);
			$DTA_CHEGADA_PAIS_PESSOA = $DTA_CHEGADA_PAIS_PESSOA[2] . "/" . $DTA_CHEGADA_PAIS_PESSOA[1] . "/" . $DTA_CHEGADA_PAIS_PESSOA[0];
		}
		$query = "SELECT NOM_PESSOA FROM pessoa_1 WHERE PESSOA=" . $PESSOA;
		$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		$tmp = mysql_fetch_row($result);
		$NOM_PESSOA = $tmp[0];
		require("includes/desconectar_mysql.php");
	}
	
	inicia_pagina();
	monta_menu_abas("operador");
	inicia_tabela_conteudo();
	?>
	<script language="JavaScript" src="includes/calendar1.js"></script>
	<script language="JavaScript" src="includes/data.js"></script>
	<script language="javascript">
		function valida_form(){
			var f = document.forms[0];
			if((f.COD_NACIONALIDADE_PESSOA.value == "2") || (f.COD_NACIONALIDADE_PESSOA.value == "3")){
				if(f.DTA_CHEGADA_PAIS_PESSOA.value == ""){
					alert("Informe a data de chegada ao Brasil.");
					f.DTA_CHEGADA_PAIS_PESSOA.focus();
					return false;
				}
				if(f.NOM_PAIS_ORIGEM_PESSOA.value == ""){
					alert("Informe o nome do país de origem.");
					f.NOM_PAIS_ORIGEM_PESSOA.focus();
					return false;
				}
				if(f.NOM_LOCALIDADE_NASC_PESSOA.value == ""){
					alert("Informe o nome da cidade natal.");
					f.NOM_LOCALIDADE_NASC_PESSOA.focus();
					return false;
				}
			}
			return true;
		}
		function se_nacionalidade(nacionalidade){
			f = document.forms[0];
			if(nacionalidade == '1'){
				f.DTA_CHEGADA_PAIS_PESSOA.disabled = true;
			}
			if(nacionalidade == '2'){
				f.DTA_CHEGADA_PAIS_PESSOA.disabled = false;
			}
			if(nacionalidade == '3'){
				f.DTA_CHEGADA_PAIS_PESSOA.disabled = false;
			}
		}
	</script>
	<table width="100%">
		<tr>
			<td width="50"><a href="form_usuario_familia_4.php?DOMICILIO=<?=$DOMICILIO?>"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<td class="conteudo_quadro_claro" valign="middle" style="padding-top: 12px;"><? monta_titulo_secao("Informa&ccedil;&otilde;es B&aacute;sicas Pessoais"); ?></td>
			<td width="50"></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<form action="salva_usuario_familia_6.php" method="post" onSubmit="return valida_form();">
	<div style="width: 100%; vertical-align: top; text-align:center;">
		<? inicia_quadro_branco('width="80%"', 'Informa&ccedil;&otilde;es B&aacute;sicas de ' . $NOM_PESSOA); ?>
			<table width="100%" border="0" cellpadding="2" cellspacing="3">
				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="label" width="50">Nacionalidade:&nbsp;&nbsp;</td>
								<td width="50">
									<select name="COD_NACIONALIDADE_PESSOA" onChange="se_nacionalidade(this.value);">
										<option value="1"<? if($COD_NACIONALIDADE_PESSOA == "1") echo(" selected"); ?>>Brasileira</option>
										<option value="2"<? if($COD_NACIONALIDADE_PESSOA == "2") echo(" selected"); ?>>Brasileiro Naturalizado</option>
										<option value="3"<? if($COD_NACIONALIDADE_PESSOA == "3") echo(" selected"); ?>>Estrangeira</option>
									</select>
								</td>
								<td class="label" width="170">Data de chegada ao Brasil:&nbsp;&nbsp;</td>
								<td><input type="text" name="DTA_CHEGADA_PAIS_PESSOA" value="<?=$DTA_CHEGADA_PAIS_PESSOA?>" maxlength="10" class="caixa_texto" style="width:100%;" onKeypress="return ajustar_data(this,event);"<? if(!(($COD_NACIONALIDADE_PESSOA == "2") || ($COD_NACIONALIDADE_PESSOA == "3"))) echo(" disabled"); ?>></td>
								<td width="20" align="right"><a tabindex="-1" href="javascript: cal2.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de chegada"></a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="label" width="30">Pais:&nbsp;&nbsp;</td>
								<td><input type="text" name="NOM_PAIS_ORIGEM_PESSOA" value="<?=$NOM_PAIS_ORIGEM_PESSOA?>" maxlength="50" class="caixa_texto" style="width:100%;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="label" width="82">Cidade Natal:&nbsp;&nbsp;</td>
								<td><input type="text" name="NOM_LOCALIDADE_NASC_PESSOA" value="<?=$NOM_LOCALIDADE_NASC_PESSOA?>" maxlength="35" class="caixa_texto" style="width:100%;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="label" width="118">Cod.Cidade (IBGE):&nbsp;&nbsp;</td>
								<td width="300"><input type="text" name="" class="caixa_texto" style="width:100%;"></td>
								<td class="label" width="50">UF:&nbsp;&nbsp;</td>
								<td width="30"><input type="text" name="COD_UF_MUNIC_NASC_PESSOA" value="<?=$COD_UF_MUNIC_NASC_PESSOA?>" maxlength="2" class="caixa_texto" style="width:100%;" onBlur="this.value = this.value.toUpperCase();"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="label" width="105">Filiação Materna:&nbsp;&nbsp;</td>
								<td><input type="text" name="NOM_COMPLETO_MAE_PESSOA" value="<?=$NOM_COMPLETO_MAE_PESSOA?>" maxlength="70" class="caixa_texto" style="width:100%;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="label" width="105">Filiação Paterna:&nbsp;&nbsp;</td>
								<td><input type="text" name="NOM_COMPLETO_PAI_PESSOA" value="<?=$NOM_COMPLETO_PAI_PESSOA?>" maxlength="70" class="caixa_texto" style="width:100%;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="label" width="176">Papel da Pessoa no Domicílio:&nbsp;&nbsp;</td>
								<td>
									<select name="COD_PAPEL_PESSOA">
										<option value="0"<? if($COD_PAPEL_PESSOA == "0") echo(" selected"); ?>>Responsável Legal</option>
										<option value="1"<? if($COD_PAPEL_PESSOA == "1") echo(" selected"); ?>>Mãe</option>
										<option value="2"<? if($COD_PAPEL_PESSOA == "2") echo(" selected"); ?>>Pai</option>
										<option value="3"<? if($COD_PAPEL_PESSOA == "3") echo(" selected"); ?>>Esposo(a)</option>
										<option value="4"<? if($COD_PAPEL_PESSOA == "4") echo(" selected"); ?>>Companheiro(a)</option>
										<option value="5"<? if($COD_PAPEL_PESSOA == "5") echo(" selected"); ?>>Filho(a)</option>
										<option value="6"<? if($COD_PAPEL_PESSOA == "6") echo(" selected"); ?>>Avô/Avó</option>
										<option value="7"<? if($COD_PAPEL_PESSOA == "7") echo(" selected"); ?>>Irmão/Irmã</option>
										<option value="8"<? if($COD_PAPEL_PESSOA == "8") echo(" selected"); ?>>Cunhado(a)</option>
										<option value="9"<? if($COD_PAPEL_PESSOA == "9") echo(" selected"); ?>>Genro/Nora</option>
										<option value="10"<? if($COD_PAPEL_PESSOA == "10") echo(" selected"); ?>>Sobrinho(a)</option>
										<option value="11"<? if($COD_PAPEL_PESSOA == "11") echo(" selected"); ?>>Primo(a)</option>
										<option value="12"<? if($COD_PAPEL_PESSOA == "12") echo(" selected"); ?>>Sogro(a)</option>
										<option value="13"<? if($COD_PAPEL_PESSOA == "13") echo(" selected"); ?>>Neto(a)</option>
										<option value="14"<? if($COD_PAPEL_PESSOA == "14") echo(" selected"); ?>>Tio(a)</option>
										<option value="15"<? if($COD_PAPEL_PESSOA == "15") echo(" selected"); ?>>Adotivo(a)</option>
										<option value="16"<? if($COD_PAPEL_PESSOA == "16") echo(" selected"); ?>>Padastro/Madastra</option>
										<option value="17"<? if($COD_PAPEL_PESSOA == "17") echo(" selected"); ?>>Enteado(a)</option>
										<option value="18"<? if($COD_PAPEL_PESSOA == "18") echo(" selected"); ?>>Bisneto(a)</option>
										<option value="19"<? if($COD_PAPEL_PESSOA == "19") echo(" selected"); ?>>Sem parentesco</option>
										<option value="20"<? if($COD_PAPEL_PESSOA == "20") echo(" selected"); ?>>Outro</option>
									</select>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="right">
						<input type="submit" class="botao_aqua" value="   Salvar   ">
					</td>
				</tr>
					<input type="hidden" name="DOMICILIO" value="<?=$DOMICILIO?>">
					<input type="hidden" name="PESSOA" value="<?=$PESSOA?>">
					<input type="hidden" name="modo" value="<? if($update) echo('update'); else echo('add');?>">
				</form>
			</table>
		<? termina_quadro_branco(); ?>
	</div>
	<script language="javascript">
		document.forms[0].elements[0].focus();
	</script>
	<script language="javascript">
		document.forms[0].elements[0].focus();
		var cal2 = new calendar1(document.forms[0].elements['DTA_CHEGADA_PAIS_PESSOA']);
		cal2.year_scroll = true;
		cal2.time_comp = false;
	</script>
	<? termina_pagina(); ?>
