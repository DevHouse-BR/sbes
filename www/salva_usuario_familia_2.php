<?
require("includes/funcoes_layout.php");

$modo = $_REQUEST["modo"];
$DOMICILIO = $_REQUEST["DOMICILIO"];
$TIP_LOCAL_DOMIC = $_REQUEST["TIP_LOCAL_DOMIC"];
$NUM_DOMICILIO_COBERTO_DOMIC = $_REQUEST["NUM_DOMICILIO_COBERTO_DOMIC"];
$SIT_DOMICILIO_DOMIC = $_REQUEST["SIT_DOMICILIO_DOMIC"];            
$TIP_DOMICILIO_DOMIC = $_REQUEST["TIP_DOMICILIO_DOMIC"];
$NUM_COMODOS_DOMIC = $_REQUEST["NUM_COMODOS_DOMIC"];
$TIP_CONSTRUCAO_DOMIC = $_REQUEST["TIP_CONSTRUCAO_DOMIC"];
$TIP_ABASTECIMENTO_AGUA_DOMIC = $_REQUEST["TIP_ABASTECIMENTO_AGUA_DOMIC"];
$TIP_TRATAMENTO_AGUA_DOMIC = $_REQUEST["TIP_TRATAMENTO_AGUA_DOMIC"];
$TIP_ILUMINACAO_DOMIC = $_REQUEST["TIP_ILUMINACAO_DOMIC"];
$TIP_ESCOAMENTO_SANITARIO_DOMIC = $_REQUEST["TIP_ESCOAMENTO_SANITARIO_DOMIC"];
$TIP_DESTINO_LIXO_DOMIC = $_REQUEST["TIP_DESTINO_LIXO_DOMIC"];
$TIP_ESTADO_DOMIC = $_REQUEST["TIP_ESTADO_DOMIC"];
$TIP_VIA_ACESSO_DOMIC = $_REQUEST["TIP_VIA_ACESSO_DOMIC"];
$TIP_BANHEIRO_DOMIC = $_REQUEST["TIP_BANHEIRO_DOMIC"];
$COD_CRECHE_DOMIC = $_REQUEST["COD_CRECHE_DOMIC"];
$COD_ESCOLA_DOMIC = $_REQUEST["COD_ESCOLA_DOMIC"];
$QTD_TEMPO_MORAR_ANOS_PESSOA = $_REQUEST["QTD_TEMPO_MORAR_ANOS_PESSOA"];
$QTD_TEMPO_MORAR_MESES_PESSOA = $_REQUEST["QTD_TEMPO_MORAR_MESES_PESSOA"];

if($COD_CRECHE_DOMIC == 'on'){
	$COD_CRECHE_DOMIC = 's';
}
else $COD_CRECHE_DOMIC = 'n';

if($COD_ESCOLA_DOMIC == 'on'){
	$COD_ESCOLA_DOMIC = 's';
}
else $COD_ESCOLA_DOMIC = 'n';

require("includes/conectar_mysql.php");

