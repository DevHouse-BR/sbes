<?
######################################################################################################################################
session_start();
error_reporting(E_ERROR | E_PARSE);
function inicia_pagina(){
	?>
	<html>
		<head>
			<title>.:: Projeto Social Futura – Gestão Social ::.</title>
			<link rel="stylesheet" href="includes/estilo.css">
		</head>
		<body>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center">
						<table width="775" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="28" height="99" background="imagens/lateral_esq_site.gif">&nbsp;</td>
								<td bgcolor="#FFFFFF"><a target="_blank" href="http://www.joinville.sc.gov.br/"><img border="0" src="imagens/cabecalho.jpg" align="texttop"></a></td>
								<td width="28" background="imagens/lateral_dir_site.gif">&nbsp;</td>
							</tr>
							<tr>
								<td width="28" background="imagens/lateral_esq_site.gif">&nbsp;</td>
								<td bgcolor="#ADC1E6" valign="top">
									<br>
	<?
}

######################################################################################################################################

function inicia_pagina_sem_cabec(){
	?>
	<html>
		<head>
			<title>.:: Projeto Social Futura – Gestão Social ::.</title>
			<link rel="stylesheet" href="includes/estilo.css">
		</head>
		<body>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="28" background="imagens/lateral_esq_site.gif">&nbsp;</td>
								<td bgcolor="#ADC1E6" valign="top">
	<?
}

######################################################################################################################################

function inicia_tabela_conteudo(){
	?>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td width="4" background="imagens/lateral_esq_tabela.gif">&nbsp;</td>
			<td bgcolor="#FFFFFF" class="conteudo" style="padding: 10px;">
	<?
}

######################################################################################################################################

function termina_pagina(){	?>
												<br>
											</td>
											<td width="4" background="imagens/lateral_dir_tabela.gif">&nbsp;</td>
										</tr>
										<tr>
											<td width="4" height="4" background="imagens/canto_inf_esq_tabela.gif"></td>
											<td height="4" background="imagens/lateral_inf_tabela.gif"></td>
											<td width="4" background="imagens/canto_inf_dir_tabela.gif"></td>
										</tr>
									</table>
								</td>
								<td width="28" background="imagens/lateral_dir_site.gif">&nbsp;</td>
							</tr>
							<tr>
								<td width="28" height="30" background="imagens/canto_inf_esq_site.gif">&nbsp;</td>
								<td background="imagens/lateral_inf_site.gif">&nbsp;</td>
								<td width="28" background="imagens/canto_inf_dir_site.gif">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</body>
	</html>
	<?
}

######################################################################################################################################

function inicia_quadro_claro($parametros, $titulo){
	?>
	<table cellpadding="0" cellspacing="0" <?=$parametros?>>
		<tr>
			<td width="30" height="34" background="imagens/canto_sup_esq_quadro_claro.gif"></td>
			<td background="imagens/lateral_sup_quadro_claro.gif" class="conteudo_quadro_claro" style="vertical-align:middle;"><b><?=$titulo?></b></td>
			<td width="36" background="imagens/canto_sup_dir_quadro_claro.gif"></td>
		</tr>
		<tr>
			<td width="24" background="imagens/lateral_esq_quadro_claro.gif"></td>
			<td bgcolor="#E8F2FF" class="conteudo_quadro_claro">
	<?
}

######################################################################################################################################

function termina_quadro_claro(){
	?>
		</td>
			<td width="36" background="imagens/lateral_dir_quadro_claro.gif"></td>
		</tr>
		<tr>
			<td width="24" height="37" background="imagens/canto_inf_esq_quadro_claro.gif"></td>
			<td background="imagens/lateral_inf_quadro_claro.gif"></td>
			<td width="36" height="37" background="imagens/canto_inf_dir_quadro_claro.gif"></td>
		</tr>
	</table>
	<?
}

######################################################################################################################################

