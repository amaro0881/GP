<?PHP

include "inc_dbConexao.php";
SESSION_START();
// A��o a ser executada nesta p�gina (ins=inserir, alt=alterar, del=excluir, ver=visualizar
$acao = $_POST['acao'];
// Campos da tabela
$id_processo = $_POST['id_processo'];
$data_criacao = $_POST['data_criacao'];
$status = $_POST['status'];
$tipo_processo = $_POST['tipo_processo'];
$autor = $_POST['autor'];
$responsavel = $_POST['responsavel'];
$coresponsavel = $_POST['coresponsavel'];
$assunto = $_POST['assunto'];
$descricao = $_POST['descricao'];

// A��o de inclus�o
if ($acao == "ins") {
	$titulo_pagina = "Inserir novo registro";
	$mensagem = "<h1 class='c_laranja'>A inclus�o do registro foi efetuada com sucesso.</h1>";
	$mensagem = $mensagem . $data_criacao . " - " . $tipo_processo;
	// Insere registro
	$sql = "INSERT INTO processo ";
	$sql = $sql . "(data_criacao, status ,tipo_processo , autor,responsavel ,coresponsavel ,assunto ,descricao) ";
	$sql = $sql . "VALUES('$data_criacao', '$status', '$tipo_processo', '$autor', '$responsavel', '$coresponsavel', '$assunto', '$descricao') ";
	mysql_query($sql, $conexao) or die(mysql_error());
	//Pega id do registro incluido
	$Registro_Inserido = mysql_insert_id($conexao);
	echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>alert ('Processo: " . $Registro_Inserido . " ')</SCRIPT>";
}
// A��o de altera��o
if ($acao == "alt") {
$titulo_pagina = "Altera��o cadastral";
$mensagem = "<h1 class='c_laranja'>A altera��o do registro foi efetuada com sucesso.</h1>";
$mensagem = $mensagem . $data_criacao . " - " . $tipo_processo;
// Altera registro
$sql = "UPDATE processo SET ";
$sql = $sql . "data_criacao = '$data_criacao', ";
$sql = $sql . "status = '$status', ";
$sql = $sql . "tipo_processo = '$tipo_processo', ";
$sql = $sql . "autor = '$autor', ";
$sql = $sql . "responsavel = '$responsavel', ";
$sql = $sql . "coresponsavel = '$coresponsavel', ";
$sql = $sql . "assunto = '$assunto', ";
$sql = $sql . "descricao = '$descricao' ";
$sql = $sql . " WHERE id_processo = '" . $id_processo . "' ";	
mysql_query($sql, $conexao) or die(mysql_error());
}

// A��o de exclus�o
if ($acao == "exc") {
// Exclui registro
$sql = "DELETE FROM processo ";
$sql = $sql . " WHERE id_processo = '" . $id_processo . "' ";	
mysql_query($sql, $conexao) or die(mysql_error());
}
// Executa p�gina cad_processo_grid.php
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cad_processo_grid.php?id_processo=" . $id_processo . "'>";
// Libera os recursos usados pela conex�o atual
//mysql_free_result($rs);
mysql_close ($conexao);
?>