if($modo == "add"){
	/*$query = "SELECT DOMICILIO FROM domicilio_1 WHERE NOM_LOGRADOURO_DOMIC='" . $NOM_LOGRADOURO_DOMIC . "' AND NUM_RESIDENCIA_DOMIC";
	$result = mysql_query($query) or tela_erro("Erro de conex�o ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result)>0) tela_erro("J� existe um programa social com este c�digo. Clique no bot�o VOLTAR e informe outro.");
	else{*/
	$query = "INSERT INTO domicilio_2 (DOMICILIO, TIP_LOCAL_DOMIC, NUM_DOMICILIO_COBERTO_DOMIC, SIT_DOMICILIO_DOMIC, TIP_DOMICILIO_DOMIC, NUM_COMODOS_DOMIC, TIP_CONSTRUCAO_DOMIC, TIP_ABASTECIMENTO_AGUA_DOMIC, TIP_TRATAMENTO_AGUA_DOMIC, TIP_ILUMINACAO_DOMIC, TIP_ESCOAMENTO_SANITARIO_DOMIC, TIP_DESTINO_LIXO_DOMIC, TIP_ESTADO_DOMIC, TIP_VIA_ACESSO_DOMIC, TIP_BANHEIRO_DOMIC, COD_CRECHE_DOMIC, COD_ESCOLA_DOMIC, QTD_TEMPO_MORAR_ANOS_PESSOA, QTD_TEMPO_MORAR_MESES_PESSOA) VALUES ";
	$query .= "('" . $DOMICILIO . "',";
	$query .= "'" . $TIP_LOCAL_DOMIC . "',";
	$query .= "'" . $NUM_DOMICILIO_COBERTO_DOMIC . "',";
	$query .= "'" . $SIT_DOMICILIO_DOMIC . "',";
	$query .= "'" . $TIP_DOMICILIO_DOMIC . "',";
	$query .= "'" . $NUM_COMODOS_DOMIC . "',";
	$query .= "'" . $TIP_CONSTRUCAO_DOMIC . "',";
	$query .= "'" . $TIP_ABASTECIMENTO_AGUA_DOMIC . "',";
	$query .= "'" . $TIP_TRATAMENTO_AGUA_DOMIC . "',";
	$query .= "'" . $TIP_ILUMINACAO_DOMIC . "',";
	$query .= "'" . $TIP_ESCOAMENTO_SANITARIO_DOMIC . "',";
	$query .= "'" . $TIP_DESTINO_LIXO_DOMIC . "',";
	$query .= "'" . $TIP_ESTADO_DOMIC . "',";
	$query .= "'" . $TIP_VIA_ACESSO_DOMIC . "',";
	$query .= "'" . $TIP_BANHEIRO_DOMIC . "',";
	$query .= "'" . $COD_CRECHE_DOMIC . "',";
	$query .= "'" . $COD_ESCOLA_DOMIC . "',";
	$query .= "'" . $QTD_TEMPO_MORAR_ANOS_PESSOA . "',";
	$query .= "'" . $QTD_TEMPO_MORAR_MESES_PESSOA . "')";
	//}
}
if($modo == "update"){
	$query = "UPDATE domicilio_2 SET ";
	$query .= "TIP_LOCAL_DOMIC='" . $TIP_LOCAL_DOMIC . "',";
	$query .= "NUM_DOMICILIO_COBERTO_DOMIC='" . $NUM_DOMICILIO_COBERTO_DOMIC . "',";
	$query .= "SIT_DOMICILIO_DOMIC='" . $SIT_DOMICILIO_DOMIC . "',";
	$query .= "TIP_DOMICILIO_DOMIC='" . $TIP_DOMICILIO_DOMIC . "',";
	$query .= "NUM_COMODOS_DOMIC='" . $NUM_COMODOS_DOMIC . "',";
	$query .= "TIP_CONSTRUCAO_DOMIC='" . $TIP_CONSTRUCAO_DOMIC . "',";
	$query .= "TIP_ABASTECIMENTO_AGUA_DOMIC='" . $TIP_ABASTECIMENTO_AGUA_DOMIC . "',";
	$query .= "TIP_TRATAMENTO_AGUA_DOMIC='" . $TIP_TRATAMENTO_AGUA_DOMIC . "',";
	$query .= "TIP_ILUMINACAO_DOMIC='" . $TIP_ILUMINACAO_DOMIC . "',";
	$query .= "TIP_ESCOAMENTO_SANITARIO_DOMIC='" . $TIP_ESCOAMENTO_SANITARIO_DOMIC . "',";
	$query .= "TIP_DESTINO_LIXO_DOMIC='" . $TIP_DESTINO_LIXO_DOMIC . "',";
	$query .= "TIP_ESTADO_DOMIC='" . $TIP_ESTADO_DOMIC . "',";
	$query .= "TIP_VIA_ACESSO_DOMIC='" . $TIP_VIA_ACESSO_DOMIC . "',";
	$query .= "TIP_BANHEIRO_DOMIC='" . $TIP_BANHEIRO_DOMIC . "',";
	$query .= "COD_CRECHE_DOMIC='" . $COD_CRECHE_DOMIC . "',";
	$query .= "COD_ESCOLA_DOMIC='" . $COD_ESCOLA_DOMIC . "',";
	$query .= "QTD_TEMPO_MORAR_ANOS_PESSOA='" . $QTD_TEMPO_MORAR_ANOS_PESSOA . "',";
	$query .= "QTD_TEMPO_MORAR_MESES_PESSOA='" . $QTD_TEMPO_MORAR_MESES_PESSOA . "'";
	$query .= " WHERE DOMICILIO='" . $DOMICILIO . "'";
}
$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error() . $query);
if($result) header("Location: form_usuario_familia_3.php?DOMICILIO=" . $DOMICILIO);

require("includes/desconectar_mysql.php");
?>