function inicia_quadro_escuro($parametros,$titulo){
	?>
	<table cellpadding="0" cellspacing="0" border="0" <?=$parametros?>>
		<tr>
			<td width="35" height="44" background="imagens/canto_sup_esq_quadro_escuro.jpg"></td>
			<td background="imagens/lateral_sup_quadro_escuro.jpg" class="cabecalho_quadro_escuro"><?=$titulo?></td>
			<td width="37" background="imagens/canto_sup_dir_quadro_escuro.jpg"></td>
		</tr>
		<tr>
			<td width="35" background="imagens/lateral_esq_quadro_escuro.jpg"></td>
			<td bgcolor="#E8F2FF" class="conteudo_quadro_claro">
	<?
}

######################################################################################################################################

function termina_quadro_escuro(){
	?>
		</td>
			<td width="37" background="imagens/lateral_dir_quadro_escuro.jpg"></td>
		</tr>
		<tr>
			<td width="35" height="38" background="imagens/canto_inf_esq_quadro_escuro.jpg"></td>
			<td background="imagens/lateral_inf_quadro_escuro.jpg"></td>
			<td width="37" height="38" background="imagens/canto_inf_dir_quadro_escuro.jpg"></td>
		</tr>
	</table>
	<?
}

######################################################################################################################################

function inicia_quadro_branco($parametros,$titulo){
	?>
	<table cellpadding="0" cellspacing="0" border="0" <?=$parametros?>>
		<tr>
			<td width="30" height="28" background="imagens/canto_sup_esq_quadro_branco.gif"></td>
			<td class="titulo_quadro_branco"><?=$titulo?></td>
			<td width="29" background="imagens/canto_sup_dir_quadro_branco.gif"></td>
		</tr>
		<tr>
			<td width="30" background="imagens/lateral_esq_quadro_branco.gif"></td>
			<td bgcolor="#FFFFFF" class="conteudo_quadro_branco">
	<?
}

######################################################################################################################################

function termina_quadro_branco(){
	?>
			</td>
			<td width="29" background="imagens/lateral_dir_quadro_branco.gif"></td>
		</tr>
		<tr>
			<td width="30" height="27" background="imagens/canto_inf_esq_quadro_branco.gif"></td>
			<td background="imagens/lateral_inf_quadro_branco.gif"></td>
			<td width="29" height="27" background="imagens/canto_inf_dir_quadro_branco.gif"></td>
		</tr>
	</table>
	<?
}

######################################################################################################################################

function inicia_pagina_login(){
	?>
	<html>
		<head>
			<title>.:: Projeto Social Futura – Gestão Social ::.</title>
			<link rel="stylesheet" href="includes/estilo.css">
		</head>
		<body onLoad="document.forms[0].usuario.focus();">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center">
						<table width="775" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="28" height="99" background="imagens/lateral_esq_site.gif">&nbsp;</td>
								<td bgcolor="#FFFFFF"><a target="_blank" href="http://www.joinville.sc.gov.br/"><img border="0" src="imagens/cabecalho.jpg" align="texttop"></a></td>
								<td width="28" background="imagens/lateral_dir_site.gif">&nbsp;</td>
							</tr>
							<tr>
								<td background="imagens/lateral_esq_site.gif">&nbsp;</td>
								<td bgcolor="#ADC1E6" valign="top">
									<br>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td width="130">
												<table width="130" height="38" cellpadding="0" cellspacing="0" border="0">
													<tr>
														<td width="16" height="12" background="imagens/canto_sup_esq_aba.gif"></td>
														<td background="imagens/lateral_sup_aba.gif"></td>
														<td width="16" background="imagens/canto_sup_dir_aba.gif"></td>
													</tr>
													<tr>
														<td width="16" background="imagens/lateral_esq_aba.gif"></td>
														<td bgcolor="#FFFFFF" align="center"><span class="aba_ativa">Login</span></td>
														<td width="14" background="imagens/lateral_dir_aba_2.gif"></td>
													</tr>
													<tr>
														<td width="16" height="3" background="imagens/lateral_esq_aba.gif"></td>
														<td bgcolor="#FFFFFF"></td>
														<td width="16" background="imagens/lateral_dir_aba_3.gif"></td>
													</tr>
												</table>
											</td>
																						
											<td style="border-bottom: 3px solid #304D9D;">&nbsp;</td>
											<td width="4">
												<table width="4" height="38" cellpadding="0" cellspacing="0">
													<tr>
														<td></td>
													</tr>
													<tr>
														<td width="4" height="3" background="imagens/canto_sup_dir_tabela.gif"></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td width="4" background="imagens/lateral_esq_tabela.gif">&nbsp;</td>
											<td bgcolor="#FFFFFF" class="conteudo" style="padding: 10px;">
	<?
}

