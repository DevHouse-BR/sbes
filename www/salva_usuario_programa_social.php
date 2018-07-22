<?
require("includes/funcoes_layout.php");

$modo = $_REQUEST["modo"];
$usuario = $_REQUEST["usuario"];
$programa_social = $_REQUEST["programa_social"];
$funcao = $_POST["funcao"];
$regiao = $_POST["regiao"];
$dt_inicio = $_POST["dt_inicio"];
$dt_termino = $_POST["dt_termino"];

require("includes/conectar_mysql.php");

if($modo == "apagar"){
	$query = "DELETE FROM usuario_programa_social WHERE usuario='" . $usuario . "' AND programa_social=" . $programa_social;
	$result = mysql_query($query) or tela_erro("Erro ao excluir dados: " . mysql_error(), true);
	if($result) saida();
	die();
}

$dt_inicio = split("/", $dt_inicio);
$dt_inicio = $dt_inicio[2] . "-" . $dt_inicio[1] . "-" . $dt_inicio[0];
$dt_termino = split("/", $dt_termino);
$dt_termino = $dt_termino[2] . "-" . $dt_termino[1] . "-" . $dt_termino[0];

if($dt_termino < $dt_inicio) tela_erro("A data de término deve ser posterior à data de inicio.", true);

if($modo == "add"){
	$query = "SELECT usuario FROM usuario_programa_social WHERE usuario='" . $usuario . "' AND programa_social=" . $programa_social;
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), true);
	if(mysql_num_rows($result)>0) tela_erro("Este usuário já está associado a este programa social. Clique no botão Fechar e informe outro.", true);
	else{
		$query = "INSERT INTO usuario_programa_social (usuario, programa_social, funcao, regiao, dt_inicio, dt_termino) VALUES ";
		$query .= "('" . $usuario ."',";
		$query .= "'" . $programa_social ."',";
		$query .= "'" . $funcao ."',";
		$query .= "'" . $regiao ."',";
		$query .= "'" . $dt_inicio ."',";
		$query .= "'" . $dt_termino ."')";
	}
}
if($modo == "update"){
	$query = "UPDATE usuario_programa_social SET ";
	$query .= "funcao='" . $funcao . "', ";
	$query .= "regiao='" . $regiao . "', ";
	$query .= "dt_inicio='" . $dt_inicio . "', ";
	$query .= "dt_termino='" . $dt_termino . "'";
	$query .= " WHERE usuario='" . $usuario . "' AND programa_social='" . $programa_social . "'";
}
$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), true);
if($result) saida();

require("includes/desconectar_mysql.php");
?>