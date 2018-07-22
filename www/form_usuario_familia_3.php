<?
	require("includes/funcoes_layout.php");
	
	$DOMICILIO = $_REQUEST["DOMICILIO"];
	$eletrodomesticos = "fogão;ferro de passar;máquina de lavar;computador;geladeira;liquidificador;televisão;rádio";

	if(!empty($DOMICILIO)){
		require("includes/conectar_mysql.php");
		$query = "SELECT COUNT(*) FROM domicilio_3 WHERE DOMICILIO=" . $DOMICILIO;
		$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		$qtd = mysql_fetch_row($result);
		if($qtd[0]>0){
			$update = true;
			require("includes/conectar_mysql.php");
			$query = "SELECT * FROM domicilio_3 WHERE DOMICILIO=" . $DOMICILIO;
			$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
			$registro = mysql_fetch_assoc($result);
			$VAL_DESP_MENSAIS_ALUGUEL_PESSOA = $registro["VAL_DESP_MENSAIS_ALUGUEL_PESSOA"];
			$VAL_DESP_PREST_HAB_PESSOA = $registro["VAL_DESP_PREST_HAB_PESSOA"];
			$VAL_DESP_ALIMENT_PESSOA = $registro["VAL_DESP_ALIMENT_PESSOA"];
			$VAL_DESP_AGUA_PESSOA = $registro["VAL_DESP_AGUA_PESSOA"];
			$VAL_DESP_LUZ_PESSOA = $registro["VAL_DESP_LUZ_PESSOA"];
			$VAL_DESP_TRANSPOR_PESSOA = $registro["VAL_DESP_TRANSPOR_PESSOA"];
			$VAL_DESP_MEDICAMENTOS_PESSOA = $registro["VAL_DESP_MEDICAMENTOS_PESSOA"];
			$VAL_DESP_GAS_PESSOA = $registro["VAL_DESP_GAS_PESSOA"];
			$VAL_OUTRAS_DESP_PESSOA = $registro["VAL_OUTRAS_DESP_PESSOA"];
			$NUM_PESSOAS_RENDA_PESSOA = $registro["NUM_PESSOAS_RENDA_PESSOA"];
			$TXT_ELETRO_FAMILIA = $registro["TXT_ELETRO_FAMILIA"];
			$temp = split(";",$TXT_ELETRO_FAMILIA);
			$TXT_ELETRO_FAMILIA = '';
			$temp2 = split(";",$eletrodomesticos);
			
			for($i = 0; $i < count($temp); $i++){
				if(strlen($temp[$i]) > 0){
					$TXT_ELETRO_FAMILIA .= '<option value="' . $temp[$i] . '">' . $temp[$i] . '</option>';
					for($j = 0; $j < count($temp2); $j++){
						if($temp2[$j] == $temp[$i]) {
							$eletrodomesticos = str_replace($temp[$i] . ";","",$eletrodomesticos);
							$eletrodomesticos = str_replace($temp[$i],"",$eletrodomesticos);
						}
					}
				}
			}
		}
		require("includes/desconectar_mysql.php");
	}
	
	inicia_pagina();
	monta_menu_abas("operador");
	inicia_tabela_conteudo();
	?>
	<script language="javascript">
		function verifica_campos(){
			var f = document.forms[0];
			var txt_eletro = document.forms[0].elements['TXT_ELETRO_FAMILIA[]'];
			for(var i = 0; i < txt_eletro.options.length; i++) txt_eletro.options[i].selected = true;
			return true;
		}
		function adiciona_eletro(){
			var f = document.forms[0];
			var txt_eletro = f.elements['TXT_ELETRO_FAMILIA[]'];
			for(var i = 0; i < f.eletrodomesticos.options.length; i++){
				if(f.eletrodomesticos.options[i].selected){
					var opcao = document.createElement("OPTION");
					opcao.text = f.eletrodomesticos.options[i].text;
					opcao.value = f.eletrodomesticos.options[i].value;
					txt_eletro.options.add(opcao);
					f.eletrodomesticos.options.remove(i);
					i = -1;
				}
			}
		}
		function remove_eletro(){
			var f = document.forms[0];
			var txt_eletro = f.elements['TXT_ELETRO_FAMILIA[]'];
			for(var i = 0; i < txt_eletro.options.length; i++){
				if(txt_eletro.options[i].selected){
					var opcao = document.createElement("OPTION");
					opcao.text = txt_eletro.options[i].text;
					opcao.value = txt_eletro.options[i].value;
					f.eletrodomesticos.options.add(opcao);
					txt_eletro.options.remove(i);
					i = -1;
				}
			}
		}
	</script>
	<table width="100%">
		<tr>
			<td width="50"><a href="busca_usuario_familia.php"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<td class="conteudo_quadro_claro" valign="middle" style="padding-top: 12px;"><? monta_titulo_secao("Sócio-econômico Domicílio - Financeiro"); ?></td>
			<td width="50"></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<form action="salva_usuario_familia_3.php" method="post" onSubmit="return verifica_campos();">
		<table width="100%">
			<tr>
				<td align="center">
					<? inicia_quadro_branco('width="80%"', 'Socio-Econômico - Financeiro'); ?>
						<table width="100%" border="0" cellpadding="2" cellspacing="3">
							<tr>
								<td>
									<fieldset>
										<legend class="conteudo_quadro_branco">Valor de Despesas Mensais</legend>
										<table width="100%" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td class="label" width="38">Aluguel:&nbsp;&nbsp;</td>
												<td><input type="text" name="VAL_DESP_MENSAIS_ALUGUEL_PESSOA" value="<?=number_format($VAL_DESP_MENSAIS_ALUGUEL_PESSOA, 2, ',', '.');?>" maxlength="19" class="caixa_texto" style="width:100%;"></td>
												<td class="label" width="150">Prestação Habitacional:&nbsp;&nbsp;</td>
												<td><input type="text" name="VAL_DESP_PREST_HAB_PESSOA" value="<?=number_format($VAL_DESP_PREST_HAB_PESSOA, 2, ',', '.');?>" class="caixa_texto" style="width:100%;"></td>
											</tr>
										</table>
										<div style="font-size:4px;">&nbsp;</div>
										<table width="100%" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td class="label" width="38">Alimentação:&nbsp;&nbsp;</td>
												<td><input type="text" name="VAL_DESP_ALIMENT_PESSOA" value="<?=number_format($VAL_DESP_ALIMENT_PESSOA, 2, ',', '.');?>" maxlength="19" class="caixa_texto" style="width:100%;"></td>
												<td class="label" width="60">Água:&nbsp;&nbsp;</td>
												<td><input type="text" name="VAL_DESP_AGUA_PESSOA" value="<?=number_format($VAL_DESP_AGUA_PESSOA, 2, ',', '.');?>" maxlength="19" class="caixa_texto" style="width:100%;"></td>
											</tr>
										</table>
										<div style="font-size:4px;">&nbsp;</div>
										<table width="100%" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td class="label" width="30">Luz:&nbsp;&nbsp;</td>
												<td><input type="text" name="VAL_DESP_LUZ_PESSOA" value="<?=number_format($VAL_DESP_LUZ_PESSOA, 2, ',', '.');?>" maxlength="19" class="caixa_texto" style="width:100%;"></td>
												<td class="label" width="84">Transporte:&nbsp;&nbsp;</td>
												<td><input type="text" name="VAL_DESP_TRANSPOR_PESSOA" value="<?=number_format($VAL_DESP_TRANSPOR_PESSOA, 2, ',', '.');?>" maxlength="19" class="caixa_texto" style="width:100%;"></td>
											</tr>
										</table>
										<div style="font-size:4px;">&nbsp;</div>
										<table width="100%" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td class="label" width="30">Medicamentos:&nbsp;&nbsp;</td>
												<td><input type="text" name="VAL_DESP_MEDICAMENTOS_PESSOA" value="<?=number_format($VAL_DESP_MEDICAMENTOS_PESSOA, 2, ',', '.');?>" maxlength="19" class="caixa_texto" style="width:100%;"></td>
												<td class="label" width="40">Gás:&nbsp;&nbsp;</td>
												<td><input type="text" name="VAL_DESP_GAS_PESSOA" value="<?=number_format($VAL_DESP_GAS_PESSOA, 2, ',', '.');?>" maxlength="19" class="caixa_texto" style="width:100%;"></td>
												<td class="label" width="120">Outras Despesas:&nbsp;&nbsp;</td>
												<td><input type="text" name="VAL_OUTRAS_DESP_PESSOA" value="<?=number_format($VAL_OUTRAS_DESP_PESSOA, 2, ',', '.');?>" maxlength="19" class="caixa_texto" style="width:100%;"></td>
											</tr>
										</table>
									</fieldset>
								</td>
							</tr>
							<tr>
								<td>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td class="label" width="286">N&ordm; de Pessoas que vivem da renda desta familia:&nbsp;&nbsp;</td>
											<td><input type="text" name="NUM_PESSOAS_RENDA_PESSOA" value="<?=$NUM_PESSOAS_RENDA_PESSOA?>" maxlength="3" class="caixa_texto" style="width:100%;"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<fieldset>
										<legend class="conteudo_quadro_branco">Eletro-domésticos</legend>
										<table width="100%" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td width="46%" class="conteudo_quadro_branco">Não possui:</td>
												<td></td>
												<td width="46%" class="conteudo_quadro_branco">No domicílio:</td>
											</tr>
											<tr>
												<td width="46%">
													<select name="eletrodomesticos" multiple style="width: 100%; height: 160px;" class="caixa_texto_gr">
														<?
														$temp = split(";", $eletrodomesticos);
														for($i = 0; $i < count($temp); $i++){
															if(strlen($temp[$i]) > 0){
																echo('<option value="' . $temp[$i] . '">' . $temp[$i] . '</option>');
															}
														}
														?>
													</select>
												</td>
												<td align="center">
													<a href="javascript: remove_eletro();">
														<img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar2_over.gif';" onMouseOut="this.src = 'imagens/voltar2_out.gif';" src="imagens/voltar2_out.gif">
													</a>
													<a href="javascript: adiciona_eletro();">
														<img title="Avançar" border="0" onMouseOver="this.src = 'imagens/avancar_over.gif';" onMouseOut="this.src = 'imagens/avancar_out.gif';" src="imagens/avancar_out.gif">
													</a>
												</td>
												<td width="46%">
													<select name="TXT_ELETRO_FAMILIA[]" multiple style="width: 100%; height: 160px;" class="caixa_texto_gr">
														<? if($update) echo($TXT_ELETRO_FAMILIA); ?>
													</select>
												</td>
											</tr>
										</table>
									</fieldset>
								</td>
							</tr>
							<tr>
								<td align="right">
									<input type="submit" class="botao_aqua" value="Proxima >>">
								</td>
							</tr>
						</table>
					<? termina_quadro_branco(); ?>
				</td>
			</tr>
		</table>
		<input type="hidden" name="DOMICILIO" value="<?=$DOMICILIO?>">
		<input type="hidden" name="modo" value="<? if($update) echo('update'); else echo('add');?>">
	</form>
	<script language="javascript">
		document.forms[0].elements[0].focus();
	</script>
<? termina_pagina(); ?>
