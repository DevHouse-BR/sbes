<?
require("includes/funcoes_layout.php");

$modo = $_REQUEST["modo"];
$DOMICILIO = $_REQUEST["DOMICILIO"];
$PESSOA = $_REQUEST["PESSOA"];
$NOM_PESSOA = $_REQUEST["NOM_PESSOA"];
$DTA_NASC_PESSOA = $_REQUEST["DTA_NASC_PESSOA"];
$COD_SEXO_PESSOA = $_REQUEST["COD_SEXO_PESSOA"];
$NUM_NIS_PESSOA = $_REQUEST["NUM_NIS_PESSOA"];
$COD_CERTID_CIVIL_PESSOA = $_REQUEST["COD_CERTID_CIVIL_PESSOA"];
$COD_TERMO_CERTID_PESSOA = $_REQUEST["COD_TERMO_CERTID_PESSOA"];
$COD_LIVRO_TERMO_CERTID_PESSOA = $_REQUEST["COD_LIVRO_TERMO_CERTID_PESSOA"];
$COD_FOLHA_TERMO_CERTID_PESSOA = $_REQUEST["COD_FOLHA_TERMO_CERTID_PESSOA"];
$DTA_EMISSAO_CERTID_PESSOA = $_REQUEST["DTA_EMISSAO_CERTID_PESSOA"];
$SIG_UF_CERTID_PESSOA = $_REQUEST["SIG_UF_CERTID_PESSOA"];
$NOM_CARTORIO_PESSOA = $_REQUEST["NOM_CARTORIO_PESSOA"];
$NUM_IDENTIDADE_PESSOA = $_REQUEST["NUM_IDENTIDADE_PESSOA"];
$TXT_COMPLEMENTO_PESSOA = $_REQUEST["TXT_COMPLEMENTO_PESSOA"];
$DTA_EMISSAO_IDENT_PESSOA = $_REQUEST["DTA_EMISSAO_IDENT_PESSOA"];
$SIG_UF_IDENT_PESSOA = $_REQUEST["SIG_UF_IDENT_PESSOA"];
$SIG_ORGAO_EMISSAO_PESSOA = $_REQUEST["SIG_ORGAO_EMISSAO_PESSOA"];
$NUM_CART_TRAB_PREV_SOC_PESSOA = $_REQUEST["NUM_CART_TRAB_PREV_SOC_PESSOA"];
$NUM_SERIE_TRAB_PREV_SOC_PESSOA = $_REQUEST["NUM_SERIE_TRAB_PREV_SOC_PESSOA"];
$DTA_EMISSAO_CART_TRAB_PESSOA = $_REQUEST["DTA_EMISSAO_CART_TRAB_PESSOA"];
$SIG_UF_CART_TRAB_PESSOA = $_REQUEST["SIG_UF_CART_TRAB_PESSOA"];
$NUM_CPF_PESSOA = $_REQUEST["NUM_CPF_PESSOA"];
$NUM_TITULO_ELEITOR_PESSOA = $_REQUEST["NUM_TITULO_ELEITOR_PESSOA"];
$NUM_ZONA_TIT_ELEITOR_PESSOA = $_REQUEST["NUM_ZONA_TIT_ELEITOR_PESSOA"];
$NUM_SECAO_TIT_ELEITOR_PESSOA = $_REQUEST["NUM_SECAO_TIT_ELEITOR_PESSOA"];
$SIT_PESSOA = $_REQUEST["SIT_PESSOA"];

if($SIT_PESSOA == 'on') $SIT_PESSOA = 's';
else $SIT_PESSOA = 'n';

$DTA_NASC_PESSOA = split("/", $DTA_NASC_PESSOA);
$DTA_NASC_PESSOA = $DTA_NASC_PESSOA[2] . "-" . $DTA_NASC_PESSOA[1] . "-" . $DTA_NASC_PESSOA[0];
$DTA_EMISSAO_CERTID_PESSOA = split("/", $DTA_EMISSAO_CERTID_PESSOA);
$DTA_EMISSAO_CERTID_PESSOA = $DTA_EMISSAO_CERTID_PESSOA[2] . "-" . $DTA_EMISSAO_CERTID_PESSOA[1] . "-" . $DTA_EMISSAO_CERTID_PESSOA[0];
$DTA_EMISSAO_CART_TRAB_PESSOA = split("/", $DTA_EMISSAO_CART_TRAB_PESSOA);
$DTA_EMISSAO_CART_TRAB_PESSOA = $DTA_EMISSAO_CART_TRAB_PESSOA[2] . "-" . $DTA_EMISSAO_CART_TRAB_PESSOA[1] . "-" . $DTA_EMISSAO_CART_TRAB_PESSOA[0];
$DTA_EMISSAO_IDENT_PESSOA = split("/", $DTA_EMISSAO_IDENT_PESSOA);
$DTA_EMISSAO_IDENT_PESSOA = $DTA_EMISSAO_IDENT_PESSOA[2] . "-" . $DTA_EMISSAO_IDENT_PESSOA[1] . "-" . $DTA_EMISSAO_IDENT_PESSOA[0];

