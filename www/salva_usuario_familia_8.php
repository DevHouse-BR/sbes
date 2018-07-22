<?
require("includes/funcoes_layout.php");

$modo = $_REQUEST["modo"];
$DOMICILIO = $_REQUEST["DOMICILIO"];
$PESSOA = $_REQUEST["PESSOA"];
$COD_ESTADO_CIVIL_PESSOA = $_REQUEST["COD_ESTADO_CIVIL_PESSOA"];
$COD_RACA_COR_PESSOA = $_REQUEST["COD_RACA_COR_PESSOA"];
$NUM_ROUPA_PESSOA = $_REQUEST["NUM_ROUPA_PESSOA"];
$NUM_CALCADO_PESSOA = $_REQUEST["NUM_CALCADO_PESSOA"];
$COD_MEIO_TRANSP_PESSOA = $_REQUEST["COD_MEIO_TRANSP_PESSOA"];
$NOM_EMAIL_PESSOA = $_REQUEST["NOM_EMAIL_PESSOA"];
$COD_CRIANCA_0_6_ANOS_PESSOA = $_REQUEST["COD_CRIANCA_0_6_ANOS_PESSOA"];
$COD_GRAVIDA_PESSOA = $_REQUEST["COD_GRAVIDA_PESSOA"];
$COD_AMAMENTANDO_PESSOA = $_REQUEST["COD_AMAMENTANDO_PESSOA"];
$COD_PRE_NATAL_PESSOA = $_REQUEST["COD_PRE_NATAL_PESSOA"];
$COD_METOD_ANTI_CONCEP_PESSOA = $_REQUEST["COD_METOD_ANTI_CONCEP_PESSOA"];
$COD_CARTEIRA_VACINA_PESSOA = $_REQUEST["COD_CARTEIRA_VACINA_PESSOA"];
$NOM_DEPEN_QUIMICA_PESSOA = $_REQUEST["NOM_DEPEN_QUIMICA_PESSOA"];
$TXT_DOENCAS_PESSOA = '';

for($i = 0; $i < count($_REQUEST["TXT_DOENCAS_PESSOA"]); $i++){
	$TXT_DOENCAS_PESSOA .= $_REQUEST["TXT_DOENCAS_PESSOA"][$i];
	if($i<count($_REQUEST["TXT_DOENCAS_PESSOA"])-1) $TXT_DOENCAS_PESSOA .= ";";
}

if($COD_AMAMENTANDO_PESSOA == 'on') $COD_AMAMENTANDO_PESSOA = 's';
else $COD_AMAMENTANDO_PESSOA = 'n';
if($COD_PRE_NATAL_PESSOA == 'on') $COD_PRE_NATAL_PESSOA = 's';
else $COD_PRE_NATAL_PESSOA = 'n';
if($COD_METOD_ANTI_CONCEP_PESSOA == 'on') $COD_METOD_ANTI_CONCEP_PESSOA = 's';
else $COD_METOD_ANTI_CONCEP_PESSOA = 'n';
if($COD_CARTEIRA_VACINA_PESSOA == 'on') $COD_CARTEIRA_VACINA_PESSOA = 's';
else $COD_CARTEIRA_VACINA_PESSOA = 'n';





require("includes/conectar_mysql.php");

