<?PHP

include "inc_dbConexao.php";
SESSION_START();
// A��o a ser executada nesta p�gina (ins=inserir, alt=alterar, del=excluir, ver=visualizar
$acao = $_POST['acao'];
// Campos da tabela
$id_processo_requerente = $_POST['id_processo_requerente'];
$id_processo = $_POST['id_processo'];
$id_requerente = $_POST['id_requerente'];
$observacao = $_POST['observacao'];

// A��o de inclus�o
if ($acao == "ins") {
	$titulo_pagina = "Inserir novo registro";
	$mensagem = "<h1 class='c_laranja'>A inclus�o do registro foi efetuada com sucesso.</h1>";
	$mensagem = $mensagem . $id_requerente . " - " . $observacao;
	// Insere registro
	$sql = "INSERT INTO processo_requerente ";
	$sql = $sql . "(id_processo,id_requerente,observacao) ";
	$sql = $sql . "VALUES('$id_processo','$id_requerente','$observacao') ";
	mysql_query($sql, $conexao);
}
// A��o de altera��o
if ($acao == "alt") {
$titulo_pagina = "Altera��o cadastral";
$mensagem = "<h1 class='c_laranja'>A altera��o do registro foi efetuada com sucesso.</h1>";
$mensagem = $mensagem . $id_requerente . " - " . $observacao;
// Altera registro
$sql = "UPDATE processo_requerente SET ";
$sql = $sql . "id_requerente = '$id_requerente', ";
$sql = $sql . "observacao = '$observacao' ";
$sql = $sql . " WHERE id_processo_requerente = '" . $id_processo_requerente . "' ";	
mysql_query($sql, $conexao);
}

// A��o de exclus�o
if ($acao == "exc") {
// Exclui registro
$sql = "DELETE FROM processo_requerente";
$sql = $sql . " WHERE id_processo_requerente = '" . $id_processo_requerente . "' ";	
mysql_query($sql, $conexao);
}
// Executa p�gina cad_processo.php
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cad_processo.php?acao=ver&id_processo=" . $id_processo . "'>";
// Libera os recursos usados pela conex�o atual
//mysql_free_result($rs);
mysql_close ($conexao);
?>