require("includes/conectar_mysql.php");


if($modo == "ativo"){
	$query = "UPDATE pessoa_1 SET ";
	$query .= "SIT_PESSOA='" . $SIT_PESSOA . "'";
	$query .= " WHERE PESSOA=" . $PESSOA;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error() . $query);
	die(header("Location: form_usuario_familia_4.php?DOMICILIO=" . $DOMICILIO));
}
if($modo == "apagar"){
	$query = "DELETE FROM pessoa_1 WHERE PESSOA=" . $PESSOA;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error() . $query);
	$query = "DELETE FROM pessoa_2 WHERE PESSOA=" . $PESSOA;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error() . $query);
	$query = "DELETE FROM pessoa_3 WHERE PESSOA=" . $PESSOA;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error() . $query);
	$query = "DELETE FROM pessoa_4 WHERE PESSOA=" . $PESSOA;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error() . $query);
	die(header("Location: form_usuario_familia_4.php?DOMICILIO=" . $DOMICILIO));
}



if($modo == "add"){
	$query = "SELECT NUM_CPF_PESSOA FROM pessoa_1 WHERE NUM_CPF_PESSOA='" . $NUM_CPF_PESSOA . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result)>0) tela_erro("Já existe uma pessoa cadastrada com este CPF. Clique no botão VOLTAR e verifique os dados digitados.");
	else{
		$query = "INSERT INTO pessoa_1 (DOMICILIO, NOM_PESSOA, DTA_NASC_PESSOA, COD_SEXO_PESSOA, NUM_NIS_PESSOA, COD_CERTID_CIVIL_PESSOA, COD_TERMO_CERTID_PESSOA, COD_LIVRO_TERMO_CERTID_PESSOA, COD_FOLHA_TERMO_CERTID_PESSOA, DTA_EMISSAO_CERTID_PESSOA, SIG_UF_CERTID_PESSOA, NOM_CARTORIO_PESSOA, NUM_IDENTIDADE_PESSOA, TXT_COMPLEMENTO_PESSOA, DTA_EMISSAO_IDENT_PESSOA, SIG_UF_IDENT_PESSOA, SIG_ORGAO_EMISSAO_PESSOA, NUM_CART_TRAB_PREV_SOC_PESSOA, NUM_SERIE_TRAB_PREV_SOC_PESSOA, DTA_EMISSAO_CART_TRAB_PESSOA, SIG_UF_CART_TRAB_PESSOA, NUM_CPF_PESSOA, NUM_TITULO_ELEITOR_PESSOA, NUM_ZONA_TIT_ELEITOR_PESSOA, NUM_SECAO_TIT_ELEITOR_PESSOA, SIT_PESSOA) VALUES ";
		$query .= "('" . $DOMICILIO . "',";
		$query .= "'" . $NOM_PESSOA . "',";
		$query .= "'" . $DTA_NASC_PESSOA . "',";
		$query .= "'" . $COD_SEXO_PESSOA . "',";
		$query .= "'" . $NUM_NIS_PESSOA . "',";
		$query .= "'" . $COD_CERTID_CIVIL_PESSOA . "',";
		$query .= "'" . $COD_TERMO_CERTID_PESSOA . "',";
		$query .= "'" . $COD_LIVRO_TERMO_CERTID_PESSOA . "',";
		$query .= "'" . $COD_FOLHA_TERMO_CERTID_PESSOA . "',";
		$query .= "'" . $DTA_EMISSAO_CERTID_PESSOA . "',";
		$query .= "'" . $SIG_UF_CERTID_PESSOA . "',";
		$query .= "'" . $NOM_CARTORIO_PESSOA . "',";
		$query .= "'" . $NUM_IDENTIDADE_PESSOA . "',";
		$query .= "'" . $TXT_COMPLEMENTO_PESSOA . "',";
		$query .= "'" . $DTA_EMISSAO_IDENT_PESSOA . "',";
		$query .= "'" . $SIG_UF_IDENT_PESSOA . "',";
		$query .= "'" . $SIG_ORGAO_EMISSAO_PESSOA . "',";
		$query .= "'" . $NUM_CART_TRAB_PREV_SOC_PESSOA . "',";
		$query .= "'" . $NUM_SERIE_TRAB_PREV_SOC_PESSOA . "',";
		$query .= "'" . $DTA_EMISSAO_CART_TRAB_PESSOA . "',";
		$query .= "'" . $SIG_UF_CART_TRAB_PESSOA . "',";
		$query .= "'" . $NUM_CPF_PESSOA . "',";
		$query .= "'" . $NUM_TITULO_ELEITOR_PESSOA . "',";
		$query .= "'" . $NUM_ZONA_TIT_ELEITOR_PESSOA . "',";
		$query .= "'" . $NUM_SECAO_TIT_ELEITOR_PESSOA . "',";
		$query .= "'" . $SIT_PESSOA . "')";
	}
}
if($modo == "update"){
	$query = "UPDATE pessoa_1 SET ";
	$query .= "NOM_PESSOA='" . $NOM_PESSOA . "',";
	$query .= "DTA_NASC_PESSOA='" . $DTA_NASC_PESSOA . "',";
	$query .= "COD_SEXO_PESSOA='" . $COD_SEXO_PESSOA . "',";
	$query .= "NUM_NIS_PESSOA='" . $NUM_NIS_PESSOA . "',";
	$query .= "COD_CERTID_CIVIL_PESSOA='" . $COD_CERTID_CIVIL_PESSOA . "',";
	$query .= "COD_TERMO_CERTID_PESSOA='" . $COD_TERMO_CERTID_PESSOA . "',";
	$query .= "COD_LIVRO_TERMO_CERTID_PESSOA='" . $COD_LIVRO_TERMO_CERTID_PESSOA . "',";
	$query .= "COD_FOLHA_TERMO_CERTID_PESSOA='" . $COD_FOLHA_TERMO_CERTID_PESSOA . "',";
	$query .= "DTA_EMISSAO_CERTID_PESSOA='" . $DTA_EMISSAO_CERTID_PESSOA . "',";
	$query .= "SIG_UF_CERTID_PESSOA='" . $SIG_UF_CERTID_PESSOA . "',";
	$query .= "NOM_CARTORIO_PESSOA='" . $NOM_CARTORIO_PESSOA . "',";
	$query .= "NUM_IDENTIDADE_PESSOA='" . $NUM_IDENTIDADE_PESSOA . "',";
	$query .= "TXT_COMPLEMENTO_PESSOA='" . $TXT_COMPLEMENTO_PESSOA . "',";
	$query .= "DTA_EMISSAO_IDENT_PESSOA='" . $DTA_EMISSAO_IDENT_PESSOA . "',";
	$query .= "SIG_UF_IDENT_PESSOA='" . $SIG_UF_IDENT_PESSOA . "',";
	$query .= "SIG_ORGAO_EMISSAO_PESSOA='" . $SIG_ORGAO_EMISSAO_PESSOA . "',";
	$query .= "NUM_CART_TRAB_PREV_SOC_PESSOA='" . $NUM_CART_TRAB_PREV_SOC_PESSOA . "',";
	$query .= "NUM_SERIE_TRAB_PREV_SOC_PESSOA='" . $NUM_SERIE_TRAB_PREV_SOC_PESSOA . "',";
	$query .= "DTA_EMISSAO_CART_TRAB_PESSOA='" . $DTA_EMISSAO_CART_TRAB_PESSOA . "',";
	$query .= "SIG_UF_CART_TRAB_PESSOA='" . $SIG_UF_CART_TRAB_PESSOA . "',";
	$query .= "NUM_CPF_PESSOA='" . $NUM_CPF_PESSOA . "',";
	$query .= "NUM_TITULO_ELEITOR_PESSOA='" . $NUM_TITULO_ELEITOR_PESSOA . "',";
	$query .= "NUM_ZONA_TIT_ELEITOR_PESSOA='" . $NUM_ZONA_TIT_ELEITOR_PESSOA . "',";
	$query .= "NUM_SECAO_TIT_ELEITOR_PESSOA='" . $NUM_SECAO_TIT_ELEITOR_PESSOA . "',";
	$query .= "SIT_PESSOA='" . $SIT_PESSOA . "'";
	$query .= " WHERE PESSOA=" . $PESSOA;
}
$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error() . $query);

if($modo == "add"){
	$result = mysql_query("SELECT LAST_INSERT_ID();") or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	$registro = mysql_fetch_row($result);
	$PESSOA = $registro[0];
}
header("Location: form_usuario_familia_6.php?DOMICILIO=" . $DOMICILIO . "&PESSOA=" . $PESSOA);

require("includes/desconectar_mysql.php");
?>