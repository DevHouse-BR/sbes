<?
	require("includes/funcoes_layout.php");
	$cd = $_GET["cd"];

	if((!empty($cd)) && ($cd != 0)){
		if(($_SESSION["cd_usuario"] != $cd) && ($_SESSION["administrador"] == 'n')) tela_erro("Você não tem permissão para ver este documento.");
		$update = true;
		require("includes/conectar_mysql.php");
		$query = "SELECT * FROM usuarios_sistema WHERE cd=" . $cd;
		$result = mysql_query($query) or tela_erro($query . "Erro de conexão ao banco de dados: " . mysql_error());
		$registro = mysql_fetch_assoc($result);
		$nome = $registro["nome"];
		$email = $registro["email"];
		$id_social = $registro["id_social"];
		$usuario = $registro["usuario"];
		$administrador = $registro["administrador"];
		$assistente_social = $registro["assistente_social"];
		$operador = $registro["operador"];
		$secretario = $registro["secretario"];
		$ativo = $registro["ativo"];
		require("includes/desconectar_mysql.php");
	}
	
	if ($update) $modo = 'update';
	else $modo = 'add';
	
	if($update){
		if($ativo == "s") $ativo = "checked";
		else $ativo = '';
	}
	else $ativo = "checked";
	
	inicia_pagina();
	monta_menu_abas("usuario");
	inicia_tabela_conteudo();
	monta_titulo_secao("Novo Usu&aacute;rio");
	?>
	<table width="100%">
		<tr>
			<? if($_SESSION["administrador"] == 's'){ ?>
				<td width="50"><a href="busca_usuario_sistema.php"><img title="Voltar" border="0" onMouseOver="this.src = 'imagens/voltar_over.gif';" onMouseOut="this.src = 'imagens/voltar_out.gif';" src="imagens/voltar_out.gif"></a></td>
			<? } ?>
			<td width="50"><a href="javascript: valida_form();"><img title="Salvar Informa&ccedil;&otilde;es" border="0" onMouseOver="this.src = 'imagens/salvar_usuario_sistema_over.gif';" onMouseOut="this.src = 'imagens/salvar_usuario_sistema_out.gif';" src="imagens/salvar_usuario_sistema_out.gif"></a></td>
			<? if(($modo == "update") && ($_SESSION["administrador"] == 's')){ ?><td width="50"><a href="javascript: janela_usuario('add');"><img title="Relacionar usu&aacute;rio a programas sociais" border="0" onMouseOver="this.src = 'imagens/novo_programa_social_over.gif';" onMouseOut="this.src = 'imagens/novo_programa_social_out.gif';" src="imagens/novo_programa_social_out.gif"></a></td><? } ?>
			<td></td>
			<? monta_botao_logout(); ?>
		</tr>
	</table>
	<hr>
	<script language="javascript">
		<?
		if($_GET["mensagem"] == "ok") echo('alert("Dados gravados com sucesso!");');
		?>
		function apagar(programa){
			if(confirm("Deseja remover este usuário do programa social?"))
				void window.open('salva_usuario_programa_social.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&usuario=<?=$cd?>&programa_social=' + programa + '<?=$string?>', '_blank', 'width=360,height=215,status=no,resizable=no,top=20,left=100');
		}
		function janela_usuario(modo,programa){
			void window.open('form_programa_social_usuario.php?base=usuario&usuario=<?=$cd?>&modo=' + modo + '&programa_social=' + programa, '_blank', 'width=360,height=215,status=no,resizable=no,top=20,left=100');
		}
		<?
		if($modo == "add"){ 
			//MODO ADD
			?>
			function valida_form(){
				var f = document.forms[0];
				var papeis_usuario = document.forms[0].elements['papeis_usuario[]'];
				var selecao = false;
				for(var i = 0; i < papeis_usuario.options.length; i++) papeis_usuario.options[i].selected = true;
				for(var i = 0; i < papeis_usuario.options.length; i++){
					if(papeis_usuario.options[i].selected) selecao = true;
				}
				if(f.nome.value == ''){
					alert('Informe o nome completo do usuário.');
					f.nome.focus();
					return;
				}
				if(f.email.value != ''){
					if(!checkEmail(f.email.value)){
						f.email.focus();
						return;
					}
				}
				if(f.usuario.value == ''){
					alert('Informe um nome de usuário para acessar o sistema.');
					f.usuario.focus();
					return;
				}
				if(!selecao){
					alert('Selecione pelo menos um papel de usuário.');
					f.papeis.focus();
					return;
				}
				if(f.senha.value != ''){
					if(f.senha.value != f.confirma_senha.value){
						alert('Digite a mesma senha no campo "Senha" e "Confirmação Senha".');
						f.senha.focus();
						return;
					}
				}
				f.submit();
			}
		<?
		}
		else{ 
		//MODO UPDATE
		?>
			function valida_form(){
				var f = document.forms[0];
				var papeis_usuario = document.forms[0].elements['papeis_usuario[]'];
				var selecao = false;
				for(var i = 0; i < papeis_usuario.options.length; i++) papeis_usuario.options[i].selected = true;
				for(var i = 0; i < papeis_usuario.options.length; i++){
					if(papeis_usuario.options[i].selected) selecao = true;
				}
				if(f.nome.value == ''){
					alert('Informe o nome completo do usuário.');
					f.nome.focus();
					return;
				}
				if(f.email.value != ''){
					if(!checkEmail(f.email.value)){
						f.email.focus();
						return;
					}
				}
				if(f.usuario.value == ''){
					alert('Informe um nome de usuário para acessar o sistema.');
					f.usuario.focus();
					return;
				}
				if(!selecao){
					alert('Selecione pelo menos um papel de usuário.');
					f.papeis.focus();
					return;
				}
				if(f.senha.value != ''){
					if(f.senha.value != f.confirma_senha.value){
						alert('Digite a mesma senha no campo "Senha" e "Confirmação Senha".');
						f.senha.focus();
						return;
					}
				}
				f.submit();
			}
		<? } 
		if($_SESSION["administrador"] == "s"){?>		
			function adiciona_aos_papeis(){
				var f = document.forms[0];
				var papeis_usuario = document.forms[0].elements['papeis_usuario[]'];
				for(var i = 0; i < f.papeis.options.length; i++){
					if(f.papeis.options[i].selected){
						var opcao = document.createElement("OPTION");
						opcao.text = f.papeis.options[i].text;
						opcao.value = f.papeis.options[i].value;
						papeis_usuario.options.add(opcao);
						f.papeis.options.remove(i);
						i = -1;
					}
				}
			}
			function remove_dos_papeis(){
				var f = document.forms[0];
				var papeis_usuario = document.forms[0].elements['papeis_usuario[]'];
				for(var i = 0; i < papeis_usuario.options.length; i++){
					if(papeis_usuario.options[i].selected){
						var opcao = document.createElement("OPTION");
						opcao.text = papeis_usuario.options[i].text;
						opcao.value = papeis_usuario.options[i].value;
						f.papeis.options.add(opcao);
						papeis_usuario.options.remove(i);
						i = -1;
					}
				}
			}
		<? } ?>
		function checkEmail(email) {
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
				return (true);
			}
			else {
				alert("Endereço de email inválido! Digite novamente.")
				return (false);
			}
		}
		function verificaNumero(campo) {
			if(isNaN(campo.value)){ 
			 alert("Formato de dados inválido.\nApenas números são permitidos."); 
			 campo.focus(); 
			 return (false); 
		   }
		   else return (true);
		}
	</script>
	<form action="salva_usuario_sistema.php" method="post">
		<table>
			<tr>
				<td width="50%">
					<? inicia_quadro_branco('width="100%"', 'Informa&ccedil;&otilde;es B&aacute;sicas'); ?>
						<table width="100%" border="0" cellpadding="2" cellspacing="3">
							<tr>
								<td width="43%" class="label">Nome:</td>
								<td><input type="text" name="nome" value="<?=$nome?>" size="30" maxlength="255" class="caixa_texto" onKeyDown="if(event.keyCode == 13) document.forms[0].email.focus();"></td>
							</tr>
							<tr>
								<td class="label">Email:</td>
								<td><input type="text" name="email" value="<?=$email?>" size="30" maxlength="100" class="caixa_texto" onKeyDown="if(event.keyCode == 13) document.forms[0].id_social.focus();"></td>
							</tr>
							<tr>
								<td class="label">Id Social:</td>
								<td><input type="text" name="id_social" value="<?=$id_social?>" size="30" maxlength="50" class="caixa_texto" onKeyDown="if(event.keyCode == 13) document.forms[0].usuario.focus();"></td>
							</tr>
							<tr>
								<td class="label">Usu&aacute;rio:</td>
								<td><input type="text" name="usuario" value="<?=$usuario?>" size="30" maxlength="50" class="caixa_texto" onKeyDown="if(event.keyCode == 13) document.forms[0].senha.focus();"></td>
							</tr>
							<tr>
								<td class="label">Senha:</td>
								<td><input type="password" name="senha" size="30" maxlength="50" class="caixa_texto" onKeyDown="if(event.keyCode == 13) document.forms[0].confirma_senha.focus();"></td>
							</tr>
							<tr>
								<td class="label">Confirma&ccedil;&atilde;o Senha:</td>
								<td><input type="password" name="confirma_senha" size="30" maxlength="50" class="caixa_texto" onKeyDown="if(event.keyCode == 13) document.forms[0].submit();"></td>
							</tr>
							<tr>
								<td class="label">Ativo:</td>
								<td align="left"><input type="checkbox" name="ativo" <?=$ativo?>></td>
							</tr>
							<tr><td colspan="2" style="font-size:0px;">&nbsp;</td></tr>
						</table>
					<? termina_quadro_branco(); ?>
				</td>
				<td>
					<? inicia_quadro_branco('width="100%"', 'Pap&eacute;is do Usu&aacute;rio'); ?>
						<table width="100%" border="0">
							<tr>
								<td colspan="3"></td>
							</tr>
							<? if($_SESSION["administrador"] == "s"){ ?>
								<tr>
									<td width="46%">
										<label class="conteudo_quadro_branco">Papéis Disponíveis</label>
										<select name="papeis" multiple style="width: 100%; height: 168px;" class="caixa_texto_gr">
											<?
											if($update){
												if($administrador == 'n') echo('<option value="administrador">Administrador</option>');
												if($assistente_social == 'n') echo('<option value="assistente_social">Assistente Social</option>');
												if($operador == 'n') echo('<option value="operador">Operador</option>');
												if($secretario == 'n') echo('<option value="secretario">Secret&aacute;rio</option>');
											}
											else{ ?>
												<option value="administrador">Administrador</option>
												<option value="assistente_social">Assistente Social</option>
												<option value="operador">Operador</option>
												<option value="secretario">Secret&aacute;rio</option>
											<? } ?>
										</select>
									</td>
									<td>
										<a href="#" onClick="remove_dos_papeis();">
											<img border="0" onMouseOver="this.src = 'imagens/voltar2_over.gif';" onMouseOut="this.src = 'imagens/voltar2_out.gif';" src="imagens/voltar2_out.gif">
										</a>
										<a href="#" onClick="adiciona_aos_papeis();">
											<img border="0" onMouseOver="this.src = 'imagens/avancar_over.gif';" onMouseOut="this.src = 'imagens/avancar_out.gif';" src="imagens/avancar_out.gif">
										</a>
									</td>
									<td width="46%">
										<label class="conteudo_quadro_branco">Papéis do Usuário</label>
										<select multiple name="papeis_usuario[]" style="width: 100%; height: 168px;" class="caixa_texto_gr">
										<?
										if($update){
											if($administrador == 's') echo('<option value="administrador">Administrador</option>');
											if($assistente_social == 's') echo('<option value="assistente_social">Assistente Social</option>');
											if($operador == 's') echo('<option value="operador">Operador</option>');
											if($secretario == 's') echo('<option value="secretario">Secret&aacute;rio</option>');
										}
										?>
										</select>
									</td>
								<? } 
								else{
									echo('<tr><td colspan="3" class="conteudo_quadro_branco" height="188">');
									if($administrador == 's') echo('Administrador<br>');
									if($assistente_social == 's') echo('Assistente Social<br>');
									if($operador == 's') echo('Operador<br>');
									if($secretario == 's') echo('Secret&aacute;rio<br>');
									echo('</td></tr>');
								}?>
							</tr>
							<input type="hidden" name="modo" value="<?=$modo?>">
							<input type="hidden" name="cd" value="<?=$cd?>">
							</form>
						</table>
					<? termina_quadro_branco(); ?>
				</td>
			</tr>
		</table>
	<? 
	if($modo == "update"){
		$titulo_browser = 'Programas sociais do usuário:';
		
		if($_SESSION["administrador"] == 's'){
			$colunas[0]['largura'] = "3%";
			$colunas[0]['label'] = "&nbsp;";
			$colunas[0]['alinhamento'] = "left";
			
			$colunas[1]['largura'] = "35%";
			$colunas[1]['label'] = "Programa Social";
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
		}
		else{		
			$colunas[0]['largura'] = "35%";
			$colunas[0]['label'] = "Programa Social";
			$colunas[0]['alinhamento'] = "left";
			
			$colunas[1]['largura'] = "20%";
			$colunas[1]['label'] = "Fun&ccedil;&atilde;o";
			$colunas[1]['alinhamento'] = "left";
			
			$colunas[2]['largura'] = "15%";
			$colunas[2]['label'] = "Regi&atilde;o";
			$colunas[2]['alinhamento'] = "left";
			
			$colunas[3]['largura'] = "12%";
			$colunas[3]['label'] = "In&iacute;cio";
			$colunas[3]['alinhamento'] = "left";
			
			$colunas[4]['largura'] = "12%";
			$colunas[4]['label'] = "T&eacute;rmino";
			$colunas[4]['alinhamento'] = "left";
		}
		
		$query = "SELECT ";
		if($_SESSION["administrador"] == 's') $query .= " CONCAT('<a href=\"javascript: janela_usuario(\'update\',', p.programa_social , ');\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as cd,";
		$query .= "ps.descricao, p.funcao, p.regiao, DATE_FORMAT(p.dt_inicio,'%d/%m/%Y'), DATE_FORMAT(p.dt_termino,'%d/%m/%Y')";
		if($_SESSION["administrador"] == 's') $query .= ", CONCAT('<a href=\"javascript: apagar(', p.programa_social , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
		$query .= " FROM usuario_programa_social p, programa_social ps ";
		
		$query .= " WHERE p.programa_social = ps.cd AND p.usuario=" . $_REQUEST["cd"];
		$string = "&cd=" .  $_REQUEST["cd"];
		
		browser($query, $colunas, $string, $titulo_browser);
	}
	?>
	<script language="javascript">
		document.forms[0].elements[0].focus();
	</script>
	<? termina_pagina(); ?>
