<?
require("includes/funcoes_layout.php");

$modo = $_REQUEST["modo"];
$DOMICILIO = $_REQUEST["DOMICILIO"];
$COD_NACIONALIDADE_PESSOA = $_REQUEST["COD_NACIONALIDADE_PESSOA"];
$NOM_PAIS_ORIGEM_PESSOA = $_REQUEST["NOM_PAIS_ORIGEM_PESSOA"];
$DTA_CHEGADA_PAIS_PESSOA = $_REQUEST["DTA_CHEGADA_PAIS_PESSOA"];
$COD_UF_MUNIC_NASC_PESSOA = $_REQUEST["COD_UF_MUNIC_NASC_PESSOA"];
$NOM_LOCALIDADE_NASC_PESSOA = $_REQUEST["NOM_LOCALIDADE_NASC_PESSOA"];
$NOM_COMPLETO_PAI_PESSOA = $_REQUEST["NOM_COMPLETO_PAI_PESSOA"];
$NOM_COMPLETO_MAE_PESSOA = $_REQUEST["NOM_COMPLETO_MAE_PESSOA"];
$COD_PAPEL_PESSOA = $_REQUEST["COD_PAPEL_PESSOA"];
$PESSOA = $_REQUEST["PESSOA"];

require("includes/conectar_mysql.php");

$DTA_CHEGADA_PAIS_PESSOA = split("/", $DTA_CHEGADA_PAIS_PESSOA);
$DTA_CHEGADA_PAIS_PESSOA = $DTA_CHEGADA_PAIS_PESSOA[2] . "-" . $DTA_CHEGADA_PAIS_PESSOA[1] . "-" . $DTA_CHEGADA_PAIS_PESSOA[0];

if($modo == "add"){
	/*$query = "SELECT DOMICILIO FROM domicilio_1 WHERE NOM_LOGRADOURO_DOMIC='" . $NOM_LOGRADOURO_DOMIC . "' AND NUM_RESIDENCIA_DOMIC";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result)>0) tela_erro("Já existe um programa social com este código. Clique no botão VOLTAR e informe outro.");
	else{*/
	$query = "INSERT INTO pessoa_2 (PESSOA, COD_NACIONALIDADE_PESSOA, NOM_PAIS_ORIGEM_PESSOA, DTA_CHEGADA_PAIS_PESSOA, COD_UF_MUNIC_NASC_PESSOA, NOM_LOCALIDADE_NASC_PESSOA, NOM_COMPLETO_PAI_PESSOA, NOM_COMPLETO_MAE_PESSOA, COD_PAPEL_PESSOA) VALUES ";
	$query .= "('" . $PESSOA . "',";
	$query .= "'" . $COD_NACIONALIDADE_PESSOA . "',";
	$query .= "'" . $NOM_PAIS_ORIGEM_PESSOA . "',";
	$query .= "'" . $DTA_CHEGADA_PAIS_PESSOA . "',";
	$query .= "'" . $COD_UF_MUNIC_NASC_PESSOA . "',";
	$query .= "'" . $NOM_LOCALIDADE_NASC_PESSOA . "',";
	$query .= "'" . $NOM_COMPLETO_PAI_PESSOA . "',";
	$query .= "'" . $NOM_COMPLETO_MAE_PESSOA . "',";
	$query .= "'" . $COD_PAPEL_PESSOA . "')";
	//}
}
if($modo == "update"){
	$query = "UPDATE pessoa_2 SET ";
	$query .= "COD_NACIONALIDADE_PESSOA='" . $COD_NACIONALIDADE_PESSOA . "',";
	$query .= "NOM_PAIS_ORIGEM_PESSOA='" . $NOM_PAIS_ORIGEM_PESSOA . "',";
	$query .= "DTA_CHEGADA_PAIS_PESSOA='" . $DTA_CHEGADA_PAIS_PESSOA . "',";
	$query .= "COD_UF_MUNIC_NASC_PESSOA='" . $COD_UF_MUNIC_NASC_PESSOA . "',";
	$query .= "NOM_LOCALIDADE_NASC_PESSOA='" . $NOM_LOCALIDADE_NASC_PESSOA . "',";
	$query .= "NOM_COMPLETO_PAI_PESSOA='" . $NOM_COMPLETO_PAI_PESSOA . "',";
	$query .= "NOM_COMPLETO_MAE_PESSOA='" . $NOM_COMPLETO_MAE_PESSOA . "',";
	$query .= "COD_PAPEL_PESSOA='" . $COD_PAPEL_PESSOA . "'";
	$query .= " WHERE PESSOA=" . $PESSOA;
}
$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error() . $query);

header("Location: form_usuario_familia_9.php?DOMICILIO=" . $DOMICILIO . "&PESSOA=" . $PESSOA);

require("includes/desconectar_mysql.php");
?>