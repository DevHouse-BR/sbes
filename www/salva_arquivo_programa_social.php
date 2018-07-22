<?
require("includes/funcoes_layout.php");	
include("funcoes_strings.php");
include("file_uploader.php");


$modo = $_REQUEST["modo"];
require("includes/conectar_mysql.php");

if($modo == "erase"){
	$query = "SELECT path FROM arquivo_programa_social WHERE cd=" . $_GET["arquivo"] . " AND programa_social=" . $_GET["programa"];
	$result = mysql_query($query) or tela_erro("Erro ao carregar registros do Banco de dados: " . mysql_error(), true);
	$registro = mysql_fetch_assoc($result);
	unlink($registro["path"]);
	$query = "DELETE FROM arquivo_programa_social WHERE cd=" . $_GET["arquivo"] . " AND programa_social=" . $_GET["programa"];
	$result = mysql_query($query) or tela_erro("Erro ao remover registro do Banco de dados: " . mysql_error(), true);
	die(header("Location: busca_arquivos_programa_social.php?cd=" . $_GET["programa"]));
}

if($modo == "add"){
	$pasta = "arquivos";
	$programa_social = $_POST["programa_social"];
	$arquivo = $_FILES["arq"];
	$nome = $programa_social . "_" . $_FILES["arq"]["name"];
	$info_arquivo = file_upload($pasta, $arquivo, $nome);
	$path = $info_arquivo[0];
	$tamanho = $info_arquivo[1];
	$ext = $info_arquivo[2];
	$nome = $info_arquivo[3];
	
	$query = "INSERT INTO arquivo_programa_social (nome, path, ext, tamanho, programa_social) VALUES ";
	$query .= "('" . $nome ."',";
	$query .= "'" . $path ."',";
	$query .= "'" . $ext ."',";
	$query .= "'" . $tamanho ."',";
	$query .= "'" . $programa_social ."')";
	
	$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	if($result) saida();
}

require("includes/desconectar_mysql.php");
?>