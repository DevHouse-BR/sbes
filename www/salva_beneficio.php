<?
require("includes/funcoes_layout.php");

$modo = $_REQUEST["modo"];
if($modo != "update") $modo == "add";


$DOMICILIO = $_REQUEST["DOMICILIO"];
$PESSOA = $_REQUEST["PESSOA"];
$programa_social = $_REQUEST["programa_social"];
$valor = $_REQUEST["valor"];
$qtd = $_REQUEST["qtd"];
$nr_recibo = $_REQUEST["nr_recibo"];
$historico = $_REQUEST["historico"];
$cd = $_REQUEST["cd"];
$usuario_sistema = $_REQUEST["usuario_sistema"];
$data = $_POST["data"];

$data = split("/", $data);
$data = $data[2] . "-" . $data[1] . "-" . $data[0];

$valor = str_replace(".","",$valor);
$valor = str_replace(",",".",$valor);

require("includes/conectar_mysql.php");

if($modo != "apagar"){
	$query = "SELECT COUNT(*) FROM programa_social WHERE cd='" . $programa_social . "' AND dt_inicio <= " . $data . " AND dt_termino >= " . $data;
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), true);
	if(mysql_num_rows($result)>0) tela_erro("A data informada está fora da data de vigência do programa social.", true);
}

if($modo == "apagar"){
	$query = "DELETE FROM beneficios WHERE cd=" . $cd . " LIMIT 1";
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	die(header("Location: busca_beneficio.php?DOMICILIO=" . $DOMICILIO . "&PESSOA=" . $PESSOA));
}
elseif($modo == "add"){
	if(strlen(trim($PESSOA))>0){
		$query = "INSERT INTO beneficios (programa_social, DOMICILIO, PESSOA, data, valor, qtd, nr_recibo, historico, usuario_sistema) VALUES ";
		$query .= "('" . $programa_social . "',";
		$query .= "'" . $DOMICILIO . "',";
		$query .= "'" . $PESSOA . "',";
		$query .= "'" . $data . "',";
		$query .= "'" . $valor . "',";
		$query .= "'" . $qtd . "',";
		$query .= "'" . $nr_recibo . "',";
		$query .= "'" . $historico . "',";
		$query .= "'" . $usuario_sistema . "')";
	}
	else{
		$query = "INSERT INTO beneficios (programa_social, DOMICILIO, data, valor, qtd, nr_recibo, historico, usuario_sistema) VALUES ";
		$query .= "('" . $programa_social . "',";
		$query .= "'" . $DOMICILIO . "',";
		$query .= "'" . $data . "',";
		$query .= "'" . $valor . "',";
		$query .= "'" . $qtd . "',";
		$query .= "'" . $nr_recibo . "',";
		$query .= "'" . $historico . "',";
		$query .= "'" . $usuario_sistema . "')";
	}
}
if($modo == "update"){
	if(strlen(trim($PESSOA))>0){
		$query = "UPDATE beneficios SET ";
		$query .= "programa_social='" . $programa_social . "', ";
		$query .= "DOMICILIO='" . $DOMICILIO . "', ";
		$query .= "PESSOA='" . $PESSOA . "', ";
		$query .= "valor='" . $valor . "', ";
		$query .= "qtd='" . $qtd . "', ";
		$query .= "nr_recibo='" . $nr_recibo . "', ";
		$query .= "historico='" . $historico . "'";
		$query .= " WHERE cd='" . $cd . "'";
	}
	else{
		$query = "UPDATE beneficios SET ";
		$query .= "programa_social='" . $programa_social . "', ";
		$query .= "DOMICILIO='" . $DOMICILIO . "', ";
		$query .= "valor='" . $valor . "', ";
		$query .= "qtd='" . $qtd . "', ";
		$query .= "nr_recibo='" . $nr_recibo . "', ";
		$query .= "historico='" . $historico . "'";
		$query .= " WHERE cd='" . $cd . "'";
	}
}
$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error() . $query);
if($result) if($result) saida();
require("includes/desconectar_mysql.php");
?>