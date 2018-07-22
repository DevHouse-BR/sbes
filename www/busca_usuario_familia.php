<?
	require("includes/funcoes_layout.php");
	
	$modo = $_REQUEST["modo"];
	
	inicia_pagina();
	if($_SESSION["operador"] == "s") monta_menu_abas("operador");
	elseif($_SESSION["assistente_social"] == "s") monta_menu_abas("assistente");
	elseif($_SESSION["secretario"] == "s") monta_menu_abas("secretario");
	
	inicia_tabela_conteudo();
	
	if($modo == "socio_economico") monta_titulo_secao("Informações Socio-Econômicas");
	elseif($modo == "beneficios") monta_titulo_secao("Recebimento de Benefícios");
	elseif($modo == "relatorio_ficha_usuario") monta_titulo_secao("Relatório de Ficha de Usuário");
	elseif($modo == "relatorio_beneficio") monta_titulo_secao("Relatório de Recebimento de Benefício");
	else monta_titulo_secao("Usuário Família");
	
	if((empty($_REQUEST["tipo_domicilio"])) && empty($_REQUEST["tipo_pessoa"])) {	
		$_REQUEST["tipo_domicilio"] = "logradouro";
	}
	?>
	<table width="100%">
		<tr>
			<? if($modo == ""){ ?>
					<td width="50"><a href="form_usuario_familia_1.php"><img title="Novo Usuario/Familia" border="0" onMouseOver="this.src = 'imagens/novo_usuario_familia_over.gif';" onMouseOut="this.src = 'imagens/novo_usuario_familia_out.gif';" src="imagens/novo_usuario_familia_out.gif"></a></td>
			<? }
				elseif($modo == "relatorio_ficha_usuario"){ ?>
					<td width="50"><a href="relatorio_ficha_usuario.php?DOMICILIO=0&PESSOA=0"><img title="Gera Ficha de Usuário em Branco" border="0" onMouseOver="this.src = 'imagens/relatorio_ficha_usuario_branco_over.gif';" onMouseOut="this.src = 'imagens/relatorio_ficha_usuario_branco_out.gif';" src="imagens/relatorio_ficha_usuario_branco_out.gif"></a></td>
			<? } ?>
			<td></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<? inicia_quadro_escuro('width="100%"', '<div><span style="width: 62%; text-align: left;">Busca Domic&iacute;lio</span><span>Busca Pessoa</span></div>'); ?>
		<table width="100%">
			<tr>
				<td width="50%">
					<table border="0">
						<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
						<tr>
							<td class="label">Busca:</td>
							<td><input type="text" name="endereco" value="<?=trim($_REQUEST["endereco"])?>" size="20" class="caixa_texto"></td>
							<td>
								<select name="tipo_domicilio">
									<option value="logradouro"<? if($_REQUEST["tipo_domicilio"] == "logradouro") echo(" selected");?>>Logradouro,Numero</option>
									<option value="bairro"<? if($_REQUEST["tipo_domicilio"] == "bairro") echo(" selected");?>>Bairro</option>
									<option value="cep"<? if($_REQUEST["tipo_domicilio"] == "cep") echo(" selected");?>>CEP</option>
								</select>
							</td>
							<td><input type="submit" value="" class="botao_busca_azul"></td>
						</tr>
						<input type="hidden" name="modo" value="<?=$modo?>">
						</form>
					</table>
				</td>
				<td>
					<table>
						<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
						<tr>
							<td class="label">Busca:</td>
							<td><input type="text" name="nome" value="<?=trim($_REQUEST["nome"])?>" size="20" class="caixa_texto"></td>
							<td>
								<select name="tipo_pessoa">
									<option value="nome">Nome</option>
								</select>
							</td>
							<td><input type="submit" value="" class="botao_busca_azul"></td>
						</tr>
						<input type="hidden" name="modo" value="<?=$modo?>">
						</form>
					</table>
				</td>
			</tr>
		</table>
	<? termina_quadro_escuro(); ?>

	<? 
	if(!empty($_REQUEST["tipo_domicilio"])) {	
		$colunas[0]['largura'] = "5%";
		$colunas[0]['label'] = "&nbsp;";
		$colunas[0]['alinhamento'] = "left";
		
		$colunas[1]['largura'] = "70%";
		$colunas[1]['label'] = "Endereço";
		$colunas[1]['alinhamento'] = "left";
		
		$colunas[2]['largura'] = "20%";
		$colunas[2]['label'] = "CEP";
		$colunas[2]['alinhamento'] = "left";
		
		$colunas[3]['largura'] = "5%";
		$colunas[3]['label'] = "&nbsp;";
		$colunas[3]['alinhamento'] = "right";
		
		if($modo == "socio_economico") $destino = "form_usuario_familia_2.php";
		elseif($modo == "beneficios") $destino = "busca_beneficio.php";
		elseif($modo == "relatorio_ficha_usuario") $destino = "relatorio_ficha_usuario.php";
		else $destino = "form_usuario_familia_4.php";
		
		$query = "SELECT ";
		if($modo == "relatorio_ficha_usuario") $query .= " CONCAT('<a href=\"" . $destino . "?DOMICILIO=', d.DOMICILIO , '\"><img border=\"0\" src=\"imagens/printer.gif\"></a>') as cd,";
		else $query .= " CONCAT('<a href=\"" . $destino . "?DOMICILIO=', d.DOMICILIO , '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as cd,";
		$query .= "CONCAT(d.TIP_LOGRAD_DOMIC, ' ', d.NOM_LOGRADOURO_DOMIC, ' ', d.NUM_RESIDENCIA_DOMIC, ' ', d.NOM_COMPL_RESIDENCIA_DOMIC) as endereco,";
		$query .= "d.CEP_RESIDENCIA_DOMIC , ";
		$query .= "CONCAT('<a href=\"javascript: apagar(', d.DOMICILIO , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
		$query .= " from domicilio_1 d";
		
		if($modo == "beneficios") $query .= ", domicilio_programa_social dps";

		if($_REQUEST["tipo_domicilio"] == "logradouro"){
			$temp = split(",",$_REQUEST["endereco"]);
			$query .= " WHERE d.NOM_LOGRADOURO_DOMIC LIKE '%" . trim($temp[0]) . "%' AND d.NUM_RESIDENCIA_DOMIC LIKE '%" . trim($temp[1]) . "%'";
			$string = "&endereco=" .  trim($_REQUEST["endereco"]) . "&tipo_domicilio=logradouro";
		}
		if($_REQUEST["tipo_domicilio"] == "bairro"){
			$query .= " WHERE d.NOM_BAIRRO_RESIDENCIA_DOMIC LIKE '%" . trim($_REQUEST["endereco"]) . "%'";
			$string = "&endereco=" .  trim($_REQUEST["endereco"]) . "&tipo_domicilio=bairro";
		}
		if($_REQUEST["tipo_domicilio"] == "cep"){
			$query .= " WHERE d.CEP_RESIDENCIA_DOMIC LIKE '%" . trim($_REQUEST["endereco"]) . "%'";
			$string = "&endereco=" .  trim($_REQUEST["endereco"]) . "&tipo_domicilio=cep";
		}
		
		if($modo == "beneficios") $query .= " AND dps.DOMICILIO = d.DOMICILIO";
		
		$ordem = " ORDER BY d.NOM_LOGRADOURO_DOMIC, d.NUM_RESIDENCIA_DOMIC";
		browser($query, $colunas, $string, '',$ordem);
	}
	elseif(!empty($_REQUEST["tipo_pessoa"])) {	
		$colunas[0]['largura'] = "5%";
		$colunas[0]['label'] = "&nbsp;";
		$colunas[0]['alinhamento'] = "left";
						
		$colunas[1]['largura'] = "30%";
		$colunas[1]['label'] = "Nome";
		$colunas[1]['alinhamento'] = "left";
		
		$colunas[2]['largura'] = "60%";
		$colunas[2]['label'] = "Endereço";
		$colunas[2]['alinhamento'] = "left";
		
		$colunas[3]['largura'] = "5%";
		$colunas[3]['label'] = "&nbsp;";
		$colunas[3]['alinhamento'] = "right";
		
		if($modo == "socio_economico") $destino = "form_usuario_familia_7.php";
		elseif($modo == "beneficios") $destino = "busca_beneficio.php";
		elseif($modo == "relatorio_ficha_usuario") $destino = "relatorio_ficha_usuario.php";
		else $destino = "form_usuario_familia_9.php";
		
		$query = "SELECT ";
		if($modo == "relatorio_ficha_usuario") $query .= " CONCAT('<a href=\"" . $destino . "?DOMICILIO=', p.DOMICILIO , '&PESSOA=', p.PESSOA, '\"><img border=\"0\" src=\"imagens/printer.gif\"></a>') as cd,";
		else $query .= " CONCAT('<a href=\"" . $destino . "?DOMICILIO=', p.DOMICILIO , '&PESSOA=', p.PESSOA, '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as cd,";
		$query .= "p.NOM_PESSOA, ";
		$query .= "CONCAT(d.TIP_LOGRAD_DOMIC, ' ', d.NOM_LOGRADOURO_DOMIC, ' ', d.NUM_RESIDENCIA_DOMIC, ' ', d.NOM_COMPL_RESIDENCIA_DOMIC) as endereco,";
		$query .= "CONCAT('<a href=\"javascript: apagar(', p.PESSOA , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
		$query .= " from domicilio_1 d, pessoa_1 p";
				
		if($modo == "beneficios") $query .= ", pessoa_programa_social pps";
		
		$query .= " WHERE p.DOMICILIO = d.DOMICILIO";
		
		if($_REQUEST["tipo_pessoa"] == "nome"){
			$query .= " AND NOM_PESSOA LIKE '%" . trim($_REQUEST["nome"]) . "%'";
			$string = "&endereco=" . trim($_REQUEST["nome"]) . "&tipo_pessoa=nome";
		}
		
		if($modo == "beneficios") $query .= " AND pps.PESSOA = p.PESSOA";
		
		$ordem = " ORDER BY p.NOM_PESSOA";
		browser($query, $colunas, $string, '',$ordem);
	}
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
	<script language="javascript">
		document.forms[0].elements[0].focus();
	</script>
	<? termina_pagina(); ?>
