<?
	require("includes/funcoes_layout.php");
	$DOMICILIO = $_REQUEST["DOMICILIO"];
	$PESSOA = $_REQUEST["PESSOA"];
	
	if(!empty($PESSOA)){
		require("includes/conectar_mysql.php");
		$query = "SELECT COUNT(*) FROM pessoa_3 WHERE PESSOA=" . $PESSOA;
		$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		$qtd = mysql_fetch_row($result);
		if($qtd[0]>0){
			$update = true;
			$query = "SELECT p1.NOM_PESSOA, p2.COD_QUALIF_ESCOLAR_PESSOA, p2.COD_GRAU_INSTRUCAO_PESSOA, p2.NUM_SERIE_ESCOLAR_PESSOA, p2.NOM_ESCOLA_PESSOA, p2.COD_CENSO_INEP_PESSOA, p2.SIT_MERCADO_TRAB_PESSOA, p2.NOM_EMPRESA_TRAB_PESSOA, p2.NUM_CNPJ_EMPRESA_PESSOA, p2.DTA_ADMIS_EMPRESA_PESSOA, p2.NOM_OCUPACAO_EMPRESA_PESSOA, p2.VAL_REMUNER_EMPREGO_PESSOA, p2.VAL_RENDA_APOSENT_PESSOA, p2.VAL_RENDA_SEGURO_DESEMP_PESSOA, p2.VAL_RENDA_PENSAO_ALIMEN_PESSOA, p2.VAL_OUTRAS_RENDAS_PESSOA FROM pessoa_1 p1, pessoa_3 p2 WHERE p1.PESSOA=p2.PESSOA AND p1.PESSOA=" . $PESSOA;
			$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
			$registro = mysql_fetch_assoc($result);
			$NOM_PESSOA = $registro["NOM_PESSOA"];
			$COD_QUALIF_ESCOLAR_PESSOA = $registro["COD_QUALIF_ESCOLAR_PESSOA"];
			$COD_GRAU_INSTRUCAO_PESSOA = $registro["COD_GRAU_INSTRUCAO_PESSOA"];
			$NUM_SERIE_ESCOLAR_PESSOA = $registro["NUM_SERIE_ESCOLAR_PESSOA"];
			$NOM_ESCOLA_PESSOA = $registro["NOM_ESCOLA_PESSOA"];
			$COD_CENSO_INEP_PESSOA = $registro["COD_CENSO_INEP_PESSOA"];
			$SIT_MERCADO_TRAB_PESSOA = $registro["SIT_MERCADO_TRAB_PESSOA"];
			$NOM_EMPRESA_TRAB_PESSOA = $registro["NOM_EMPRESA_TRAB_PESSOA"];
			$NUM_CNPJ_EMPRESA_PESSOA = $registro["NUM_CNPJ_EMPRESA_PESSOA"];
			$DTA_ADMIS_EMPRESA_PESSOA = $registro["DTA_ADMIS_EMPRESA_PESSOA"];
			$NOM_OCUPACAO_EMPRESA_PESSOA = $registro["NOM_OCUPACAO_EMPRESA_PESSOA"];
			$VAL_REMUNER_EMPREGO_PESSOA = $registro["VAL_REMUNER_EMPREGO_PESSOA"];
			$VAL_RENDA_APOSENT_PESSOA = $registro["VAL_RENDA_APOSENT_PESSOA"];
			$VAL_RENDA_SEGURO_DESEMP_PESSOA = $registro["VAL_RENDA_SEGURO_DESEMP_PESSOA"];
			$VAL_RENDA_PENSAO_ALIMEN_PESSOA = $registro["VAL_RENDA_PENSAO_ALIMEN_PESSOA"];
			$VAL_OUTRAS_RENDAS_PESSOA = $registro["VAL_OUTRAS_RENDAS_PESSOA"];
			
			$DTA_ADMIS_EMPRESA_PESSOA = split("-",$DTA_ADMIS_EMPRESA_PESSOA);
			$DTA_ADMIS_EMPRESA_PESSOA = $DTA_ADMIS_EMPRESA_PESSOA[2] . "/" . $DTA_ADMIS_EMPRESA_PESSOA[1] . "/" . $DTA_ADMIS_EMPRESA_PESSOA[0];
		}
		else{
			$query = "SELECT NOM_PESSOA FROM pessoa_1 WHERE PESSOA=" . $PESSOA;
			$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
			$tmp = mysql_fetch_row($result);
			$NOM_PESSOA = $tmp[0];
		}
		require("includes/desconectar_mysql.php");
	}
	
	inicia_pagina();
	monta_menu_abas("operador");
	inicia_tabela_conteudo();
	?>
	<script language="JavaScript" src="includes/calendar1.js"></script>
	<script language="JavaScript" src="includes/data.js"></script>
	<table width="100%">
		<tr>
			<td width="50"><a href="form_usuario_familia_9.php?DOMICILIO=<?=$DOMICILIO?>&PESSOA=<?=$PESSOA?>"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<td class="conteudo_quadro_claro" valign="middle" style="padding-top: 12px;"><? monta_titulo_secao("Qualificação Escolar/Profissional"); ?></td>
			<td width="50"></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<form action="salva_usuario_familia_7.php" method="post">
	<div style="width: 100%; vertical-align: top; text-align:center;">
		<? inicia_quadro_branco('width="80%"', 'Qualificação Escolar/Profissional de ' . $NOM_PESSOA); ?>
			<table width="100%" border="0" cellpadding="2" cellspacing="3">
				<tr>
					<td>
						<fieldset>
							<legend class="conteudo_quadro_branco">Qualificação Escolar</legend>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="112">Frequenta Escola:&nbsp;&nbsp;</td>
									<td align="left">
										<select name="COD_QUALIF_ESCOLAR_PESSOA">
											<option value="1"<? if($COD_QUALIF_ESCOLAR_PESSOA == "1") echo(' selected');?>>Pública Municipal</option>
											<option value="2"<? if($COD_QUALIF_ESCOLAR_PESSOA == "2") echo(' selected');?>>Pública Estadual</option>
											<option value="3"<? if($COD_QUALIF_ESCOLAR_PESSOA == "3") echo(' selected');?>>Pública Federal</option>
											<option value="4"<? if($COD_QUALIF_ESCOLAR_PESSOA == "4") echo(' selected');?>>Particular</option>
											<option value="5"<? if($COD_QUALIF_ESCOLAR_PESSOA == "5") echo(' selected');?>>Outra</option>
											<option value="6"<? if($COD_QUALIF_ESCOLAR_PESSOA == "6") echo(' selected');?>>Não Frequenta</option>
											<option value="7"<? if($COD_QUALIF_ESCOLAR_PESSOA == "7") echo(' selected');?>>Sala de Recurso</option>
										</select>
									</td>
									<td class="label" width="86">Série:&nbsp;&nbsp;</td>
									<td>
										<select name="NUM_SERIE_ESCOLAR_PESSOA">
											<option value="1"<? if($NUM_SERIE_ESCOLAR_PESSOA == "1") echo(' selected');?>>Maternal I</option>
											<option value="2"<? if($NUM_SERIE_ESCOLAR_PESSOA == "2") echo(' selected');?>>Maternal II</option>
											<option value="3"<? if($NUM_SERIE_ESCOLAR_PESSOA == "3") echo(' selected');?>>Maternal III</option>
											<option value="4"<? if($NUM_SERIE_ESCOLAR_PESSOA == "4") echo(' selected');?>>Jardim I</option>
											<option value="5"<? if($NUM_SERIE_ESCOLAR_PESSOA == "5") echo(' selected');?>>Jardim II</option>
											<option value="6"<? if($NUM_SERIE_ESCOLAR_PESSOA == "6") echo(' selected');?>>Jardim III</option>
											<option value="7"<? if($NUM_SERIE_ESCOLAR_PESSOA == "7") echo(' selected');?>>CA Alfabetização</option>
											<option value="8"<? if($NUM_SERIE_ESCOLAR_PESSOA == "8") echo(' selected');?>>1&ordf; série do ensino fundamental</option>
											<option value="9"<? if($NUM_SERIE_ESCOLAR_PESSOA == "9") echo(' selected');?>>2&ordf; série do ensino fundamental</option>
											<option value="10"<? if($NUM_SERIE_ESCOLAR_PESSOA == "10") echo(' selected');?>>3&ordf; série do ensino fundamental</option>
											<option value="11"<? if($NUM_SERIE_ESCOLAR_PESSOA == "11") echo(' selected');?>>4&ordf; série do ensino fundamental</option>
											<option value="12"<? if($NUM_SERIE_ESCOLAR_PESSOA == "12") echo(' selected');?>>5&ordf; série do ensino fundamental</option>
											<option value="13"<? if($NUM_SERIE_ESCOLAR_PESSOA == "13") echo(' selected');?>>6&ordf; série do ensino fundamental</option>
											<option value="14"<? if($NUM_SERIE_ESCOLAR_PESSOA == "14") echo(' selected');?>>7&ordf; série do ensino fundamental</option>
											<option value="15"<? if($NUM_SERIE_ESCOLAR_PESSOA == "15") echo(' selected');?>>8&ordf; série do ensino fundamental</option>
											<option value="16"<? if($NUM_SERIE_ESCOLAR_PESSOA == "16") echo(' selected');?>>1&ordf; série do ensino médio</option>
											<option value="17"<? if($NUM_SERIE_ESCOLAR_PESSOA == "17") echo(' selected');?>>2&ordf; série do ensino médio</option>
											<option value="18"<? if($NUM_SERIE_ESCOLAR_PESSOA == "18") echo(' selected');?>>3&ordf; série do ensino médio</option>
										</select>
									</td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="114">Grau de Instrução:&nbsp;&nbsp;</td>
									<td align="left">
										<select name="" style="width:356px;">
											<option value="1"<? if($COD_GRAU_INSTRUCAO_PESSOA == "1") echo(' selected');?>>Analfabeto</option>
											<option value="2"<? if($COD_GRAU_INSTRUCAO_PESSOA == "2") echo(' selected');?>>Até 4ª série</option>
											<option value="3"<? if($COD_GRAU_INSTRUCAO_PESSOA == "3") echo(' selected');?>>Com 4ª série completa do ensino fundamental</option>
											<option value="4"<? if($COD_GRAU_INSTRUCAO_PESSOA == "4") echo(' selected');?>>De 5ª a 8ª série incompleta do ensino fundamental</option>
											<option value="5"<? if($COD_GRAU_INSTRUCAO_PESSOA == "5") echo(' selected');?>>Ensino fundamental completo</option>
											<option value="6"<? if($COD_GRAU_INSTRUCAO_PESSOA == "6") echo(' selected');?>>Ensino médio incompleto</option>
										</select>
									</td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="100">Nome da Escola:&nbsp;&nbsp;</td>
									<td><input type="text" name="NOM_ESCOLA_PESSOA" value="<?=$NOM_ESCOLA_PESSOA?>" maxlength="115" class="caixa_texto" style="width:100%;"></td>
									<td class="label" width="128">Código Censo INEP:&nbsp;&nbsp;</td>
									<td width="60"><input type="text" name="COD_CENSO_INEP_PESSOA" value="<?=$COD_CENSO_INEP_PESSOA?>" maxlength="8" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<fieldset>
							<legend class="conteudo_quadro_branco">Qualificação Profissional</legend>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="200">Situação no mercado de Trabalho:&nbsp;&nbsp;</td>
									<td align="left">
										<select name="SIT_MERCADO_TRAB_PESSOA" style="width:270px;">
											<option value="1"<? if($SIT_MERCADO_TRAB_PESSOA == "1") echo(' selected');?>>Empregador</option>
											<option value="2"<? if($SIT_MERCADO_TRAB_PESSOA == "2") echo(' selected');?>>Assalariado com carteira de trabalho</option>
											<option value="3"<? if($SIT_MERCADO_TRAB_PESSOA == "3") echo(' selected');?>>Assalariado sem carteira de trabalho</option>
											<option value="4"<? if($SIT_MERCADO_TRAB_PESSOA == "4") echo(' selected');?>>Autônomo com previdência social</option>
											<option value="5"<? if($SIT_MERCADO_TRAB_PESSOA == "5") echo(' selected');?>>Autônomo sem previdência social</option>
											<option value="6"<? if($SIT_MERCADO_TRAB_PESSOA == "6") echo(' selected');?>>Aposentado/Pensionista</option>
											<option value="7"<? if($SIT_MERCADO_TRAB_PESSOA == "7") echo(' selected');?>>Trabalhador rural</option>
											<option value="8"<? if($SIT_MERCADO_TRAB_PESSOA == "8") echo(' selected');?>>Empregador rural</option>
											<option value="9"<? if($SIT_MERCADO_TRAB_PESSOA == "9") echo(' selected');?>>Não trabalha</option>
											<option value="10"<? if($SIT_MERCADO_TRAB_PESSOA == "10") echo(' selected');?>>Outra</option>
										</select>
									</td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="286">Nome da empresa que trabalha/ultimo emprego:&nbsp;&nbsp;</td>
									<td><input type="text" name="NOM_EMPRESA_TRAB_PESSOA" value="<?=$NOM_EMPRESA_TRAB_PESSOA?>" maxlength="115" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="120">CNPJ/CEI Empresa:&nbsp;&nbsp;</td>
									<td><input type="text" name="NUM_CNPJ_EMPRESA_PESSOA" value="<?=$NUM_CNPJ_EMPRESA_PESSOA?>" maxlength="14" class="caixa_texto" style="width:100%;"></td>
									<td class="label" width="130">Data de Adminissão:&nbsp;&nbsp;</td>
									<td><input type="text" name="DTA_ADMIS_EMPRESA_PESSOA" value="<?=$DTA_ADMIS_EMPRESA_PESSOA?>" maxlength="10" class="caixa_texto" style="width:100%;" onKeypress="return ajustar_data(this,event);"></td>
									<td width="20" align="right"><a tabindex="-1" href="javascript: cal1.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de emissão"></a></td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="50">Ocupação:&nbsp;&nbsp;</td>
									<td width="140"><input type="text" name="NOM_OCUPACAO_EMPRESA_PESSOA" value="<?=$NOM_OCUPACAO_EMPRESA_PESSOA?>" maxlength="115" class="caixa_texto" style="width:100%;"></td>
									<td class="label" width="190">Remuneração deste emprego:&nbsp;&nbsp;</td>
									<td><input type="text" name="VAL_REMUNER_EMPREGO_PESSOA" value="<?=number_format($VAL_REMUNER_EMPREGO_PESSOA, 2, ',', '.');?>" maxlength="16" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<fieldset>
							<legend class="conteudo_quadro_branco">Rendas</legend>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="80">Aposentadoria/Pensão:&nbsp;&nbsp;</td>
									<td><input type="text" name="VAL_RENDA_APOSENT_PESSOA" value="<?=number_format($VAL_RENDA_APOSENT_PESSOA, 2, ',', '.');?>" maxlength="16" class="caixa_texto" style="width:100%;"></td>
									<td class="label" width="130">Seguro desemprego:&nbsp;&nbsp;</td>
									<td><input type="text" name="VAL_RENDA_SEGURO_DESEMP_PESSOA" value="<?=number_format($VAL_RENDA_SEGURO_DESEMP_PESSOA, 2, ',', '.');?>" maxlength="16" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="120">Pensão Alimentícia:&nbsp;&nbsp;</td>
									<td><input type="text" name="VAL_RENDA_PENSAO_ALIMEN_PESSOA" value="<?=number_format($VAL_RENDA_PENSAO_ALIMEN_PESSOA, 2, ',', '.');?>" maxlength="16" class="caixa_texto" style="width:100%;"></td>
									<td class="label" width="70">Outras:&nbsp;&nbsp;</td>
									<td><input type="text" name="VAL_OUTRAS_RENDAS_PESSOA" value="<?=number_format($VAL_OUTRAS_RENDAS_PESSOA, 2, ',', '.');?>" maxlength="16" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td align="right">
						<input type="submit" class="botao_aqua" value="Proxima >>">
						<input type="hidden" name="modo" value="<? if($update) echo('update'); else echo('add');?>">
						<input type="hidden" name="DOMICILIO" value="<?=$DOMICILIO?>">
						<input type="hidden" name="PESSOA" value="<?=$PESSOA?>">
					</td>
				</tr>
				</form>
			</table>
		<? termina_quadro_branco(); ?>
	</div>
	<script language="javascript">
		document.forms[0].elements[0].focus();
		var cal1 = new calendar1(document.forms[0].elements['DTA_ADMIS_EMPRESA_PESSOA']);
		cal1.year_scroll = true;
		cal1.time_comp = false;
	</script>
	<? termina_pagina(); ?>