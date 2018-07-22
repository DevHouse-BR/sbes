<?
require("includes/funcoes_layout.php");

$DOMICILIO = $_REQUEST["DOMICILIO"];
$PESSOA = $_REQUEST["PESSOA"];

if(!strpos($_SERVER['HTTP_REFERER'],"busca_usuario_familia.php")){
	if(strlen($PESSOA)>0) $voltar = 'form_usuario_familia_9.php?DOMICILIO=' . $DOMICILIO . '&PESSOA=' . $PESSOA;
	else $voltar = 'form_usuario_familia_4.php?DOMICILIO=' . $DOMICILIO;
}
else $voltar = strstr($_SERVER['HTTP_REFERER'],"busca_usuario_familia.php");

inicia_pagina();
monta_menu_abas("operador");
inicia_tabela_conteudo();

if(strlen($PESSOA)>0){
	require("includes/conectar_mysql.php");
	$query = "SELECT NOM_PESSOA FROM pessoa_1 WHERE DOMICILIO=" . $DOMICILIO . " AND PESSOA=" . $PESSOA;
	$result = mysql_query($query) or tela_erro("Erro ao Ler registros do Banco de dados: " . mysql_error());
	$registro = mysql_fetch_assoc($result);
	$NOM_PESSOA = $registro["NOM_PESSOA"];
	require("includes/desconectar_mysql.php");
	monta_titulo_secao("Benefícios Recebidos: " . $NOM_PESSOA);
}
else monta_titulo_secao("Benefícios Recebidos: Domicílio");
?>
<script language="javascript">
	function janela(){
		void window.open('form_beneficio.php?DOMICILIO=<?=$DOMICILIO?>&PESSOA=<?=$PESSOA?>', '_blank', 'width=400,height=328,status=no,resizable=no,top=20,left=100');
	}
	function editar(codigo){
		void window.open('form_beneficio.php?DOMICILIO=<?=$DOMICILIO?>&PESSOA=<?=$PESSOA?>&modo=update&cd=' + codigo, '_blank', 'width=400,height=300,status=no,resizable=no,top=20,left=100');
	}
	function apagar(cd){
		if(confirm("Deseja remover este beneficio?"))
			window.location = 'salva_beneficio.php?DOMICILIO=<?=$DOMICILIO?>&PESSOA=<?=$PESSOA?>&modo=apagar&cd=' + cd;
	}
</script>
	<table width="100%">
		<tr>
			<td width="50"><a href="<?=$voltar?>"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<td width="50"><a href="#" onClick="javascript: janela();"><img title="Registrar recebimento de beneficio" border="0" onMouseOver="this.src = 'imagens/adiciona_beneficio_over.gif';" onMouseOut="this.src = 'imagens/adiciona_beneficio_out.gif';" src="imagens/adiciona_beneficio_out.gif"></a></td>
			<td></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<? 				
	$colunas[0]['largura'] = "4%";
	$colunas[0]['label'] = "&nbsp;";
	$colunas[0]['alinhamento'] = "left";
	
	$colunas[1]['largura'] = "13%";
	$colunas[1]['label'] = "Data";
	$colunas[1]['alinhamento'] = "left";
	
	$colunas[2]['largura'] = "40%";
	$colunas[2]['label'] = "Programa Social";
	$colunas[2]['alinhamento'] = "left";
	
	$colunas[3]['largura'] = "10%";
	$colunas[3]['label'] = "Valor";
	$colunas[3]['alinhamento'] = "right";

	$colunas[4]['largura'] = "13%";
	$colunas[4]['label'] = "Qtd";
	$colunas[4]['alinhamento'] = "center";
	
	$colunas[5]['largura'] = "15%";
	$colunas[5]['label'] = "Recibo";
	$colunas[5]['alinhamento'] = "left";
	
	$colunas[6]['largura'] = "5%";
	$colunas[6]['label'] = "&nbsp;";
	$colunas[6]['alinhamento'] = "right";
	
	$query = "SELECT ";
	$query .= "CONCAT('<a href=\"#\" onClick=\"editar(', b.cd , ');\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as editar, ";
	$query .= "CONCAT('<b>', DATE_FORMAT(b.data,'%d/%m/%Y') , '</b>'), ";
	$query .= "p.descricao, REPLACE(b.valor, '.', ','), b.qtd, b.nr_recibo, ";
	$query .= "CONCAT('<a href=\"javascript: apagar(', b.cd , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
	$query .= " FROM beneficios b, programa_social p WHERE b.programa_social = p.cd ";
	
	if(!empty($_REQUEST["DOMICILIO"])) {
		$query .= " AND DOMICILIO=" . $_REQUEST["DOMICILIO"];
		$string = "&DOMICILIO=" .  $_REQUEST["DOMICILIO"];
		if(strlen(trim($_REQUEST["PESSOA"]))>0){
			$query .= " AND PESSOA=" . $_REQUEST["PESSOA"];
			$string .= "&PESSOA=" .  $_REQUEST["PESSOA"];
		}
		else $query .= " AND PESSOA IS NULL";
	}
	//echo($query);
	browser($query, $colunas, $string);
	termina_pagina(); ?>
