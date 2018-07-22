<?
require("includes/funcoes_layout.php");	
$programa_social = $_REQUEST["programa_social"];
$DOMICILIO = $_REQUEST["DOMICILIO"];
$modo = $_REQUEST["modo"];

if($modo == "update"){
	require("includes/conectar_mysql.php");
	$query = "SELECT ps.descricao, DATE_FORMAT(p.dt_inicio,'%d/%m/%Y') as dt_inicio, DATE_FORMAT(p.dt_termino,'%d/%m/%Y') as dt_termino FROM domicilio_programa_social p, programa_social ps WHERE p.programa_social=ps.cd AND p.DOMICILIO=" . $DOMICILIO . " AND p.programa_social=" . $programa_social;
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error() . " - " . $query, true);
	$registro = mysql_fetch_assoc($result);
	$descricao = $registro["descricao"];
	$dt_inicio = $registro["dt_inicio"];
	$dt_termino = $registro["dt_termino"];
	require("includes/desconectar_mysql.php");
}
?>
<html>
	<head>
		<title>Domicílio - Programas Sociais</title>
		<link rel="stylesheet" href="includes/estilo.css">
		<script language="JavaScript" src="includes/calendar1.js"></script>
		<script language="JavaScript" src="includes/data.js"></script>
		<script language="javascript">
			function valida_form(){
				var f = document.forms[0];
				if(f.dt_inicio.value == ""){
					alert('Informe a data de inicio.');
					f.dt_inicio.focus();
					return false;
				}
				else {
					hoje = new Date();
					anoAtual = hoje.getFullYear();
					barras = f.dt_inicio.value.split("/");
					if (barras.length == 3){
						dia = barras[0];
						mes = barras[1];
						ano = barras[2];
						resultado = (!isNaN(dia) && (dia > 0) && (dia < 32)) && (!isNaN(mes) && (mes > 0) && (mes < 13)) && (!isNaN(ano) && (ano.length == 4));
						if (!resultado) {
							alert("Formato de data inválido!");
							f.dt_inicio.focus();
							return false;
						}
					}
					else {
						alert("Formato de data inválido!");
						f.dt_inicio.focus();
						return false;
					}
				}
				if(f.dt_termino.value == ""){
					alert('Informe a data de término.');
					f.dt_termino.focus();
					return false;
				}
				else {
					hoje = new Date();
					anoAtual = hoje.getFullYear();
					barras = f.dt_termino.value.split("/");
					if (barras.length == 3){
						dia = barras[0];
						mes = barras[1];
						ano = barras[2];
						resultado = (!isNaN(dia) && (dia > 0) && (dia < 32)) && (!isNaN(mes) && (mes > 0) && (mes < 13)) && (!isNaN(ano) && (ano.length == 4));
						if (!resultado) {
							alert("Formato de data inválido!");
							f.dt_termino.focus();
							return false;
						}
					}
					else {
						alert("Formato de data inválido!");
						f.dt_termino.focus();
						return false;
					}
				}
			}
		</script>
	</head>
	<body>
		<? inicia_quadro_branco('width="100%"', 'Associa&ccedil;&atilde;o Programa Social/Domicílio'); ?>
			<table width="100%" border="0" cellpadding="2" cellspacing="3">
				<form action="salva_programa_social_domicilio.php" method="post" onSubmit="return valida_form();">
				<tr>
					<td width="15%" class="label">Programa Social:</td>
					<td width="80%" class="conteudo_quadro_claro" style="vertical-align: middle;">
						<?
						if($modo == "add"){
							echo('<select name="programa_social" style="width: 100%;">');
							require("includes/conectar_mysql.php");	
							$query = "SELECT cd, descricao FROM programa_social ps, usuario_programa_social ups WHERE ups.programa_social=ps.cd AND ups.dt_inicio <= NOW() AND ups.dt_termino >= NOW() AND ups.usuario=" . $_SESSION["cd_usuario"];
							$result = mysql_query($query) or tela_erro("Erro buscado dados dos programas sociais.", true);
							while($registro = mysql_fetch_assoc($result)){
								echo('<option value="' . $registro["cd"] . '">' . $registro['descricao'] . '</option>');
							}
							require("includes/desconectar_mysql.php");
							echo('</select>');
						}
						elseif ($modo == "update"){
							echo($descricao);
							echo('<input type="hidden" name="programa_social" value="' . $programa_social . '">');
						}
						?>
					</td>
					<td width="5%"></td>
				</tr>
				<tr>
					<td class="label">In&iacute;cio:</td>
					<td><input type="text" name="dt_inicio" value="<?=$dt_inicio?>" size="46" class="caixa_texto" maxlength="10" onKeypress="return ajustar_data(this,event);"></td>
					<td><a tabindex="-1" href="javascript: cal1.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de in&iacute;cio"></a></td>
				</tr>
				<tr>
					<td class="label">T&eacute;rmino:</td>
					<td><input type="text" name="dt_termino" value="<?=$dt_termino?>" size="46" class="caixa_texto" maxlength="10" onKeypress="return ajustar_data(this,event);"></td>
					<td><a tabindex="-1" href="javascript: cal2.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de t&eacute;rmino"></a></td>
				</tr>
				<tr>
					<td align="right" colspan="3"><input type="submit" value="  Salvar  " class="botao_aqua">&nbsp;&nbsp;<input type="button" value="Cancelar" class="botao_aqua" onClick="self.close();"></td>
				</tr>
					<input type="hidden" name="DOMICILIO" value="<?=$DOMICILIO?>">
					<input type="hidden" name="modo" value="<?=$modo?>">
				</form>
			</table>
		<? termina_quadro_branco(); ?>
	</body>
	<script language="javascript">
		<? if($modo == "add") echo('document.forms[0].elements[1].focus();'); ?>
		var cal1 = new calendar1(document.forms[0].elements['dt_inicio']);
		cal1.year_scroll = true;
		cal1.time_comp = false;
		var cal2 = new calendar1(document.forms[0].elements['dt_termino']);
		cal2.year_scroll = true;
		cal2.time_comp = false;
	</script>
</html>
