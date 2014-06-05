<?PHP

include "inc_dbConexao.php";
SESSION_START();
// Ação a ser executada nesta página (ins=inserir, alt=alterar, del=excluir, ver=visualizar
$acao = $_POST['acao'];
// Campos da tabela
$id_entidade = $_POST['id_entidade'];
$codigo = $_POST['codigo'];

$autor = $_POST['autor'];
$responsavel = $_POST['responsavel'];
$coresponsavel = $_POST['coresponsavel'];
$requerente = $_POST['requerente'];

$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];
$cpf_cnpj = $_POST['cpf_cnpj'];
$observacao = $_POST['observacao'];
$data_cadastro = $_POST['data_cadastro'];
$data_alteracao = date('Y-m-d H:s:i');
$utiliza_sistema = $_POST['utiliza_sistema'];
$senha = $_POST['senha'];

// Ação de inclusão
if ($acao == "ins") {
	$titulo_pagina = "Inserir novo registro";
	$mensagem = "<h1 class='c_laranja'>A inclusão do registro foi efetuada com sucesso.</h1>";
	$mensagem = $mensagem . $codigo . " - " . $nome;
	// Insere registro
	$sql = "INSERT INTO entidade ";
	$sql = $sql . "(codigo, autor ,responsavel ,coresponsavel ,requerente ,nome ,endereco ,numero ,complemento ,bairro ,cidade ,uf ,cpf_cnpj ,observacao ,data_cadastro ,data_alteracao, utiliza_sistema, senha) ";
	$sql = $sql . "VALUES('$codigo', '$autor', '$responsavel', '$coresponsavel', '$requerente', '$nome', '$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$uf', '$cpf_cnpj', '$observacao', '$data_cadastro', '$data_alteracao', '$utiliza_sistema','$senha') ";
	mysql_query($sql, $conexao) or die(mysql_error());
}
// Ação de alteração
if ($acao == "alt") {
$titulo_pagina = "Alteração cadastral";
$mensagem = "<h1 class='c_laranja'>A alteração do registro foi efetuada com sucesso.</h1>";
$mensagem = $mensagem . $codigo . " - " . $nome;
// Altera registro
$sql = "UPDATE entidade SET ";
$sql = $sql . "codigo = '$codigo', ";
$sql = $sql . "autor = '$autor', ";
$sql = $sql . "responsavel = '$responsavel', ";
$sql = $sql . "coresponsavel = '$coresponsavel', ";
$sql = $sql . "requerente = '$requerente', ";
$sql = $sql . "nome = '$nome', ";
$sql = $sql . "endereco = '$endereco', ";
$sql = $sql . "numero = '$numero', ";
$sql = $sql . "complemento = '$complemento', ";
$sql = $sql . "bairro = '$bairro', ";	
$sql = $sql . "cidade = '$cidade', ";
$sql = $sql . "uf = '$uf', ";
$sql = $sql . "cpf_cnpj = '$cpf_cnpj', ";
$sql = $sql . "observacao = '$observacao', ";
$sql = $sql . "data_cadastro = '$data_cadastro', ";
$sql = $sql . "utiliza_sistema = '$utiliza_sistema', ";
$sql = $sql . "senha = '$senha' ";
$sql = $sql . " WHERE id_entidade = '" . $id_entidade . "' ";
mysql_query($sql, $conexao) or die(mysql_error());
}

// Ação de exclusão
if ($acao == "exc") {
// Exclui registro
$sql = "DELETE FROM entidade ";
$sql = $sql . " WHERE id_entidade = '" . $id_entidade . "' ";	
mysql_query($sql, $conexao) or die(mysql_error());
}
// Executa página cad_entidade_grid.php
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cad_entidade_grid.php?id_entidade=" . $id_entidade . "'>";
// Libera os recursos usados pela conexão atual
//mysql_free_result($rs);
mysql_close ($conexao);
?>
