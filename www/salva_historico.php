<?
require("includes/funcoes_layout.php");

$cd = $_REQUEST["cd"];
$modo = $_REQUEST["modo"];
$DOMICILIO = $_REQUEST["DOMICILIO"];
$PESSOA = $_REQUEST["PESSOA"];
$historico = $_REQUEST["historico"];
$data = $_REQUEST["data"];


$data = split("/", $data);
$data = $data[2] . "-" . $data[1] . "-" . $data[0];

require("includes/conectar_mysql.php");

if($modo == "apagar"){
	$query = "DELETE FROM historicos WHERE cd=" . $cd . " LIMIT 1";
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	die(header("Location: busca_historico.php?DOMICILIO=" . $DOMICILIO . "&PESSOA=" . $PESSOA));
}
elseif($modo == "add"){
	if(strlen(trim($PESSOA))>0){
		$query = "INSERT INTO historicos (DOMICILIO, PESSOA, data, historico) VALUES ";
		$query .= "('" . $DOMICILIO . "',";
		$query .= "'" . $PESSOA . "',";
		$query .= "'" . $data . "',";
		$query .= "'" . $historico . "')";
	}
	else{
		$query = "INSERT INTO historicos (DOMICILIO, data, historico) VALUES ";
		$query .= "('" . $DOMICILIO . "',";
		$query .= "'" . $data . "',";
		$query .= "'" . $historico . "')";
	}
}
if($modo == "update"){
	$query = "UPDATE historicos SET ";
	$query .= "data='" . $data . "', ";
	$query .= "historico='" . $historico . "'";
	$query .= " WHERE cd=" . $cd;
}
$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error() . $query);
if($result) if($result) saida();
require("includes/desconectar_mysql.php");
?>