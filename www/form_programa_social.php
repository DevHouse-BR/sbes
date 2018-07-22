<?
	require("includes/funcoes_layout.php");
	
	$cd = $_GET["cd"];
	if(!empty($cd)){
		//session_start();
		//if(($_SESSION["cd_usuario"] != $cd) && ($_SESSION["administrador"] == 'n')) tela_erro("Você não tem permissão para ver este documento.");
		$update = true;
		require("includes/conectar_mysql.php");
		$query = "SELECT codigo, descricao, DATE_FORMAT(dt_inicio,'%d/%m/%Y') as dt_inicio, DATE_FORMAT(dt_termino,'%d/%m/%Y') as dt_termino, comentarios FROM programa_social WHERE cd=" . $cd;
		$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		$registro = mysql_fetch_assoc($result);
		$codigo = $registro["codigo"];
		$descricao = $registro["descricao"];
		$dt_inicio = $registro["dt_inicio"];
		$dt_termino = $registro["dt_termino"];
		$comentarios = $registro["comentarios"];
		require("includes/desconectar_mysql.php");
	}
	
	if ($update) $modo = 'update';
	else $modo = 'add';
	
	inicia_pagina();
	monta_menu_abas("assistente");
	inicia_tabela_conteudo();
	monta_titulo_secao("Novo Programa Social");
	?>
	<script language="JavaScript" src="includes/calendar1.js"></script>
	<script language="JavaScript" src="includes/data.js"></script>
	<table width="100%" border="0">
		<tr>
			<td width="40" align="center"><a href="busca_programa_social.php"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<td width="40" align="center"><a href="javascript: document.forms[0].submit();"><img title="Salvar Informa&ccedil;&otilde;es" border="0" onMouseOver="this.src = 'imagens/salvar_programa_social_over.gif';" onMouseOut="this.src = 'imagens/salvar_programa_social_out.gif';" src="imagens/salvar_programa_social_out.gif"></a></td>
			<? if($modo == "update") { ?>
				<td width="40" align="center"><a href="javascript: janela_usuario('add');"><img title="Adicionar Usu&aacute;rios ao Programa Social" border="0" onMouseOver="this.src = 'imagens/novo_usuario_sistema_over.gif';" onMouseOut="this.src = 'imagens/novo_usuario_sistema_out.gif';" src="imagens/novo_usuario_sistema_out.gif"></a></td>
				<td width="40" align="center"><a href="salva_programa_social.php?modo=apagar&cd=<?=$cd?>"><img title="Apagar o Programa Social" border="0" onMouseOver="this.src = 'imagens/apagar_over.gif';" onMouseOut="this.src = 'imagens/apagar_out.gif';" src="imagens/apagar_out.gif"></a></td>
			<? } ?>
			<td></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<script language="javascript">
		function apagar(usuario){
			if(confirm("Deseja remover este usuário do programa social?"))
				void window.open('salva_usuario_programa_social.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&programa_social=<?=$cd?>&usuario=' + usuario + '<?=$string?>', '_blank', 'width=360,height=215,status=no,resizable=no,top=20,left=100');
		}
		function janela_usuario(modo,usuario){
			if(usuario != 'undefined') user = '&usuario=' + usuario;
			else user = '';
			void window.open('form_programa_social_usuario.php?base=programa_social&programa_social=<?=$cd?>&modo=' + modo + user, '_blank', 'width=360,height=215,status=no,resizable=no,top=20,left=100');
		}
		function valida_form(){
			var f = document.forms[0];
			if(f.codigo.value == ""){
				alert('Informe o código do programa social.');
				f.codigo.focus();
				return false;
			}
			if(f.descricao.value == ""){
				alert('Faça uma breve descrição do programa.');
				f.descricao.focus();
				return false;
			}
			if(f.dt_inicio.value == ""){
				alert('Informe a data de inicio do programa social.');
				f.dt_inicio.focus();
				return false;
			}
			else {
				hoje = new Date();
				anoAtual = hoje.getFullYear();
				barras = f.dt_inicio.value.split("/");
				if (barras.length == 3){
					dia = barras[0];
					mes = barras[1];
					ano = barras[2];
					resultado = (!isNaN(dia) && (dia > 0) && (dia < 32)) && (!isNaN(mes) && (mes > 0) && (mes < 13)) && (!isNaN(ano) && (ano.length == 4));
					if (!resultado) {
						alert("Formato de data inválido!");
						f.dt_inicio.focus();
						return false;
					}
				}
				else {
					alert("Formato de data inválido!");
					f.dt_inicio.focus();
					return false;
				}
			}
			if(f.dt_termino.value == ""){
				alert('Informe a data de término do programa social.');
				f.dt_termino.focus();
				return false;
			}
			else {
				hoje = new Date();
				anoAtual = hoje.getFullYear();
				barras = f.dt_termino.value.split("/");
				if (barras.length == 3){
					dia = barras[0];
					mes = barras[1];
					ano = barras[2];
					resultado = (!isNaN(dia) && (dia > 0) && (dia < 32)) && (!isNaN(mes) && (mes > 0) && (mes < 13)) && (!isNaN(ano) && (ano.length == 4));
					if (!resultado) {
						alert("Formato de data inválido!");
						f.dt_termino.focus();
						return false;
					}
				}
				else {
					alert("Formato de data inválido!");
					f.dt_termino.focus();
					return false;
				}
			}
			f.submit();
		}
	</script>
	<div style="width: 100%; vertical-align: top;">
		<span style="width: 50%; height: 250px;">
			<? inicia_quadro_branco('width="100%"', 'Informa&ccedil;&otilde;es B&aacute;sicas'); ?>
				<table width="100%" border="0" cellpadding="2" cellspacing="3">
					<form action="salva_programa_social.php" method="post">
					<tr>
						<td width="33%" class="label">C&oacute;digo:</td>
						<td><input type="text" name="codigo" value="<?=$codigo?>" size="35" class="caixa_texto" maxlength="30" onKeyDown="if(event.keyCode == 13) document.forms[0].descricao.focus();"></td>
						<td></td>
					</tr>
					<tr>
						<td class="label">Descri&ccedil;&atilde;o:</td>
						<td><input type="text" name="descricao" value="<?=$descricao?>" size="35" class="caixa_texto" maxlength="255" onKeyDown="if(event.keyCode == 13) document.forms[0].dt_inicio.focus();"></td>
						<td></td>
					</tr>
					<tr>
						<td class="label">Data Inicio:</td>
						<td><input type="text" name="dt_inicio" value="<?=$dt_inicio?>" size="35" class="caixa_texto" maxlength="10" onKeyDown="if(event.keyCode == 13) document.forms[0].dt_termino.focus();" onKeypress="return ajustar_data(this,event);"></td>
						<td><a href="javascript: document.forms[0].elements['dt_inicio'].value=''; cal1.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de in&iacute;cio"></a></td>
					</tr>
					<tr>
						<td class="label">Data T&eacute;mino:</td>
						<td><input type="text" name="dt_termino" value="<?=$dt_termino?>" size="35" class="caixa_texto" maxlength="10" onKeyDown="if(event.keyCode == 13) document.forms[0].comentarios.focus();" onKeypress="return ajustar_data(this,event);"></td>
						<td><a href="javascript: document.forms[0].elements['dt_termino'].value=''; cal2.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data de in&iacute;cio"></a></td>
					</tr>
					<tr>
						<td class="label">Coment&aacute;rios Gerais:</td>
						<td><textarea name="comentarios" class="caixa_texto_gr" style="width: 100%; height:70px;"><?=$comentarios?></textarea></td>
						<td></td>
					</tr>
					<tr><td colspan="2" style="font-size:0px;">&nbsp;</td></tr>
						<input type="hidden" name="modo" value="<?=$modo?>">
						<input type="hidden" name="cd" value="<?=$cd?>">
					</form>
				</table>
			<? termina_quadro_branco(); ?>
		</span>
		<span style="width: 50%; height: 250px;">
			<? inicia_quadro_branco('width="100%"', 'Arquivos Anexados'); ?>
				<table width="100%" border="0">
					<tr>
						<td class="conteudo_quadro_branco">
							<?
							if($modo == "update") echo('<iframe frameborder="0" src="busca_arquivos_programa_social.php?cd=' . $cd . '" width="100%" height="190"></iframe>');
							else echo("Grave as informações básicas primeiro.");
							?>
						</td>
					</tr>					
				</table>
			<? termina_quadro_branco(); ?>
		</span>
	</div>
	<? 
	if($modo == "update"){
		$titulo_browser = 'Usuários associados a este programa social:';
		$colunas[0]['largura'] = "3%";
		$colunas[0]['label'] = "&nbsp;";
		$colunas[0]['alinhamento'] = "left";
		
		$colunas[1]['largura'] = "35%";
		$colunas[1]['label'] = "Usu&aacute;rio";
		$colunas[1]['alinhamento'] = "left";
		
		$colunas[2]['largura'] = "20%";
		$colunas[2]['label'] = "Fun&ccedil;&atilde;o";
		$colunas[2]['alinhamento'] = "left";
		
		$colunas[3]['largura'] = "15%";
		$colunas[3]['label'] = "Regi&atilde;o";
		$colunas[3]['alinhamento'] = "left";
		
		$colunas[4]['largura'] = "12%";
		$colunas[4]['label'] = "In&iacute;cio";
		$colunas[4]['alinhamento'] = "left";
		
		$colunas[5]['largura'] = "12%";
		$colunas[5]['label'] = "T&eacute;rmino";
		$colunas[5]['alinhamento'] = "left";
		
		$colunas[6]['largura'] = "3%";
		$colunas[6]['label'] = "&nbsp;";
		$colunas[6]['alinhamento'] = "left";
		
		$query = "SELECT ";
		$query .= " CONCAT('<a href=\"javascript: janela_usuario(\'update\',', p.usuario , ');\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as cd,";
		$query .= "u.nome, p.funcao, p.regiao, DATE_FORMAT(p.dt_inicio,'%d/%m/%Y'), DATE_FORMAT(p.dt_termino,'%d/%m/%Y'), ";
		$query .= "CONCAT('<a href=\"javascript: apagar(', p.usuario , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
		$query .= " FROM usuario_programa_social p, usuarios_sistema u ";
		
		$query .= " WHERE p.usuario = u.cd AND p.programa_social=" . $_REQUEST["cd"];
		$string = "&cd=" .  $_REQUEST["cd"];
		
		browser($query, $colunas, $string, $titulo_browser);
	}
	?>
	<script language="javascript">
			document.forms[0].elements[0].focus();
			var cal1 = new calendar1(document.forms[0].elements['dt_inicio']);
			cal1.year_scroll = true;
			cal1.time_comp = false;
			var cal2 = new calendar1(document.forms[0].elements['dt_termino']);
			cal2.year_scroll = true;
			cal2.time_comp = false;
		</script>
	<? termina_pagina(); ?>
