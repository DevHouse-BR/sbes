<?
require("includes/funcoes_layout.php");	
$programa_social = $_REQUEST["programa_social"];
$DOMICILIO = $_REQUEST["DOMICILIO"];
$PESSOA = $_REQUEST["PESSOA"];
$modo = $_REQUEST["modo"];
$cd = $_REQUEST["cd"];
$usuario_sistema = $_SESSION["cd_usuario"];

if($modo == "update"){
	$update = true;
	require("includes/conectar_mysql.php");
	$query = "SELECT p.descricao, b.valor, b.qtd, b.nr_recibo, b.historico FROM beneficios b, programa_social p WHERE b.programa_social=p.cd AND b.cd=" . $cd;
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error() . " - " . $query, true);
	$registro = mysql_fetch_assoc($result);
	$programa_social = $registro["descricao"];
	$valor = number_format($registro["valor"], 2, ',', '.');
	$qtd = $registro["qtd"];
	$nr_recibo = $registro["nr_recibo"];
	$historico = $registro["historico"];
	require("includes/desconectar_mysql.php");
}
?>
<html>
	<head>
		<title>Benefício</title>
		<link rel="stylesheet" href="includes/estilo.css">
		<script language="JavaScript" src="includes/calendar1.js"></script>
		<script language="JavaScript" src="includes/data.js"></script>
		<script language="javascript">
			function valida_form(){
				var f = document.forms[0];
				if(f.programa_social.value == ""){
					alert('Informe o programa social!');
					f.programa_social.focus();
					return false;
				}
				if(f.valor.value == ""){
					alert('Informe o valor do benefício.');
					f.valor.focus();
					return false;
				}
				if(f.qtd.value == ""){
					alert('Informe a quantidade.');
					f.qtd.focus();
					return false;
				}
				if(f.nr_recibo.value == ""){
					alert('Informe o número do recibo.');
					f.nr_recibo.focus();
					return false;
				}
				if(f.data.value == ""){
					alert("Informe a data!");
					f.data.focus();
					return false;
				}
				hoje = new Date();
				anoAtual = hoje.getFullYear();
				barras = f.data.value.split("/");
				if (barras.length == 3){
					dia = barras[0];
					mes = barras[1];
					ano = barras[2];
					resultado = (!isNaN(dia) && (dia > 0) && (dia < 32)) && (!isNaN(mes) && (mes > 0) && (mes < 13)) && (!isNaN(ano) && (ano.length == 4));
					if (!resultado) {
						alert("Formato de data inválido!");
						f.data.focus();
						return false;
					}
				}
				else {
					alert("Formato de data inválido!");
					f.data.focus();
					return false;
				}
				return true;
			}
		</script>
	</head>
	<body>
		<? inicia_quadro_branco('width="100%"', 'Registrar Benefício'); ?>
			<table width="100%" border="0" cellpadding="2" cellspacing="3">
				<form action="salva_beneficio.php" method="post" onSubmit="return valida_form();">
				<tr>
					<td width="15%" class="label">Programa Social:</td>
					<td width="80%" class="conteudo_quadro_claro" style="vertical-align: middle;">
						<?
						echo('<select name="programa_social" style="width: 100%;">');
						require("includes/conectar_mysql.php");	
						
						if(strlen($PESSOA)>0){
							$query = "SELECT p.cd, p.descricao FROM programa_social p, pessoa_programa_social pp, usuario_programa_social ups WHERE p.cd=pp.programa_social AND pp.PESSOA=" . $PESSOA . " AND ups.programa_social=p.cd AND ups.dt_inicio <= NOW() AND ups.dt_termino >= NOW() AND ups.usuario=" . $_SESSION["cd_usuario"];
						}
						else{
							$query = "SELECT p.cd, p.descricao FROM programa_social p, domicilio_programa_social dp, usuario_programa_social ups WHERE p.cd=dp.programa_social AND dp.DOMICILIO=" . $DOMICILIO . " AND ups.programa_social=p.cd AND ups.dt_inicio <= NOW() AND ups.dt_termino >= NOW() AND ups.usuario=" . $_SESSION["cd_usuario"];
						}
						$result = mysql_query($query) or tela_erro("Erro buscado dados dos programas sociais.", true);
						while($registro = mysql_fetch_assoc($result)){
							if(($modo == "update") && ($registro["cd"] == $programa_social)) echo('<option value="' . $registro["cd"] . '" selected>' . $registro['descricao'] . '</option>');
							else echo('<option value="' . $registro["cd"] . '">' . $registro['descricao'] . '</option>');
						}
						require("includes/desconectar_mysql.php");
						echo('</select>');
						?>
					</td>
				<tr>
					<td class="label">Valor:</td>
					<td><input type="text" name="valor" value="<?=$valor?>" class="caixa_texto" style="width: 100%;" maxlength="80"></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="label">Quantidade:</td>
					<td><input type="text" name="qtd" value="<?=$qtd?>" class="caixa_texto" style="width: 100%;" maxlength="80"></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="label">Nr. Recibo:</td>
					<td><input type="text" name="nr_recibo" value="<?=$nr_recibo?>" class="caixa_texto" style="width: 100%;" maxlength="80"></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="label">Data:</td>
					<td><input type="text" name="data" value="<?=$data?>" class="caixa_texto" style="width: 100%;" maxlength="80" onKeypress="return ajustar_data(this,event);"></td>
					<td><a href="javascript: cal1.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data"></a></td>
				</tr>
				<tr>
					<td class="label" style="vertical-align:top;">Observações:</td>
					<td><textarea name="historico" style="width: 100%; height: 100px;" class="caixa_texto_gr"><?=$historico?></textarea></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="right" colspan="2"><input type="submit" value="  Salvar  " class="botao_aqua">&nbsp;&nbsp;<input type="button" value="Cancelar" class="botao_aqua" onClick="self.close();"></td>
				</tr>
					<input type="hidden" name="DOMICILIO" value="<?=$DOMICILIO?>">
					<input type="hidden" name="PESSOA" value="<?=$PESSOA?>">
					<input type="hidden" name="usuario_sistema" value="<?=$usuario_sistema?>">
					<?
					if($update) echo('<input type="hidden" name="modo" value="update">');
					else echo('<input type="hidden" name="modo" value="add">');
					?>
					<input type="hidden" name="cd" value="<?=$cd?>">
				</form>
			</table>
		<? termina_quadro_branco(); ?>
	</body>
	<script language="javascript">
		<? if($modo != "update") echo('document.forms[0].elements[0].focus();'); ?>
		var cal1 = new calendar1(document.forms[0].elements['data']);
		cal1.year_scroll = true;
		cal1.time_comp = false;
	</script>
</html>