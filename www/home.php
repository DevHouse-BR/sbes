<?
	require("includes/funcoes_layout.php");
	verifica_permissoes("s","s","s");
	inicia_pagina();
	if(!empty($_GET["aba"])) $aba = $_GET["aba"];
	else{
		if($_SESSION["operador"] == "s") $aba = 'operador';
		elseif($_SESSION["assistente_social"] == "s") $aba = "assistente";
		elseif($_SESSION["secretario"] == "s") $aba = "secretario";
		elseif($_SESSION["administrador"] == "s") $aba = "assistente";
	}
	monta_menu_abas($aba);
	inicia_tabela_conteudo();
	?>
	<table width="100%">
		<tr>
			<td></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<? 
	switch ($aba){
		case "operador":
			opcoes_operador();
			break;
		case "assistente":
			opcoes_assistente();
			break;
		case "administrador":
			opcoes_administrador();
			break;
		case "secretario":
			opcoes_secretario();
			break;
	}
	
	termina_pagina();

#######################################################################################################################	

function opcoes_operador(){
	echo('<table width="100%" cellpadding="0" cellspacing="0"><tr><td width="50%">');
	socio_economico();
	echo('</td><td>');
	usuario_familia();
	echo('</td></tr></table>');
}

#######################################################################################################################

function opcoes_assistente(){
	echo('<table width="100%" cellpadding="0" cellspacing="0"><tr><td width="50%">');
	recebimento_beneficio();
	echo('</td><td>');
	usuario_familia();
	echo('</td></tr></table>');
	
	echo('<table width="100%" cellpadding="0" cellspacing="0"><tr><td width="50%">');
	socio_economico();
	echo('</td><td>');
	programas_sociais();
	echo('</td></tr></table>');
	
	echo('<table width="100%" cellpadding="0" cellspacing="0"><tr><td width="50%">');
	relatorio_beneficios();
	echo('</td><td>');
	relatorio_ficha_usuario();
	echo('</td></tr></table>');
}

#######################################################################################################################

function opcoes_administrador(){
	echo('<table width="100%" cellpadding="0" cellspacing="0"><tr><td width="50%">');
	manter_usuario_sistema();
	echo('</td><td>&nbsp;');
	echo('</td></tr></table>');
}

#######################################################################################################################

function opcoes_secretario(){
	echo('<table width="100%" cellpadding="0" cellspacing="0"><tr><td width="50%">');
	relatorio_beneficios();
	echo('</td><td>');
	relatorio_ficha_usuario();
	echo('</td></tr></table>');
}

#######################################################################################################################

function relatorio_beneficios(){
	?>
	<span class="conteudo_quadro_branco" style="width: 100%;">
		<? inicia_quadro_branco('width="100%"',"Relat�rio de Benef�cios"); ?>
			<a href="relatorio_recebimento_beneficio.php"><img border="0" src="imagens/icone_relatorio_rec_beneficio.jpg" align="left"></a>
			<br>Relat�rio gerencial com objetivo de analisar os benef�cios que foram concedidos aos usu�rios e domic�lios, podendo ter totais por bairros e programas sociais.
		<? termina_quadro_branco(); ?>
	</span>
	<?
}

#######################################################################################################################

function relatorio_ficha_usuario(){
	?>
	<span class="conteudo_quadro_branco" style="width: 100%;">
		<? inicia_quadro_branco('width="100%"',"Relat�rio de Ficha de Usu�rio"); ?>
			<a href="busca_usuario_familia.php?modo=relatorio_ficha_usuario"><img border="0" src="imagens/icone_relatorio_ficha_usuario.jpg" align="left"></a>
			<br>Imprime a ficha do usu�rio e domic�lio, contendo suas informa��es b�sicas, s�cio-econ�micos, hist�ricos e benef�cios concedidos. Permite tamb�m a impress�o de uma ficha em branco. 
		<? termina_quadro_branco(); ?>
	</span>
	<?
}

#######################################################################################################################

function manter_usuario_sistema(){
	?>
	<span class="conteudo_quadro_branco" style="width: 100%;">
		<? inicia_quadro_branco('width="100%"',"Manter Usu&aacute;rios do Sistema"); ?>
			<a href="busca_usuario_sistema.php"><img border="0" src="imagens/usuario_sistema.jpg" align="left"></a>
			<br>Cria e atribui pap�is para os usu�rios do sistema, bem como os associa a programas sociais.
		<? termina_quadro_branco(); ?>
	</span>
	<?
}

#######################################################################################################################

function socio_economico(){
	?>
	<span class="conteudo_quadro_branco" style="width: 100%;">
		<? inicia_quadro_branco('width="100%"',"Informa��es S�cio Econ�micas"); ?>
			<a href="busca_usuario_familia.php?modo=socio_economico"><img border="0" src="imagens/icone_info_socio_economica.jpg" align="left"></a>
			<br>Para cada Domic�lio e/ou Pessoa � possivel incluir informa��es socio-econ�micas para posterior an�lise.
		<? termina_quadro_branco(); ?>
	</span>
	<?
}

#######################################################################################################################

function programas_sociais(){
	?>
	<span class="conteudo_quadro_branco" style="width: 100%;">
		<? inicia_quadro_branco('width="100%"',"Programas Sociais"); ?>
			<a href="busca_programa_social.php"><img border="0" src="imagens/icone_programa_social.jpg" align="left"></a>
			<br>Gerencia informa��es dos programas sociais dispon�veis bem como anexa documentos relevantes para cada programa social.
		<? termina_quadro_branco(); ?>
	</span>
	<?
}

#######################################################################################################################

function usuario_familia(){
	?>
	<span class="conteudo_quadro_branco" style="width: 100%;">
		<? inicia_quadro_branco('width="100%"',"Usu�rio fam&iacute;lia"); ?>
			<a href="busca_usuario_familia.php"><img border="0" src="imagens/icone_usuario_familia.jpg" align="left"></a>
			<br>Cadastra e edita informa��es de Usu�rios Familia (Domic�lios e Pessoas) beneficiados pelos programas sociais.
		<? termina_quadro_branco(); ?>
	</span>
	<?
}

#######################################################################################################################

function recebimento_beneficio(){
	?>
	<span class="conteudo_quadro_branco" style="width: 100%;">
		<? inicia_quadro_branco('width="100%"',"Recebimento de Benef�cio"); ?>
			<a href="busca_usuario_familia.php?modo=beneficios"><img border="0" src="imagens/icone_rec_beneficio.jpg" align="left"></a>
			<br>Controla o recebimento de benef�cios para usu�rios fam&iacute;lia de acordo com data e programa social.
		<? termina_quadro_branco(); ?>
	</span>
	<?
}
?>
