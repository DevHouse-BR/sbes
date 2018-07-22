<?
require("includes/funcoes_layout.php");
?>
	<html>
	<head>
		<title>Usu&aacute;rios do Sistema</title>
		<link rel="stylesheet" href="includes/estilo.css">
		</head>
	<body style="background-image:url(); background-color:#FFFFFF; margin: 2px;">
		<div>
			<? inicia_quadro_claro('width="100%"', 'Busca de Usuários'); ?>
			<div style="width: 100%; text-align:center;">
				<table>
					<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
					<tr>
						<td class="label">Nome:</td>
						<td><input type="text" name="nome" size="10" class="caixa_texto" value="<?=$_REQUEST["nome"]?>"></td>
						<td>
							<select name="ativo">
								<option value=""></option>
								<option value="s"<? if($_REQUEST["ativo"] == 's') echo(' selected');?>>Ativo</option>
								<option value="n"<? if($_REQUEST["ativo"] == 'n') echo(' selected');?>>Inativo</option>
							</select>					
						</td>
						<td><input type="submit" value="" class="botao_busca_azul"></td>
					</tr>
						<input type="hidden" name="modo" value="<?=$_REQUEST["modo"]?>">
					</form>

					<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
					<tr>
						<td class="label">ID Social:</td>
						<td><input type="text" name="id_social" size="10" class="caixa_texto"></td>
						<td>
							<select name="ativo">
								<option value=""></option>
								<option value="s"<? if($_REQUEST["ativo"] == 's') echo(' selected');?>>Ativo</option>
								<option value="n"<? if($_REQUEST["ativo"] == 'n') echo(' selected');?>>Inativo</option>
							</select>					
						</td>
						<td><input type="submit" value="" class="botao_busca_azul"></td>
					</tr>
						<input type="hidden" name="modo" value="<?=$_REQUEST["modo"]?>">
					</form>
				</table>
			</div>
			<? termina_quadro_claro(); ?>
		</div>
		<?
		if(trim($_REQUEST["modo"]) == "relatorio") { ?>
			<script language="javascript">
				function adiciona_filtro(filtro, valor, texto){
					var opcao = opener.document.createElement("OPTION");
					opcao.text = texto;
					opcao.value = filtro + ';' + valor;
					opener.document.forms[0].elements['filtros[]'].options.add(opcao);
				}
			</script>
		<? 
		}
		$colunas[0]['largura'] = "5%";
		$colunas[0]['label'] = "&nbsp;";
		$colunas[0]['alinhamento'] = "left";
		
		$colunas[1]['largura'] = "45%";
		$colunas[1]['label'] = "Nome";
		$colunas[1]['alinhamento'] = "left";
		
		$colunas[2]['largura'] = "40%";
		$colunas[2]['label'] = "Identificação Social";
		$colunas[2]['alinhamento'] = "left";
		
		$query = "SELECT ";
		if(trim($_REQUEST["modo"]) == "relatorio") {
			$query .= " CONCAT('<a href=\"#\" onClick=\"adiciona_filtro(4,', cd , ',\'Usuario do Sistema: ', nome, '\');\"><img border=\"0\" src=\"imagens/seta.gif\"></a>') as cd,";
		}
		else {
			$query .= " CONCAT('<a href=\"#\" onClick=\"opener.document.forms[0].usuario.value=\'', cd , '\'; opener.document.forms[0].nome.value=\'', nome, '\'; self.close();\"><img border=\"0\" src=\"imagens/seta.gif\"></a>') as cd,";
		}
		$query .= "nome, id_social";
		$query .= " from usuarios_sistema ";
		
		if(!empty($_REQUEST["nome"])) {
			$query .= " WHERE nome LIKE '%" . $_REQUEST["nome"] . "%' AND ativo LIKE '%" . $_REQUEST["ativo"] . "%'";
			$string = "&nome=" .  $_REQUEST["nome"] . "&ativo=" . $_REQUEST["ativo"];
		}
		if(!empty($_REQUEST["id_social"])) {
			$query .= " WHERE id_social LIKE '%" . $_REQUEST["id_social"] . "%' AND ativo LIKE '%" . $_REQUEST["ativo"] . "%'";
			$string = "&id_social=" .  $_REQUEST["id_social"] . "&ativo=" . $_REQUEST["ativo"];
		}
		if(trim($_REQUEST["modo"]) == "relatorio") $string .= "&modo=relatorio";
		$ordem = " ORDER BY nome";
		browser($query, $colunas, $string, '',$ordem, 5); ?>
		<script language="javascript">
			document.forms[0].elements[0].focus();
		</script>
	</body>
</html>