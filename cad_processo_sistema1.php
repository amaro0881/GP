<?PHP

include "inc_dbConexao.php";
SESSION_START();
// A��o a ser executada nesta p�gina (ins=inserir, alt=alterar, del=excluir, ver=visualizar
$acao = $_POST['acao'];
// Campos da tabela
$id_processo_sistema = $_POST['id_processo_sistema'];
$id_processo = $_POST['id_processo'];
$id_sistema = $_POST['id_sistema'];
$observacao = $_POST['observacao'];

// A��o de inclus�o
if ($acao == "ins") {
	$titulo_pagina = "Inserir novo registro";
	$mensagem = "<h1 class='c_laranja'>A inclus�o do registro foi efetuada com sucesso.</h1>";
	$mensagem = $mensagem . $id_sistema . " - " . $observacao;
	// Insere registro
	$sql = "INSERT INTO processo_sistema ";
	$sql = $sql . "(id_processo,id_sistema,observacao) ";
	$sql = $sql . "VALUES('$id_processo','$id_sistema','$observacao') ";
	mysql_query($sql, $conexao);
}
// A��o de altera��o
if ($acao == "alt") {
$titulo_pagina = "Altera��o cadastral";
$mensagem = "<h1 class='c_laranja'>A altera��o do registro foi efetuada com sucesso.</h1>";
$mensagem = $mensagem . $id_sistema . " - " . $observacao;
// Altera registro
$sql = "UPDATE processo_sistema SET ";
$sql = $sql . "id_sistema = '$id_sistema', ";
$sql = $sql . "observacao = '$observacao' ";
$sql = $sql . " WHERE id_processo_sistema = '" . $id_processo_sistema . "' ";	
mysql_query($sql, $conexao);
}

// A��o de exclus�o
if ($acao == "exc") {
// Exclui registro
$sql = "DELETE FROM processo_sistema ";
$sql = $sql . " WHERE id_processo_sistema = '" . $id_processo_sistema . "' ";	
mysql_query($sql, $conexao);
}
// Executa p�gina cad_processo.php
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cad_processo.php?acao=ver&id_processo=" . $id_processo . "'>";
// Libera os recursos usados pela conex�o atual
//mysql_free_result($rs);
mysql_close ($conexao);
?>
