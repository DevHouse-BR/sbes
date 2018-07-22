<?
require("includes/funcoes_layout.php");	
$programa_social = $_REQUEST["programa_social"];
$DOMICILIO = $_REQUEST["DOMICILIO"];
$PESSOA = $_REQUEST["PESSOA"];
$modo = $_REQUEST["modo"];

if($modo == "update"){
	$cd = $_GET["cd"];
	require("includes/conectar_mysql.php");
	$query = "SELECT historico, DATE_FORMAT(data,'%d/%m/%Y') as data FROM historicos WHERE cd=" . $cd;
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error() . " - " . $query, true);
	$registro = mysql_fetch_assoc($result);
	$historico = $registro["historico"];
	$data = $registro["data"];
	require("includes/desconectar_mysql.php");
}
else $modo = "add";
?>
<html>
	<head>
		<title>Histórico</title>
		<link rel="stylesheet" href="includes/estilo.css">
		<script language="JavaScript" src="includes/calendar1.js"></script>
		<script language="JavaScript" src="includes/data.js"></script>
		<script language="javascript">
			function valida_form(){
				var f = document.forms[0];
				if(f.historico.value == ""){
					alert("Digite o histórico.");
					return false;
				}
				if(!validacao_data(f.data.value)){
					f.data.focus();
					return false;
				}
				else return true;
			}
		</script>
	</head>
	<body>
		<? inicia_quadro_branco('width="100%"', 'Adicionar Histórico'); ?>
			<table width="100%" border="0" cellpadding="2" cellspacing="3">
				<form action="salva_historico.php" method="post" onSubmit="return valida_form();">
				<tr>
					<td class="label">Data:</td>
					<td><input type="text" name="data" value="<?=$data?>" size="60" class="caixa_texto" maxlength="10" onKeypress="return ajustar_data(this,event);">&nbsp;<a href="javascript: cal1.popup();"><img align="absmiddle" src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de in&iacute;cio"></a></td>
				</tr>
				<tr>
					<td width="10%" class="label" valign="top" style="vertical-align: top;">Histórico:</td>
					<td width="90%"><textarea name="historico" class="caixa_texto_gr" style="width: 100%; height: 150px;"><?=$historico?></textarea></td>
				</tr>
				<tr>
					<td align="right" colspan="2"><input type="submit" value="  Salvar  " class="botao_aqua">&nbsp;&nbsp;<input type="button" value="Cancelar" class="botao_aqua" onClick="self.close();"></td>
				</tr>
					<input type="hidden" name="DOMICILIO" value="<?=$DOMICILIO?>">
					<input type="hidden" name="PESSOA" value="<?=$PESSOA?>">
					<input type="hidden" name="modo" value="<?=$modo?>">
					<input type="hidden" name="cd" value="<?=$cd?>">
				</form>
			</table>
		<? termina_quadro_branco(); ?>
	</body>
	<script language="javascript">
		document.forms[0].elements[0].focus();
		var cal1 = new calendar1(document.forms[0].elements['data']);
		cal1.year_scroll = true;
		cal1.time_comp = false;
	</script>
</html>
