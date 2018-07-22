<?
	require("includes/funcoes_layout.php");
	
	$DOMICILIO = $_REQUEST["DOMICILIO"];
	
	if(!empty($DOMICILIO)){
		require("includes/conectar_mysql.php");
		$query = "SELECT COUNT(*) FROM domicilio_2 WHERE DOMICILIO=" . $DOMICILIO;
		$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		$qtd = mysql_fetch_row($result);
		if($qtd[0]>0){
			$update = true;
			require("includes/conectar_mysql.php");
			$query = "SELECT * FROM domicilio_2 WHERE DOMICILIO=" . $DOMICILIO;
			$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
			$registro = mysql_fetch_assoc($result);
			$TIP_LOCAL_DOMIC = $registro["TIP_LOCAL_DOMIC"];
			$NUM_DOMICILIO_COBERTO_DOMIC = $registro["NUM_DOMICILIO_COBERTO_DOMIC"];
			$SIT_DOMICILIO_DOMIC = $registro["SIT_DOMICILIO_DOMIC"];            
			$TIP_DOMICILIO_DOMIC = $registro["TIP_DOMICILIO_DOMIC"];
			$NUM_COMODOS_DOMIC = $registro["NUM_COMODOS_DOMIC"];
			$TIP_CONSTRUCAO_DOMIC = $registro["TIP_CONSTRUCAO_DOMIC"];
			$TIP_ABASTECIMENTO_AGUA_DOMIC = $registro["TIP_ABASTECIMENTO_AGUA_DOMIC"];
			$TIP_TRATAMENTO_AGUA_DOMIC = $registro["TIP_TRATAMENTO_AGUA_DOMIC"];
			$TIP_ILUMINACAO_DOMIC = $registro["TIP_ILUMINACAO_DOMIC"];
			$TIP_ESCOAMENTO_SANITARIO_DOMIC = $registro["TIP_ESCOAMENTO_SANITARIO_DOMIC"];
			$TIP_DESTINO_LIXO_DOMIC = $registro["TIP_DESTINO_LIXO_DOMIC"];
			$TIP_ESTADO_DOMIC = $registro["TIP_ESTADO_DOMIC"];
			$TIP_VIA_ACESSO_DOMIC = $registro["TIP_VIA_ACESSO_DOMIC"];
			$TIP_BANHEIRO_DOMIC = $registro["TIP_BANHEIRO_DOMIC"];
			$COD_CRECHE_DOMIC = $registro["COD_CRECHE_DOMIC"];
			$COD_ESCOLA_DOMIC = $registro["COD_ESCOLA_DOMIC"];
			$QTD_TEMPO_MORAR_ANOS_PESSOA = $registro["QTD_TEMPO_MORAR_ANOS_PESSOA"];
			$QTD_TEMPO_MORAR_MESES_PESSOA = $registro["QTD_TEMPO_MORAR_MESES_PESSOA"];
		}
		require("includes/desconectar_mysql.php");
	}
	
	inicia_pagina();
	monta_menu_abas("operador");
	inicia_tabela_conteudo();
	?>
	<table width="100%">
		<tr>
			<td width="50"><a href="busca_usuario_familia.php"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<td class="conteudo_quadro_claro" valign="middle" style="padding-top: 12px;"><? monta_titulo_secao("Sócio-econômico Domicílio - Básico"); ?></td>
			<td width="50"></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<script language="javascript">
		function valida_form(){
			var f = document.forms[0];
			return true;
		}
	</script>
	<form action="salva_usuario_familia_2.php" method="post" onSubmit="return valida_form();">
		<table width="100%">
			<tr>
				<td align="center">
					<? inicia_quadro_branco('width="80%"', 'Socio-Econômico - Básico'); ?>
						<table width="100%" border="0" cellpadding="2" cellspacing="3">
							<tr>
								<td>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td class="label" width="38">Área:&nbsp;&nbsp;</td>
											<td>
												<select name="TIP_LOCAL_DOMIC">
													<option value="1"<? if($TIP_LOCAL_DOMIC == "1") echo(" selected"); ?>>Urbana</option>
													<option value="2"<? if($TIP_LOCAL_DOMIC == "2") echo(" selected"); ?>>Rural</option>
												</select>
											</td>
											<td class="label" width="84">Coberto Por:&nbsp;&nbsp;</td>
											<td width="50" align="right">
												<select name="NUM_DOMICILIO_COBERTO_DOMIC">
													<option value="1"<? if($NUM_DOMICILIO_COBERTO_DOMIC == "1") echo(" selected"); ?>>PACS Programa de Agentes Comunitários de Saúde</option>
													<option value="2"<? if($NUM_DOMICILIO_COBERTO_DOMIC == "2") echo(" selected"); ?>>PSF Programa de Saúde da Família</option>
													<option value="3"<? if($NUM_DOMICILIO_COBERTO_DOMIC == "3") echo(" selected"); ?>>Similares ao PSF</option>
													<option value="4"<? if($NUM_DOMICILIO_COBERTO_DOMIC == "4") echo(" selected"); ?>>Outro</option>
												</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td class="label" width="50">Situação:&nbsp;&nbsp;</td>
											<td width="50">
												<select name="SIT_DOMICILIO_DOMIC">
													<option value="1"<? if($SIT_DOMICILIO_DOMIC == "1") echo(" selected"); ?>>Próprio</option>
													<option value="2"<? if($SIT_DOMICILIO_DOMIC == "2") echo(" selected"); ?>>Alugado</option>
													<option value="3"<? if($SIT_DOMICILIO_DOMIC == "3") echo(" selected"); ?>>Arrendado</option>
													<option value="4"<? if($SIT_DOMICILIO_DOMIC == "4") echo(" selected"); ?>>Cedido</option>
													<option value="5"<? if($SIT_DOMICILIO_DOMIC == "5") echo(" selected"); ?>>Invasão</option>
													<option value="6"<? if($SIT_DOMICILIO_DOMIC == "6") echo(" selected"); ?>>Financiado</option>
													<option value="7"<? if($SIT_DOMICILIO_DOMIC == "7") echo(" selected"); ?>>Outro</option>
												</select>
											</td>
											<td class="label" width="50">Tipo:&nbsp;&nbsp;</td>
											<td width="50">
												<select name="TIP_DOMICILIO_DOMIC">
													<option value="1"<? if($TIP_DOMICILIO_DOMIC == "1") echo(" selected"); ?>>Casa</option>
													<option value="2"<? if($TIP_DOMICILIO_DOMIC == "2") echo(" selected"); ?>>Apartamento</option>
													<option value="3"<? if($TIP_DOMICILIO_DOMIC == "3") echo(" selected"); ?>>Cômodos</option>
													<option value="4"<? if($TIP_DOMICILIO_DOMIC == "4") echo(" selected"); ?>>Outros</option>
												</select>
											</td>
											<td class="label" width="100">N&ordm; de Comodos&nbsp;&nbsp;</td>
											<td><input type="text" name="NUM_COMODOS_DOMIC" value="<?=$NUM_COMODOS_DOMIC?>" maxlength="3" class="caixa_texto" style="width:100%;"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td class="label" width="117">Tipo da Construção:&nbsp;&nbsp;</td>
											<td width="50">
												<select name="TIP_CONSTRUCAO_DOMIC">
													<option value="1"<? if($TIP_CONSTRUCAO_DOMIC == "1") echo(" selected"); ?>>Tijolo/Alvenaria</option>
													<option value="2"<? if($TIP_CONSTRUCAO_DOMIC == "2") echo(" selected"); ?>>Adobe</option>
													<option value="3"<? if($TIP_CONSTRUCAO_DOMIC == "3") echo(" selected"); ?>>Taipa revestida</option>
													<option value="4"<? if($TIP_CONSTRUCAO_DOMIC == "4") echo(" selected"); ?>>Taipa não revestida</option>
													<option value="5"<? if($TIP_CONSTRUCAO_DOMIC == "5") echo(" selected"); ?>>Madeira</option>
													<option value="6"<? if($TIP_CONSTRUCAO_DOMIC == "6") echo(" selected"); ?>>Material reaproveitado</option>
													<option value="7"<? if($TIP_CONSTRUCAO_DOMIC == "7") echo(" selected"); ?>>Outro</option>
												</select>
											</td>
											<td class="label" width="113">Iluminação:&nbsp;&nbsp;</td>
											<td align="right">
												<select name="TIP_ILUMINACAO_DOMIC">
													<option value="1"<? if($TIP_ILUMINACAO_DOMIC == "1") echo(" selected"); ?>>Relógio próprio</option>
													<option value="2"<? if($TIP_ILUMINACAO_DOMIC == "2") echo(" selected"); ?>>Sem relógio</option>
													<option value="3"<? if($TIP_ILUMINACAO_DOMIC == "3") echo(" selected"); ?>>Relógio comunitário</option>
													<option value="4"<? if($TIP_ILUMINACAO_DOMIC == "4") echo(" selected"); ?>>Lampião</option>
													<option value="5"<? if($TIP_ILUMINACAO_DOMIC == "5") echo(" selected"); ?>>Vela</option>
													<option value="6"<? if($TIP_ILUMINACAO_DOMIC == "6") echo(" selected"); ?>>Cortada</option>
													<option value="7"<? if($TIP_ILUMINACAO_DOMIC == "7") echo(" selected"); ?>>Não tem</option>
													<option value="8"<? if($TIP_ILUMINACAO_DOMIC == "8") echo(" selected"); ?>>Outro</option>
												</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td class="label" width="30">Água:&nbsp;&nbsp;</td>
											<td class="label" width="150">Tratamento:&nbsp;&nbsp;</td>
											<td>
												<select name="TIP_TRATAMENTO_AGUA_DOMIC">
													<option value="1"<? if($TIP_TRATAMENTO_AGUA_DOMIC == "1") echo(" selected"); ?>>Filtração</option>
													<option value="2"<? if($TIP_TRATAMENTO_AGUA_DOMIC == "2") echo(" selected"); ?>>Fervura</option>
													<option value="3"<? if($TIP_TRATAMENTO_AGUA_DOMIC == "3") echo(" selected"); ?>>Cloração</option>
													<option value="4"<? if($TIP_TRATAMENTO_AGUA_DOMIC == "4") echo(" selected"); ?>>Sem abastecimento</option>
													<option value="5"<? if($TIP_TRATAMENTO_AGUA_DOMIC == "5") echo(" selected"); ?>>Outro</option>
												</select>
											</td>
											<td class="label" width="150">Abastecimento:&nbsp;&nbsp;</td>
											<td align="right">
												<select name="TIP_ABASTECIMENTO_AGUA_DOMIC">
													<option value="1"<? if($TIP_ABASTECIMENTO_AGUA_DOMIC == "1") echo(" selected"); ?>>Rede pública (Casan)</option>
													<option value="2"<? if($TIP_ABASTECIMENTO_AGUA_DOMIC == "2") echo(" selected"); ?>>Poço/nascente</option>
													<option value="3"<? if($TIP_ABASTECIMENTO_AGUA_DOMIC == "3") echo(" selected"); ?>>Carro pipa</option>
													<option value="4"<? if($TIP_ABASTECIMENTO_AGUA_DOMIC == "4") echo(" selected"); ?>>Encanada de terceiros</option>
													<option value="5"<? if($TIP_ABASTECIMENTO_AGUA_DOMIC == "5") echo(" selected"); ?>>Cortada</option>
												</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td class="label" width="134">Escoamento Sanitário:&nbsp;&nbsp;</td>
											<td>
												<select name="TIP_ESCOAMENTO_SANITARIO_DOMIC">
													<option value="1"<? if($TIP_ESCOAMENTO_SANITARIO_DOMIC == "1") echo(" selected"); ?>>Rede pública</option>
													<option value="2"<? if($TIP_ESCOAMENTO_SANITARIO_DOMIC == "2") echo(" selected"); ?>>Fossa rudimentar</option>
													<option value="3"<? if($TIP_ESCOAMENTO_SANITARIO_DOMIC == "3") echo(" selected"); ?>>Fossa séptica</option>
													<option value="4"<? if($TIP_ESCOAMENTO_SANITARIO_DOMIC == "4") echo(" selected"); ?>>Vala</option>
													<option value="5"<? if($TIP_ESCOAMENTO_SANITARIO_DOMIC == "5") echo(" selected"); ?>>Céu aberto</option>
													<option value="6"<? if($TIP_ESCOAMENTO_SANITARIO_DOMIC == "6") echo(" selected"); ?>>Outro</option>
												</select>
											</td>
											<td class="label" width="166">Destino do Lixo:&nbsp;&nbsp;</td>
											<td align="right">
												<select name="TIP_DESTINO_LIXO_DOMIC">
													<option value="1"<? if($TIP_DESTINO_LIXO_DOMIC == "1") echo(" selected"); ?>>Coletado</option>
													<option value="2"<? if($TIP_DESTINO_LIXO_DOMIC == "2") echo(" selected"); ?>>Queimado</option>
													<option value="3"<? if($TIP_DESTINO_LIXO_DOMIC == "3") echo(" selected"); ?>>Enterrado</option>
													<option value="4"<? if($TIP_DESTINO_LIXO_DOMIC == "4") echo(" selected"); ?>>Céu Aberto</option>
													<option value="5"<? if($TIP_DESTINO_LIXO_DOMIC == "5") echo(" selected"); ?>>Outro</option>
												</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td class="label" width="121">Estado do Domicílio:&nbsp;&nbsp;</td>
											<td>
												<select name="TIP_ESTADO_DOMIC">
													<option value="1"<? if($TIP_ESTADO_DOMIC == "1") echo(" selected"); ?>>Ruim</option>
													<option value="2"<? if($TIP_ESTADO_DOMIC == "2") echo(" selected"); ?>>Regular</option>
													<option value="3"<? if($TIP_ESTADO_DOMIC == "3") echo(" selected"); ?>>Bom</option>
												</select>
											</td>
											<td class="label" width="118">Via de Acesso:&nbsp;&nbsp;</td>
											<td align="right">
												<select name="TIP_VIA_ACESSO_DOMIC">
													<option value="1"<? if($TIP_VIA_ACESSO_DOMIC == "1") echo(" selected"); ?>>Rua pavimentada</option>
													<option value="2"<? if($TIP_VIA_ACESSO_DOMIC == "2") echo(" selected"); ?>>Rua não pavimentada</option>
													<option value="3"<? if($TIP_VIA_ACESSO_DOMIC == "3") echo(" selected"); ?>>Acesso por propriedade particular</option>
													<option value="4"<? if($TIP_VIA_ACESSO_DOMIC == "4") echo(" selected"); ?>>Beco</option>
												</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td class="label" width="182">Existem próximas ao domicílio:&nbsp;&nbsp;</td>
											<td class="label">Creches:&nbsp;&nbsp;</td>
											<td width="5"><input type="checkbox" name="COD_CRECHE_DOMIC"<? if($COD_CRECHE_DOMIC == "s") echo(" checked"); ?>></td>
											<td class="label">Escolas:&nbsp;&nbsp;</td>
											<td width="5"><input type="checkbox" name="COD_ESCOLA_DOMIC"<? if($COD_ESCOLA_DOMIC == "s") echo(" checked"); ?>></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<td class="label" width="116">Tempo de Moradia:&nbsp;&nbsp;</td>
										<td class="label" width="60">Anos:&nbsp;&nbsp;</td>
										<td><input type="text" name="QTD_TEMPO_MORAR_ANOS_PESSOA" value="<?=$QTD_TEMPO_MORAR_ANOS_PESSOA?>"  maxlength="3" class="caixa_texto" style="width:100%;"></td>
										<td class="label" width="60">Meses:&nbsp;&nbsp;</td>
										<td><input type="text" name="QTD_TEMPO_MORAR_MESES_PESSOA" value="<?=$QTD_TEMPO_MORAR_MESES_PESSOA?>"  maxlength="2" class="caixa_texto" style="width:100%;"></td>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td class="label" width="30">Banheiro:&nbsp;&nbsp;</td>
											<td>
												<select name="TIP_BANHEIRO_DOMIC">
													<option value="1"<? if($TIP_BANHEIRO_DOMIC == "1") echo(" selected"); ?>>Dentro da casa</option>
													<option value="2"<? if($TIP_BANHEIRO_DOMIC == "2") echo(" selected"); ?>>Fora da casa</option>
													<option value="3"<? if($TIP_BANHEIRO_DOMIC == "3") echo(" selected"); ?>>Não possui</option>
												</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td align="right">
									<input type="submit" class="botao_aqua" value="Proxima >>">
								</td>
							</tr>
								<input type="hidden" name="DOMICILIO" value="<?=$DOMICILIO?>">
								<input type="hidden" name="modo" value="<? if($update) echo('update'); else echo('add');?>">
							</form>
						</table>
					<? termina_quadro_branco(); ?>
				</td>
			</tr>
		</table>
	<script language="javascript">
		document.forms[0].elements[0].focus();
	</script>
<? termina_pagina(); ?>
