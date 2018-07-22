<?
	require("includes/funcoes_layout.php");
	inicia_pagina();
	monta_menu_abas("assistente");
	inicia_tabela_conteudo();
	monta_titulo_secao("Programas Sociais");
	?>
	<table width="100%">
		<tr>
			<td width="50"><a href="form_programa_social.php"><img title="Novo Programa Social" border="0" onMouseOver="this.src = 'imagens/novo_programa_social_over.gif';" onMouseOut="this.src = 'imagens/novo_programa_social_out.gif';" src="imagens/novo_programa_social_out.gif"></a></td>
			<td></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<div>
		<? inicia_quadro_escuro('width="100%"', '<div><span style="width: 61%; text-align: left;">Busca Programa Social por C&oacute;digo</span><span>Busca Programa Social por Descri&ccedil;&atilde;o</span></div>'); ?>
		<span style="width: 43%;">
			<table>
				<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
				<tr>
					<td class="label">C&oacute;digo:</td>
					<td><input type="text" name="codigo" size="20" class="caixa_texto" value="<?=$_REQUEST["codigo"]?>"></td>
					<td><input type="submit" value="" class="botao_busca_azul"></td>
				</tr>
				</form>
			</table>
		</span>
		<span style="width: 57%; text-align:right;">
			<table>
				<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
				<tr>
					<td class="label">Descri&ccedil;&atilde;o:</td>
					<td><input type="text" name="descricao" size="30" class="caixa_texto" value="<?=$_REQUEST["descricao"]?>"></td>
					<td><input type="submit" value="" class="botao_busca_azul"></td>
				</tr>
				</form>
			</table>
		</span>
		<? termina_quadro_escuro(); ?>
	</div>
	<? 				
	$colunas[0]['largura'] = "5%";
	$colunas[0]['label'] = "&nbsp;";
	$colunas[0]['alinhamento'] = "left";
	
	$colunas[1]['largura'] = "10%";
	$colunas[1]['label'] = "C&oacute;digo";
	$colunas[1]['alinhamento'] = "left";
	
	$colunas[2]['largura'] = "56%";
	$colunas[2]['label'] = "Descri&ccedil;&atilde;o";
	$colunas[2]['alinhamento'] = "left";
	
	$colunas[3]['largura'] = "12%";
	$colunas[3]['label'] = "In&iacute;cio";
	$colunas[3]['alinhamento'] = "left";
	
	$colunas[4]['largura'] = "12%";
	$colunas[4]['label'] = "T&eacute;rmino";
	$colunas[4]['alinhamento'] = "left";
	
	$query = "SELECT ";
	$query .= " CONCAT('<a href=\"form_programa_social.php?cd=', cd , '\"><img title=\"Editar ', descricao,'\" border=\"0\" src=\"imagens/editar.gif\"></a>') as cd,";
	$query .= " codigo, descricao, DATE_FORMAT(dt_inicio,'%d/%m/%Y'), DATE_FORMAT(dt_termino,'%d/%m/%Y')";
	$query .= " FROM programa_social ";
	
	if(!empty($_REQUEST["codigo"])) {
		$query .= " WHERE codigo LIKE '%" . $_REQUEST["codigo"] . "%'";
		$string = "&codigo=" .  $_REQUEST["nome"];
	}
	if(!empty($_REQUEST["descricao"])) {
		$query .= " WHERE descricao LIKE '%" . $_REQUEST["descricao"] . "%'";
		$string = "&descricao=" .  $_REQUEST["descricao"];
	}
	?>
	<script language="javascript">
		function altera_estado(novo, cd){
			if(novo == 's') estado = 'ativo?';
			if(novo == 'n') estado = 'inativo?';
			if(confirm("Deseja mudar o estado do usuário para " + estado))
				window.location = 'salva_usuario_sistema.php?modo=ativo&pagina=<?=$_REQUEST["pagina"]?>&new=' + novo + '&cd=' + cd + '<?=$string?>';
		}
	</script>
	<? 
	browser($query, $colunas, $string); ?>
	<script language="javascript">
		document.forms[0].elements[0].focus();
	</script>
	<? termina_pagina(); ?>
