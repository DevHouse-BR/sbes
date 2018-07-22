<?
require("includes/funcoes_layout.php");

$modo = $_REQUEST["modo"];
$cd = $_REQUEST["cd"];
$codigo = $_POST["codigo"];
$descricao = $_POST["descricao"];
$dt_inicio = $_POST["dt_inicio"];
$dt_termino = $_POST["dt_termino"];
$comentarios = $_POST["comentarios"];

$dt_inicio = split("/", $dt_inicio);
$dt_inicio = $dt_inicio[2] . "-" . $dt_inicio[1] . "-" . $dt_inicio[0];
$dt_termino = split("/", $dt_termino);
$dt_termino = $dt_termino[2] . "-" . $dt_termino[1] . "-" . $dt_termino[0];

require("includes/conectar_mysql.php");

if($modo == "apagar"){
	$query = "SELECT COUNT(*) FROM beneficios WHERE programa_social=" . $cd;
	$result = mysql_query($query) or tela_erro("Erro ao pesquisar dados: " . mysql_error(), $janela);
	$registro = mysql_fetch_row($result);
	$qtd = $registro[0];
	if($qtd > 0) die(tela_erro("Já foram concebidos benefícios para este programa social. Não é possível remover!", $janela));

	$query = "DELETE FROM pessoa_programa_social WHERE programa_social=" . $cd;
	$result = mysql_query($query) or tela_erro("Erro ao excluir dados: " . mysql_error(), $janela);
	
	$query = "DELETE FROM domicilio_programa_social WHERE programa_social=" . $cd;
	$result = mysql_query($query) or tela_erro("Erro ao excluir dados: " . mysql_error(), $janela);
	
	$query = "DELETE FROM usuario_programa_social WHERE programa_social=" . $cd;
	$result = mysql_query($query) or tela_erro("Erro ao excluir dados: " . mysql_error(), $janela);
	
	$query = "SELECT cd, path FROM arquivo_programa_social WHERE programa_social=" . $cd;
	$result = mysql_query($query) or tela_erro("Erro ao carregar registros do Banco de dados: " . mysql_error(), true);
	while($registro = mysql_fetch_assoc($result)){
		unlink($registro["path"]);
		$query = "DELETE FROM arquivo_programa_social WHERE cd=" . $registro["cd"];
		$result2 = mysql_query($query) or tela_erro("Erro ao remover registro do Banco de dados: " . mysql_error(), true);
	}
		
	$query = "DELETE FROM programa_social WHERE cd=" . $cd;
	$result = mysql_query($query) or tela_erro("Erro ao excluir dados: " . mysql_error(), $janela);
	if($result) die('<html><head><title>Operação bem sucedida</title><script language="javascript">alert("Operação concluida com sucesso!");	window.location = "busca_programa_social.php";</script></head></html>');
}

if($modo == "add"){
	$query = "SELECT codigo FROM programa_social WHERE codigo='" . $codigo . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result)>0) tela_erro("Já existe um programa social com este código. Clique no botão VOLTAR e informe outro.");
	else{
		$query = "INSERT INTO programa_social (codigo, descricao, dt_inicio, dt_termino, comentarios) VALUES ";
		$query .= "('" . $codigo ."',";
		$query .= "'" . $descricao ."',";
		$query .= "'" . $dt_inicio ."',";
		$query .= "'" . $dt_termino ."',";
		$query .= "'" . $comentarios ."')";
	}
}
if($modo == "update"){
	$query = "UPDATE programa_social SET ";
	$query .= "codigo='" . $codigo . "', ";
	$query .= "descricao='" . $descricao . "', ";
	$query .= "dt_inicio='" . $dt_inicio . "', ";
	$query .= "dt_termino='" . $dt_termino . "', ";
	$query .= "comentarios='" . $comentarios . "'";
	$query .= " WHERE cd='" . $cd . "'";
}
$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error());

if($modo == "update"){	
	$query = "UPDATE domicilio_programa_social SET dt_termino='" . $dt_termino . "' WHERE programa_social=" . $cd . " AND dt_termino >= '" . $dt_termino . "'";
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	$query = "UPDATE pessoa_programa_social SET dt_termino='" . $dt_termino . "' WHERE programa_social=" . $cd . " AND dt_termino >= '" . $dt_termino . "'";
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error());
}

if($modo == "add"){
	$result = mysql_query("SELECT LAST_INSERT_ID();") or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	$registro = mysql_fetch_row($result);
	$cd = $registro[0];
}
if($result) tela_sucesso("Dados gravados com sucesso!","form_programa_social.php?cd=" . $cd);

require("includes/desconectar_mysql.php");

?>