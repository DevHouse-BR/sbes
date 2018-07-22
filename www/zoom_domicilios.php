<?
require("includes/funcoes_layout.php");
?>
	<html>
	<head>
		<title>Domicilios</title>
		<link rel="stylesheet" href="includes/estilo.css">
		</head>
	<body style="background-image:url(); background-color:#FFFFFF; margin: 2px;">
		<div>
			<? inicia_quadro_claro('width="100%"', 'Busca de Domicílios'); ?>
			<div style="width: 100%; text-align:center;">
				<table border="0">
					<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
					<tr>
						<td class="label">Busca:</td>
						<td><input type="text" name="endereco" value="<?=trim($_REQUEST["endereco"])?>" size="20" class="caixa_texto"></td>
						<td>
							<select name="tipo_domicilio">
								<option value="logradouro"<? if($_REQUEST["tipo_domicilio"] == "logradouro") echo(" selected");?>>Logradouro,Numero</option>
								<option value="bairro"<? if($_REQUEST["tipo_domicilio"] == "bairro") echo(" selected");?>>Bairro</option>
								<option value="cep"<? if($_REQUEST["tipo_domicilio"] == "cep") echo(" selected");?>>CEP</option>
							</select>
						</td>
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
		
		$colunas[1]['largura'] = "70%";
		$colunas[1]['label'] = "Endereço";
		$colunas[1]['alinhamento'] = "left";
		
		$colunas[2]['largura'] = "20%";
		$colunas[2]['label'] = "CEP";
		$colunas[2]['alinhamento'] = "left";
				
		$query = "SELECT ";
		$query .= " CONCAT('<a href=\"#\" onClick=\"adiciona_filtro(1,', DOMICILIO , ',\'Domicílio: ', TIP_LOGRAD_DOMIC, ' ', NOM_LOGRADOURO_DOMIC, ' ', NUM_RESIDENCIA_DOMIC, ' ', NOM_COMPL_RESIDENCIA_DOMIC, '\');\"><img border=\"0\" src=\"imagens/seta.gif\"></a>') as cd,";
		$query .= "CONCAT(TIP_LOGRAD_DOMIC, ' ', NOM_LOGRADOURO_DOMIC, ' ', NUM_RESIDENCIA_DOMIC, ' ', NOM_COMPL_RESIDENCIA_DOMIC) as endereco,";
		$query .= "CEP_RESIDENCIA_DOMIC ";
		$query .= " from domicilio_1 ";

		if($_REQUEST["tipo_domicilio"] == "logradouro"){
			$temp = split(",",$_REQUEST["endereco"]);
			$query .= " WHERE NOM_LOGRADOURO_DOMIC LIKE '%" . trim($temp[0]) . "%' AND NUM_RESIDENCIA_DOMIC LIKE '%" . trim($temp[1]) . "%'";
			$string = "&endereco=" .  trim($_REQUEST["endereco"]) . "&tipo_domicilio=logradouro";
		}
		if($_REQUEST["tipo_domicilio"] == "bairro"){
			$query .= " WHERE NOM_BAIRRO_RESIDENCIA_DOMIC LIKE '%" . trim($_REQUEST["endereco"]) . "%'";
			$string = "&endereco=" .  trim($_REQUEST["endereco"]) . "&tipo_domicilio=bairro";
		}
		if($_REQUEST["tipo_domicilio"] == "cep"){
			$query .= " WHERE CEP_RESIDENCIA_DOMIC LIKE '%" . trim($_REQUEST["endereco"]) . "%'";
			$string = "&endereco=" .  trim($_REQUEST["endereco"]) . "&tipo_domicilio=cep";
		}
		$ordem = " ORDER BY NOM_LOGRADOURO_DOMIC, NUM_RESIDENCIA_DOMIC";
		browser($query, $colunas, $string, '',$ordem,5); ?>
		<script language="javascript">
			document.forms[0].elements[0].focus();
		</script>
	</body>
</html>