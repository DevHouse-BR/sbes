<?
require("includes/funcoes_layout.php");

$modo = $_REQUEST["modo"];
$PESSOA = $_REQUEST["PESSOA"];
$DOMICILIO = $_REQUEST["DOMICILIO"];
$programa_social = $_REQUEST["programa_social"];
$dt_inicio = $_POST["dt_inicio"];
$dt_termino = $_POST["dt_termino"];

require("includes/conectar_mysql.php");


if($modo == "apagar") $janela = false;
else $janela = true;

$query = "SELECT * FROM usuario_programa_social WHERE usuario='" . $_SESSION["cd_usuario"] . "' AND programa_social=" . $programa_social . " AND dt_inicio <= NOW() AND dt_termino >= NOW()";
$result = mysql_query($query) or tela_erro("Erro ao excluir dados: " . mysql_error(), $janela);
$qtd = mysql_num_rows($result);
if($qtd < 1) die(tela_erro("Você não tem permissões para fazer alterações neste programa social!", $janela));

if($modo != "apagar"){
	$query = "SELECT COUNT(*) FROM programa_social WHERE cd=" . $programa_social . " AND dt_inicio <= '" . $dt_inicio . "' AND dt_termino >= '" . $dt_termino . "'";
	$result = mysql_query($query) or tela_erro("Erro ao excluir dados: " . mysql_error(), $janela);
	$registro = mysql_fetch_row($result);
	$qtd = $registro[0];
	if($qtd < 1) die(tela_erro("As datas informadas estão fora da vigência do programa social.", $janela));
}

if($modo == "apagar"){
	$query = "SELECT COUNT(*) FROM beneficios WHERE DOMICILIO='" . $DOMICILIO . "' AND programa_social=" . $programa_social . " AND PESSOA=" . $PESSOA;
	$result = mysql_query($query) or tela_erro("Erro ao excluir dados: " . mysql_error(), $janela);
	$registro = mysql_fetch_row($result);
	$qtd = $registro[0];
	if($qtd > 0) die(tela_erro("Já foram concebidos benefícios para este programa social. Não é possível remover!", $janela));
	
	$query = "DELETE FROM pessoa_programa_social WHERE PESSOA='" . $PESSOA . "' AND programa_social=" . $programa_social;
	$result = mysql_query($query) or tela_erro("Erro ao excluir dados: " . mysql_error(), $janela);
	if($result) header("Location: form_usuario_familia_9.php?DOMICILIO=" . $DOMICILIO . "&PESSOA=" . $PESSOA);
	die();
}

$dt_inicio = split("/", $dt_inicio);
$dt_inicio = $dt_inicio[2] . "-" . $dt_inicio[1] . "-" . $dt_inicio[0];
$dt_termino = split("/", $dt_termino);
$dt_termino = $dt_termino[2] . "-" . $dt_termino[1] . "-" . $dt_termino[0];

if($dt_termino < $dt_inicio) tela_erro("A data de término deve ser posterior à data de inicio.", true);

if($modo == "add"){
	$query = "SELECT PESSOA FROM pessoa_programa_social WHERE PESSOA='" . $DOMICILIO . "' AND programa_social=" . $programa_social;
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), true);
	if(mysql_num_rows($result)>0) tela_erro("Esta pessoa já está associado a este programa social. Clique no botão Fechar e informe outro.", true);
	else{
		$query = "INSERT INTO pessoa_programa_social (PESSOA, programa_social, dt_inicio, dt_termino) VALUES ";
		$query .= "('" . $PESSOA ."',";
		$query .= "'" . $programa_social ."',";
		$query .= "'" . $dt_inicio ."',";
		$query .= "'" . $dt_termino ."')";
	}
}
if($modo == "update"){
	$query = "UPDATE pessoa_programa_social SET ";
	$query .= "dt_inicio='" . $dt_inicio . "', ";
	$query .= "dt_termino='" . $dt_termino . "'";
	$query .= " WHERE PESSOA='" . $PESSOA . "' AND programa_social='" . $programa_social . "'";
}
$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), true);
if($result) saida();

require("includes/desconectar_mysql.php");
?>