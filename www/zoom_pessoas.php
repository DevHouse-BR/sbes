<?
require("includes/funcoes_layout.php");
?>
	<html>
	<head>
		<title>Pessoas</title>
		<link rel="stylesheet" href="includes/estilo.css">
		</head>
	<body style="background-image:url(); background-color:#FFFFFF; margin: 2px;">
		<div>
			<? inicia_quadro_claro('width="100%"', 'Busca de Pessoas'); ?>
			<div style="width: 100%; text-align:center;">
				<table>
				<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
				<tr>
					<td class="label">Busca:</td>
					<td><input type="text" name="nome" value="<?=trim($_REQUEST["nome"])?>" size="20" class="caixa_texto"></td>
					<td>
						<select name="tipo_pessoa">
							<option value="nome">Nome</option>
						</select>
					</td>
					<td><input type="submit" value="" class="botao_busca_azul"></td>
				</tr>
				<input type="hidden" name="modo" value="<?=$modo?>">
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
						
		$colunas[1]['largura'] = "30%";
		$colunas[1]['label'] = "Nome";
		$colunas[1]['alinhamento'] = "left";
		
		$colunas[2]['largura'] = "60%";
		$colunas[2]['label'] = "Endereço";
		$colunas[2]['alinhamento'] = "left";
				
		$query = "SELECT ";
		$query .= " CONCAT('<a href=\"#\" onClick=\"adiciona_filtro(2,', p.PESSOA , ',\'Usuário: ', p.NOM_PESSOA, '\');\"><img border=\"0\" src=\"imagens/seta.gif\"></a>') as cd,";
		$query .= "p.NOM_PESSOA, ";
		$query .= "CONCAT(d.TIP_LOGRAD_DOMIC, ' ', d.NOM_LOGRADOURO_DOMIC, ' ', d.NUM_RESIDENCIA_DOMIC, ' ', d.NOM_COMPL_RESIDENCIA_DOMIC) as endereco";
		$query .= " from domicilio_1 d, pessoa_1 p WHERE p.DOMICILIO = d.DOMICILIO";

		if($_REQUEST["tipo_pessoa"] == "nome"){
			$query .= " AND NOM_PESSOA LIKE '%" . trim($_REQUEST["nome"]) . "%'";
			$string = "&endereco=" . trim($_REQUEST["nome"]) . "&tipo_pessoa=nome";
		}
		$ordem = " ORDER BY p.NOM_PESSOA";
		browser($query, $colunas, $string, '',$ordem, 5); ?>
		<script language="javascript">
			document.forms[0].elements[0].focus();
		</script>
	</body>
</html>