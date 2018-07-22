<? 
require("includes/funcoes_layout.php");
require("includes/conectar_mysql.php");


$de = $_REQUEST["de"];
$ate = $_REQUEST["ate"];

$de = split("/", $de);
$de = $de[2] . "-" . $de[1] . "-" . $de[0];

$ate = split("/", $ate);
$ate = $ate[2] . "-" . $ate[1] . "-" . $ate[0];

$classificacao = $_REQUEST["classificacao"];


$query = "SELECT ps.descricao, DATE_FORMAT(b.data,'%d/%m/%Y %H:%i:%s') as data, b.valor, b.qtd, b.nr_recibo, CONCAT(do.TIP_LOGRAD_DOMIC, ' ', do.NOM_LOGRADOURO_DOMIC, ' ', do.NUM_RESIDENCIA_DOMIC, ' ', do.NOM_COMPL_RESIDENCIA_DOMIC, ' ', do.NOM_BAIRRO_RESIDENCIA_DOMIC, ' ', do.CEP_RESIDENCIA_DOMIC ) as endereco, us.nome as nome_usuario, b.historico, do.NOM_BAIRRO_RESIDENCIA_DOMIC as bairro, CASE IF(b.PESSOA IS NULL, 0, 1) WHEN 0 THEN '&nbsp;' ELSE pes.NOM_PESSOA END as nome_pessoa ";
$query .= "FROM beneficios b LEFT OUTER JOIN usuarios_sistema us ON b.usuario_sistema=us.cd LEFT OUTER JOIN pessoa_1 pes ON b.PESSOA=pes.PESSOA, programa_social ps, domicilio_1 do WHERE ";
$query .= "ps.cd = b.programa_social AND do.DOMICILIO=b.DOMICILIO AND b.data > '" . $de . "' AND b.data < '" . $ate . "' ";
for($i = 0; $i < count($_REQUEST["filtros"]); $i++){
	$filtro = split(";", $_REQUEST["filtros"][$i]);
	$tipo = $filtro[0];
	$valor = $filtro[1];
	switch($tipo){
		case 1:
			$query .= " AND b.DOMICILIO=" . $valor;
			break;
		case 2:
			$query .= " AND b.PESSOA=" . $valor;
			break;
		case 3:
			$query .= " AND do.NOM_BAIRRO_RESIDENCIA_DOMIC ='" . $valor . "'";
			break;
		case 4:
			$query .= " AND us.cd=" . $valor;
			break;
	}
}


switch($classificacao){
	case "domicilios":
		$query .= " ORDER BY endereco, data DESC";
		$campo = "endereco";
		break;
	case "usuarios":
		$query .= " AND b.PESSOA IS NOT NULL";
		$query .= " ORDER BY b.PESSOA, data DESC";
		$campo = "nome_pessoa";
		break;
	case "bairros":
		$query .= " ORDER BY endereco, data DESC";
		$campo = "bairro";
		break;
	case "usuarios_sistema":
		$query .= " ORDER BY us.nome, data DESC";
		$campo = "nome_usuario";
		break;
}
//die($query);
$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
?>
<html>
	<head>
		<title>Relatório de Recebimento de Benefício</title>
		<style type="text/css" media="all">
			@page leo { size: 21cm 27,9cm; page-break-after: left }
			body{
				page: leo; 
				text-align: center;
				page-break-after: right;
			}
			td{
				font-family:Arial, Helvetica, sans-serif;
				font-size:11px;
			}
			tr{
				page-break-inside: avoid;
			}
			table{
				empty-cells: show;
			}
		</style>
	</head>
	<body>
		<table width="400" border="0" cellpadding="3" cellspacing="3">
			<tr>
				<td><? monta_titulo_secao("RELATORIO DE RECEBIMENTO DE BENEFÍCIOS"); ?></td>
			</tr>
		</table>
		<br>
		<table width="950" border="0" cellspacing="0" cellpadding="2">
			<tr height="50">
				<td align="center"><b>Programa Social</b></td>
				<td align="center"><b>Data</b></td>
				<td align="center"><b>Valor</b></td>
				<td align="center"><b>Qtd.</b></td>
				<td align="center"><b>Nr. Recibo</b></td>
				<td align="center"><b>Domicílio</b></td>
				<td align="center"><b>Pessoa</b></td>
				<td align="center"><b>Usuário do Sistema</b></td>
				<td align="center"><b>Histórico</b></td>
			</tr>
			<?
			$anterior = "";
			$i = 0;
			$total_valor = 0;
			$total_qtd = 0;
			if(mysql_num_rows($result) == 0) echo('<tr><td colspan="9">Nenhum Registro encontrado! Tente usar outra combinação de filtros.</td></tr>');
			while($registro = mysql_fetch_assoc($result)){
				if(($anterior != $registro[$campo]) && ($i != 0)){
					?>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align="right" style="border: solid 1px black;"><?="R$ " . number_format($total_valor, 2, ',', '.');?></td>
						<td align="center" style="border: solid 1px black;"><?=$total_qtd?></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="9">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="9" style="border: solid 1px black; font-weight: bold; font-size: 14px;"><?=$registro[$campo]?></td>
					</tr>
					<?
					$total_valor = 0;
					$total_qtd = 0;
				}
				?>
				<tr>
					<td style="border: solid 1px black;"><?=$registro["descricao"]?></td>
					<td style="border: solid 1px black;"><?=$registro["data"]?></td>
					<td align="right" style="border: solid 1px black;"><?="R$ " . number_format($registro["valor"], 2, ',', '.');?></td>
					<td align="center" style="border: solid 1px black;"><?=$registro["qtd"]?></td>
					<td style="border: solid 1px black;"><?=$registro["nr_recibo"]?></td>
					<td style="border: solid 1px black;"><?=$registro["endereco"]?></td>
					<td style="border: solid 1px black;">&nbsp;<?=$registro["nome_pessoa"]?></td>
					<td style="border: solid 1px black;"><?=$registro["nome_usuario"]?></td>
					<td style="border: solid 1px black;">&nbsp;<?=$registro["historico"]?></td>
				</tr>
			<? 
				$total_valor += $registro["valor"];
				$total_qtd += (int)$registro["qtd"];
				$anterior = $registro[$campo];
				$i++;
			} ?>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td align="right" style="border: solid 1px black;"><?="R$ " . number_format($total_valor, 2, ',', '.');?></td>
				<td align="center" style="border: solid 1px black;"><?=$total_qtd?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			
		</table>
	</body>
</html>