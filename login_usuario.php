<?PHP
include "inc_dbConexao.php";

SESSION_START();

// Captura dados enviados pelo m�todo POST da p�gina index.php
$codigo = $_POST['codigo'];
$senha = $_POST['senha'];
$utiliza_sistema = $_POST['utiliza_sistema'];
$nome = $_POST['nome'];


// Verifica se o e-mail do cliente j� est� cadastrado
// Utiliza_sistema = 1 indica que sim e 0 indica que n�o.
$sql = "SELECT codigo, senha, utiliza_sistema, nome , id_entidade";
$sql = $sql . " FROM entidade ";
$sql = $sql . " WHERE codigo = '" . $codigo . "' ";
$sql = $sql . " AND senha = '" . $senha . "' AND utiliza_sistema='1' ";

$rs = mysql_query($sql, $conexao);
$reg = mysql_fetch_array($rs);
// Recupera o n�mero de acesso do usu�rio
$id_entidade = $reg['id_entidade'];
$acesso = $reg['acesso'];
$nome = $reg['nome'];
$total_registros = mysql_num_rows($rs);
if ($total_registros == 0) {
	$_SESSION['mensagem_erro'] = "Login ou senha inv�lidos";
	print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";
} else {
	$_SESSION['mensagem_erro'] = "";
	// Autoriza libera��o para as p�ginas de administra��o do site
	$_SESSION['acesso'] = "liberado";	
	
	//Passa o id da entidade para pr�xima tela ao qual � a p�gina desejada.
	print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=lista_processos_por_tipo.php?id=$id_entidade'>";
	
	//Armazena dentro da sess�o
	$_SESSION['sessionIdEntidade'] = $id_entidade;
	$_SESSION['sessionCodigo'] = $codigo;
	$_SESSION['sessionNome'] = $nome;
}
// Libera os recursos usados pela conex�o atual
mysql_free_result($rs);
mysql_close ($conexao);


?>