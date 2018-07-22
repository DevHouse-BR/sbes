<?
require("includes/funcoes_layout.php");

$modo = $_REQUEST["modo"];
$DOMICILIO = $_REQUEST["DOMICILIO"];
$COD_DOMICILIAR = $_REQUEST["COD_DOMICILIAR"];
$TIP_LOGRAD_DOMIC = $_REQUEST["TIP_LOGRAD_DOMIC"];
$NOM_LOGRADOURO_DOMIC = $_REQUEST["NOM_LOGRADOURO_DOMIC"];
$NUM_RESIDENCIA_DOMIC = $_REQUEST["NUM_RESIDENCIA_DOMIC"];
$NOM_COMPL_RESIDENCIA_DOMIC = $_REQUEST["NOM_COMPL_RESIDENCIA_DOMIC"];
$NOM_BAIRRO_RESIDENCIA_DOMIC = $_REQUEST["NOM_BAIRRO_RESIDENCIA_DOMIC"];
$CEP_RESIDENCIA_DOMIC = $_REQUEST["CEP_RESIDENCIA_DOMIC"];
$NOM_LOCALIDADE_DOMIC = $_REQUEST["NOM_LOCALIDADE_DOMIC"];
$SIG_UF_RESIDENCIA_DOMIC = $_REQUEST["SIG_UF_RESIDENCIA_DOMIC"];
$COD_DDD_RESIDENCIA_DOMIC = $_REQUEST["COD_DDD_RESIDENCIA_DOMIC"];
$NUM_TEL_CONTATO_DOMIC = $_REQUEST["NUM_TEL_CONTATO_DOMIC"];

require("includes/conectar_mysql.php");

if($modo == "add"){
	if((strlen($CEP_RESIDENCIA_DOMIC)>0) && (strlen($NUM_RESIDENCIA_DOMIC) > 0)){
		$query = "SELECT DOMICILIO FROM domicilio_1 WHERE CEP_RESIDENCIA_DOMIC='" . $CEP_RESIDENCIA_DOMIC . "' AND NUM_RESIDENCIA_DOMIC='" . $NUM_RESIDENCIA_DOMIC . "'";
		$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
		if(mysql_num_rows($result)>0) tela_erro("Domícilio já cadastrado. Clique no botão VOLTAR e informe outro.");
	}
	$query = "INSERT INTO domicilio_1 (COD_DOMICILIAR, TIP_LOGRAD_DOMIC, NOM_LOGRADOURO_DOMIC, NUM_RESIDENCIA_DOMIC, NOM_COMPL_RESIDENCIA_DOMIC, NOM_BAIRRO_RESIDENCIA_DOMIC, CEP_RESIDENCIA_DOMIC, NOM_LOCALIDADE_DOMIC, SIG_UF_RESIDENCIA_DOMIC, COD_DDD_RESIDENCIA_DOMIC, NUM_TEL_CONTATO_DOMIC) VALUES ";
	$query .= "('" . $COD_DOMICILIAR . "',";
	$query .= "'" . $TIP_LOGRAD_DOMIC . "',";
	$query .= "'" . $NOM_LOGRADOURO_DOMIC . "',";
	$query .= "'" . $NUM_RESIDENCIA_DOMIC . "',";
	$query .= "'" . $NOM_COMPL_RESIDENCIA_DOMIC . "',";
	$query .= "'" . $NOM_BAIRRO_RESIDENCIA_DOMIC . "',";
	$query .= "'" . $CEP_RESIDENCIA_DOMIC . "',";
	$query .= "'" . $NOM_LOCALIDADE_DOMIC . "',";
	$query .= "'" . $SIG_UF_RESIDENCIA_DOMIC . "',";
	$query .= "'" . $COD_DDD_RESIDENCIA_DOMIC . "',";
	$query .= "'" . $NUM_TEL_CONTATO_DOMIC . "')";
}
if($modo == "update"){
	$query = "UPDATE domicilio_1 SET ";
	$query .= "COD_DOMICILIAR='" . $COD_DOMICILIAR . "', ";
	$query .= "TIP_LOGRAD_DOMIC='" . $TIP_LOGRAD_DOMIC . "', ";
	$query .= "NOM_LOGRADOURO_DOMIC='" . $NOM_LOGRADOURO_DOMIC . "', ";
	$query .= "NUM_RESIDENCIA_DOMIC='" . $NUM_RESIDENCIA_DOMIC . "', ";
	$query .= "NOM_COMPL_RESIDENCIA_DOMIC='" . $NOM_COMPL_RESIDENCIA_DOMIC . "', ";
	$query .= "NOM_BAIRRO_RESIDENCIA_DOMIC='" . $NOM_BAIRRO_RESIDENCIA_DOMIC . "', ";
	$query .= "CEP_RESIDENCIA_DOMIC='" . $CEP_RESIDENCIA_DOMIC . "', ";
	$query .= "NOM_LOCALIDADE_DOMIC='" . $NOM_LOCALIDADE_DOMIC . "', ";
	$query .= "SIG_UF_RESIDENCIA_DOMIC='" . $SIG_UF_RESIDENCIA_DOMIC . "', ";
	$query .= "COD_DDD_RESIDENCIA_DOMIC='" . $COD_DDD_RESIDENCIA_DOMIC . "', ";
	$query .= "NUM_TEL_CONTATO_DOMIC='" . $NUM_TEL_CONTATO_DOMIC . "'";
	$query .= " WHERE DOMICILIO='" . $DOMICILIO . "'";
}
$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error() . $query);
if($modo == "add"){
	$result = mysql_query("SELECT LAST_INSERT_ID();") or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	$registro = mysql_fetch_row($result);
	$DOMICILIO = $registro[0];
}
if($result) header("Location: form_usuario_familia_4.php?DOMICILIO=" . $DOMICILIO);

require("includes/desconectar_mysql.php");

?>