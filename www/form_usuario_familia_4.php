<?
	require("includes/funcoes_layout.php");
	
	$DOMICILIO = $_REQUEST["DOMICILIO"];
	require("includes/conectar_mysql.php");
	$query = "SELECT * FROM domicilio_1 WHERE DOMICILIO=" . $DOMICILIO;
	$result = mysql_query($query) or tela_erro("Erro ao Ler registros do Banco de dados: " . mysql_error());
	$registro = mysql_fetch_assoc($result);
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
	
	inicia_pagina();
	monta_menu_abas("operador");
	inicia_tabela_conteudo();
	?>
	<script language="javascript">
		function janela_programa(modo,programa){
			void window.open('form_programa_social_domicilio.php?DOMICILIO=<?=$DOMICILIO?>&modo=' + modo + '&programa_social=' + programa, '_blank', 'width=360,height=166,status=no,resizable=no,top=20,left=100');
		}
	</script>
	<table width="100%">
		<tr>
			<td width="50"><a href="busca_usuario_familia.php"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<td class="conteudo_quadro_claro" valign="middle" style="padding-top: 12px;"><? monta_titulo_secao("Ficha do Domic&iacute;lio"); ?></td>
			<td width="50"></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<form action="manter_usuario_sistema.php" method="post">
	<table>
		<tr>
			<td width="60%">
				<? inicia_quadro_escuro('width="100%"', '<a href="form_usuario_familia_1.php?DOMICILIO=' . $DOMICILIO . '"><img title="Alterar Informações" border="0" align="absmiddle" src="imagens/editar.gif"></a>&nbsp;&nbsp;Informa&ccedil;&otilde;es do Domic&iacute;lio'); ?>
					<table width="100%" border="0" cellpadding="2" cellspacing="3" class="conteudo_quadro_claro">
						<tr>
							<td width="110" class="label">Codigo Domiciliar:</td>
							<td><?=$COD_DOMICILIAR?></td>
						</tr>
						<tr>
							<td class="label">Logradouro:</td>
							<td>
								<table cellpadding="0" cellspacing="0" width="100%" class="conteudo_quadro_claro">
									<tr>
										<td width="5%"><?=$TIP_LOGRAD_DOMIC?></td>
										<td width="5%">&nbsp;</td>
										<td width="90%"><?=$NOM_LOGRADOURO_DOMIC?>, <?=$NUM_RESIDENCIA_DOMIC?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class="label">Complemento:</td>
							<td><?=$NOM_COMPL_RESIDENCIA_DOMIC?></td>
						</tr>
						<tr>
							<td class="label">Bairro:</td>
							<td>
								<table cellpadding="0" cellspacing="0" width="100%" class="conteudo_quadro_claro">
									<tr>
										<td width="45%"><?=$NOM_BAIRRO_RESIDENCIA_DOMIC?></td>
										<td width="5%">&nbsp;</td>
										<td width="5%" class="label">CEP:&nbsp;</td>
										<td width="45%"><?=$CEP_RESIDENCIA_DOMIC?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class="label">Cidade:&nbsp;</td>
							<td>
								<table cellpadding="0" cellspacing="0" width="100%" class="conteudo_quadro_claro">
									<tr>
										<td width="55%"><?=$NOM_LOCALIDADE_DOMIC?></td>
										<td width="5%">&nbsp;</td>
										<td width="5%" class="label">Estado:&nbsp;</td>
										<td width="35%"><?=$SIG_UF_RESIDENCIA_DOMIC?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class="label">Telefone Contato:</td>
							<td>
								<table cellpadding="0" cellspacing="0" width="100%" class="conteudo_quadro_claro">
									<tr>
										<td width="5%"><?=$COD_DDD_RESIDENCIA_DOMIC?></td>
										<td width="45%"><?=$NUM_TEL_CONTATO_DOMIC?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr><td colspan="2" style="font-size:0px;">&nbsp;</td></tr>
					</table>
				<? termina_quadro_escuro(); ?>
			</td>
			<td valign="top">
				<? inicia_quadro_branco('width="100%"', 'Ações'); ?>
					<table width="100%">
						<tr>
							<td><a href="busca_historico.php?DOMICILIO=<?=$DOMICILIO?>"><img title="Histórico" border="0" onMouseOver="this.src = 'imagens/historico_over.gif';" onMouseOut="this.src = 'imagens/historico_out.gif';" src="imagens/historico_out.gif"></a></td>
							<?
							require("includes/conectar_mysql.php");
							$query = "SELECT COUNT(*) FROM domicilio_programa_social WHERE DOMICILIO=" . $DOMICILIO;
							$result = mysql_query($query) or tela_erro("Erro ao Ler registros do Banco de dados: " . mysql_error());
							$registro = mysql_fetch_row($result);
							if($registro[0] < 1){
								?>
								<td width="25%"><a href="#" onClick="alert('O domicílio deve estar associada a um programa social primeiro!');"><img title="Registrar o recebimento de um benefício" border="0" onMouseOver="this.src = 'imagens/icone_rec_beneficio_over.gif';" onMouseOut="this.src = 'imagens/icone_rec_beneficio_out.gif';" src="imagens/icone_rec_beneficio_out.gif"></a></td>
								<?
							}
							else{
								$query = "SELECT COUNT(*) FROM domicilio_programa_social dps, usuario_programa_social ups WHERE dps.DOMICILIO=" . $DOMICILIO . " AND ups.programa_social=dps.programa_social AND ups.usuario=" . $_SESSION["cd_usuario"];
								$result = mysql_query($query) or tela_erro("Erro ao Ler registros do Banco de dados: " . mysql_error());
								$registro = mysql_fetch_row($result);
								if($registro[0] < 1){
									?>
									<td width="25%"><a href="#" onClick="alert('Você não tem permissões para conceber benefícios para os programas sociais relacionados a este domicílio!');"><img title="Registrar o recebimento de um benefício" border="0" onMouseOver="this.src = 'imagens/icone_rec_beneficio_over.gif';" onMouseOut="this.src = 'imagens/icone_rec_beneficio_out.gif';" src="imagens/icone_rec_beneficio_out.gif"></a></td>
									<?
								}
								else{
									?>
									<td width="25%"><a href="busca_beneficio.php?DOMICILIO=<?=$DOMICILIO?>&PESSOA=<?=$PESSOA?>"><img title="Registrar o recebimento de um benefício" border="0" onMouseOver="this.src = 'imagens/icone_rec_beneficio_over.gif';" onMouseOut="this.src = 'imagens/icone_rec_beneficio_out.gif';" src="imagens/icone_rec_beneficio_out.gif"></a></td>
									<?
								}
							}
							require("includes/desconectar_mysql.php");
							?>
							<td><a href="javascript: janela_programa('add');"><img title="Adicionar o Domicílio a um Programa Social" border="0" onMouseOver="this.src = 'imagens/novo_programa_social_over.gif';" onMouseOut="this.src = 'imagens/novo_programa_social_out.gif';" src="imagens/novo_programa_social_out.gif"></a></td>
							<td><a href="form_usuario_familia_2.php?DOMICILIO=<?=$DOMICILIO?>"><img title="Informações Sócio-econômicas do Domicílio" border="0" onMouseOver="this.src = 'imagens/icone_info_socio_economica_over.gif';" onMouseOut="this.src = 'imagens/icone_info_socio_economica_out.gif';" src="imagens/icone_info_socio_economica_out.gif"></a></td>
							<td><a href="form_usuario_familia_5.php?DOMICILIO=<?=$DOMICILIO?>"><img title="Adiciona Pessoa ao Domicílio" border="0" onMouseOver="this.src = 'imagens/novo_usuario_sistema_over.gif';" onMouseOut="this.src = 'imagens/novo_usuario_sistema_out.gif';" src="imagens/novo_usuario_sistema_out.gif"></a></td>
						</tr>
					</table>
				<? termina_quadro_branco(); ?>
			</td>
		</tr>
	</table>
	<? 
	$colunas[0]['largura'] = "5%";
	$colunas[0]['label'] = "";
	$colunas[0]['alinhamento'] = "left";
	
	$colunas[1]['largura'] = "69%";
	$colunas[1]['label'] = "Nome";
	$colunas[1]['alinhamento'] = "left";
	
	$colunas[2]['largura'] = "20%";
	$colunas[2]['label'] = "Nascimento";
	$colunas[2]['alinhamento'] = "left";
	
	$colunas[3]['largura'] = "3%";
	$colunas[3]['label'] = "&nbsp;";
	$colunas[3]['alinhamento'] = "right";

	$colunas[4]['largura'] = "3%";
	$colunas[4]['label'] = "&nbsp;";
	$colunas[4]['alinhamento'] = "right";
	
	$query = "SELECT ";
	$query .= "CONCAT('<a title=\"Editar\" href=\"form_usuario_familia_9.php?DOMICILIO=" . $DOMICILIO . "&PESSOA=', p1.PESSOA , '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as etapas, ";
	$query .= "p1.NOM_PESSOA , DATE_FORMAT(p1.DTA_NASC_PESSOA,'%d/%m/%Y') as DTA_NASC_PESSOA, ";
	$query .= "CASE p1.SIT_PESSOA  WHEN 's' THEN CONCAT('<a title=\"Desativar\" href=\"javascript: altera_estado(\'n\',', p1.PESSOA , ');\"><img border=\"0\" src=\"imagens/ativo.gif\"></a>') WHEN 'n' THEN CONCAT('<a title=\"Ativar\" href=\"javascript: altera_estado(\'s\',', p1.PESSOA , ');\"><img border=\"0\" src=\"imagens/inativo.gif\"></a>') END, ";
	$query .= "CONCAT('<a title=\"Apagar\" href=\"javascript: apagar(', p1.PESSOA , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
	$query .= " from pessoa_1 p1";	
	$query .= " WHERE p1.DOMICILIO=" . $DOMICILIO;

	$ordem = " ORDER BY p1.NOM_PESSOA";
	?>
	<script language="javascript">
		function altera_estado(novo, cd){
			if(novo == 's') estado = 'ativo?';
			if(novo == 'n') estado = 'inativo?';
			if(confirm("Deseja mudar o estado da pessoa para " + estado))
				window.location = 'salva_usuario_familia_5.php?modo=ativo&DOMICILIO=<?=$DOMICILIO?>&SIT_PESSOA=' + novo + '&PESSOA=' + cd;
		}
		function apagar(usuario){
			if(confirm("Deseja remover esta pessoa do domicilio?"))
				window.location = 'salva_usuario_familia_5.php?modo=apagar&DOMICILIO=<?=$DOMICILIO?>&PESSOA=' + usuario;
		}
	</script>
	<? 
	browser($query, $colunas, $string, 'Pessoas no domicílio', $ordem, 50);
	
	############################################################################################################
	 
	$colunas[0]['largura'] = "5%";
	$colunas[0]['label'] = "";
	$colunas[0]['alinhamento'] = "left";
	
	$colunas[1]['largura'] = "45%";
	$colunas[1]['label'] = "Programa Social";
	$colunas[1]['alinhamento'] = "left";
	
	$colunas[2]['largura'] = "25%";
	$colunas[2]['label'] = "Data de Início";
	$colunas[2]['alinhamento'] = "left";
	
	$colunas[3]['largura'] = "25%";
	$colunas[3]['label'] = "Data de Término";
	$colunas[3]['alinhamento'] = "left";

	$colunas[4]['largura'] = "3%";
	$colunas[4]['label'] = "&nbsp;";
	$colunas[4]['alinhamento'] = "right";
	
	$query = "SELECT ";
	$query .= "CONCAT('<a title=\"Editar\" href=\"javascript: janela_programa(\'update\'\,', d.programa_social, ');', '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as editar, ";
	$query .= "ps.descricao, DATE_FORMAT(d.dt_inicio,'%d/%m/%Y') as dt_inicio, DATE_FORMAT(d.dt_termino,'%d/%m/%Y') as dt_termino, ";
	$query .= "CONCAT('<a title=\"Apagar\" href=\"javascript: apagar_programa(', d.programa_social , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
	$query .= " from programa_social ps, domicilio_programa_social d";	
	$query .= " WHERE ps.cd=d.programa_social AND d.DOMICILIO=" . $DOMICILIO;
	$ordem = " ORDER BY ps.descricao";
	?>
	<script language="javascript">
		function apagar_programa(programa){
			if(confirm("Deseja remover este programa do domicilio?"))
				window.location = 'salva_programa_social_domicilio.php?modo=apagar&DOMICILIO=<?=$DOMICILIO?>&programa_social=' + programa;
		}
	</script>
	<? 
	browser($query, $colunas, $string, 'Programas Sociais', $ordem, 50); 
	termina_pagina(); ?>
