<?	require("includes/funcoes_layout.php");
$cd = $_GET["cd"];
?>
<html>
	<head>
		<title>Arquivos - Programas Sociais</title>
		<link rel="stylesheet" href="includes/estilo.css">
	</head>
	<body>
		<? inicia_quadro_branco('width="100%"', 'Anexar Arquivo'); ?>
			<table width="100%" border="0" cellpadding="2" cellspacing="3">
				<form action="salva_arquivo_programa_social.php" method="post" encType="multipart/form-data">
				<tr>
					<td width="10%" class="label">Arquivo:</td>
					<td><input type="file" name="arq" class="caixa_texto" style="width: 100%;"></td>
				</tr>
				<tr>
					<td align="right" colspan="2"><input type="submit" value="  Salvar  " class="botao_aqua" onClick="document.getElementById('loading').style.visibility = 'visible';">&nbsp;&nbsp;<input type="button" value="Cancelar" class="botao_aqua" onClick="self.close();"></td>
				</tr>
					<input name="MAX_FILE_SIZE" type="hidden" value="10000000">
					<input type="hidden" name="programa_social" value="<?=$cd?>">
					<input type="hidden" name="modo" value="add">
				</form>
			</table>
			<div id="loading" style="text-align:center; visibility:hidden;"><img align="middle" src="imagens/carregando.gif">&nbsp;&nbsp;Enviando arquivo</div>
		<? termina_quadro_branco(); ?>
	</body>
</html>