######################################################################################################################################

function monta_menu_abas($aba_atual){
	echo('<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr>');
	switch($aba_atual){
		case "operador":
			if($_SESSION["operador"] == 's'){
				monta_aba_branca_comeco("Operador");
				if($_SESSION["assistente_social"] == 's') monta_aba_azul_entre_azuis("Assistente Social","home.php?aba=assistente");
				else monta_aba_azul_entre_azuis("Assistente Social");
				
				if($_SESSION["secretario"] == 's') monta_aba_azul_entre_azuis("Secret&aacute;rio","home.php?aba=secretario");
				else monta_aba_azul_entre_azuis("Secret&aacute;rio");
				
				if($_SESSION["administrador"] == 's') monta_aba_azul_entre_azuis("Administrador","home.php?aba=administrador");
				else monta_aba_azul_entre_azuis("Administrador");
				
				monta_aba_azul_final("Usu&aacute;rio","form_usuario_sistema.php?cd=" . $_SESSION["cd_usuario"]);
				
				monta_espaco_sem_aba();
				break;
			}
			else {
				$aba_atual = "assistente";
			}
		case "assistente":
			if($_SESSION["assistente_social"] == 's'){
				if($_SESSION["operador"] == 's') monta_aba_azul_comeco_antes_branca("Operador","home.php?aba=operador");
				else monta_aba_azul_comeco_antes_branca("Operador");
				
				monta_aba_branca_entre_azuis("Assistente Social");
				
				if($_SESSION["secretario"] == 's') monta_aba_azul_entre_azuis("Secret&aacute;rio","home.php?aba=secretario");
				else monta_aba_azul_entre_azuis("Secret&aacute;rio");
				
				if($_SESSION["administrador"] == 's') monta_aba_azul_entre_azuis("Administrador","home.php?aba=administrador");
				else monta_aba_azul_entre_azuis("Administrador");
				
				monta_aba_azul_final("Usu&aacute;rio","form_usuario_sistema.php?cd=" . $_SESSION["cd_usuario"]);
				
				monta_espaco_sem_aba();
				break;
			}
			else {
				$aba_atual = "secretario";
			}
		case "secretario":
			if($_SESSION["secretario"] == 's'){
				if($_SESSION["operador"] == 's') monta_aba_azul_comeco_antes_azul("Operador","home.php?aba=operador");
				else monta_aba_azul_comeco_antes_azul("Operador");
				
				if($_SESSION["assistente_social"] == 's') monta_aba_azul_antes_branca("Assistente Social","home.php?aba=assistente");
				else monta_aba_azul_antes_branca("Assistente Social");
				
				monta_aba_branca_entre_azuis("Secret&aacute;rio","home.php?aba=secretario");
				
				if($_SESSION["administrador"] == 's') monta_aba_azul_entre_azuis("Administrador","home.php?aba=administrador");
				else monta_aba_azul_entre_azuis("Administrador");
				
				monta_aba_azul_final("Usu&aacute;rio","form_usuario_sistema.php?cd=" . $_SESSION["cd_usuario"]);
				
				monta_espaco_sem_aba();
				break;
			}
			else {
				$aba_atual = "administrador";
			}
		case "administrador":
			if($_SESSION["administrador"] == 's'){
				if($_SESSION["operador"] == 's') monta_aba_azul_comeco_antes_azul("Operador","home.php?aba=operador");
				else monta_aba_azul_comeco_antes_azul("Operador");
				
				if($_SESSION["assistente_social"] == 's') monta_aba_azul_entre_azuis("Assistente Social","home.php?aba=assistente");
				else monta_aba_azul_entre_azuis("Assistente Social");
				
				if($_SESSION["secretario"] == 's') monta_aba_azul_antes_branca("Secret&aacute;rio","home.php?aba=secretario");
				else monta_aba_azul_antes_branca("Assistente Social");
				
				monta_aba_branca_entre_azuis("Administrador");
				monta_aba_azul_final("Usu&aacute;rio","form_usuario_sistema.php?cd=" . $_SESSION["cd_usuario"]);
				monta_espaco_sem_aba();
				break;
			}
			else tela_erro("Você não tem permissão para ver este documento!");
		case "usuario":
			if($_SESSION["operador"] == 's') monta_aba_azul_comeco_antes_azul("Operador","home.php?aba=operador");
			else monta_aba_azul_comeco_antes_azul("Operador");
			
			if($_SESSION["assistente_social"] == 's') monta_aba_azul_entre_azuis("Assistente Social","home.php?aba=assistente");
			else monta_aba_azul_entre_azuis("Assistente Social");
			
			if($_SESSION["secretario"] == 's') monta_aba_azul_entre_azuis("Secret&aacute;rio","home.php?aba=secretario");
			else monta_aba_azul_entre_azuis("Secret&aacute;rio");
			
			if($_SESSION["administrador"] == 's') monta_aba_azul_antes_branca("Administrador","home.php?aba=administrador");
			else monta_aba_azul_antes_branca("Administrador");
			
			monta_aba_branca_final("Usu&aacute;rio","form_usuario_sistema.php?cd=" . $_SESSION["cd_usuario"]);
			
			monta_espaco_sem_aba();
			break;
	}
	echo('</tr></table>');
}

