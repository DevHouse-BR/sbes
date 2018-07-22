<?
require("includes/funcoes_layout.php");
?>
	<html>
	<head>
		<title>Bairros</title>
		<link rel="stylesheet" href="includes/estilo.css">
		</head>
	<body style="background-image:url(); background-color:#FFFFFF; margin: 2px;">
		<div>
			<? inicia_quadro_claro('width="100%"', 'Busca de Bairros'); ?>
			<div style="width: 100%; text-align:center;">
				<table border="0">
					<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
					<tr>
						<td class="label">Busca:</td>
						<td><input type="text" name="bairro" value="<?=trim($_REQUEST["bairro"])?>" size="40" class="caixa_texto"></td>
						<td><input type="submit" value="" class="botao_busca_azul"></td>
					</tr>
					</form>
				</table>
			</div>
			<? termina_quadro_claro(); ?>
		</div>
		<script language="javascript">
			function adiciona_filtro(filtro, valor, texto){
				var opcao = opener.document.createElement("OPTION");
				opcao.text = texto;
				opcao.value = filtro + ';' + valor;
				opener.document.forms[0].elements['filtros[]'].options.add(opcao);
			}
		</script>
		<? 
		$colunas[0]['largura'] = "5%";
		$colunas[0]['label'] = "&nbsp;";
		$colunas[0]['alinhamento'] = "left";
		
		$colunas[1]['largura'] = "90%";
		$colunas[1]['label'] = "Bairro";
		$colunas[1]['alinhamento'] = "left";
				
		$query = "SELECT ";
		$query .= " CONCAT('<a href=\"#\" onClick=\"adiciona_filtro(3,\'', bairro , '\',\'Bairro: ', bairro, '\');\"><img border=\"0\" src=\"imagens/seta.gif\"></a>') as cd,";
		$query .= "bairro ";
		$query .= " from (SELECT DISTINCT NOM_BAIRRO_RESIDENCIA_DOMIC as bairro from domicilio_1) domicilios";
		$query .= " WHERE bairro LIKE '%" . trim($_REQUEST["bairro"]) . "%'";
		$string = "&bairro=" .  trim($_REQUEST["bairro"]);
		$ordem = " ORDER BY bairro";
		//die($query . $ordem);
		browser($query, $colunas, $string, '',$ordem,5); ?>
		<script language="javascript">
			document.forms[0].elements[0].focus();
		</script>
	</body>
</html>