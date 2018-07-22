<?
	require("includes/funcoes_layout.php");
	
	$DOMICILIO = $_REQUEST["DOMICILIO"];
	
	if(!empty($DOMICILIO)){
		$update = true;
		require("includes/conectar_mysql.php");
		$query = "SELECT * FROM domicilio_1 WHERE DOMICILIO=" . $DOMICILIO;
		$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		$registro = mysql_fetch_assoc($result);
		$DOMICILIO = $registro["DOMICILIO"];
		$COD_DOMICILIAR = $registro["COD_DOMICILIAR"];
		$TIP_LOGRAD_DOMIC = $registro["TIP_LOGRAD_DOMIC"];
		$NOM_LOGRADOURO_DOMIC = $registro["NOM_LOGRADOURO_DOMIC"];
		$NUM_RESIDENCIA_DOMIC = $registro["NUM_RESIDENCIA_DOMIC"];
		$NOM_COMPL_RESIDENCIA_DOMIC = $registro["NOM_COMPL_RESIDENCIA_DOMIC"];
		$NOM_BAIRRO_RESIDENCIA_DOMIC = $registro["NOM_BAIRRO_RESIDENCIA_DOMIC"];
		$CEP_RESIDENCIA_DOMIC = $registro["CEP_RESIDENCIA_DOMIC"];
		$NOM_LOCALIDADE_DOMIC = $registro["NOM_LOCALIDADE_DOMIC"];
		$SIG_UF_RESIDENCIA_DOMIC = $registro["SIG_UF_RESIDENCIA_DOMIC"];
		$COD_DDD_RESIDENCIA_DOMIC = $registro["COD_DDD_RESIDENCIA_DOMIC"];
		$NUM_TEL_CONTATO_DOMIC = $registro["NUM_TEL_CONTATO_DOMIC"];
		require("includes/desconectar_mysql.php");
	}
	else{
		$NOM_LOCALIDADE_DOMIC = "Joinville";
		$SIG_UF_RESIDENCIA_DOMIC = "SC";
		$COD_DDD_RESIDENCIA_DOMIC ="47";
	}
	
	inicia_pagina();
	monta_menu_abas("operador");
	inicia_tabela_conteudo();
	?>
	<table width="100%">
		<tr>
			<td width="50"><a href="busca_usuario_familia.php"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<td class="conteudo_quadro_claro" valign="middle" style="padding-top: 12px;"><? monta_titulo_secao("Informa&ccedil;&otilde;es do Domic&iacute;lio"); ?></td>
			<td width="50"></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<script language="javascript">
		function valida_form(){
			var f = document.forms[0];
			if(f.NOM_LOGRADOURO_DOMIC.value == ''){
				alert("Informe o nome da rua!");
				return false;
			}
			if(f.NOM_BAIRRO_RESIDENCIA_DOMIC.value == ''){
				alert("Informe o bairro!");
				return false;
			}
			return true;
		}
	</script>
	<form action="salva_usuario_familia_1.php" method="post" onSubmit="return valida_form();">
	<div style="width: 100%; vertical-align: top; text-align:center;">
		<? inicia_quadro_branco('width="80%"', 'Informa&ccedil;&otilde;es B&aacute;sicas'); ?>
			<table width="100%" border="0" cellpadding="2" cellspacing="3">
				<tr>
					<td width="115" class="label">Codigo Domiciliar:</td>
					<td><input type="text" name="COD_DOMICILIAR" value="<?=$COD_DOMICILIAR?>" class="caixa_texto" maxlength="10" style="width:100%;"></td>
				</tr>
				<tr>
					<td class="label">Logradouro:</td>
					<td>
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="5%">
									<select name="TIP_LOGRAD_DOMIC">
										<option value="Rua"<? if($TIP_LOGRAD_DOMIC == "Rua") echo(" selected"); ?>>Rua</option>
										<option value="Praça"<? if($TIP_LOGRAD_DOMIC == "Praça") echo(" selected"); ?>>Praça</option>
										<option value="Largo"<? if($TIP_LOGRAD_DOMIC == "Largo") echo(" selected"); ?>>Largo</option>
										<option value="Alameda"<? if($TIP_LOGRAD_DOMIC == "Alameda") echo(" selected"); ?>>Alameda</option>
										<option value="Avenida"<? if($TIP_LOGRAD_DOMIC == "Avenida") echo(" selected"); ?>>Avenida</option>
										<option value="Travessa"<? if($TIP_LOGRAD_DOMIC == "Travessa") echo(" selected"); ?>>Travessa</option>
										<option value="Servidão"<? if($TIP_LOGRAD_DOMIC == "Servidão") echo(" selected"); ?>>Servid&atilde;o</option>
										<option value="Estrada"<? if($TIP_LOGRAD_DOMIC == "Estrada") echo(" selected"); ?>>Estrada</option>
										<option value="Rodovia"<? if($TIP_LOGRAD_DOMIC == "Rodovia") echo(" selected"); ?>>Rodovia</option>
									</select>
								</td>
								<td width="5%">&nbsp;</td>
								<td width="90%"><input type="text" name="NOM_LOGRADOURO_DOMIC" value="<?=$NOM_LOGRADOURO_DOMIC?>" maxlength="50" class="caixa_texto" style="width:100%;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="label">N&ordm;:</td>
					<td>
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="25%"><input type="text" name="NUM_RESIDENCIA_DOMIC" value="<?=$NUM_RESIDENCIA_DOMIC?>" maxlength="7" class="caixa_texto" style="width:100%;"></td>
								<td width="5%">&nbsp;</td>
								<td width="5%" class="label">Complemento:&nbsp;</td>
								<td width="65%"><input type="text" name="NOM_COMPL_RESIDENCIA_DOMIC" value="<?=$NOM_COMPL_RESIDENCIA_DOMIC?>" maxlength="15" class="caixa_texto" style="width:100%;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="label">Bairro:</td>
					<td>
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="70%"><input type="text" name="NOM_BAIRRO_RESIDENCIA_DOMIC" value="<?=$NOM_BAIRRO_RESIDENCIA_DOMIC?>" maxlength="40" class="caixa_texto" style="width:100%;"></td>
								<td width="5%">&nbsp;</td>
								<td width="5%" class="label">CEP:&nbsp;</td>
								<td width="20%"><input type="text" name="CEP_RESIDENCIA_DOMIC" value="<?=$CEP_RESIDENCIA_DOMIC?>" maxlength="8" class="caixa_texto" style="width:100%;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="label">Cidade:&nbsp;</td>
					<td>
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="80%"><input type="text" name="NOM_LOCALIDADE_DOMIC" value="<?=$NOM_LOCALIDADE_DOMIC?>" maxlength="25" class="caixa_texto" style="width:100%;"></td>
								<td width="5%">&nbsp;</td>
								<td width="5%" class="label">Estado:&nbsp;</td>
								<td width="10%"><input type="text" name="SIG_UF_RESIDENCIA_DOMIC" value="<?=$SIG_UF_RESIDENCIA_DOMIC?>" maxlength="2" class="caixa_texto" style="width:100%;" onBlur="this.value = this.value.toUpperCase();"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="label">DDD:</td>
					<td>
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="22%"><input type="text" name="COD_DDD_RESIDENCIA_DOMIC" value="<?=$COD_DDD_RESIDENCIA_DOMIC?>" maxlength="4" class="caixa_texto" style="width:100%;"></td>
								<td width="3%">&nbsp;</td>
								<td width="30%" class="label">Telefone Contato:&nbsp;</td>
								<td width="45%"><input type="text" name="NUM_TEL_CONTATO_DOMIC" value="<?=$NUM_TEL_CONTATO_DOMIC?>" maxlength="10" class="caixa_texto" style="width:100%;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td colspan="2" style="font-size:0px;">&nbsp;</td></tr>
				<tr>
					<td colspan="2" align="right">
						<input type="submit" class="botao_aqua" value="   Salvar   ">
					</td>
				</tr>
					<input type="hidden" name="DOMICILIO" value="<?=$DOMICILIO?>">
					<input type="hidden" name="modo" value="<? if($update) echo('update'); else echo('add');?>">
				</form>
			</table>
		<? termina_quadro_branco(); ?>
	</div>
	<script language="javascript">
		document.forms[0].elements[0].focus();
	</script>
	<? termina_pagina(); ?>
