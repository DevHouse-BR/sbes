<?
require("includes/funcoes_layout.php");

$modo = $_REQUEST["modo"];

if($modo == "apagar"){
	require("includes/conectar_mysql.php");
	$query = "SELECT COUNT(*) FROM usuario_programa_social WHERE usuario='" . $_GET["cd"] . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	$registro = mysql_fetch_row($result);
	if($registro[0] > 0) tela_erro('Usuario está associado a um ou mais programas sociais.');
	$query = "DELETE FROM usuarios_sistema WHERE cd='" . $_GET["cd"] . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	require("includes/desconectar_mysql.php");
	die(header("Location: busca_usuario_sistema.php?pagina=" . $_GET['pagina'] . "&nome=" . $_GET["nome"] . "&id_social=" . $_GET["id_social"] . "&ativo=" . $_GET["ativo"]));
}


if($modo == "ativo"){
	require("includes/conectar_mysql.php");
	$query = "UPDATE usuarios_sistema SET ativo='" . $_GET["new"] . "' WHERE cd='" . $_GET["cd"] . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	require("includes/desconectar_mysql.php");
	die(header("Location: busca_usuario_sistema.php?pagina=" . $_GET['pagina'] . "&nome=" . $_GET["nome"] . "&id_social=" . $_GET["id_social"] . "&ativo=" . $_GET["ativo"]));
}
$cd = $_POST["cd"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$id_social = $_POST["id_social"];
$usuario = $_POST["usuario"];
$senha = $_POST["senha"];
$papeis_usuario = $_POST["papeis_usuario"];
$ativo = $_POST["ativo"];

if($ativo == "on") $ativo = 's';
else $ativo = 'n';

$administrador = "n";
$assistente_social = "n";
$operador = "n";
$secretario = "n";

for($i = 0; $i < count($papeis_usuario); $i++){
	switch($papeis_usuario[$i]){
		case "administrador":
			$administrador = "s";
			break;
		case "assistente_social":
			$assistente_social = "s";
			break;
		case "operador":
			$operador = "s";
			break;
		case "secretario":
			$secretario = "s";
			break;
	}
}

require("includes/conectar_mysql.php");

if($modo == "add"){
	$query = "SELECT usuario FROM usuarios_sistema WHERE usuario='" . $usuario . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result)>0) tela_erro("Este Login (nome de usuário) já se encontra em uso por outro usuário do sistema. Clique no botão VOLTAR e escolha outro nome.");
	else{
		$query = "INSERT INTO usuarios_sistema (nome, email, id_social, usuario, senha, administrador, assistente_social, operador, secretario, ativo) VALUES ";
		$query .= "('" . $nome ."',";
		$query .= "'" . $email ."',";
		$query .= "'" . $id_social ."',";
		$query .= "'" . $usuario ."',";
		$query .= "'" . $senha ."',";
		$query .= "'" . $administrador ."',";
		$query .= "'" . $assistente_social ."',";
		$query .= "'" . $operador ."',";
		$query .= "'" . $secretario ."',";
		$query .= "'" . $ativo ."')";
	}
}
if($modo == "update"){
	$query = "UPDATE usuarios_sistema SET ";
	$query .= "nome='" . $nome . "', ";
	$query .= "email='" . $email . "', ";
	$query .= "id_social='" . $id_social . "', ";
	$query .= "usuario='" . $usuario . "', ";
	if(strlen($senha)>0) $query .= "senha='" . $senha . "', ";
	$query .= "administrador='" . $administrador . "', ";
	$query .= "assistente_social='" . $assistente_social . "', ";
	$query .= "operador='" . $operador . "', ";
	$query .= "ativo='" . $ativo . "', ";
	$query .= "secretario='" . $secretario . "'";
	$query .= " WHERE cd='" . $cd . "'";
}
$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error());
if($modo == "add"){
	$result = mysql_query("SELECT LAST_INSERT_ID();") or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	$registro = mysql_fetch_row($result);
	$cd = $registro[0];
}
die(header("Location: form_usuario_sistema.php?mensagem=ok&cd=" . $cd));
require("includes/desconectar_mysql.php");

?>