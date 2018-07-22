<?
	require("includes/funcoes_layout.php");
	
	$DOMICILIO = $_REQUEST["DOMICILIO"];
	$PESSOA = $_REQUEST["PESSOA"];

	require("includes/conectar_mysql.php");
	
	if($_REQUEST["DOMICILIO_BASICO"] == "on") carrega_vetor_domicilio_basico();
	if($_REQUEST["DOMICILIO_SE"] == "on") carrega_vetor_domicilio_se();
	if(($_REQUEST["DOMICILIO_BASICO"] == "on") || ($_REQUEST["DOMICILIO_SE"] == "on")) {
		carrega_labels_domicilio();
		if(strlen($DOMICILIO)>0) informacoes_domicilio($DOMICILIO);
	}
	?>
	<html>
	<head>
		<title>Projeto Social Futura - Relatório de Ficha de Usuário</title>
		<style type="text/css" media="all">
			td{
				font-family:Arial, Helvetica, sans-serif;
				font-size:12px;
				page-break-inside: avoid;
			}
			body{
				text-align: center;
			}
			tr {
				page-break-inside: avoid;
			}
		</style>
	</head>
	<body>
	<table width="700" border="0">
	<?
	if(($_REQUEST["DOMICILIO_BASICO"] == "on") || ($_REQUEST["DOMICILIO_SE"] == "on")){
		echo('<tr><td colspan="20">');
		monta_titulo_secao("Domicílio");
		echo('</td></tr>');
	}
	$j = 0;
	for($i = 0; $i < count($vetor); $i++){
		if($j == 0) echo('<tr>' . chr(10) . chr(13));
		if(($j + $vetor[$i]['lenght']) >= 16) $colspan = 20-$j;
		else $colspan = $vetor[$i]['lenght'];
		if((strlen($vetor[$i]['fieldset'])>0) && ($vetor[$i]['fieldset'] != '*')){
			echo('</tr><tr><td colspan="20"><hr color="blue"><b>' . $vetor[$i]['fieldset'] . '</b></td></tr><tr>');
			$j = 0;
		}
		echo('<td valign="bottom" colspan="' . $colspan . '">' . chr(10) . chr(13));
		$valor = $vetor[$i]['valor'];
		if($valor == "") $valor = "&nbsp;";
		echo('<table width="100%"><tr><td>' . $vetor[$i]['label'] . '</td></tr><tr><td style="border: 1px solid black;">' . $valor . '</td></tr></table>' . chr(10) . chr(13));
		echo('</td>' . chr(10) . chr(13));
		if((strlen($vetor[$i]['fieldset']) == 1) && ($vetor[$i]['fieldset'] == '*') && (strlen($vetor[$i+1]['fieldset']) == 0)) {
			echo('</tr><tr><td colspan="20"><hr color="blue"></td></tr>');
			$j = 0;
		}
		else $j += $vetor[$i]['lenght'];
		if($j >= 16){
			echo('</tr>');
			$j = 0;
		}	
	}
	?>
	</table>
	<?
	unset($vetor);
	
	if($_REQUEST["DOMICILIO_PESSOA_BASICO"] == "on"){
		$query = "SELECT PESSOA FROM pessoa_1 WHERE DOMICILIO=" . $DOMICILIO . " ORDER BY NOM_PESSOA";
		$result2 = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		$cont = 0;
		while($registro2 = mysql_fetch_assoc($result2)) {
			$PESSOA =  $registro2["PESSOA"];
			carrega_vetor_pessoa_basico();
			if($_REQUEST["DOMICILIO_PESSOA_SE"] == "on") carrega_vetor_pessoa_se();
			carrega_labels_pessoa();
			informacoes_pessoa($PESSOA);
			tabela_pessoa();
			unset($vetor);
		}
	}
	else {
		if($_REQUEST["PESSOA_BASICO"] == "on") carrega_vetor_pessoa_basico();
		if($_REQUEST["PESSOA_SE"] == "on") carrega_vetor_pessoa_se();
		if(($_REQUEST["PESSOA_BASICO"] == "on") || ($_REQUEST["PESSOA_SE"] == "on")) {
			carrega_labels_pessoa();			
			if(strlen($PESSOA)>0) informacoes_pessoa($PESSOA);
		}
		tabela_pessoa();
	}
	
	?>
	</body>
	</html>
	<?
	require("includes/desconectar_mysql.php");


##########################################################################################################
function carrega_vetor_domicilio_basico(){
	global $vetor;
	$i = 0;
	$query = "SHOW FIELDS FROM domicilio_1";
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	while($campo = mysql_fetch_assoc($result)){
		if($campo['Field'] != 'DOMICILIO'){
			$vetor[$i]['field'] = $campo['Field'];
			$temp = split("\(", $campo['Type']);		
			$vetor[$i]['type'] = $temp[0];
			$tamanho = round(trim(str_replace("unsigned","",str_replace(")","",$temp[1]))));
			if($tamanho>20) $tamanho = 20;
			if($tamanho<6) $tamanho = 6;
			if($tamanho==16) $tamanho = 6;
			$vetor[$i]['lenght'] =  $tamanho;
			$i++;
		}
	}
}

