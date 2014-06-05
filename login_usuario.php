<?PHP
include "inc_dbConexao.php";

SESSION_START();

// Captura dados enviados pelo método POST da página index.php
$codigo = $_POST['codigo'];
$senha = $_POST['senha'];
$utiliza_sistema = $_POST['utiliza_sistema'];
$nome = $_POST['nome'];


// Verifica se o e-mail do cliente já está cadastrado
// Utiliza_sistema = 1 indica que sim e 0 indica que não.
$sql = "SELECT codigo, senha, utiliza_sistema, nome , id_entidade";
$sql = $sql . " FROM entidade ";
$sql = $sql . " WHERE codigo = '" . $codigo . "' ";
$sql = $sql . " AND senha = '" . $senha . "' AND utiliza_sistema='1' ";

$rs = mysql_query($sql, $conexao);
$reg = mysql_fetch_array($rs);
// Recupera o número de acesso do usuário
$id_entidade = $reg['id_entidade'];
$acesso = $reg['acesso'];
$nome = $reg['nome'];
$total_registros = mysql_num_rows($rs);
if ($total_registros == 0) {
	$_SESSION['mensagem_erro'] = "Login ou senha inválidos";
	print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";
} else {
	$_SESSION['mensagem_erro'] = "";
	// Autoriza liberação para as páginas de administração do site
	$_SESSION['acesso'] = "liberado";	
	
	//Passa o id da entidade para próxima tela ao qual é a página desejada.
	print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=lista_processos_por_tipo.php?id=$id_entidade'>";
	
	//Armazena dentro da sessão
	$_SESSION['sessionIdEntidade'] = $id_entidade;
	$_SESSION['sessionCodigo'] = $codigo;
	$_SESSION['sessionNome'] = $nome;
}
// Libera os recursos usados pela conexão atual
mysql_free_result($rs);
mysql_close ($conexao);


?>