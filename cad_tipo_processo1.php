<?PHP

include "inc_dbConexao.php";
SESSION_START();
// Ação a ser executada nesta página (ins=inserir, alt=alterar, del=excluir, ver=visualizar
$acao = $_POST['acao'];
// Campos da tabela
$id_tipo_processo = $_POST['id_tipo_processo'];
$codigo_tipo_processo = $_POST['codigo_tipo_processo'];
$descricao = $_POST['descricao'];
// Ação de inclusão
if ($acao == "ins") {
	$titulo_pagina = "Inserir novo registro";
	$mensagem = "<h1 class='c_laranja'>A inclusão do registro foi efetuada com sucesso.</h1>";
	$mensagem = $mensagem . $codigo_tipo_processo . " - " . $descricao;
	// Insere registro
	$sql = "INSERT INTO tipo_processo ";
	$sql = $sql . "(codigo_tipo_processo,descricao) ";
	$sql = $sql . "VALUES('$codigo_tipo_processo','$descricao') ";
	mysql_query($sql, $conexao);
}
// Ação de alteração
if ($acao == "alt") {
$titulo_pagina = "Alteração cadastral";
$mensagem = "<h1 class='c_laranja'>A alteração do registro foi efetuada com sucesso.</h1>";
$mensagem = $mensagem . $codigo_tipo_processo . " - " . $descricao;
// Altera registro
$sql = "UPDATE tipo_processo SET ";
$sql = $sql . "codigo_tipo_processo = '$codigo_tipo_processo', ";
$sql = $sql . "descricao = '$descricao' ";
$sql = $sql . " WHERE id_tipo_processo = '" . $id_tipo_processo . "' ";	
mysql_query($sql, $conexao);
}

// Ação de exclusão
if ($acao == "exc") {
// Exclui registro
$sql = "DELETE FROM tipo_processo ";
$sql = $sql . " WHERE id_tipo_processo = '" . $id_tipo_processo . "' ";	
mysql_query($sql, $conexao);
}
// Executa página cad_tipo_processo_grid.php
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cad_tipo_processo_grid.php?id_tipo_processo=" . $id_tipo_processo . "'>";
// Libera os recursos usados pela conexão atual
mysql_free_result($rs);
mysql_close ($conexao);
?>