##########################################################################################################
function carrega_vetor_domicilio_se(){
	global $vetor;
	$i = count($vetor);
	$query = "SHOW FIELDS FROM domicilio_2";
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	while($campo = mysql_fetch_assoc($result)){
		if($campo['Field'] != 'DOMICILIO'){
			$vetor[$i]['field'] = $campo['Field'];
			$temp = split("\(", $campo['Type']);		
			$vetor[$i]['type'] = $temp[0];
			$tamanho = round(trim(str_replace("unsigned","",str_replace(")","",$temp[1]))));
			if($tamanho>20) $tamanho = 20;
			if($tamanho<6) $tamanho = 6;
			if($tamanho==16) $tamanho = 6;
			$vetor[$i]['lenght'] =  $tamanho;
			$i++;
		}
	}
	$query = "SHOW FIELDS FROM domicilio_3";
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	while($campo = mysql_fetch_assoc($result)){
		if($campo['Field'] != 'DOMICILIO'){
			$vetor[$i]['field'] = $campo['Field'];
			$temp = split("\(", $campo['Type']);		
			$vetor[$i]['type'] = $temp[0];
			$tamanho = round(trim(str_replace("unsigned","",str_replace(")","",$temp[1]))));
			if($tamanho>20) $tamanho = 20;
			if($tamanho<6) $tamanho = 6;
			if($tamanho==16) $tamanho = 6;
			$vetor[$i]['lenght'] =  $tamanho;
			$i++;
		}
	}
}


##########################################################################################################

function carrega_vetor_pessoa_basico(){
	global $vetor;
	$i = 0;
	$query = "SHOW FIELDS FROM pessoa_1";
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	while($campo = mysql_fetch_assoc($result)){
		if(($campo['Field'] != 'DOMICILIO') && ($campo['Field'] != 'PESSOA')){
			$vetor[$i]['field'] = $campo['Field'];
			$temp = split("\(", $campo['Type']);		
			$vetor[$i]['type'] = $temp[0];
			$tamanho = round(trim(str_replace("unsigned","",str_replace(")","",$temp[1]))));
			if($tamanho>20) $tamanho = 20;
			if($tamanho<6) $tamanho = 6;
			if($tamanho==16) $tamanho = 6;
			$vetor[$i]['lenght'] =  $tamanho;
			$i++;
		}
	}
	$query = "SHOW FIELDS FROM pessoa_2";
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	while($campo = mysql_fetch_assoc($result)){
		if(($campo['Field'] != 'DOMICILIO') && ($campo['Field'] != 'PESSOA')){
			$vetor[$i]['field'] = $campo['Field'];
			$temp = split("\(", $campo['Type']);		
			$vetor[$i]['type'] = $temp[0];
			$tamanho = round(trim(str_replace("unsigned","",str_replace(")","",$temp[1]))));
			if($tamanho>20) $tamanho = 20;
			if($tamanho<6) $tamanho = 6;
			if($tamanho==16) $tamanho = 6;
			$vetor[$i]['lenght'] =  $tamanho;
			$i++;
		}
	}
}


##########################################################################################################

function carrega_vetor_pessoa_se(){
	global $vetor;
	$i = count($vetor);
	$query = "SHOW FIELDS FROM pessoa_3";
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	while($campo = mysql_fetch_assoc($result)){
		if(($campo['Field'] != 'DOMICILIO') && ($campo['Field'] != 'PESSOA')){
			$vetor[$i]['field'] = $campo['Field'];
			$temp = split("\(", $campo['Type']);		
			$vetor[$i]['type'] = $temp[0];
			$tamanho = round(trim(str_replace("unsigned","",str_replace(")","",$temp[1]))));
			if($tamanho>20) $tamanho = 20;
			if($tamanho<6) $tamanho = 6;
			if($tamanho==16) $tamanho = 6;
			$vetor[$i]['lenght'] =  $tamanho;
			$i++;
		}
	}
	$query = "SHOW FIELDS FROM pessoa_4";
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	while($campo = mysql_fetch_assoc($result)){
		if(($campo['Field'] != 'DOMICILIO') && ($campo['Field'] != 'PESSOA')){
			$vetor[$i]['field'] = $campo['Field'];
			$temp = split("\(", $campo['Type']);		
			$vetor[$i]['type'] = $temp[0];
			$tamanho = round(trim(str_replace("unsigned","",str_replace(")","",$temp[1]))));
			if($tamanho>20) $tamanho = 20;
			if($tamanho<6) $tamanho = 6;
			if($tamanho==16) $tamanho = 6;
			$vetor[$i]['lenght'] =  $tamanho;
			$i++;
		}
	}
}

##########################################################################################################

