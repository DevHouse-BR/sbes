<?
require("includes/funcoes_layout.php");

$modo = $_REQUEST["modo"];
$DOMICILIO = $_REQUEST["DOMICILIO"];
$VAL_DESP_MENSAIS_ALUGUEL_PESSOA = $_REQUEST["VAL_DESP_MENSAIS_ALUGUEL_PESSOA"];
$VAL_DESP_PREST_HAB_PESSOA = $_REQUEST["VAL_DESP_PREST_HAB_PESSOA"];
$VAL_DESP_ALIMENT_PESSOA = $_REQUEST["VAL_DESP_ALIMENT_PESSOA"];
$VAL_DESP_AGUA_PESSOA = $_REQUEST["VAL_DESP_AGUA_PESSOA"];
$VAL_DESP_LUZ_PESSOA = $_REQUEST["VAL_DESP_LUZ_PESSOA"];
$VAL_DESP_TRANSPOR_PESSOA = $_REQUEST["VAL_DESP_TRANSPOR_PESSOA"];
$VAL_DESP_MEDICAMENTOS_PESSOA = $_REQUEST["VAL_DESP_MEDICAMENTOS_PESSOA"];
$VAL_DESP_GAS_PESSOA = $_REQUEST["VAL_DESP_GAS_PESSOA"];
$VAL_OUTRAS_DESP_PESSOA = $_REQUEST["VAL_OUTRAS_DESP_PESSOA"];
$NUM_PESSOAS_RENDA_PESSOA = $_REQUEST["NUM_PESSOAS_RENDA_PESSOA"];
$TXT_ELETRO_FAMILIA = '';

for($i = 0; $i < count($_REQUEST["TXT_ELETRO_FAMILIA"]); $i++){
	$TXT_ELETRO_FAMILIA .= $_REQUEST["TXT_ELETRO_FAMILIA"][$i];
	if($i<count($_REQUEST["TXT_ELETRO_FAMILIA"])-1) $TXT_ELETRO_FAMILIA .= ";";
}

$VAL_DESP_MENSAIS_ALUGUEL_PESSOA = str_replace(".","",$VAL_DESP_MENSAIS_ALUGUEL_PESSOA);
$VAL_DESP_PREST_HAB_PESSOA = str_replace(".","",$VAL_DESP_PREST_HAB_PESSOA);
$VAL_DESP_ALIMENT_PESSOA = str_replace(".","",$VAL_DESP_ALIMENT_PESSOA);
$VAL_DESP_AGUA_PESSOA = str_replace(".","",$VAL_DESP_AGUA_PESSOA);
$VAL_DESP_LUZ_PESSOA = str_replace(".","",$VAL_DESP_LUZ_PESSOA);
$VAL_DESP_TRANSPOR_PESSOA = str_replace(".","",$VAL_DESP_TRANSPOR_PESSOA);
$VAL_DESP_MEDICAMENTOS_PESSOA = str_replace(".","",$VAL_DESP_MEDICAMENTOS_PESSOA);
$VAL_DESP_GAS_PESSOA = str_replace(".","",$VAL_DESP_GAS_PESSOA);
$VAL_OUTRAS_DESP_PESSOA = str_replace(".","",$VAL_OUTRAS_DESP_PESSOA);

$VAL_DESP_MENSAIS_ALUGUEL_PESSOA = str_replace(",",".",$VAL_DESP_MENSAIS_ALUGUEL_PESSOA);
$VAL_DESP_PREST_HAB_PESSOA = str_replace(",",".",$VAL_DESP_PREST_HAB_PESSOA);
$VAL_DESP_ALIMENT_PESSOA = str_replace(",",".",$VAL_DESP_ALIMENT_PESSOA);
$VAL_DESP_AGUA_PESSOA = str_replace(",",".",$VAL_DESP_AGUA_PESSOA);
$VAL_DESP_LUZ_PESSOA = str_replace(",",".",$VAL_DESP_LUZ_PESSOA);
$VAL_DESP_TRANSPOR_PESSOA = str_replace(",",".",$VAL_DESP_TRANSPOR_PESSOA);
$VAL_DESP_MEDICAMENTOS_PESSOA = str_replace(",",".",$VAL_DESP_MEDICAMENTOS_PESSOA);
$VAL_DESP_GAS_PESSOA = str_replace(",",".",$VAL_DESP_GAS_PESSOA);
$VAL_OUTRAS_DESP_PESSOA = str_replace(",",".",$VAL_OUTRAS_DESP_PESSOA);


