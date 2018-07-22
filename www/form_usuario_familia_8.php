<?
	require("includes/funcoes_layout.php");
	$DOMICILIO = $_REQUEST["DOMICILIO"];
	$PESSOA = $_REQUEST["PESSOA"];
	
	$deficiencias = "Cegueira;Mudez;Surdez;Mental;Física;Desnutrição;Tuberculose;Cancer;Prostituição;Alcoolismo;Doença Sexualmente Transmissível;Outras;Maus Tratos: Físicos;Maus Tratos: Pisicológicos;Maus Tratos: Estupro;Maus Tratos: Aliciamento;Maus Tratos: Violência";

	if(!empty($DOMICILIO)){
		require("includes/conectar_mysql.php");
		$query = "SELECT COUNT(*) FROM pessoa_4 WHERE PESSOA=" . $PESSOA;
		$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		$qtd = mysql_fetch_row($result);
		if($qtd[0]>0){
			$update = true;
			$query = "SELECT p1.NOM_PESSOA, p4.COD_ESTADO_CIVIL_PESSOA, p4.COD_RACA_COR_PESSOA, p4.NUM_ROUPA_PESSOA, p4.NUM_CALCADO_PESSOA, p4.COD_MEIO_TRANSP_PESSOA, p4.NOM_EMAIL_PESSOA, p4.COD_CRIANCA_0_6_ANOS_PESSOA, p4.COD_GRAVIDA_PESSOA, p4.COD_AMAMENTANDO_PESSOA, p4.COD_PRE_NATAL_PESSOA, p4.COD_METOD_ANTI_CONCEP_PESSOA, p4.COD_CARTEIRA_VACINA_PESSOA, p4.NOM_DEPEN_QUIMICA_PESSOA, p4.TXT_DOENCAS_PESSOA FROM pessoa_1 p1, pessoa_4 p4 WHERE p1.PESSOA=p4.PESSOA AND p4.PESSOA=" . $PESSOA;
			$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
			$registro = mysql_fetch_assoc($result);
			$NOM_PESSOA = $registro["NOM_PESSOA"];
			$COD_ESTADO_CIVIL_PESSOA = $registro["COD_ESTADO_CIVIL_PESSOA"];
			$COD_RACA_COR_PESSOA = $registro["COD_RACA_COR_PESSOA"];
			$NUM_ROUPA_PESSOA = $registro["NUM_ROUPA_PESSOA"];
			$NUM_CALCADO_PESSOA = $registro["NUM_CALCADO_PESSOA"];
			$COD_MEIO_TRANSP_PESSOA = $registro["COD_MEIO_TRANSP_PESSOA"];
			$NOM_EMAIL_PESSOA = $registro["NOM_EMAIL_PESSOA"];
			$COD_CRIANCA_0_6_ANOS_PESSOA = $registro["COD_CRIANCA_0_6_ANOS_PESSOA"];
			$COD_GRAVIDA_PESSOA = $registro["COD_GRAVIDA_PESSOA"];
			$COD_AMAMENTANDO_PESSOA = $registro["COD_AMAMENTANDO_PESSOA"];
			$COD_PRE_NATAL_PESSOA = $registro["COD_PRE_NATAL_PESSOA"];
			$COD_METOD_ANTI_CONCEP_PESSOA = $registro["COD_METOD_ANTI_CONCEP_PESSOA"];
			$COD_CARTEIRA_VACINA_PESSOA = $registro["COD_CARTEIRA_VACINA_PESSOA"];
			$NOM_DEPEN_QUIMICA_PESSOA = $registro["NOM_DEPEN_QUIMICA_PESSOA"];
			$TXT_DOENCAS_PESSOA = $registro["TXT_DOENCAS_PESSOA"];
			$temp = split(";",$TXT_DOENCAS_PESSOA);
			$TXT_DOENCAS_PESSOA = '';
			$temp2 = split(";",$deficiencias);
			
			for($i = 0; $i < count($temp); $i++){
				if(strlen($temp[$i]) > 0){
					$TXT_DOENCAS_PESSOA .= '<option value="' . $temp[$i] . '">' . $temp[$i] . '</option>';
					for($j = 0; $j < count($temp2); $j++){
						if($temp2[$j] == $temp[$i]) {
							$deficiencias = str_replace($temp[$i] . ";","",$deficiencias);
							$deficiencias = str_replace($temp[$i],"",$deficiencias);
						}
					}
				}
			}
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
	<table width="100%">
		<tr>
			<td width="50"><a href="form_usuario_familia_9.php?DOMICILIO=<?=$DOMICILIO?>&PESSOA=<?=$PESSOA?>"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<td class="conteudo_quadro_claro" valign="middle" style="padding-top: 12px;"><? monta_titulo_secao("Estado Pessoal"); ?></td>
			<td width="50"></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<form action="salva_usuario_familia_8.php" method="post" onSubmit="return verifica_campos();">
	<div style="width: 100%; vertical-align: top; text-align:center;">
		<? inicia_quadro_branco('width="80%"', 'Estado Pessoal de ' . $NOM_PESSOA); ?>
			<table width="100%" border="0" cellpadding="2" cellspacing="3">
				<tr>
					<td>
						<fieldset>
							<legend class="conteudo_quadro_branco">Sócio-Econômicas</legend>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="78">Estado Civil:&nbsp;&nbsp;</td>
									<td width="50">
										<select name="COD_ESTADO_CIVIL_PESSOA">
											<option value="1"<? if($COD_ESTADO_CIVIL_PESSOA == "1") echo(' selected');?>>Solteiro(a)</option>
											<option value="2"<? if($COD_ESTADO_CIVIL_PESSOA == "2") echo(' selected');?>>Casado(a)</option>
											<option value="3"<? if($COD_ESTADO_CIVIL_PESSOA == "3") echo(' selected');?>>Divorciado(a)</option>
											<option value="4"<? if($COD_ESTADO_CIVIL_PESSOA == "4") echo(' selected');?>>Separado(a)</option>
											<option value="5"<? if($COD_ESTADO_CIVIL_PESSOA == "5") echo(' selected');?>>Viúvo(a)</option>
										</select>
									</td>
									<td class="label" width="50">Raça:&nbsp;&nbsp;</td>
									<td width="50">
										<select name="COD_RACA_COR_PESSOA">
											<option value="1"<? if($COD_RACA_COR_PESSOA == "1") echo(' selected');?>>Branca</option>
											<option value="2"<? if($COD_RACA_COR_PESSOA == "2") echo(' selected');?>>Negra</option>
											<option value="3"<? if($COD_RACA_COR_PESSOA == "3") echo(' selected');?>>Parda</option>
											<option value="4"<? if($COD_RACA_COR_PESSOA == "4") echo(' selected');?>>Amarela</option>
											<option value="5"<? if($COD_RACA_COR_PESSOA == "5") echo(' selected');?>>Indígena</option>
										</select>
									</td>
									<td class="label" width="90">N&ordm; de Roupa:&nbsp;&nbsp;</td>
									<td><input type="text" name="NUM_ROUPA_PESSOA" value="<?=$NUM_ROUPA_PESSOA?>" maxlength="3" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="90">N&ordm; de calçado:&nbsp;&nbsp;</td>
									<td><input type="text" name="NUM_CALCADO_PESSOA" value="<?=$NUM_CALCADO_PESSOA?>" maxlength="3" class="caixa_texto" style="width:100%;"></td>
									<td class="label" width="130">Meio de Transporte:&nbsp;&nbsp;</td>
									<td width="50">
										<select name="COD_MEIO_TRANSP_PESSOA">
											<option value="1"<? if($COD_MEIO_TRANSP_PESSOA == "1") echo(' selected');?>>Automóvel</option>
											<option value="2"<? if($COD_MEIO_TRANSP_PESSOA == "2") echo(' selected');?>>Motocicleta</option>
											<option value="3"<? if($COD_MEIO_TRANSP_PESSOA == "3") echo(' selected');?>>Ônibus</option>
											<option value="4"<? if($COD_MEIO_TRANSP_PESSOA == "4") echo(' selected');?>>Bicicleta</option>
											<option value="5"<? if($COD_MEIO_TRANSP_PESSOA == "5") echo(' selected');?>>A pé</option>
											<option value="6"<? if($COD_MEIO_TRANSP_PESSOA == "6") echo(' selected');?>>Passe Livre</option>
										</select>
									</td>
									<td class="label" width="50">Email:&nbsp;&nbsp;</td>
									<td><input type="text" name="NOM_EMAIL_PESSOA" value="<?=$NOM_EMAIL_PESSOA?>" maxlength="50" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="236">Se criança de 0 a 6 anos, com quem fica:&nbsp;&nbsp;</td>
									<td>
										<select name="COD_CRIANCA_0_6_ANOS_PESSOA" style="width: 236px;">
											<option value="0"<? if($COD_CRIANCA_0_6_ANOS_PESSOA == "0") echo(' selected');?>>Não é criança</option>
											<option value="1"<? if($COD_CRIANCA_0_6_ANOS_PESSOA == "1") echo(' selected');?>>Pai/Mãe</option>
											<option value="2"<? if($COD_CRIANCA_0_6_ANOS_PESSOA == "2") echo(' selected');?>>Irmão/Irmã</option>
											<option value="3"<? if($COD_CRIANCA_0_6_ANOS_PESSOA == "3") echo(' selected');?>>Avô/Avó</option>
											<option value="4"<? if($COD_CRIANCA_0_6_ANOS_PESSOA == "4") echo(' selected');?>>Sozinho</option>
											<option value="5"<? if($COD_CRIANCA_0_6_ANOS_PESSOA == "5") echo(' selected');?>>Creche</option>
											<option value="6"<? if($COD_CRIANCA_0_6_ANOS_PESSOA == "6") echo(' selected');?>>Outro</option>
										</select>
									</td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="226">Se grávida, informar mês de gestação:&nbsp;&nbsp;</td>
									<td><input type="text" name="COD_GRAVIDA_PESSOA" value="<?=$COD_GRAVIDA_PESSOA?>" maxlength="2" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<fieldset>
							<legend class="conteudo_quadro_branco">Doenças, Deficiências, Distúrbios e Fraquezas</legend>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td width="46%" class="conteudo_quadro_branco">Não possui:</td>
									<td></td>
									<td width="46%" class="conteudo_quadro_branco">Possui:</td>
								</tr>
								<tr>
									<td width="46%">
										<select name="doencas" multiple style="width: 100%; height: 160px;" class="caixa_texto_gr">
											<?
											$temp = split(";", $deficiencias);
											for($i = 0; $i < count($temp); $i++){
												if(strlen($temp[$i]) > 0){
													echo('<option value="' . $temp[$i] . '">' . $temp[$i] . '</option>');
												}
											}
											?>
										</select>
									</td>
									<td align="center">
										<a href="#" onClick="remove_dos_papeis();">
											<img border="0" onMouseOver="this.src = 'imagens/voltar2_over.gif';" onMouseOut="this.src = 'imagens/voltar2_out.gif';" src="imagens/voltar2_out.gif">
										</a>
										<a href="#" onClick="adiciona_aos_papeis();">
											<img border="0" onMouseOver="this.src = 'imagens/avancar_over.gif';" onMouseOut="this.src = 'imagens/avancar_out.gif';" src="imagens/avancar_out.gif">
										</a>
									</td>
									<td width="46%">
										<select name="TXT_DOENCAS_PESSOA[]" multiple style="width: 100%; height: 160px;" class="caixa_texto_gr">
											<? if($update) echo($TXT_DOENCAS_PESSOA); ?>
										</select>
									</td>
								</tr>
							</table>
							<div style="font-size:4px;">&nbsp;</div>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="186">Nome da dependência química:&nbsp;&nbsp;</td>
									<td><input type="text" name="NOM_DEPEN_QUIMICA_PESSOA" value="<?=$NOM_DEPEN_QUIMICA_PESSOA?>" maxlength="100" class="caixa_texto" style="width:100%;"></td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<fieldset>
							<legend class="conteudo_quadro_branco">Outros</legend>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="label" width="200">Amamentando:&nbsp;&nbsp;</td>
									<td align="left"><input name="COD_AMAMENTANDO_PESSOA" type="checkbox"<? if($COD_AMAMENTANDO_PESSOA == "s") echo(' checked');?>></td>
									<td class="label" width="200">Fazendo Pré-Natal:&nbsp;&nbsp;</td>
									<td align="left"><input name="COD_PRE_NATAL_PESSOA" type="checkbox"<? if($COD_PRE_NATAL_PESSOA == "s") echo(' checked');?>></td>
								</tr>
								<tr>
									<td class="label">Usa ou usou métodos anti-conceptivos:&nbsp;&nbsp;</td>
									<td align="left"><input name="COD_METOD_ANTI_CONCEP_PESSOA" type="checkbox"<? if($COD_METOD_ANTI_CONCEP_PESSOA == "s") echo(' checked');?>></td>
									<td class="label">A carteira de vacina está em dia:&nbsp;&nbsp;</td>
									<td align="left"><input name="COD_CARTEIRA_VACINA_PESSOA" type="checkbox"<? if($COD_CARTEIRA_VACINA_PESSOA == "s") echo(' checked');?>></td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td align="right">
						<input type="submit" class="botao_aqua" value=" Finalizar ">
					</td>
				</tr>
					<input type="hidden" name="modo" value="<? if($update) echo('update'); else echo('add');?>">
					<input type="hidden" name="DOMICILIO" value="<?=$DOMICILIO?>">
					<input type="hidden" name="PESSOA" value="<?=$PESSOA?>">
				</form>
			</table>
		<? termina_quadro_branco(); ?>
	</div>
	<script language="javascript">
		document.forms[0].elements[0].focus();
		function verifica_campos(){
			var f = document.forms[0];
			var txt_eletro = document.forms[0].elements['TXT_DOENCAS_PESSOA[]'];
			for(var i = 0; i < txt_eletro.options.length; i++) txt_eletro.options[i].selected = true;
			return true;
		}
		function adiciona_aos_papeis(){
			var f = document.forms[0];
			var papeis_usuario = document.forms[0].elements['TXT_DOENCAS_PESSOA[]'];
			for(var i = 0; i < f.doencas.options.length; i++){
				if(f.doencas.options[i].selected){
					var opcao = document.createElement("OPTION");
					opcao.text = f.doencas.options[i].text;
					opcao.value = f.doencas.options[i].value;
					papeis_usuario.options.add(opcao);
					f.doencas.options.remove(i);
					i = -1;
				}
			}
		}
		function remove_dos_papeis(){
			var f = document.forms[0];
			var papeis_usuario = document.forms[0].elements['TXT_DOENCAS_PESSOA[]'];
			for(var i = 0; i < papeis_usuario.options.length; i++){
				if(papeis_usuario.options[i].selected){
					var opcao = document.createElement("OPTION");
					opcao.text = papeis_usuario.options[i].text;
					opcao.value = papeis_usuario.options[i].value;
					f.doencas.options.add(opcao);
					papeis_usuario.options.remove(i);
					i = -1;
				}
			}
		}
		function checkEmail(email) {
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
				return (true);
			}
			else {
				alert("Endereço de email inválido! Digite novamente.")
				return (false);
			}
		}
		function verificaNumero(campo) {
			if(isNaN(campo.value)){ 
			 alert("Formato de dados inválido.\nApenas números são permitidos."); 
			 campo.focus(); 
			 return (false); 
		   }
		   else return (true);
		}
	</script>
	<? termina_pagina(); ?>