function carrega_labels_domicilio(){
	global $vetor;
	$labels = 'Informações Básicas|Código Domiciliar=COD_DOMICILIAR;Tipo do Logradouro=TIP_LOGRAD_DOMIC;Logradouro=NOM_LOGRADOURO_DOMIC;Número=NUM_RESIDENCIA_DOMIC;Complemento=NOM_COMPL_RESIDENCIA_DOMIC;Bairro=NOM_BAIRRO_RESIDENCIA_DOMIC;CEP=CEP_RESIDENCIA_DOMIC;Cidade=NOM_LOCALIDADE_DOMIC;Estado=SIG_UF_RESIDENCIA_DOMIC;DDD=COD_DDD_RESIDENCIA_DOMIC;*|Telefone Contato=NUM_TEL_CONTATO_DOMIC;Área=TIP_LOCAL_DOMIC;Coberto Por=NUM_DOMICILIO_COBERTO_DOMIC;Situação=SIT_DOMICILIO_DOMIC;Tipo=TIP_DOMICILIO_DOMIC;Número de Comodos=NUM_COMODOS_DOMIC;Tipo da Construção=TIP_CONSTRUCAO_DOMIC;Iluminação=TIP_ILUMINACAO_DOMIC;Água - Tratamento=TIP_TRATAMENTO_AGUA_DOMIC;Água - Abastecimento=TIP_ABASTECIMENTO_AGUA_DOMIC;Escoamento Sanitário=TIP_ESCOAMENTO_SANITARIO_DOMIC;Destino do Lixo=TIP_DESTINO_LIXO_DOMIC;Estado do Domicílio=TIP_ESTADO_DOMIC;Via de Acesso=TIP_VIA_ACESSO_DOMIC;Existem próximas ao domicílio|Creches=COD_CRECHE_DOMIC;*|Escolas=COD_ESCOLA_DOMIC;Tempo de Moradia|Anos=QTD_TEMPO_MORAR_ANOS_PESSOA;*|Meses=QTD_TEMPO_MORAR_MESES_PESSOA;Banheiro=TIP_BANHEIRO_DOMIC;Valor de Despesas Mensais|Aluguel=VAL_DESP_MENSAIS_ALUGUEL_PESSOA;Prestação Habitacional=VAL_DESP_PREST_HAB_PESSOA;Alimentação=VAL_DESP_ALIMENT_PESSOA;Água=VAL_DESP_AGUA_PESSOA;Luz=VAL_DESP_LUZ_PESSOA;Transporte=VAL_DESP_TRANSPOR_PESSOA;Medicamentos=VAL_DESP_MEDICAMENTOS_PESSOA;Gás=VAL_DESP_GAS_PESSOA;*|Outras Despesas=VAL_OUTRAS_DESP_PESSOA;Número de Pessoas que vivem da renda desta familia=NUM_PESSOAS_RENDA_PESSOA;Eletro-domésticos=TXT_ELETRO_FAMILIA';
	$linhas = split(";",$labels);
	
	for($i = 0; $i < count($linhas); $i++){
		$vetor_labels[$i] = split("=",$linhas[$i]);
	}
	for($i = 0; $i < count($vetor_labels); $i++){
		$temp = busca_chave(trim($vetor_labels[$i][1]));
		$label = split("\|",$vetor_labels[$i][0]);
		if(is_int($temp)) {
			if(count($label)>1){
				$vetor[$temp]['label'] = $label[1];
				$vetor[$temp]['fieldset'] = $label[0];
			}
			else $vetor[$temp]['label'] = $vetor_labels[$i][0];
		}
	}
}

##########################################################################################################
function carrega_labels_pessoa(){
	global $vetor;
	$labels = 'Informações Básicas|Nome=NOM_PESSOA;Data de Nascimento=DTA_NASC_PESSOA;Sexo=COD_SEXO_PESSOA;Número Identificação Social (NIS)=NUM_NIS_PESSOA;Cadastro de Pessoa Física|CPF=NUM_CPF_PESSOA;Ativo=SIT_PESSOA;Certidão Civil|Tipo=COD_CERTID_CIVIL_PESSOA;Número do Termo=COD_TERMO_CERTID_PESSOA;Livro=COD_LIVRO_TERMO_CERTID_PESSOA;Folha=COD_FOLHA_TERMO_CERTID_PESSOA;UF=SIG_UF_CERTID_PESSOA;Data de Emissão=DTA_EMISSAO_CERTID_PESSOA;*|Nome do Cartório=NOM_CARTORIO_PESSOA;Identidade|Número Identidade=NUM_IDENTIDADE_PESSOA;Complemento=TXT_COMPLEMENTO_PESSOA;Órgão Emissor=SIG_ORGAO_EMISSAO_PESSOA;UF=SIG_UF_IDENT_PESSOA;Data de Emissão=DTA_EMISSAO_IDENT_PESSOA;Carteira de Trabalho|Número Carteira=NUM_CART_TRAB_PREV_SOC_PESSOA;Série=NUM_SERIE_TRAB_PREV_SOC_PESSOA;UF=SIG_UF_CART_TRAB_PESSOA;Data de Emissão=DTA_EMISSAO_CART_TRAB_PESSOA;Título de Eleitor|Número do Título=NUM_TITULO_ELEITOR_PESSOA;Zona=NUM_ZONA_TIT_ELEITOR_PESSOA;*|Seção=NUM_SECAO_TIT_ELEITOR_PESSOA;Nacionalidade=COD_NACIONALIDADE_PESSOA;Data de chegada ao Brasil=DTA_CHEGADA_PAIS_PESSOA;Pais=NOM_PAIS_ORIGEM_PESSOA;Cidade Natal=NOM_LOCALIDADE_NASC_PESSOA;UF=COD_UF_MUNIC_NASC_PESSOA;Filiação Materna=NOM_COMPLETO_MAE_PESSOA;Filiação Paterna=NOM_COMPLETO_PAI_PESSOA;Papel da Pessoa no Domicílio=COD_PAPEL_PESSOA;Qualificação Escolar|Frequenta Escola=COD_QUALIF_ESCOLAR_PESSOA;Série=NUM_SERIE_ESCOLAR_PESSOA;Grau de Instrução=COD_GRAU_INSTRUCAO_PESSOA;Nome da Escola=NOM_ESCOLA_PESSOA;*|Código Censo INEP=COD_CENSO_INEP_PESSOA;Qualificação Profissional|Situação no mercado de Trabalho=SIT_MERCADO_TRAB_PESSOA;Nome da empresa que trabalha/ultimo emprego=NOM_EMPRESA_TRAB_PESSOA;CNPJ/CEI Empresa=NUM_CNPJ_EMPRESA_PESSOA;Data de Adminissão=DTA_ADMIS_EMPRESA_PESSOA;Ocupação=NOM_OCUPACAO_EMPRESA_PESSOA;*|Remuneração deste emprego=VAL_REMUNER_EMPREGO_PESSOA;Rendas|Aposentadoria/Pensão=VAL_RENDA_APOSENT_PESSOA;Seguro desemprego=VAL_RENDA_SEGURO_DESEMP_PESSOA;Pensão Alimentícia=VAL_RENDA_PENSAO_ALIMEN_PESSOA;*|Outras=VAL_OUTRAS_RENDAS_PESSOA;Sócio-Econômicas|Estado Civil=COD_ESTADO_CIVIL_PESSOA;Raça=COD_RACA_COR_PESSOA;Número de Roupa=NUM_ROUPA_PESSOA;Número de calçado=NUM_CALCADO_PESSOA;Meio de Transporte=COD_MEIO_TRANSP_PESSOA;Email=NOM_EMAIL_PESSOA;Se criança de 0 a 6 anos, com quem fica=COD_CRIANCA_0_6_ANOS_PESSOA;*|Se grávida, informar mês de gestação=COD_GRAVIDA_PESSOA;Doenças, Deficiências, Distúrbios e Fraquezas=TXT_DOENCAS_PESSOA;Nome da dependência química=NOM_DEPEN_QUIMICA_PESSOA;Outros|Amamentando=COD_AMAMENTANDO_PESSOA;Fazendo Pré-Natal=COD_PRE_NATAL_PESSOA;Usa ou usou métodos anti-conceptivos=COD_METOD_ANTI_CONCEP_PESSOA;A carteira de vacina está em dia=COD_CARTEIRA_VACINA_PESSOA';
	$linhas = split(";",$labels);
	
	for($i = 0; $i < count($linhas); $i++){
		$vetor_labels[$i] = split("=",$linhas[$i]);
	}
	for($i = 0; $i < count($vetor_labels); $i++){
		$temp = busca_chave(trim($vetor_labels[$i][1]));
		$label = split("\|",$vetor_labels[$i][0]);
		if(is_int($temp)) {
			if(count($label)>1){
				$vetor[$temp]['label'] = $label[1];
				$vetor[$temp]['fieldset'] = $label[0];
			}
			else $vetor[$temp]['label'] = $vetor_labels[$i][0];
		}
	}
}


