<?
	require("includes/funcoes_layout.php");
	inicia_pagina();
	monta_menu_abas("administrador");
	inicia_tabela_conteudo();
	monta_titulo_secao("Usu&aacute;rios do Sistema");
	?>
	<table width="100%">
		<tr>
			<td width="50"><a href="form_usuario_sistema.php"><img title="Novo Usu&aacute;rio do Sistema" border="0" onMouseOver="this.src = 'imagens/novo_usuario_sistema_over.gif';" onMouseOut="this.src = 'imagens/novo_usuario_sistema_out.gif';" src="imagens/novo_usuario_sistema_out.gif"></a></td>
			<td></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<? inicia_quadro_escuro('width="100%"', '<div><span style="width: 55%; text-align: left;">Busca Usuário Por Nome</span><span>Busca Usuário Por Id Social</span></div>'); ?>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td width="45%">
				<table width="100%">
					<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
					<tr>
						<td class="label">Nome:</td>
						<td width="20"><input type="text" name="nome" size="20" class="caixa_texto" value="<?=$_REQUEST["nome"]?>"></td>
						<td width="20">
							<select name="ativo">
								<option value=""></option>
								<option value="s"<? if($_REQUEST["ativo"] == 's') echo(' selected');?>>Ativo</option>
								<option value="n"<? if($_REQUEST["ativo"] == 'n') echo(' selected');?>>Inativo</option>
							</select>					
						</td>
						<td><input type="submit" value="" class="botao_busca_azul"></td>
					</tr>
					</form>
				</table>
			</td>
			<td>
				<table width="100%">
					<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
					<tr>
						<td class="label">Identificação Social:</td>
						<td width="20"><input type="text" name="id_social" size="20" class="caixa_texto"></td>
						<td width="20">
							<select name="ativo">
								<option value=""></option>
								<option value="s"<? if($_REQUEST["ativo"] == 's') echo(' selected');?>>Ativo</option>
								<option value="n"<? if($_REQUEST["ativo"] == 'n') echo(' selected');?>>Inativo</option>
							</select>					
						</td>
						<td><input type="submit" value="" class="botao_busca_azul"></td>
					</tr>
					</form>
				</table>
			</td>
		</tr>
	</table>
	<? termina_quadro_escuro(); ?>
	<? 
	$colunas[0]['largura'] = "5%";
	$colunas[0]['label'] = "&nbsp;";
	$colunas[0]['alinhamento'] = "left";
	
	$colunas[1]['largura'] = "45%";
	$colunas[1]['label'] = "Nome";
	$colunas[1]['alinhamento'] = "left";
	
	$colunas[2]['largura'] = "40%";
	$colunas[2]['label'] = "Identificação Social";
	$colunas[2]['alinhamento'] = "left";
	
	$colunas[3]['largura'] = "4%";
	$colunas[3]['label'] = "&nbsp;";
	$colunas[3]['alinhamento'] = "right";
	
	$colunas[4]['largura'] = "4%";
	$colunas[4]['label'] = "&nbsp;";
	$colunas[4]['alinhamento'] = "right";
	
	$query = "SELECT ";
	$query .= " CONCAT('<a href=\"form_usuario_sistema.php?cd=', cd , '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as cd,";
	$query .= "nome, id_social,";
	$query .= "CASE ativo WHEN 's' THEN CONCAT('<a href=\"javascript: altera_estado(\'n\',', cd , ');\"><img border=\"0\" src=\"imagens/ativo.gif\"></a>') WHEN 'n' THEN CONCAT('<a href=\"javascript: altera_estado(\'s\',', cd , ');\"><img border=\"0\" src=\"imagens/inativo.gif\"></a>') END, ";
	$query .= "CONCAT('<a href=\"javascript: apagar(', cd , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
	$query .= " from usuarios_sistema ";
	
	if(!empty($_REQUEST["nome"])) {
		$query .= " WHERE nome LIKE '%" . trim($_REQUEST["nome"]) . "%' AND ativo LIKE '%" . trim($_REQUEST["ativo"]) . "%'";
		$string = "&nome=" .  $_REQUEST["nome"] . "&ativo=" . $_REQUEST["ativo"];
	}
	if(!empty($_REQUEST["id_social"])) {
		$query .= " WHERE id_social LIKE '%" .  trim($_REQUEST["id_social"]) . "%' AND ativo LIKE '%" .  trim($_REQUEST["ativo"]) . "%'";
		$string = "&id_social=" .   trim($_REQUEST["id_social"]) . "&ativo=" .  trim($_REQUEST["ativo"]);
	}
	$ordem = " ORDER BY nome";
	?>
	<script language="javascript">
		function altera_estado(novo, cd){
			if(novo == 's') estado = 'ativo?';
			if(novo == 'n') estado = 'inativo?';
			if(confirm("Deseja mudar o estado do usuário para " + estado))
				window.location = 'salva_usuario_sistema.php?modo=ativo&pagina=<?=$_REQUEST["pagina"]?>&new=' + novo + '&cd=' + cd + '<?=$string?>';
		}
		function apagar(usuario){
			if(confirm("Deseja remover este usuário do sistema?"))
				window.location = 'salva_usuario_sistema.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&cd=' + usuario + '<?=$string?>';
		}
	</script>
	<? 
	browser($query, $colunas, $string, '',$ordem); ?>
	<script language="javascript">
		document.forms[0].elements[0].focus();
	</script>
	<? termina_pagina(); ?>