######################################################################################################################################

function monta_aba_azul_entre_azuis($titulo, $link){
	?>
	<td width="150">
		<table width="150" height="38" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td colspan="2" height="12"></td>
			</tr>
			<tr>
				<td bgcolor="#CCE1FF" style="border-top: 3px solid #304D9D;" align="center">
					<span class="aba_inativa">
						<?
						if(strlen($link) != 0) echo('<a class="link_aba" href="' . $link . '">' . $titulo . '</a>');
						else echo($titulo);
						?>
					</span>
				</td>
				<td width="20">
					<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="21" height="12" background="imagens/canto_sup_dir_aba_azul.gif"></td>
						</tr>
						<tr>
							<td background="imagens/lateral_dir_aba_azul.gif"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" height="3" bgcolor="#304D9D"></td>
			</tr>
		</table>
	</td>
	<?
}

######################################################################################################################################

function monta_aba_branca_final($titulo){
	?>
	<td width="135">
		<table width="135" height="38" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="20" height="12" background="imagens/canto_sup_esq_aba2.gif"></td>
				<td background="imagens/lateral_sup_aba.gif"></td>
				<td width="15" background="imagens/canto_sup_dir_aba.gif"></td>
			</tr>
			<tr>
				<td>
					<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="20" height="3" background="imagens/lateral_esq_aba_3.gif"></td>
						</tr>
						<tr>
							<td background="imagens/lateral_esq_aba_2.gif"></td>
						</tr>
					</table>
				</td>
				<td bgcolor="#FFFFFF" align="center"><span class="aba_ativa"><?=$titulo?></span></td>
				<td>
					<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="15" height="3" background="imagens/lateral_dir_aba_1.gif"></td>
						</tr>
						<tr>
							<td background="imagens/lateral_dir_aba_2.gif"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td height="3" background="imagens/lateral_esq_aba_3.gif"></td>
				<td bgcolor="#FFFFFF"></td>
				<td background="imagens/lateral_dir_aba_3.gif"></td>
			</tr>
		</table>
	</td>
	<?
}

