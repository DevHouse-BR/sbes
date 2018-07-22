<?
	require("includes/funcoes_layout.php");
	inicia_pagina_login();
	?>
	<hr>
	<table width="100%" height="200">
		<tr>
			<td><br><br><br></td>
		</tr>
		<tr><td align="center">
		<? inicia_quadro_claro("",""); ?>
			<table>
				<form action="valida_usuario.php" method="post">
				<tr>
					<td class="label">Usu&aacute;rio:</td>
					<td><input type="text" name="usuario" class="caixa_texto"></td>
				</tr>
				<tr>
					<td class="label">Senha:</td>
					<td><input type="password" name="senha" class="caixa_texto"></td>
				</tr>
				<tr>
					<td colspan="2" class="label"><input type="submit" value="  OK  " class="botao_aqua"></td>
				</tr>
				</form>
			</table>							
		<? termina_quadro_claro(); ?>
	</td></tr></table>
	<? termina_pagina();
?>