##########################################################################################################

function busca_chave($chave){
	global $vetor;
	for($i = 0; $i < count($vetor); $i++){
		if($vetor[$i]['field'] == $chave) return $i;
	}
}

##########################################################################################################

function informacoes_domicilio($DOMICILIO){
	global $vetor;
	
	
	$query = "SELECT * FROM domicilio_1 WHERE DOMICILIO=" . $DOMICILIO;
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	$registro = mysql_fetch_assoc($result);
	
	foreach ($registro as $campo => $valor) {
		$temp = busca_chave(trim($campo));
		if(is_int($temp)) {
			$vetor[$temp]['valor'] = $valor;
		}
	} 	
	
	
	$query = "SELECT (CASE TIP_LOCAL_DOMIC ";
	$query .= "WHEN 1 THEN '1 - Urbana' ";
	$query .= "WHEN 2 THEN '2 - Rural' END) AS TIP_LOCAL_DOMIC, ";
	
	$query .= "(CASE NUM_DOMICILIO_COBERTO_DOMIC ";
	$query .= "WHEN 1 THEN '1 - PACS Programa de Agentes Comunitários de Saúde' ";
	$query .= "WHEN 2 THEN '2 - PSF Programa de Saúde da Família' ";
	$query .= "WHEN 3 THEN '3 - Similares ao PSF' ";
	$query .= "WHEN 4 THEN '4 - Outro' END) AS NUM_DOMICILIO_COBERTO_DOMIC, ";
	
	$query .= "(CASE SIT_DOMICILIO_DOMIC ";
	$query .= "WHEN 1 THEN '1 - Próprio' ";
	$query .= "WHEN 2 THEN '2 - Alugado' ";
	$query .= "WHEN 3 THEN '3 - Arrendado' ";
	$query .= "WHEN 4 THEN '4 - Cedido' ";
	$query .= "WHEN 5 THEN '5 - Invasão' ";
	$query .= "WHEN 6 THEN '6 - Financiado' ";
	$query .= "WHEN 7 THEN '7 - Outro' END) AS SIT_DOMICILIO_DOMIC, ";
	
	$query .= "(CASE TIP_DOMICILIO_DOMIC ";
	$query .= "WHEN 1 THEN '1 - Casa' ";
	$query .= "WHEN 2 THEN '2 - Apartamento' ";
	$query .= "WHEN 3 THEN '3 - Cômodos' ";
	$query .= "WHEN 4 THEN '4 - Outros' END) AS TIP_DOMICILIO_DOMIC, ";
	
	$query .= "NUM_COMODOS_DOMIC, ";
	
	$query .= "(CASE TIP_CONSTRUCAO_DOMIC ";
	$query .= "WHEN 1 THEN '1 - Tijolo/Alvenaria' ";
	$query .= "WHEN 2 THEN '2 - Adobe' ";
	$query .= "WHEN 3 THEN '3 - Taipa revestida' ";
	$query .= "WHEN 4 THEN '4 - Taipa não revestida' ";
	$query .= "WHEN 5 THEN '5 - Madeira' ";
	$query .= "WHEN 6 THEN '6 - Material reaproveitado' ";
	$query .= "WHEN 7 THEN '7 - Outro' END) AS TIP_CONSTRUCAO_DOMIC, ";
	
	$query .= "(CASE TIP_ABASTECIMENTO_AGUA_DOMIC ";
	$query .= "WHEN 1 THEN '1 - Rede pública (Casan)' ";
	$query .= "WHEN 2 THEN '2 - Poço/nascente' ";
	$query .= "WHEN 3 THEN '3 - Carro pipa' ";
	$query .= "WHEN 4 THEN '4 - Encanada de terceiros' ";
	$query .= "WHEN 5 THEN '5 - Cortada' END) AS TIP_ABASTECIMENTO_AGUA_DOMIC, ";
	
	$query .= "(CASE TIP_TRATAMENTO_AGUA_DOMIC ";
	$query .= "WHEN 1 THEN '1 - Filtração' ";
	$query .= "WHEN 2 THEN '2 - Fervura' ";
	$query .= "WHEN 3 THEN '3 - Cloração' ";
	$query .= "WHEN 4 THEN '4 - Sem abastecimento' ";
	$query .= "WHEN 5 THEN '5 - Outro' END) AS TIP_TRATAMENTO_AGUA_DOMIC, ";
	
	$query .= "(CASE TIP_ILUMINACAO_DOMIC ";
	$query .= "WHEN 1 THEN '1 - Relógio próprio' ";
	$query .= "WHEN 2 THEN '2 - Sem relógio' ";
	$query .= "WHEN 3 THEN '3 - Relógio comunitário' ";
	$query .= "WHEN 4 THEN '4 - Lampião' ";
	$query .= "WHEN 5 THEN '5 - Vela' ";
	$query .= "WHEN 6 THEN '6 - Cortada' ";
	$query .= "WHEN 7 THEN '7 - Não tem' ";
	$query .= "WHEN 8 THEN '8 - Outro' END) AS TIP_ILUMINACAO_DOMIC, ";
	
	$query .= "(CASE TIP_ESCOAMENTO_SANITARIO_DOMIC ";
	$query .= "WHEN 1 THEN '1 - Rede pública' ";
	$query .= "WHEN 2 THEN '2 - Fossa rudimentar' ";
	$query .= "WHEN 3 THEN '3 - Fossa séptica' ";
	$query .= "WHEN 4 THEN '4 - Vala' ";
	$query .= "WHEN 5 THEN '5 - Céu aberto' ";
	$query .= "WHEN 6 THEN '6 - Outro' END) AS TIP_ESCOAMENTO_SANITARIO_DOMIC, ";
	
	$query .= "(CASE TIP_DESTINO_LIXO_DOMIC ";
	$query .= "WHEN 1 THEN '1 - Coletado' ";
	$query .= "WHEN 2 THEN '2 - Queimado' ";
	$query .= "WHEN 3 THEN '3 - Enterrado' ";
	$query .= "WHEN 4 THEN '4 - Céu Aberto' ";
	$query .= "WHEN 5 THEN '5 - Outro' END) AS TIP_DESTINO_LIXO_DOMIC, ";
	
	$query .= "(CASE TIP_ESTADO_DOMIC ";
	$query .= "WHEN 1 THEN '1 - Ruim' ";
	$query .= "WHEN 2 THEN '2 - Regular' ";
	$query .= "WHEN 3 THEN '3 - Bom' END) AS TIP_ESTADO_DOMIC, ";
	
	$query .= "(CASE TIP_VIA_ACESSO_DOMIC ";
	$query .= "WHEN 1 THEN '1 - Rua pavimentada' ";
	$query .= "WHEN 2 THEN '2 - Rua não pavimentada' ";
	$query .= "WHEN 3 THEN '3 - Acesso por propriedade particular' ";
	$query .= "WHEN 4 THEN '4 - Beco' END) AS TIP_VIA_ACESSO_DOMIC, ";
	
	$query .= "(CASE TIP_BANHEIRO_DOMIC ";
	$query .= "WHEN 1 THEN '1 - Dentro da casa' ";
	$query .= "WHEN 2 THEN '2 - Fora da casa' ";
	$query .= "WHEN 3 THEN '3 - Não possui' END) AS TIP_BANHEIRO_DOMIC, ";
	
	$query .= "(CASE COD_CRECHE_DOMIC ";
	$query .= "WHEN 's' THEN 'Sim' ";
	$query .= "WHEN 'n' THEN 'Não' END) AS COD_CRECHE_DOMIC, ";
	
	$query .= "(CASE COD_ESCOLA_DOMIC ";
	$query .= "WHEN 's' THEN 'Sim' ";
	$query .= "WHEN 'n' THEN 'Não' END) AS COD_ESCOLA_DOMIC, ";
	
	$query .= "QTD_TEMPO_MORAR_ANOS_PESSOA, QTD_TEMPO_MORAR_MESES_PESSOA";
	
	$query .= " FROM domicilio_2 WHERE DOMICILIO=" . $DOMICILIO;
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	$registro = mysql_fetch_assoc($result);
	
	foreach ($registro as $campo => $valor) {
		$temp = busca_chave(trim($campo));
		if(is_int($temp)) {
			$vetor[$temp]['valor'] = $valor;
		}
	} 
		
	
	$query = "SELECT * FROM domicilio_3 WHERE DOMICILIO=" . $DOMICILIO;
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	$registro = mysql_fetch_assoc($result);
	
	foreach ($registro as $campo => $valor) {
		$temp = busca_chave(trim($campo));
		if(is_int($temp)) {
			if(trim($campo) == "TXT_ELETRO_FAMILIA") $valor = str_replace(";" , ", " , $valor);
			if(strpos($campo,"VAL_") !== false) $valor = "R$ " . number_format($valor, 2, ',', '.');
			$vetor[$temp]['valor'] = $valor;
		}
	} 	

}