######################################################################################################################################

function monta_aba_azul_antes_branca($titulo,$link){
	?>
	<td width="120">
		<table width="120" height="38" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td height="12"></td>
			</tr>
			<tr>
				<td bgcolor="#CCE1FF" style="border-top: 3px solid #304D9D;" align="center">
					<span class="aba_inativa">
						<?
						if(strlen($link) != 0) echo('<a class="link_aba" href="' . $link . '">' . $titulo . '</a>');
						else echo($titulo);
						?>
					</span>
				</td>
			</tr>
			<tr>
				<td height="3" bgcolor="#304D9D"></td>
			</tr>
		</table>
	</td>
	<?
}

######################################################################################################################################

function monta_aba_azul_comeco_antes_azul($titulo,$link){
	?>
	<td width="4">
		<table width="4" height="38" cellpadding="0" cellspacing="0">
			<tr>
				<td></td>
			</tr>
			<tr>
				<td width="4" height="3" background="imagens/canto_sup_esq_tabela.gif"></td>
			</tr>
		</table>
	</td>
	<td width="130">
		<table width="130" height="38" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td colspan="3" height="12"></td>
			</tr>
			<tr>
				<td width="20">
					<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="21" height="12" background="imagens/canto_sup_esq_aba_azul_comeco.gif"></td>
						</tr>
						<tr>
							<td background="imagens/lateral_esq_aba_azul_comeco.gif"></td>
						</tr>
					</table>
				</td>
				<td bgcolor="#CCE1FF" style="border-top: 3px solid #304D9D;" align="center">
					<span class="aba_inativa">
						<?
						if(strlen($link) != 0) echo('<a class="link_aba" href="' . $link . '">' . $titulo . '</a>');
						else echo($titulo);
						?>
					</span>
				</td>
				<td width="20">
					<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="21" height="12" background="imagens/canto_sup_dir_aba_azul.gif"></td>
						</tr>
						<tr>
							<td background="imagens/lateral_dir_aba_azul.gif"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3" height="3" bgcolor="#304D9D"></td>
			</tr>
		</table>
	</td>
	<?
}

######################################################################################################################################

function monta_espaco_sem_aba(){
	?>
	<td style="border-bottom: 3px solid #304D9D;">&nbsp;</td>
	<td width="4">
		<table width="4" height="38" cellpadding="0" cellspacing="0">
			<tr>
				<td></td>
			</tr>
			<tr>
				<td width="4" height="3" background="imagens/canto_sup_dir_tabela.gif"></td>
			</tr>
		</table>
	</td>
	<?
}

######################################################################################################################################

function monta_aba_azul_comeco_antes_branca($titulo,$link){
	?>
	<td width="4">
		<table width="4" height="38" cellpadding="0" cellspacing="0">
			<tr>
				<td></td>
			</tr>
			<tr>
				<td width="4" height="3" background="imagens/canto_sup_esq_tabela.gif"></td>
			</tr>
		</table>
	</td>
	<td width="120">
		<table width="120" height="38" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td colspan="2" height="12"></td>
			</tr>
			<tr>
				<td width="20">
					<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="21" height="12" background="imagens/canto_sup_esq_aba_azul_comeco.gif"></td>
						</tr>
						<tr>
							<td background="imagens/lateral_esq_aba_azul_comeco.gif"></td>
						</tr>
					</table>
				</td>
				<td bgcolor="#CCE1FF" style="border-top: 3px solid #304D9D;" align="center">
					<span class="aba_inativa">
						<?
						if(strlen($link) != 0) echo('<a class="link_aba" href="' . $link . '">' . $titulo . '</a>');
						else echo($titulo);
						?>
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="3" height="3" bgcolor="#304D9D"></td>
			</tr>
		</table>
	</td>
	<?
}

######################################################################################################################################