if($modo == "add"){
	/*$query = "SELECT DOMICILIO FROM domicilio_1 WHERE NOM_LOGRADOURO_DOMIC='" . $NOM_LOGRADOURO_DOMIC . "' AND NUM_RESIDENCIA_DOMIC";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result)>0) tela_erro("Já existe um programa social com este código. Clique no botão VOLTAR e informe outro.");
	else{*/
	$query = "INSERT INTO pessoa_4 (PESSOA, COD_ESTADO_CIVIL_PESSOA, COD_RACA_COR_PESSOA, NUM_ROUPA_PESSOA, NUM_CALCADO_PESSOA, COD_MEIO_TRANSP_PESSOA, NOM_EMAIL_PESSOA, COD_CRIANCA_0_6_ANOS_PESSOA, COD_GRAVIDA_PESSOA, COD_AMAMENTANDO_PESSOA, COD_PRE_NATAL_PESSOA, COD_METOD_ANTI_CONCEP_PESSOA, COD_CARTEIRA_VACINA_PESSOA, NOM_DEPEN_QUIMICA_PESSOA, TXT_DOENCAS_PESSOA) VALUES ";
	$query .= "('" . $PESSOA . "',";
	$query .= "'" . $COD_ESTADO_CIVIL_PESSOA . "',";
	$query .= "'" . $COD_RACA_COR_PESSOA . "',";
	$query .= "'" . $NUM_ROUPA_PESSOA . "',";
	$query .= "'" . $NUM_CALCADO_PESSOA . "',";
	$query .= "'" . $COD_MEIO_TRANSP_PESSOA . "',";
	$query .= "'" . $NOM_EMAIL_PESSOA . "',";
	$query .= "'" . $COD_CRIANCA_0_6_ANOS_PESSOA . "',";
	$query .= "'" . $COD_GRAVIDA_PESSOA . "',";
	$query .= "'" . $COD_AMAMENTANDO_PESSOA . "',";
	$query .= "'" . $COD_PRE_NATAL_PESSOA . "',";
	$query .= "'" . $COD_METOD_ANTI_CONCEP_PESSOA . "',";
	$query .= "'" . $COD_CARTEIRA_VACINA_PESSOA . "',";
	$query .= "'" . $NOM_DEPEN_QUIMICA_PESSOA  . "',";
	$query .= "'" . $TXT_DOENCAS_PESSOA . "')";
	//}
}
if($modo == "update"){
	$query = "UPDATE pessoa_4 SET ";
	$query .= "COD_ESTADO_CIVIL_PESSOA='" . $COD_ESTADO_CIVIL_PESSOA . "',";
	$query .= "COD_RACA_COR_PESSOA='" . $COD_RACA_COR_PESSOA . "',";
	$query .= "NUM_ROUPA_PESSOA='" . $NUM_ROUPA_PESSOA . "',";
	$query .= "NUM_CALCADO_PESSOA='" . $NUM_CALCADO_PESSOA . "',";
	$query .= "COD_MEIO_TRANSP_PESSOA='" . $COD_MEIO_TRANSP_PESSOA . "',";
	$query .= "NOM_EMAIL_PESSOA='" . $NOM_EMAIL_PESSOA . "',";
	$query .= "COD_CRIANCA_0_6_ANOS_PESSOA='" . $COD_CRIANCA_0_6_ANOS_PESSOA . "',";
	$query .= "COD_GRAVIDA_PESSOA='" . $COD_GRAVIDA_PESSOA . "',";
	$query .= "COD_AMAMENTANDO_PESSOA='" . $COD_AMAMENTANDO_PESSOA . "',";
	$query .= "COD_PRE_NATAL_PESSOA='" . $COD_PRE_NATAL_PESSOA . "',";
	$query .= "COD_METOD_ANTI_CONCEP_PESSOA='" . $COD_METOD_ANTI_CONCEP_PESSOA . "',";
	$query .= "COD_CARTEIRA_VACINA_PESSOA='" . $COD_CARTEIRA_VACINA_PESSOA . "',";
	$query .= "NOM_DEPEN_QUIMICA_PESSOA='" . $NOM_DEPEN_QUIMICA_PESSOA . "',";
	$query .= "TXT_DOENCAS_PESSOA='" . $TXT_DOENCAS_PESSOA . "'";
	$query .= " WHERE PESSOA='" . $PESSOA . "'";
}

$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error() . $query);
if($result) header("Location: form_usuario_familia_9.php?DOMICILIO=" . $DOMICILIO . "&PESSOA=" . $PESSOA);

require("includes/desconectar_mysql.php");
?>