##########################################################################################################

function informacoes_pessoa($PESSOA){
	global $vetor;
	
	
	$query = "SELECT NOM_PESSOA, DATE_FORMAT(DTA_NASC_PESSOA,'%d/%m/%Y') as DTA_NASC_PESSOA, ";

	$query .= "(CASE COD_SEXO_PESSOA ";
	$query .= "WHEN 'M' THEN 'Masculino' ";
	$query .= "WHEN 'F' THEN 'Feminino' END) AS COD_SEXO_PESSOA, ";
	
	$query .= "NUM_NIS_PESSOA, ";
	
	$query .= "(CASE COD_CERTID_CIVIL_PESSOA ";
	$query .= "WHEN 1 THEN '1 - Nascimento' ";
	$query .= "WHEN 2 THEN '2 - Casamento' ";
	$query .= "WHEN 3 THEN '3 - Indio' END) AS COD_CERTID_CIVIL_PESSOA, ";
	
	$query .= "COD_TERMO_CERTID_PESSOA, COD_LIVRO_TERMO_CERTID_PESSOA, COD_FOLHA_TERMO_CERTID_PESSOA, DATE_FORMAT(DTA_EMISSAO_CERTID_PESSOA,'%d/%m/%Y') as DTA_EMISSAO_CERTID_PESSOA, ";
	$query .= "SIG_UF_CERTID_PESSOA, NOM_CARTORIO_PESSOA, NUM_IDENTIDADE_PESSOA, TXT_COMPLEMENTO_PESSOA, DATE_FORMAT(DTA_EMISSAO_IDENT_PESSOA,'%d/%m/%Y') as DTA_EMISSAO_IDENT_PESSOA, ";
	$query .= "SIG_UF_IDENT_PESSOA, SIG_ORGAO_EMISSAO_PESSOA, NUM_CART_TRAB_PREV_SOC_PESSOA, NUM_SERIE_TRAB_PREV_SOC_PESSOA, DATE_FORMAT(DTA_EMISSAO_CART_TRAB_PESSOA,'%d/%m/%Y') as DTA_EMISSAO_CART_TRAB_PESSOA, ";
	$query .= "SIG_UF_CART_TRAB_PESSOA, NUM_CPF_PESSOA, NUM_TITULO_ELEITOR_PESSOA, NUM_ZONA_TIT_ELEITOR_PESSOA, NUM_SECAO_TIT_ELEITOR_PESSOA, ";
	
	$query .= "(CASE SIT_PESSOA ";
	$query .= "WHEN 's' THEN 'Ativo' ";
	$query .= "WHEN 'n' THEN 'Inativo' END) AS SIT_PESSOA";
	
	$query .= " FROM pessoa_1 WHERE PESSOA=" . $PESSOA;
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	$registro = mysql_fetch_assoc($result);
	
	foreach ($registro as $campo => $valor) {
		$temp = busca_chave(trim($campo));
		if(is_int($temp)) {
			$vetor[$temp]['valor'] = $valor;
		}
	} 	
	
	
	$query = "SELECT ";
	$query .= "(CASE COD_NACIONALIDADE_PESSOA ";
	$query .= "WHEN 1 THEN '1 - Brasileira' ";
	$query .= "WHEN 2 THEN '2 - Brasileiro Naturalizado' ";
	$query .= "WHEN 3 THEN '3 - Estrangeira' END) AS COD_NACIONALIDADE_PESSOA, ";
	
	$query .= "NOM_PAIS_ORIGEM_PESSOA, DATE_FORMAT(DTA_CHEGADA_PAIS_PESSOA,'%d/%m/%Y') as DTA_CHEGADA_PAIS_PESSOA, COD_UF_MUNIC_NASC_PESSOA, ";
	$query .= "NOM_LOCALIDADE_NASC_PESSOA, NOM_COMPLETO_PAI_PESSOA, NOM_COMPLETO_MAE_PESSOA, ";
	
	$query .= "(CASE COD_PAPEL_PESSOA ";
	$query .= "WHEN 0 THEN '0 - Responsável Legal' ";
	$query .= "WHEN 1 THEN '1 - Mãe' ";
	$query .= "WHEN 2 THEN '2 - Pai' ";
	$query .= "WHEN 3 THEN '3 - Esposo(a)' ";
	$query .= "WHEN 4 THEN '4 - Companheiro(a)' ";
	$query .= "WHEN 5 THEN '5 - Filho(a)' ";
	$query .= "WHEN 6 THEN '6 - Avô/Avó' ";
	$query .= "WHEN 7 THEN '7 - Irmão/Irmã' ";
	$query .= "WHEN 8 THEN '8 - Cunhado(a)' ";
	$query .= "WHEN 9 THEN '9 - Genro/Nora' ";
	$query .= "WHEN 10 THEN '10 - Sobrinho(a)' ";
	$query .= "WHEN 11 THEN '11 - Primo(a)' ";
	$query .= "WHEN 12 THEN '12 - Sogro(a)' ";
	$query .= "WHEN 13 THEN '13 - Neto(a)' ";
	$query .= "WHEN 14 THEN '14 - Tio(a)' ";
	$query .= "WHEN 15 THEN '15 - Adotivo(a)' ";
	$query .= "WHEN 16 THEN '16 - Padastro/Madastra' ";
	$query .= "WHEN 17 THEN '17 - Enteado(a)' ";
	$query .= "WHEN 18 THEN '18 - Bisneto(a)' ";
	$query .= "WHEN 19 THEN '19 - Sem parentesco' ";
	$query .= "WHEN 20 THEN '20 - Outro' END) AS COD_PAPEL_PESSOA";
	
	$query .= " FROM pessoa_2 WHERE PESSOA=" . $PESSOA;
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	$registro = mysql_fetch_assoc($result);
	
	foreach ($registro as $campo => $valor) {
		$temp = busca_chave(trim($campo));
		if(is_int($temp)) {
			$vetor[$temp]['valor'] = $valor;
		}
	} 
		
	$query = "SELECT ";
	$query .= "(CASE COD_QUALIF_ESCOLAR_PESSOA ";
	$query .= "WHEN 1 THEN '1 - Pública Municipal' ";
	$query .= "WHEN 2 THEN '2 - Pública Estadual' ";
	$query .= "WHEN 3 THEN '3 - Pública Federal' ";
	$query .= "WHEN 4 THEN '4 - Particular' ";
	$query .= "WHEN 5 THEN '5 - Outra' ";
	$query .= "WHEN 6 THEN '6 - Não Frequenta' ";
	$query .= "WHEN 7 THEN '7 - Sala de Recurso' END) AS COD_QUALIF_ESCOLAR_PESSOA, ";
	
	$query .= "(CASE COD_GRAU_INSTRUCAO_PESSOA ";
	$query .= "WHEN 1 THEN '1 - Analfabeto' ";
	$query .= "WHEN 2 THEN '2 - Até 4ª série' ";
	$query .= "WHEN 3 THEN '3 - Com 4ª série completa do ensino fundamental' ";
	$query .= "WHEN 4 THEN '4 - De 5ª a 8ª série incompleta do ensino fundamental' ";
	$query .= "WHEN 5 THEN '5 - Ensino fundamental completo' ";
	$query .= "WHEN 6 THEN '6 - Ensino médio incompleto' END) AS COD_GRAU_INSTRUCAO_PESSOA, ";
	
	$query .= "(CASE NUM_SERIE_ESCOLAR_PESSOA ";
	$query .= "WHEN 1 THEN '1 - Maternal I' ";
	$query .= "WHEN 2 THEN '2 - Maternal II' ";
	$query .= "WHEN 3 THEN '3 - Maternal III' ";
	$query .= "WHEN 4 THEN '4 - Jardim I' ";
	$query .= "WHEN 5 THEN '5 - Jardim II' ";
	$query .= "WHEN 6 THEN '6 - Jardim III' ";
	$query .= "WHEN 7 THEN '7 - CA Alfabetização' ";
	$query .= "WHEN 8 THEN '8 - 1&ordf; série do ensino fundamental' ";
	$query .= "WHEN 9 THEN '9 - 2&ordf; série do ensino fundamental' ";
	$query .= "WHEN 10 THEN '10 - 3&ordf; série do ensino fundamental' ";
	$query .= "WHEN 11 THEN '11 - 4&ordf; série do ensino fundamental' ";
	$query .= "WHEN 12 THEN '12 - 5&ordf; série do ensino fundamental' ";
	$query .= "WHEN 13 THEN '13 - 6&ordf; série do ensino fundamental' ";
	$query .= "WHEN 14 THEN '14 - 7&ordf; série do ensino fundamental' ";
	$query .= "WHEN 15 THEN '15 - 8&ordf; série do ensino fundamental' ";
	$query .= "WHEN 16 THEN '16 - 1&ordf; série do ensino médio' ";
	$query .= "WHEN 17 THEN '17 - 2&ordf; série do ensino médio' ";
	$query .= "WHEN 18 THEN '18 - 3&ordf; série do ensino médio' END) AS NUM_SERIE_ESCOLAR_PESSOA, ";
	
	$query .= "NOM_ESCOLA_PESSOA, COD_CENSO_INEP_PESSOA, ";
	
	$query .= "(CASE SIT_MERCADO_TRAB_PESSOA ";
	$query .= "WHEN 1 THEN '1 - Empregador' ";
	$query .= "WHEN 2 THEN '2 - Assalariado com carteira de trabalho' ";
	$query .= "WHEN 3 THEN '3 - Assalariado sem carteira de trabalho' ";
	$query .= "WHEN 4 THEN '4 - Autônomo com previdência social' ";
	$query .= "WHEN 5 THEN '5 - Autônomo sem previdência social' ";
	$query .= "WHEN 6 THEN '6 - Aposentado/Pensionista' ";
	$query .= "WHEN 7 THEN '7 - Trabalhador rural' ";
	$query .= "WHEN 8 THEN '8 - Empregador rural' ";
	$query .= "WHEN 9 THEN '9 - Não trabalha' ";
	$query .= "WHEN 10 THEN '10 - Outra' END) AS SIT_MERCADO_TRAB_PESSOA, ";
	
	$query .= "NOM_EMPRESA_TRAB_PESSOA, NUM_CNPJ_EMPRESA_PESSOA, DATE_FORMAT(DTA_ADMIS_EMPRESA_PESSOA,'%d/%m/%Y') as DTA_ADMIS_EMPRESA_PESSOA, ";
	$query .= "NOM_OCUPACAO_EMPRESA_PESSOA, VAL_REMUNER_EMPREGO_PESSOA, VAL_RENDA_APOSENT_PESSOA, VAL_RENDA_SEGURO_DESEMP_PESSOA, VAL_RENDA_PENSAO_ALIMEN_PESSOA, VAL_OUTRAS_RENDAS_PESSOA ";
	$query .= " FROM pessoa_3 WHERE PESSOA=" . $PESSOA;
	
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	$registro = mysql_fetch_assoc($result);
	
	foreach ($registro as $campo => $valor) {
		$temp = busca_chave(trim($campo));
		if(is_int($temp)) {
			if(strpos($campo,"VAL_") !== false) $valor = "R$ " . number_format($valor, 2, ',', '.');
			$vetor[$temp]['valor'] = $valor;
		}
	}
	
	
	$query = "SELECT ";
	$query .= "(CASE COD_ESTADO_CIVIL_PESSOA ";
	$query .= "WHEN 1 THEN '1 - Solteiro(a)' ";
	$query .= "WHEN 2 THEN '2 - Casado(a)' ";
	$query .= "WHEN 3 THEN '3 - Divorciado(a)' ";
	$query .= "WHEN 4 THEN '4 - Separado(a)' ";
	$query .= "WHEN 5 THEN '5 - Viúvo(a)' END) AS COD_ESTADO_CIVIL_PESSOA, ";
	
	$query .= "(CASE COD_RACA_COR_PESSOA ";
	$query .= "WHEN 1 THEN '1 - Branca' ";
	$query .= "WHEN 2 THEN '2 - Negra' ";
	$query .= "WHEN 3 THEN '3 - Parda' ";
	$query .= "WHEN 4 THEN '4 - Amarela' ";
	$query .= "WHEN 5 THEN '5 - Indígena' END) AS COD_RACA_COR_PESSOA, ";
	
	$query .= "NUM_ROUPA_PESSOA, NUM_CALCADO_PESSOA, ";
	
	$query .= "(CASE COD_MEIO_TRANSP_PESSOA ";
	$query .= "WHEN 1 THEN '1 - Automóvel' ";
	$query .= "WHEN 2 THEN '2 - Motocicleta' ";
	$query .= "WHEN 3 THEN '3 - Ônibus' ";
	$query .= "WHEN 4 THEN '4 - Bicicleta' ";
	$query .= "WHEN 5 THEN '5 - A pé' ";
	$query .= "WHEN 6 THEN '6 - Passe Livre' END) AS COD_MEIO_TRANSP_PESSOA, ";
	
	$query .= "NOM_EMAIL_PESSOA, ";
	
	$query .= "(CASE COD_CRIANCA_0_6_ANOS_PESSOA ";
	$query .= "WHEN 0 THEN '0 - Não é criança' ";
	$query .= "WHEN 1 THEN '1 - Pai/Mãe' ";
	$query .= "WHEN 2 THEN '2 - Irmão/Irmã' ";
	$query .= "WHEN 3 THEN '3 - Avô/Avó' ";
	$query .= "WHEN 4 THEN '4 - Sozinho' ";
	$query .= "WHEN 5 THEN '5 - Creche' ";
	$query .= "WHEN 6 THEN '6 - Outro' END) AS COD_CRIANCA_0_6_ANOS_PESSOA, ";
	
	$query .= "COD_GRAVIDA_PESSOA, TXT_DOENCAS_PESSOA, NOM_DEPEN_QUIMICA_PESSOA, ";
	
	$query .= "(CASE COD_AMAMENTANDO_PESSOA ";
	$query .= "WHEN 's' THEN 'Sim' ";
	$query .= "WHEN 'n' THEN 'Não' END) AS COD_AMAMENTANDO_PESSOA, ";
	
	$query .= "(CASE COD_PRE_NATAL_PESSOA ";
	$query .= "WHEN 's' THEN 'Sim' ";
	$query .= "WHEN 'n' THEN 'Não' END) AS COD_PRE_NATAL_PESSOA, ";
	
	$query .= "(CASE COD_METOD_ANTI_CONCEP_PESSOA ";
	$query .= "WHEN 's' THEN 'Sim' ";
	$query .= "WHEN 'n' THEN 'Não' END) AS COD_METOD_ANTI_CONCEP_PESSOA, ";
	
	$query .= "(CASE COD_CARTEIRA_VACINA_PESSOA ";
	$query .= "WHEN 's' THEN 'Sim' ";
	$query .= "WHEN 'n' THEN 'Não' END) AS COD_CARTEIRA_VACINA_PESSOA ";
	
	$query .= " FROM pessoa_4 WHERE PESSOA=" . $PESSOA;
	
	$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
	$registro = mysql_fetch_assoc($result);
	
	foreach ($registro as $campo => $valor) {
		$temp = busca_chave(trim($campo));
		if(is_int($temp)) {
			if(trim($campo) == "TXT_DOENCAS_PESSOA") $valor = str_replace(";" , ", " , $valor);
			$vetor[$temp]['valor'] = $valor;
		}
	}

}