function monta_aba_branca_entre_azuis($titulo){
	?>
	<td width="180">
		<table width="180" height="38" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="20" height="12" background="imagens/canto_sup_esq_aba2.gif"></td>
				<td background="imagens/lateral_sup_aba.gif"></td>
				<td width="20" background="imagens/canto_sup_dir_aba.gif"></td>
			</tr>
			<tr>
				<td width="20">
					<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="20" height="3" background="imagens/lateral_esq_aba_3.gif"></td>
						</tr>
						<tr>
							<td background="imagens/lateral_esq_aba_2.gif"></td>
						</tr>
					</table>
				</td>
				<td bgcolor="#FFFFFF" align="center"><span class="aba_ativa"><?=$titulo?></span></td>
				<td width="20">
					<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="20" height="3" background="imagens/lateral_dir_aba_1.gif"></td>
						</tr>
						<tr>
							<td background="imagens/lateral_dir_aba_2.gif"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td width="20" height="3" background="imagens/lateral_esq_aba_3.gif"></td>
				<td bgcolor="#FFFFFF"></td>
				<td width="20" background="imagens/lateral_dir_aba_3.gif"></td>
			</tr>
		</table>
	</td>
	<?
}

######################################################################################################################################

function monta_aba_azul_final($titulo,$link){
	?>
	<td width="120">
		<table width="120" height="38" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td colspan="2" height="12"></td>
			</tr>
			<tr>
				<td bgcolor="#CCE1FF" style="border-top: 3px solid #304D9D;" align="center">
					<span class="aba_inativa">
						<?
						if(strlen($link) != 0) echo('<a class="link_aba" href="' . $link . '">' . $titulo . '</a>');
						else echo($titulo);
						?>
					</span>
				</td>
				<td width="20">
					<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="21" height="12" background="imagens/canto_sup_dir_aba_azul_final.gif"></td>
						</tr>
						<tr>
							<td background="imagens/lateral_dir_aba_azul_final.gif"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" height="3" bgcolor="#304D9D"></td>
			</tr>
		</table>
	</td>
	<td style="border-bottom: 3px solid #304D9D;">&nbsp;</td>
	<?
}

######################################################################################################################################

function monta_aba_branca_comeco($titulo){
	?>
	<td width="130">
		<table width="130" height="38" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="16" height="12" background="imagens/canto_sup_esq_aba.gif"></td>
				<td background="imagens/lateral_sup_aba.gif"></td>
				<td width="16" background="imagens/canto_sup_dir_aba.gif"></td>
			</tr>
			<tr>
				<td width="16" background="imagens/lateral_esq_aba.gif"></td>
				<td bgcolor="#FFFFFF" align="center"><span class="aba_ativa"><?=$titulo?></span></td>
				<td width="20">
					<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="20" height="3" background="imagens/lateral_dir_aba_1.gif"></td>
						</tr>
						<tr>
							<td background="imagens/lateral_dir_aba_2.gif"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td width="16" height="3" background="imagens/lateral_esq_aba.gif"></td>
				<td bgcolor="#FFFFFF"></td>
				<td width="16" background="imagens/lateral_dir_aba_3.gif"></td>
			</tr>
		</table>
	</td>
	<?
}

######################################################################################################################################

function monta_botao_logout(){
	?>
	<td width="30"><a href="home.php"><img title="Pagina Inicial" border="0" onMouseOver="this.src = 'imagens/home_over.gif';" onMouseOut="this.src = 'imagens/home_out.gif';" src="imagens/home_out.gif"></a></td>
	<td width="22"><a href="logout.php"><img title="Sair do Sistema" border="0" onMouseOver="this.src = 'imagens/logout.gif';" onMouseOut="this.src = 'imagens/logout_out.gif';" src="imagens/logout_out.gif"></a></td>
	<?
}

######################################################################################################################################

function monta_titulo_secao($titulo){
	?>
	<div style="font-family: Arial; font-size: 16px; font-weight: bold; position: absolute; color:#CCCCCC; z-index: 0; margin-top: 2px; margin-left: 2px;"><?=$titulo?></div>
	<div style="font-family: Arial; font-size: 16px; font-weight: bold; position: absolute; z-index:1000;"><?=$titulo?></div>
	<br><br>
	<?
}

