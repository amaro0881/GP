<?PHP

include "inc_dbConexao.php";
SESSION_START();
// A��o a ser executada nesta p�gina (ins=inserir, alt=alterar, del=excluir, ver=visualizar
$acao = $_POST['acao'];
// Campos da tabela
$id_entidade_contato = $_POST['id_entidade_contato'];
$id_entidade = $_POST['id_entidade'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

// A��o de inclus�o
if ($acao == "ins") {
	$titulo_pagina = "Inserir novo registro";
	$mensagem = "<h1 class='c_laranja'>A inclus�o do registro foi efetuada com sucesso.</h1>";
	$mensagem = $mensagem . $nome . " - " . $telefone;
	// Insere registro
	$sql = "INSERT INTO entidade_contato ";
	$sql = $sql . "(id_entidade,nome,telefone,email) ";
	$sql = $sql . "VALUES('$id_entidade','$nome','$telefone','$email') ";
	mysql_query($sql, $conexao);
}
// A��o de altera��o
if ($acao == "alt") {
$titulo_pagina = "Altera��o cadastral";
$mensagem = "<h1 class='c_laranja'>A altera��o do registro foi efetuada com sucesso.</h1>";
$mensagem = $mensagem . $nome . " - " . $telefone;
// Altera registro
$sql = "UPDATE entidade_contato SET ";
$sql = $sql . "nome = '$nome', ";
$sql = $sql . "telefone = '$telefone', ";
$sql = $sql . "email = '$email' ";
$sql = $sql . " WHERE id_entidade_contato = '" . $id_entidade_contato . "' ";	
mysql_query($sql, $conexao);
}

// A��o de exclus�o
if ($acao == "exc") {
// Exclui registro
$sql = "DELETE FROM entidade_contato ";
$sql = $sql . " WHERE id_entidade_contato = '" . $id_entidade_contato . "' ";	
mysql_query($sql, $conexao);
}
// Executa p�gina cad_entidade.php
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cad_entidade.php?acao=ver&id_entidade=" . $id_entidade . "'>";
// Libera os recursos usados pela conex�o atual
//mysql_free_result($rs);
mysql_close ($conexao);
?>