##########################################################################################################

function tabela_pessoa(){
	global $vetor;
	?>
	<br><br>
	<table style="page-break-before: always;" width="700" border="0" style="font:Arial, Helvetica, sans-serif; font-size:10px;">
	<? 
	//if(($_REQUEST["PESSOA_BASICO"] == "on") || ($_REQUEST["PESSOA_SE"] == "on")){
		
		echo('<tr><td colspan="20">');
		 monta_titulo_secao("Pessoa");
		echo('</td></tr>');
	//}
	$j = 0;
	for($i = 0; $i < count($vetor); $i++){
		if($j == 0) echo('<tr>' . chr(10) . chr(13));
		if(($j + $vetor[$i]['lenght']) >= 16) $colspan = 20-$j;
		else $colspan = $vetor[$i]['lenght'];
		if((strlen($vetor[$i]['fieldset'])>0) && ($vetor[$i]['fieldset'] != '*')){
			echo('</tr><tr><td colspan="20"><hr color="blue"><b>' . $vetor[$i]['fieldset'] . '</b></td></tr><tr>');
			$j = 0;
		}
		echo('<td valign="bottom" colspan="' . $colspan . '">' . chr(10) . chr(13));
		$valor = $vetor[$i]['valor'];
		if($valor == "") $valor = "&nbsp;";
		echo('<table width="100%" style="font:Arial, Helvetica, sans-serif; font-size:10px;"><tr><td>' . $vetor[$i]['label'] . '</td></tr><tr><td style="border: 1px solid black;">' . $valor . '</td></tr></table>' . chr(10) . chr(13));
		echo('</td>' . chr(10) . chr(13));
		if((strlen($vetor[$i]['fieldset']) == 1) && ($vetor[$i]['fieldset'] == '*') && (strlen($vetor[$i+1]['fieldset']) == 0)) {
			echo('</tr><tr><td colspan="20"><hr color="blue"></td></tr>');
			$j = 0;
		}
		else $j += $vetor[$i]['lenght'];
		if($j >= 16){
			echo('</tr>');
			$j = 0;
		}	
	}
	?>
	</table>
	<?
}
?>
