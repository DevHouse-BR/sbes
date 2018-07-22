<?	require("includes/funcoes_layout.php");	

$cd = $_GET["cd"];
?>
<html>
	<head>
		<title>Arquivos - Programas Sociais</title>
		<link rel="stylesheet" href="includes/estilo.css">
		<script language="javascript">
			function apagar(arquivo){
				if(confirm('Deseja apagar este arquivo?')){
					self.location = 'salva_arquivo_programa_social.php?modo=erase&programa=<?=$cd?>&arquivo=' + arquivo;
				}
				else return false;
			}
		</script>
	</head>
	<body style="background-image:url(); background-color:#FFFFFF;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<form action="manter_usuario_sistema.php" method="post">
			<tr>
				<td><input type="button" value="Anexar" class="botao_aqua" onClick="void window.open('form_anexa_arquivo_programa_social.php?cd=<?=$cd?>', '_blank', 'width=360,height=127,status=no,resizable=no,top=20,left=100');"></td>
			</tr>
			</form>
		</table>
		<div style="height:5px; font-size:5px;"></div>
		<table width="100%" class="conteudo_quadro_claro" border="0" cellpadding="2" cellspacing="0">
		<?
		require("includes/conectar_mysql.php");
		$query = "SELECT * FROM arquivo_programa_social WHERE programa_social=" . $cd;
		$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		if(mysql_num_rows($result) == 0) echo('<tr><td colspan="4">Nenhum arquivo anexado.</td></tr>');	
		$i = 0;
		while($registro = mysql_fetch_assoc($result)){ 
			if ($i == 0){
				$bgcolor = '#E8F2FF';
				$i = 1;
			}
			else {
				$bgcolor = '#F7F7FB';
				$i = 0;
			}
			switch($registro["ext"]){
				case "pdf":
					$icone = 'pdf.gif';
					break;
				case "zip":
					$icone = 'zip.gif';
					break;
				case "doc":
					$icone = 'doc.gif';
					break;
				case "xls":
					$icone = 'xls.gif';
					break;
				case "html":
					$icone = 'html.gif';
					break;
				case "htm":
					$icone = 'html.gif';
					break;
				case "rar":
					$icone = 'rar.gif';
					break;
				case "eml":
					$icone = 'eml.gif';
					break;
				case "mdb":
					$icone = 'mdb.gif';
					break;
				case "ppt":
					$icone = 'ppt.gif';
					break;
				default:
					$icone = 'arq.gif';
			}
			?>
			<tr style="background-color: <?=$bgcolor?>;" onMouseOver="this.style.backgroundColor = '#BACAEB';" onMouseOut="this.style.backgroundColor = '<?=$bgcolor?>';">
				<td width="3%"><a href="<?=$registro["path"]?>" target="_blank"><img border="0" src="imagens/icones_arquivos/<?=$icone?>"></a></td>
				<td title="<?=$registro["nome"]?>">
					<?
					if(strlen($registro["nome"]) > 23) echo(substr($registro["nome"], 0, 23) . '...');
					else echo($registro["nome"]);
					?>
				</td>
				<td width="30%"><?=$registro["tamanho"]?></td>
				<td width="3%"><a href="javascript: apagar(<?=$registro["cd"]?>);"><img border="0" src="imagens/lixeira.gif"></a></td>
			</tr>
		<? } ?>
		</table>
	</body>
</html>