######################################################################################################################################

function tela_erro($mensagem, $tela_pq){
	if($tela_pq){
		inicia_pagina_sem_cabec();
	}
	else{
		inicia_pagina();
		monta_menu_abas("usuario");
	}
	inicia_tabela_conteudo();
	monta_titulo_secao("Erro ao processar informações!");
	if(!$tela_pq){ ?>
		<table width="100%">
			<tr>
				<td width="50"><a href="#" onClick="window.history.back();"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
				<td></td>
				<? monta_botao_logout(); ?>
			</tr>
		</table>
		<hr>
	<?
	}
	inicia_quadro_branco('width="500"', 'Atenção!'); ?>
		<table width="100%">
			<tr>
				<td><img src="imagens/atencao.jpg"></td>
				<td class="conteudo_quadro_branco"><?=$mensagem?></td>
			</tr>
			<?	if($tela_pq) echo('<tr><td class="conteudo_quadro_branco" colspan="2" align="right">[<a href="javascript: self.close();">FECHAR</a>]</td></tr>'); ?>
		</table>
	<?
	termina_quadro_branco(); 
	termina_pagina();
	if($tela_pq){ ?>
		<script language="javascript">
			self.resizeTo(600, 260);
		</script>
	<? }
	die();
}

######################################################################################################################################

function tela_sucesso($mensagem , $destino){
	inicia_pagina();
	monta_menu_abas("usuario");
	inicia_tabela_conteudo();
	monta_titulo_secao("Alterações realizadas com sucesso!");
	?>
	<table width="100%">
		<tr>
			<td width="50"><a href="<?=$destino?>"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<td></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<?
	inicia_quadro_branco('width="500"', 'Sucesso!'); ?>
		<table width="100%">
			<tr>
				<td><img src="imagens/ok.jpg"></td>
				<td class="conteudo_quadro_branco"><?=$mensagem?></td>
			</tr>
		</table>
	<?
	termina_quadro_branco(); 
	termina_pagina();
	die();
}


######################################################################################################################################

function browser($query, $colunas, $string, $titulo, $order, $num_registro_pagina){
	inicia_quadro_claro('width="100%"', $titulo); ?>
		<table width="100%" class="conteudo_quadro_claro" border="0" cellpadding="2" cellspacing="0">
			<tr class="label" style="text-align: left; background-color:#314e9a; color:#FFFFFF">
				<?
				for($i = 0; $i < count($colunas); $i++){ ?>
					<td width="<?=$colunas[$i]['largura']?>" align="<?=$colunas[$i]['alinhamento']?>"><?=$colunas[$i]['label']?></td>
				<? } ?>
			</tr>
			<tr>
				<td colspan="<?=count($colunas);?>">&nbsp;</td>
			</tr>
			<?
			if(!isset($num_registro_pagina)) $num_registro_pagina = 15;
			
			if(strlen($_GET["pagina"]) == 0) $pagina = 1;
			else $pagina = $_GET["pagina"];
			
			$limite = ($num_registro_pagina * ($pagina -1));
			$query_limit = " LIMIT " . $limite . "," . $num_registro_pagina;
			
			require("includes/conectar_mysql.php");
		
			$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
			$quantidade = mysql_num_rows($result);
			
			$query .= $order . $query_limit;
			$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
			if(mysql_num_rows($result) == 0) echo('<tr><td colspan="' . count($colunas) . '">Nenhum Registro Encontrado</td></tr>');
			$j = 0;
	
			while($registro = mysql_fetch_row($result)){
				if($j == 0){ 
					?>
					<tr style="background-color: #DBE6FA;" onMouseOver="this.style.backgroundColor = '#BACAEB';" onMouseOut="this.style.backgroundColor = '#DBE6FA';">
					<?
					$j = 1;
				}
				else{
					?>
					<tr onMouseOver="this.style.backgroundColor = '#BACAEB';" onMouseOut="this.style.backgroundColor = '';">
					<?
					$j = 0;
				}
				for($i = 0; $i < count($registro); $i++){
					echo('<td align="' . $colunas[$i]['alinhamento'] . '" valign="top">' . $registro[$i] . '</td>');
				}
				echo("</tr>");
			}
			require("includes/desconectar_mysql.php");
			?>
		</table>
		<br>
		<div style="width: 100%; text-align: center;">
			<? make_user_page_nums($quantidade, $string, $_SERVER['SCRIPT_NAME'] , $num_registro_pagina, $pagina, 10); ?>
		</div>
	<? termina_quadro_claro(); 
}

