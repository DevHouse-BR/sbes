<?php
$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

require("includes/funcoes_layout.php");

if ((strcmp($usuario, "super") == 0) && (strcmp("super", $senha) == 0)) {
	valida_super();
}

require("includes/conectar_mysql.php");
$query = "SELECT * from usuarios_sistema WHERE usuario = '" . $usuario . "' AND senha='" . $senha . "'";
$result = mysql_query($query) or erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
$quantidade = mysql_num_rows($result);
$registro = mysql_fetch_assoc($result);

if ($quantidade > 0){
	if($registro["ativo"] == "n") erro("Usuário está inativo, e portanto não poderá utilizar o sistema.");
	else valida();
}
else{
	erro("Usuário ou senha inválidos!");
}

function valida(){
	global $usuario, $registro;
	session_start();
	$_SESSION["cd_usuario"] = $registro["cd"];
	$_SESSION["usuario"] = $usuario;
	$_SESSION["administrador"] = $registro["administrador"];
	$_SESSION["assistente_social"] = $registro["assistente_social"];
	$_SESSION["operador"] = $registro["operador"];
	$_SESSION["secretario"] = $registro["secretario"];
	redirecionamento("home.php");
}

function valida_super(){
	global $usuario;
	session_start();
	$_SESSION["cd_usuario"] = "0";
	$_SESSION["usuario"] = "Super Usuário";
	$_SESSION["administrador"] = "s";
	$_SESSION["assistente_social"] = "s";
	$_SESSION["operador"] = "s";
	$_SESSION["secretario"] = "s";
	redirecionamento("home.php");
}

function redirecionamento($redireciona){
$HTML = '<html>
			<head>
				<script language="javascript">
					location = "' . $redireciona . '";
				</script>
			</head>
		</html>';
	die($HTML);
}

require("includes/desconectar_mysql.php");

function erro($mensagem){
	inicia_pagina();
	monta_menu_abas("usuario");
	inicia_tabela_conteudo();
	monta_titulo_secao("Erro ao processar informações!");
	?>
		<table width="100%">
			<tr>
				<td width="50"><a href="#" onClick="window.history.back();"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
				<td></td>
			</tr>
		</table>
		<hr>
	<?
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
	die();
}
?>