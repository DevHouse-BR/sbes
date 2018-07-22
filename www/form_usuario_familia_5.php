<?
	require("includes/funcoes_layout.php");
	$DOMICILIO = $_REQUEST["DOMICILIO"];
	$PESSOA = $_REQUEST["PESSOA"];
	
	$SIG_UF_CERTID_PESSOA = "SC";
	$SIG_UF_IDENT_PESSOA = "SC";
	$SIG_UF_CART_TRAB_PESSOA = "SC";
	$SIG_ORGAO_EMISSAO_PESSOA = "SSP";
	
	if(!empty($PESSOA)){
		require("includes/conectar_mysql.php");
		$update = true;
		$query = "SELECT * FROM pessoa_1 WHERE PESSOA=" . $PESSOA;
		$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		$registro = mysql_fetch_assoc($result);
		$NOM_PESSOA = $registro["NOM_PESSOA"];
		$DTA_NASC_PESSOA = $registro["DTA_NASC_PESSOA"];
		$COD_SEXO_PESSOA = $registro["COD_SEXO_PESSOA"];
		$NUM_NIS_PESSOA = $registro["NUM_NIS_PESSOA"];
		$COD_CERTID_CIVIL_PESSOA = $registro["COD_CERTID_CIVIL_PESSOA"];
		$COD_TERMO_CERTID_PESSOA = $registro["COD_TERMO_CERTID_PESSOA"];
		$COD_LIVRO_TERMO_CERTID_PESSOA = $registro["COD_LIVRO_TERMO_CERTID_PESSOA"];
		$COD_FOLHA_TERMO_CERTID_PESSOA = $registro["COD_FOLHA_TERMO_CERTID_PESSOA"];
		$DTA_EMISSAO_CERTID_PESSOA = $registro["DTA_EMISSAO_CERTID_PESSOA"];
		$SIG_UF_CERTID_PESSOA = $registro["SIG_UF_CERTID_PESSOA"];
		$NOM_CARTORIO_PESSOA = $registro["NOM_CARTORIO_PESSOA"];
		$NUM_IDENTIDADE_PESSOA = $registro["NUM_IDENTIDADE_PESSOA"];
		$TXT_COMPLEMENTO_PESSOA = $registro["TXT_COMPLEMENTO_PESSOA"];
		$DTA_EMISSAO_IDENT_PESSOA = $registro["DTA_EMISSAO_IDENT_PESSOA"];
		$SIG_UF_IDENT_PESSOA = $registro["SIG_UF_IDENT_PESSOA"];
		$SIG_ORGAO_EMISSAO_PESSOA = $registro["SIG_ORGAO_EMISSAO_PESSOA"];
		$NUM_CART_TRAB_PREV_SOC_PESSOA = $registro["NUM_CART_TRAB_PREV_SOC_PESSOA"];
		$NUM_SERIE_TRAB_PREV_SOC_PESSOA = $registro["NUM_SERIE_TRAB_PREV_SOC_PESSOA"];
		$DTA_EMISSAO_CART_TRAB_PESSOA = $registro["DTA_EMISSAO_CART_TRAB_PESSOA"];
		$SIG_UF_CART_TRAB_PESSOA = $registro["SIG_UF_CART_TRAB_PESSOA"];
		$NUM_CPF_PESSOA = $registro["NUM_CPF_PESSOA"];
		$NUM_TITULO_ELEITOR_PESSOA = $registro["NUM_TITULO_ELEITOR_PESSOA"];
		$NUM_ZONA_TIT_ELEITOR_PESSOA = $registro["NUM_ZONA_TIT_ELEITOR_PESSOA"];
		$NUM_SECAO_TIT_ELEITOR_PESSOA = $registro["NUM_SECAO_TIT_ELEITOR_PESSOA"];
		$SIT_PESSOA = $registro["SIT_PESSOA"];
		
		$DTA_NASC_PESSOA = split("-",$DTA_NASC_PESSOA);
		$DTA_NASC_PESSOA = $DTA_NASC_PESSOA[2] . "/" . $DTA_NASC_PESSOA[1] . "/" . $DTA_NASC_PESSOA[0];
		$DTA_EMISSAO_CERTID_PESSOA = split("-",$DTA_EMISSAO_CERTID_PESSOA);
		$DTA_EMISSAO_CERTID_PESSOA = $DTA_EMISSAO_CERTID_PESSOA[2] . "/" . $DTA_EMISSAO_CERTID_PESSOA[1] . "/" . $DTA_EMISSAO_CERTID_PESSOA[0];
		$DTA_EMISSAO_IDENT_PESSOA = split("-",$DTA_EMISSAO_IDENT_PESSOA);
		$DTA_EMISSAO_IDENT_PESSOA = $DTA_EMISSAO_IDENT_PESSOA[2] . "/" . $DTA_EMISSAO_IDENT_PESSOA[1] . "/" . $DTA_EMISSAO_IDENT_PESSOA[0];
		$DTA_EMISSAO_CART_TRAB_PESSOA = split("-",$DTA_EMISSAO_CART_TRAB_PESSOA);
		$DTA_EMISSAO_CART_TRAB_PESSOA = $DTA_EMISSAO_CART_TRAB_PESSOA[2] . "/" . $DTA_EMISSAO_CART_TRAB_PESSOA[1] . "/" . $DTA_EMISSAO_CART_TRAB_PESSOA[0];
		require("includes/desconectar_mysql.php");
	}
	
	inicia_pagina();
	monta_menu_abas("operador");
	inicia_tabela_conteudo();
	?>
	<script language="JavaScript" src="includes/calendar1.js"></script>
	<script language="javascript">
		function valida_form(){
			var f = document.forms[0];
			if(f.NOM_PESSOA.value == ''){
				alert("Informe o nome da pessoa!");
				f.NOM_PESSOA.focus();
				return false;
			}
			if(f.DTA_NASC_PESSOA.value == ''){
				alert("Informe a data de nascimento da pessoa!");
				f.DTA_NASC_PESSOA.focus();
				return false;
			}
			if((f.NUM_CPF_PESSOA.value != '') && (isNaN(f.NUM_CPF_PESSOA.value))){
				alert('Digite apenas números no campo CPF!');
				f.NUM_CPF_PESSOA.focus();
				return false;
			}
			else if(!valida_cpf(f.NUM_CPF_PESSOA.value)){
				f.NUM_CPF_PESSOA.focus();
				return false;
			}
			return true;
		}
		function valida_cpf(cpf) {
			var i = 0;
			var n_checked = 0;
			var error = 0;
			var error_message = "";
			
			if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999") {
				error_message = "Por favor digite um cpf válido!\n";
				error = 1;
			}
			soma = 0;
			for (i=0; i<9; i++) {
				soma += parseInt(cpf.charAt(i))*(10-i);
			}
			resto = 11-(soma%11);
			if (resto == 10 || resto == 11) {
				resto = 0;
			}
			if (resto != parseInt(cpf.charAt(9))) {
				error_message = "Por favor digite um cpf válido!\n";
				error = 1;
			}
			soma = 0;
			for (i=0; i<10; i++) {
				soma += parseInt(cpf.charAt(i))*(11-i);
			}
			resto = 11-(soma%11);
			if (resto == 10 || resto == 11) {
				resto = 0;
			}
			if (resto != parseInt(cpf.charAt(10))) {
				error_message = "Por favor digite um cpf válido!\n";
				error = 1;
			}
			if (error == 1) {
				alert(error_message);
				return false;
			} else {
				return true;
			}
		}
	</script>
	<table width="100%">
		<tr>
			<td width="50"><a href="form_usuario_familia_4.php?DOMICILIO=<?=$DOMICILIO?>"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<td class="conteudo_quadro_claro" valign="middle" style="padding-top: 12px;"><? monta_titulo_secao("Documentos Pessoais"); ?></td>
			<td width="50"></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<form action="salva_usuario_familia_5.php" method="post" onSubmit="return valida_form();">
	<div style="width: 100%; vertical-align: top; text-align:center;">
		<? inicia_quadro_branco('width="80%"', 'Documentos Pessoais da Pessoa'); ?>
			<table width="100%" border="0" cellpadding="2" cellspacing="3">
				<tr>
					<td>
					<fieldset>
						<legend class="conteudo_quadro_branco">Básico</legend>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="label" width="38">Nome:&nbsp;&nbsp;</td>
								<td><input type="text" name="NOM_PESSOA" value="<?=$NOM_PESSOA?>" maxlength="70" class="caixa_texto" style="width:100%;"></td>
							</tr>
						</table>
						<div style="font-size:4px;">&nbsp;</div>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="label" width="126">Data de Nascimento:&nbsp;&nbsp;</td>
								<td><input type="text" name="DTA_NASC_PESSOA" value="<?=$DTA_NASC_PESSOA?>" maxlength="10" class="caixa_texto" style="width:100%;" onKeypress="return ajustar_data(this,event);"></td>
								<td width="20" align="right"><a tabindex="-1" href="javascript: cal4.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de nascimento"></a></td>
								<td class="label" width="80">Sexo:&nbsp;&nbsp;</td>
								<td width="50">
									<select name="COD_SEXO_PESSOA">
										<option value="M"<? if($COD_SEXO_PESSOA == "M") echo(" selected"); ?>>Masculino</option>
										<option value="F"<? if($COD_SEXO_PESSOA == "F") echo(" selected"); ?>>Feminino</option>
									</select>
								</td>
							</tr>
						</table>
						<div style="font-size:4px;">&nbsp;</div>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="label" width="176">N&ordm; Identificação Social (NIS):&nbsp;&nbsp;</td>
								<td width="130"><input type="text" name="NUM_NIS_PESSOA" value="<?=$NUM_NIS_PESSOA?>" maxlength="11" class="caixa_texto" style="width:100%;"></td>
								<td class="label" width="38">CPF:&nbsp;&nbsp;</td>
								<td><input type="text" name="NUM_CPF_PESSOA" value="<?=$NUM_CPF_PESSOA?>" maxlength="11" class="caixa_texto" style="width:100%;"></td>
							</tr>
						</table>
						<div style="font-size:4px;">&nbsp;</div>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="label" width="15">Ativo:</td>
								<td align="left"><input type="checkbox" name="SIT_PESSOA"<? if(!$update) echo(" checked"); elseif($SIT_PESSOA == "s") echo(" checked"); ?>></td>
							</tr>
						</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td><hr></td>
				</tr>
				<tr>
					<td>
						<fieldset>
							<legend class="conteudo_quadro_branco">Certidão Civil</legend>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="30">Tipo:&nbsp;&nbsp;</td>
									<td width="50">
										<select name="COD_CERTID_CIVIL_PESSOA">
											<option value="1"<? if($COD_CERTID_CIVIL_PESSOA == "1") echo(" selected"); ?>>Nascimento</option>
											<option value="2"<? if($COD_CERTID_CIVIL_PESSOA == "2") echo(" selected"); ?>>Casamento</option>
											<option value="3"<? if($COD_CERTID_CIVIL_PESSOA == "3") echo(" selected"); ?>>Indio</option>
										</select>
									</td>
									<td class="label" width="110">N&ordm; do Termo:&nbsp;&nbsp;</td>
									<td width="120"><input type="text" name="COD_TERMO_CERTID_PESSOA" maxlength="8" value="<?=$COD_TERMO_CERTID_PESSOA?>" class="caixa_texto" style="width:100%;"></td>
									<td class="label" width="80">Livro:&nbsp;&nbsp;</td>
									<td width="120"><input type="text" name="COD_LIVRO_TERMO_CERTID_PESSOA" maxlength="8" value="<?=$COD_LIVRO_TERMO_CERTID_PESSOA?>" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="30">Folha:&nbsp;&nbsp;</td>
									<td width="60"><input type="text" name="COD_FOLHA_TERMO_CERTID_PESSOA" maxlength="4" value="<?=$COD_FOLHA_TERMO_CERTID_PESSOA?>" class="caixa_texto" style="width:100%;"></td>
									<td class="label" width="40">UF:&nbsp;&nbsp;</td>
									<td width="60"><input type="text" name="SIG_UF_CERTID_PESSOA" maxlength="2" value="<?=$SIG_UF_CERTID_PESSOA?>" class="caixa_texto" style="width:100%;" onBlur="this.value = this.value.toUpperCase();"></td>
									<td class="label" width="120">Data de Emissão:&nbsp;&nbsp;</td>
									<td width="80"><input type="text" name="DTA_EMISSAO_CERTID_PESSOA" maxlength="10" value="<?=$DTA_EMISSAO_CERTID_PESSOA?>" class="caixa_texto" style="width:100%;" onKeypress="return ajustar_data(this,event);"></td>
									<td width="20" align="right"><a tabindex="-1" href="javascript: cal1.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de emissão"></a></td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="110">Nome do Cartório:&nbsp;&nbsp;</td>
									<td><input type="text" name="NOM_CARTORIO_PESSOA" value="<?=$NOM_CARTORIO_PESSOA?>" maxlength="48" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<fieldset>
							<legend class="conteudo_quadro_branco">Identidade</legend>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="92">N&ordm; Identidade:&nbsp;&nbsp;</td>
									<td width="200"><input type="text" name="NUM_IDENTIDADE_PESSOA" value="<?=$NUM_IDENTIDADE_PESSOA?>" maxlength="16" class="caixa_texto" style="width:100%;"></td>
									<td class="label" width="100">Complemento:&nbsp;&nbsp;</td>
									<td width="100"><input type="text" name="TXT_COMPLEMENTO_PESSOA" value="<?=$TXT_COMPLEMENTO_PESSOA?>" maxlength="5" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="96">Órgão Emissor:&nbsp;&nbsp;</td>
									<td width="80"><input type="text" name="SIG_ORGAO_EMISSAO_PESSOA" value="<?=$SIG_ORGAO_EMISSAO_PESSOA?>" maxlength="10" class="caixa_texto" style="width:100%;"></td>
									<td class="label" width="40">UF:&nbsp;&nbsp;</td>
									<td width="50"><input type="text" name="SIG_UF_IDENT_PESSOA" value="<?=$SIG_UF_IDENT_PESSOA?>" maxlength="2" class="caixa_texto" style="width:100%;" onBlur="this.value = this.value.toUpperCase();"></td>
									<td class="label" width="120">Data de Emissão:&nbsp;&nbsp;</td>
									<td><input type="text" name="DTA_EMISSAO_IDENT_PESSOA" value="<?=$DTA_EMISSAO_IDENT_PESSOA?>" maxlength="10" class="caixa_texto" style="width:100%;" onKeypress="return ajustar_data(this,event);"></td>
									<td width="20" align="right"><a tabindex="-1" href="javascript: cal2.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de emissão"></a></td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<fieldset>
							<legend class="conteudo_quadro_branco">Carteira de Trabalho</legend>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="80">N&ordm; Carteira:&nbsp;&nbsp;</td>
									<td width="220"><input type="text" name="NUM_CART_TRAB_PREV_SOC_PESSOA" value="<?=$NUM_CART_TRAB_PREV_SOC_PESSOA?>" maxlength="7" class="caixa_texto" style="width:100%;"></td>
									<td class="label" width="80">Série:&nbsp;&nbsp;</td>
									<td width="130"><input type="text" name="NUM_SERIE_TRAB_PREV_SOC_PESSOA" value="<?=$NUM_SERIE_TRAB_PREV_SOC_PESSOA?>" maxlength="5" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="30">UF:&nbsp;&nbsp;</td>
									<td width="150"><input type="text" name="SIG_UF_CART_TRAB_PESSOA" value="<?=$SIG_UF_CART_TRAB_PESSOA?>" maxlength="2" class="caixa_texto" style="width:100%;" onBlur="this.value = this.value.toUpperCase();"></td>
									<td class="label" width="120">Data de Emissão:&nbsp;&nbsp;</td>
									<td width="150"><input type="text" name="DTA_EMISSAO_CART_TRAB_PESSOA" value="<?=$DTA_EMISSAO_CART_TRAB_PESSOA?>" maxlength="10" class="caixa_texto" style="width:100%;" onKeypress="return ajustar_data(this,event);"></td>
									<td width="20" align="right"><a tabindex="-1" href="javascript: cal3.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de emissão"></a></td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<fieldset>
							<legend class="conteudo_quadro_branco">Título de Eleitor</legend>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="80">N&ordm; do Título:&nbsp;&nbsp;</td>
									<td width="100"><input type="text" name="NUM_TITULO_ELEITOR_PESSOA" value="<?=$NUM_TITULO_ELEITOR_PESSOA?>" maxlength="13" class="caixa_texto" style="width:100%;"></td>
									<td class="label" width="80">Zona:&nbsp;&nbsp;</td>
									<td width="90"><input type="text" name="NUM_ZONA_TIT_ELEITOR_PESSOA" value="<?=$NUM_ZONA_TIT_ELEITOR_PESSOA?>" maxlength="4" class="caixa_texto" style="width:100%;"></td>
									<td class="label" width="80">Seção:&nbsp;&nbsp;</td>
									<td width="90"><input type="text" name="NUM_SECAO_TIT_ELEITOR_PESSOA" value="<?=$NUM_SECAO_TIT_ELEITOR_PESSOA?>" maxlength="4" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td align="right">
						<input type="hidden" name="modo" value="<? if($update) echo('update'); else echo('add');?>">
						<input type="hidden" name="DOMICILIO" value="<?=$DOMICILIO?>">
						<input type="hidden" name="PESSOA" value="<?=$PESSOA?>">
						<input type="submit" class="botao_aqua" value="Proxima >>">
					</td>
				</tr>
				</form>
			</table>
		<? termina_quadro_branco(); ?>
	</div>
	<script language="javascript">
		document.forms[0].elements[0].focus();
		var cal1 = new calendar1(document.forms[0].elements['DTA_EMISSAO_CERTID_PESSOA']);
		cal1.year_scroll = true;
		cal1.time_comp = false;
		var cal2 = new calendar1(document.forms[0].elements['DTA_EMISSAO_IDENT_PESSOA']);
		cal2.year_scroll = true;
		cal2.time_comp = false;
		var cal3 = new calendar1(document.forms[0].elements['DTA_EMISSAO_CART_TRAB_PESSOA']);
		cal3.year_scroll = true;
		cal3.time_comp = false;
		var cal4 = new calendar1(document.forms[0].elements['DTA_NASC_PESSOA']);
		cal4.year_scroll = true;
		cal4.time_comp = false;
	</script>
	<script language="JavaScript" src="includes/data.js"></script>
	<? termina_pagina(); ?>