######################################################################################################################################

function verifica_permissoes($assistente_social, $operador, $secretario){
	if(!isset($_SESSION["usuario"])) tela_erro('Usuário sem login e senha válidos!');
	else{
		if($_SESSION["administrador"] != 's'){
			$i = 0;
			if(($assistente_social == 's') && ($_SESSION["assistente_social"] == 's')) $i = 1;
			if(($operador == 's') && ($_SESSION["operador"] == 's')) $i = 1;
			if(($secretario == 's') && ($_SESSION["secretario"] == 's')) $i = 1;
			if($i == 0) tela_erro('Você não tem permissão para ver este documento!');
		}
	}
}

######################################################################################################################################

function saida(){
	?>
	<html>
		<head>
			<title>SUCESSO!</title>
			<script language="javascript">
				opener.location.reload();
				self.close();
			</script>
		</head>
		<body></body>
	</html>
	<?
}

############################################################################################################################

function make_user_page_nums($total_results, $print_query, $page_name, $results_per_page, $page, $max_pages_to_show) {
	
	/* PREV LINK: print a Prev link, if the page number is not 1 */
	if($page != 1) {
		$pageprev = $page - 1;
		echo '<a href="' . $page_name . '?pagina=' . $pageprev . $print_query . '"><img title="Voltar" border="0" onMouseOver="this.src = \'imagens/voltar2_over.gif\';" onMouseOut="this.src = \'imagens/voltar2_out.gif\';" src="imagens/voltar2_out.gif"></a> ';
	}
	
	/* get the total number of pages that are needed */
	
	$showpages = round($max_pages_to_show/2);
	$numofpages = $total_results/$results_per_page;
	
	if ($numofpages > $showpages ) { 
		$startpage = $page - $showpages ;
	}
	else { 
		$startpage = 0; 
	}
	
	if ($startpage < 0){
		$startpage = 0; 
	}
	
	if ($numofpages > $showpages ) {
		$endpage = $page + $showpages; 
	}
	else { 
		$endpage = $showpages; 
	}
	
	if ($endpage > $numofpages){ 
		$endpage = $numofpages; 
	}
	
	/* loop through the page numbers and print them out */
	for($i = $startpage; $i < $endpage; $i++) {
		/* if the page number in the loop is not the same as the page were on, make it a link */
		$real_page = $i + 1;
		if ($real_page!=$page){
			echo " <a class=\"link_aba\" href=\"".$page_name."?pagina=".$real_page.$print_query."\">".$real_page."</a> ";
			/* otherwise, if the loop page number is the same as the page were on, do not make it a link, but rather just print it out */
		}
		else {
			echo "<b class=\"link_aba\">".$real_page."</b>";
		}
	}
	
	/* NEXT LINK -If the totalrows - $results_per_page * $page is > 0 (meaning there is a remainder), print the Next button. */
	if(($total_results-($results_per_page*$page)) > 0){
		$pagenext = $page + 1;
		echo ' <a href="' . $page_name . '?pagina=' . $pagenext . $print_query . '"><img title="Avançar" border="0" onMouseOver="this.src = \'imagens/avancar_over.gif\';" onMouseOut="this.src = \'imagens/avancar_out.gif\';" src="imagens/avancar_out.gif"></a>';
	}
}
?>