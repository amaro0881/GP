<?PHP

include "inc_dbConexao.php";
SESSION_START();
// A��o a ser executada nesta p�gina (ins=inserir, alt=alterar, del=excluir, ver=visualizar
$acao = $_POST['acao'];
// Campos da tabela
$id_sistema = $_POST['id_sistema'];
$codigo_sistema = $_POST['codigo_sistema'];
$descricao = $_POST['descricao'];
$observacao = $_POST['observacao'];

// A��o de inclus�o
if ($acao == "ins") {
	$titulo_pagina = "Inserir novo registro";
	$mensagem = "<h1 class='c_laranja'>A inclus�o do registro foi efetuada com sucesso.</h1>";
	$mensagem = $mensagem . $codigo_sistema . " - " . $descricao;
	// Insere registro
	$sql = "INSERT INTO sistema ";
	$sql = $sql . "(codigo_sistema,descricao,observacao) ";
	$sql = $sql . "VALUES('$codigo_sistema','$descricao','$observacao') ";
	mysql_query($sql, $conexao)or die(mysql_error());
}
// A��o de altera��o
if ($acao == "alt") {
$titulo_pagina = "Altera��o cadastral";
$mensagem = "<h1 class='c_laranja'>A altera��o do registro foi efetuada com sucesso.</h1>";
$mensagem = $mensagem . $codigo_sistema . " - " . $descricao;
// Altera registro
$sql = "UPDATE sistema SET ";
$sql = $sql . "codigo_sistema = '$codigo_sistema', ";
$sql = $sql . "descricao = '$descricao', ";
$sql = $sql . "observacao = '$observacao' ";
$sql = $sql . " WHERE id_sistema = '" . $id_sistema . "' ";	
mysql_query($sql, $conexao)or die(mysql_error());
}

// A��o de exclus�o
if ($acao == "exc") {
// Exclui registro
$sql = "DELETE FROM sistema ";
$sql = $sql . " WHERE id_sistema = '" . $id_sistema . "' ";	
mysql_query($sql, $conexao)or die(mysql_error());
}
// Executa p�gina cad_sistema_grid.php
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cad_sistema_grid.php?id_sistema=" . $id_sistema . "'>";
// Libera os recursos usados pela conex�o atual
//mysql_free_result($rs);
mysql_close ($conexao);
?>
