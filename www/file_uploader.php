<?php 
function file_upload($dir_arquivo, $arquivo, $nome){
	if (strlen($nome) == 0)	$nome_da_imagem = verifica_nome_arquivo($arquivo["name"]);
	else $nome_da_imagem = verifica_nome_arquivo($nome);
	$nome = $nome_da_imagem;
	
	if(file_exists($dir_arquivo . "/" . $nome)){
		tela_erro('Já existe um arquivo com o mesmo nome. Altere o nome e tente novamente.',true);
	}
	if (move_uploaded_file($arquivo['tmp_name'], $dir_arquivo . "/" . $nome)) {
		print "O arquivo é valido e foi carregado com sucesso.\n";
	} 
	else {
		die($arquivo['tmp_name'] . "<br> $dir_arquivo <br> $nome <br> Erro ao enviar arquivo!");
	}
	$extensao = substr($nome, -3); 
	$resultado = $dir_arquivo . "/" . $nome;
	return array($resultado, sizeformater($arquivo['size']), $extensao, $nome);
}
?>