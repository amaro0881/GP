<?PHP

include "inc_dbConexao.php";
SESSION_START();
// A��o a ser executada nesta p�gina (ins=inserir, alt=alterar, del=excluir, ver=visualizar
$acao = $_POST['acao'];
// Campos da tabela
$id_andamento = $_POST['id_andamento'];
$id_processo = $_POST['id_processo'];
$data_andamento = $_POST['data_andamento'];
$andamento = $_POST['andamento'];
$observacao = $_POST['observacao'];

// A��o de inclus�o
if ($acao == "ins") {
	$titulo_pagina = "Inserir novo registro";
	$mensagem = "<h1 class='c_laranja'>A inclus�o do registro foi efetuada com sucesso.</h1>";
	$mensagem = $mensagem . $data_andamento . " - " . $observacao;
	// Insere registro
	$sql = "INSERT INTO andamento ";
	$sql = $sql . "(id_processo,data_andamento,andamento,observacao) ";
	$sql = $sql . "VALUES('$id_processo','$data_andamento','$andamento','$observacao') ";
	mysql_query($sql, $conexao);
}
// A��o de altera��o
if ($acao == "alt") {
$titulo_pagina = "Altera��o cadastral";
$mensagem = "<h1 class='c_laranja'>A altera��o do registro foi efetuada com sucesso.</h1>";
$mensagem = $mensagem . $data_andamento . " - " . $observacao;
// Altera registro
$sql = "UPDATE andamento SET ";
$sql = $sql . "data_andamento = '$data_andamento', ";
$sql = $sql . "andamento = '$andamento', ";
$sql = $sql . "observacao = '$observacao' ";
$sql = $sql . " WHERE id_andamento = '" . $id_andamento . "' ";	
mysql_query($sql, $conexao);
}

// A��o de exclus�o
if ($acao == "exc") {
// Exclui registro
$sql = "DELETE FROM andamento ";
$sql = $sql . " WHERE id_andamento = '" . $id_andamento . "' ";	
mysql_query($sql, $conexao);
}
// Executa p�gina cad_processo.php
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cad_processo.php?acao=ver&id_processo=" . $id_processo . "'>";
// Libera os recursos usados pela conex�o atual
//mysql_free_result($rs);
mysql_close ($conexao);
?>
