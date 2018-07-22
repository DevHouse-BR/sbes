<?
require("includes/funcoes_layout.php");
inicia_pagina();
monta_menu_abas("usuario");
inicia_tabela_conteudo();
session_destroy();
?>
<table width="100%">
	<tr>
		<td width="30"><a href="index.php"><img title="Login" border="0" onMouseOver="this.src = 'imagens/login_over.gif';" onMouseOut="this.src = 'imagens/login_out.gif';" src="imagens/login_out.gif"></a></td>
		<td></td>
	</tr>
</table>
<hr>
<?
inicia_quadro_branco('width="500"', 'Sucesso!'); ?>
	<table width="100%">
		<tr>
			<td><img src="imagens/ok.jpg"></td>
			<td>Obrigado por utilizar o sistema. Tenha um bom dia!</td>
		</tr>
	</table>
<?
termina_quadro_branco(); 
termina_pagina();
die();
?>