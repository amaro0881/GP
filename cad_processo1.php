<?PHP

include "inc_dbConexao.php";
SESSION_START();
// Ação a ser executada nesta página (ins=inserir, alt=alterar, del=excluir, ver=visualizar
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

// Ação de inclusão
if ($acao == "ins") {
	$titulo_pagina = "Inserir novo registro";
	$mensagem = "<h1 class='c_laranja'>A inclusão do registro foi efetuada com sucesso.</h1>";
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
// Ação de alteração
if ($acao == "alt") {
$titulo_pagina = "Alteração cadastral";
$mensagem = "<h1 class='c_laranja'>A alteração do registro foi efetuada com sucesso.</h1>";
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

// Ação de exclusão
if ($acao == "exc") {
// Exclui registro
$sql = "DELETE FROM processo ";
$sql = $sql . " WHERE id_processo = '" . $id_processo . "' ";	
mysql_query($sql, $conexao) or die(mysql_error());
}
// Executa página cad_processo_grid.php
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cad_processo_grid.php?id_processo=" . $id_processo . "'>";
// Libera os recursos usados pela conexão atual
//mysql_free_result($rs);
mysql_close ($conexao);
?>
