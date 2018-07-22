<?
require("includes/funcoes_layout.php");

$DOMICILIO = $_REQUEST["DOMICILIO"];
$PESSOA = $_REQUEST["PESSOA"];

if(strlen($PESSOA)>0) $voltar = 'form_usuario_familia_9.php?DOMICILIO=' . $DOMICILIO . '&PESSOA=' . $PESSOA;
else $voltar = 'form_usuario_familia_4.php?DOMICILIO=' . $DOMICILIO;

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
	monta_titulo_secao("Histórico de " . $NOM_PESSOA);
}
else monta_titulo_secao("Histórico do Domicílio");
?>
<script language="javascript">
	function janela(){
		void window.open('form_historico.php?DOMICILIO=<?=$DOMICILIO?>&PESSOA=<?=$PESSOA?>', '_blank', 'width=400,height=270,status=no,resizable=no,top=20,left=100');
	}
	function editar(cd){
		void window.open('form_historico.php?DOMICILIO=<?=$DOMICILIO?>&PESSOA=<?=$PESSOA?>&modo=update&cd=' + cd, '_blank', 'width=400,height=270,status=no,resizable=no,top=20,left=100');
	}
	function apagar(cd){
		if(confirm("Deseja remover esta histórico?"))
			window.location = 'salva_historico.php?DOMICILIO=<?=$DOMICILIO?>&PESSOA=<?=$PESSOA?>&modo=apagar&cd=' + cd;
	}
</script>
	<table width="100%">
		<tr>
			<td width="50"><a href="<?=$voltar?>"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<td width="50"><a href="#" onClick="javascript: janela();"><img title="Adicionar um histórico" border="0" onMouseOver="this.src = 'imagens/adiciona_historico_over.gif';" onMouseOut="this.src = 'imagens/adiciona_historico_out.gif';" src="imagens/adiciona_historico_out.gif"></a></td>
			<td></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<?
	$colunas[0]['largura'] = "5%";
	$colunas[0]['label'] = "&nbsp;";
	$colunas[0]['alinhamento'] = "left";
	
	$colunas[1]['largura'] = "13%";
	$colunas[1]['label'] = "Data";
	$colunas[1]['alinhamento'] = "left";
	
	$colunas[2]['largura'] = "77%";
	$colunas[2]['label'] = "Histórico";
	$colunas[2]['alinhamento'] = "left";
	
	$colunas[3]['largura'] = "5%";
	$colunas[3]['label'] = "&nbsp;";
	$colunas[3]['alinhamento'] = "right";
	
	$query = "SELECT ";
	$query .= "CONCAT('<a href=\"#\" onClick=\"editar(', cd , ');\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as etapas, ";
	$query .= "CONCAT('<b>', DATE_FORMAT(data,'%d/%m/%Y'), '</b>'), ";
	$query .= "historico, ";
	$query .= "CONCAT('<a href=\"javascript: apagar(', cd , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
	$query .= " FROM historicos ";
	
	if(!empty($_REQUEST["DOMICILIO"])) {
		$query .= " WHERE DOMICILIO=" . $_REQUEST["DOMICILIO"];
		$string = "&DOMICILIO=" .  $_REQUEST["DOMICILIO"];
		if(strlen(trim($_REQUEST["PESSOA"]))>0){
			$query .= " AND PESSOA=" . $_REQUEST["PESSOA"];
			$string .= "&PESSOA=" .  $_REQUEST["PESSOA"];
		}
		else $query .= " AND PESSOA IS NULL";
	}
	$query .= " ORDER BY data DESC";
	browser($query, $colunas, $string);
	termina_pagina(); ?>
