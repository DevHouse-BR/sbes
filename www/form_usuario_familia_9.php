<?
	require("includes/funcoes_layout.php");
	
	$DOMICILIO = $_REQUEST["DOMICILIO"];
	$PESSOA = $_REQUEST["PESSOA"];
	
	require("includes/conectar_mysql.php");
	$query = "SELECT NOM_PESSOA, DATE_FORMAT(DTA_NASC_PESSOA,'%d/%m/%Y') as DTA_NASC_PESSOA, COD_SEXO_PESSOA, NUM_NIS_PESSOA, NUM_CPF_PESSOA, NUM_IDENTIDADE_PESSOA, TXT_COMPLEMENTO_PESSOA, DATE_FORMAT(DTA_EMISSAO_IDENT_PESSOA,'%d/%m/%Y') as DTA_EMISSAO_IDENT_PESSOA, SIG_UF_IDENT_PESSOA, SIG_ORGAO_EMISSAO_PESSOA FROM pessoa_1 WHERE DOMICILIO=" . $DOMICILIO . " AND PESSOA=" . $PESSOA;
	$result = mysql_query($query) or tela_erro("Erro ao Ler registros do Banco de dados: " . mysql_error());
	$registro = mysql_fetch_assoc($result);
	$NOM_PESSOA = $registro["NOM_PESSOA"];
	$DTA_NASC_PESSOA = $registro["DTA_NASC_PESSOA"];
	$COD_SEXO_PESSOA = $registro["COD_SEXO_PESSOA"];
	$NUM_NIS_PESSOA = $registro["NUM_NIS_PESSOA"];
	$NUM_CPF_PESSOA = $registro["NUM_CPF_PESSOA"];
	$NUM_IDENTIDADE_PESSOA = $registro["NUM_IDENTIDADE_PESSOA"];
	$TXT_COMPLEMENTO_PESSOA = $registro["TXT_COMPLEMENTO_PESSOA"];
	$DTA_EMISSAO_IDENT_PESSOA = $registro["DTA_EMISSAO_IDENT_PESSOA"];
	$SIG_UF_IDENT_PESSOA = $registro["SIG_UF_IDENT_PESSOA"];
	$SIG_ORGAO_EMISSAO_PESSOA = $registro["SIG_ORGAO_EMISSAO_PESSOA"];
	
	require("includes/desconectar_mysql.php");
	
	inicia_pagina();
	monta_menu_abas("operador");
	inicia_tabela_conteudo();
	?>
	<script language="javascript">
		function janela_programa(modo,programa){
			void window.open('form_programa_social_pessoa.php?DOMICILIO=<?=$DOMICILIO?>&PESSOA=<?=$PESSOA?>&modo=' + modo + '&programa_social=' + programa, '_blank', 'width=360,height=166,status=no,resizable=no,top=20,left=100');
		}
	</script>
	<table width="100%">
		<tr>
			<td width="50"><a href="form_usuario_familia_4.php?DOMICILIO=<?=$DOMICILIO?>"><img title="Voltar para Ficha do Domicilio" border="0" onMouseOver="this.src = 'imagens/voltar_domicilio_over.gif';" onMouseOut="this.src = 'imagens/voltar_domicilio_out.gif';" src="imagens/voltar_domicilio_out.gif"></a></td>
			<td class="conteudo_quadro_claro" valign="middle" style="padding-top: 12px;"><? monta_titulo_secao("Ficha de " . $NOM_PESSOA); ?></td>
			<td width="50"></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<form action="manter_usuario_sistema.php" method="post">
	<div style="width: 100%; vertical-align: top;">
		<span style="width: 60%;">
		<? inicia_quadro_escuro('width="100%"', '<a href="form_usuario_familia_5.php?DOMICILIO=' . $DOMICILIO . '&PESSOA=' . $PESSOA . '"><img title="Alterar Informações" border="0" align="absmiddle" src="imagens/editar.gif"></a>&nbsp;&nbsp;Informa&ccedil;&otilde;es da Pessoa'); ?>
			<table width="100%" border="0" cellpadding="2" cellspacing="3" class="conteudo_quadro_claro">
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" width="100%" class="conteudo_quadro_claro">
							<tr>
								<td width="40" class="label">Nome:</td>
								<td width="10">&nbsp;</td>
								<td><?=$NOM_PESSOA?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" width="100%" class="conteudo_quadro_claro">
							<tr>
								<td width="120" class="label">Data de Nascimento:</td>
								<td width="10">&nbsp;</td>
								<td width=""><?=$DTA_NASC_PESSOA?></td>
								<td width="10">&nbsp;</td>
								<td class="label" width="">Sexo:</td>
								<td width="10">&nbsp;</td>
								<td width="20"><?=$COD_SEXO_PESSOA?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" width="100%" class="conteudo_quadro_claro">
							<tr>
								<td width="140" class="label">N&ordm; Identificação Social:</td>
								<td width="10">&nbsp;</td>
								<td width=""><?=$NUM_NIS_PESSOA?></td>
								<td width="10">&nbsp;</td>
								<td class="label" width="20">CPF:</td>
								<td width="10">&nbsp;</td>
								<td><?=$NUM_CPF_PESSOA?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" width="100%" class="conteudo_quadro_claro">
							<tr>
								<td width="120" class="label">Identidade:</td>
								<td width="30%"><?=$$NUM_IDENTIDADE_PESSOA?>&nbsp;<?=$TXT_COMPLEMENTO_PESSOA?></td>
								<td width="40%"><? echo($SIG_ORGAO_EMISSAO_PESSOA); if(strlen($SIG_UF_IDENT_PESSOA)>0) echo("/" . $SIG_UF_IDENT_PESSOA); ?></td>
								<td width="10%"><?=$DTA_EMISSAO_IDENT_PESSOA?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td colspan="2" style="font-size:0px;">&nbsp;</td></tr>
			</table>
		<? termina_quadro_escuro(); ?>
		</span>
		<span style="width: 40%; position: absolute;">
			<? inicia_quadro_branco('width="100%"', 'Opções'); ?>
			<table width="100%">
				<tr>
					<td><a href="busca_historico.php?DOMICILIO=<?=$DOMICILIO?>&PESSOA=<?=$PESSOA?>"><img title="Histórico" border="0" onMouseOver="this.src = 'imagens/historico_over.gif';" onMouseOut="this.src = 'imagens/historico_out.gif';" src="imagens/historico_out.gif"></a></td>
					<?
					require("includes/conectar_mysql.php");
					$query = "SELECT COUNT(*) FROM pessoa_programa_social WHERE PESSOA=" . $PESSOA;
					$result = mysql_query($query) or tela_erro("Erro ao Ler registros do Banco de dados: " . mysql_error());
					$registro = mysql_fetch_row($result);
					if($registro[0] < 1){
						?>
						<td width="25%"><a href="#" onClick="alert('A pessoa deve estar associada a um programa social primeiro!');"><img title="Registrar o recebimento de um benefício" border="0" onMouseOver="this.src = 'imagens/icone_rec_beneficio_over.gif';" onMouseOut="this.src = 'imagens/icone_rec_beneficio_out.gif';" src="imagens/icone_rec_beneficio_out.gif"></a></td>
						<?
					}
					else{
						$query = "SELECT COUNT(*) FROM pessoa_programa_social pps, usuario_programa_social ups WHERE pps.PESSOA=" . $PESSOA . " AND ups.programa_social=pps.programa_social AND ups.usuario=" . $_SESSION["cd_usuario"];
						$result = mysql_query($query) or tela_erro("Erro ao Ler registros do Banco de dados: " . mysql_error());
						$registro = mysql_fetch_row($result);
						if($registro[0] < 1){
							?>
							<td width="25%"><a href="#" onClick="alert('Você não tem permissões para conceber benefícios para os programas sociais relacionados a esta pessoa!');"><img title="Registrar o recebimento de um benefício" border="0" onMouseOver="this.src = 'imagens/icone_rec_beneficio_over.gif';" onMouseOut="this.src = 'imagens/icone_rec_beneficio_out.gif';" src="imagens/icone_rec_beneficio_out.gif"></a></td>
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
					<td width="25%"><a href="javascript: janela_programa('add');"><img title="Adicionar a pessoa a um Programa Social" border="0" onMouseOver="this.src = 'imagens/novo_programa_social_over.gif';" onMouseOut="this.src = 'imagens/novo_programa_social_out.gif';" src="imagens/novo_programa_social_out.gif"></a></td>
					<td width="25%"><a href="form_usuario_familia_7.php?DOMICILIO=<?=$DOMICILIO?>&PESSOA=<?=$PESSOA?>"><img title="Informações Sócio-econômicas da pessoa" border="0" onMouseOver="this.src = 'imagens/icone_info_socio_economica_over.gif';" onMouseOut="this.src = 'imagens/icone_info_socio_economica_out.gif';" src="imagens/icone_info_socio_economica_out.gif"></a></td>
					<td><input type="button" value="Salvar" class="botao_aqua"></td>
				</tr>
			</table>
			<? termina_quadro_branco(); ?>
		</span>
	</div>
	<?	
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
	$query .= "CONCAT('<a href=\"javascript: janela_programa(\'update\'\,', d.programa_social, ');', '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as editar, ";
	$query .= "ps.descricao, DATE_FORMAT(d.dt_inicio,'%d/%m/%Y') as dt_inicio, DATE_FORMAT(d.dt_termino,'%d/%m/%Y') as dt_termino, ";
	$query .= "CONCAT('<a href=\"javascript: apagar_programa(', d.programa_social , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
	$query .= " from programa_social ps, pessoa_programa_social d";	
	$query .= " WHERE ps.cd=d.programa_social AND d.PESSOA=" . $PESSOA;
	$ordem = " ORDER BY ps.descricao";
	?>
	<script language="javascript">
		function apagar_programa(programa){
			if(confirm("Deseja remover esta pessoa do programa social?"))
				window.location = 'salva_programa_social_pessoa.php?modo=apagar&DOMICILIO=<?=$DOMICILIO?>&PESSOA=<?=$PESSOA?>&programa_social=' + programa;
		}
	</script>
	<? 
	browser($query, $colunas, $string, 'Programas Sociais', $ordem, 50); 
	termina_pagina(); ?>