require("includes/conectar_mysql.php");

if($modo == "add"){
	/*$query = "SELECT DOMICILIO FROM domicilio_1 WHERE NOM_LOGRADOURO_DOMIC='" . $NOM_LOGRADOURO_DOMIC . "' AND NUM_RESIDENCIA_DOMIC";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result)>0) tela_erro("Já existe um programa social com este código. Clique no botão VOLTAR e informe outro.");
	else{*/
	$query = "INSERT INTO domicilio_3 (DOMICILIO, VAL_DESP_MENSAIS_ALUGUEL_PESSOA, VAL_DESP_PREST_HAB_PESSOA, VAL_DESP_ALIMENT_PESSOA, VAL_DESP_AGUA_PESSOA, VAL_DESP_LUZ_PESSOA, VAL_DESP_TRANSPOR_PESSOA, VAL_DESP_MEDICAMENTOS_PESSOA, VAL_DESP_GAS_PESSOA, VAL_OUTRAS_DESP_PESSOA, NUM_PESSOAS_RENDA_PESSOA, TXT_ELETRO_FAMILIA) VALUES ";
	$query .= "('" . $DOMICILIO . "',";
	$query .= "'" . $VAL_DESP_MENSAIS_ALUGUEL_PESSOA . "',";
	$query .= "'" . $VAL_DESP_PREST_HAB_PESSOA . "',";
	$query .= "'" . $VAL_DESP_ALIMENT_PESSOA . "',";
	$query .= "'" . $VAL_DESP_AGUA_PESSOA . "',";
	$query .= "'" . $VAL_DESP_LUZ_PESSOA . "',";
	$query .= "'" . $VAL_DESP_TRANSPOR_PESSOA . "',";
	$query .= "'" . $VAL_DESP_MEDICAMENTOS_PESSOA . "',";
	$query .= "'" . $VAL_DESP_GAS_PESSOA . "',";
	$query .= "'" . $VAL_OUTRAS_DESP_PESSOA . "',";
	$query .= "'" . $NUM_PESSOAS_RENDA_PESSOA . "',";
	$query .= "'" . $TXT_ELETRO_FAMILIA . "')";
	//}
}
if($modo == "update"){
	$query = "UPDATE domicilio_3 SET ";
	$query .= "VAL_DESP_MENSAIS_ALUGUEL_PESSOA='" . $VAL_DESP_MENSAIS_ALUGUEL_PESSOA . "',";
	$query .= "VAL_DESP_PREST_HAB_PESSOA='" . $VAL_DESP_PREST_HAB_PESSOA . "',";
	$query .= "VAL_DESP_ALIMENT_PESSOA='" . $VAL_DESP_ALIMENT_PESSOA . "',";
	$query .= "VAL_DESP_AGUA_PESSOA='" . $VAL_DESP_AGUA_PESSOA . "',";
	$query .= "VAL_DESP_LUZ_PESSOA='" . $VAL_DESP_LUZ_PESSOA . "',";
	$query .= "VAL_DESP_TRANSPOR_PESSOA='" . $VAL_DESP_TRANSPOR_PESSOA . "',";
	$query .= "VAL_DESP_MEDICAMENTOS_PESSOA='" . $VAL_DESP_MEDICAMENTOS_PESSOA . "',";
	$query .= "VAL_DESP_GAS_PESSOA='" . $VAL_DESP_GAS_PESSOA . "',";
	$query .= "VAL_OUTRAS_DESP_PESSOA='" . $VAL_OUTRAS_DESP_PESSOA . "',";
	$query .= "NUM_PESSOAS_RENDA_PESSOA='" . $NUM_PESSOAS_RENDA_PESSOA . "',";
	$query .= "TXT_ELETRO_FAMILIA='" . $TXT_ELETRO_FAMILIA . "'";
	$query .= " WHERE DOMICILIO='" . $DOMICILIO . "'";
}
$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error() . $query);
if($result) header("Location: form_usuario_familia_4.php?DOMICILIO=" . $DOMICILIO);

require("includes/desconectar_mysql.php");
?>