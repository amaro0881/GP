<?PHP
include "inc_dbConexao.php";

SESSION_START();

//#######  Verifica se a sessão esta liberada  #######
if ($_SESSION['acesso'] <> "liberado") {
  print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=liberacao.php'>";	
}



//Resgata as informações da entidade logada e passa para suas variaveis.
$IdEntidadeNaSessao = $_SESSION['sessionIdEntidade'];
$CodigoNaSessao = $_SESSION['sessionCodigo'];
$NomeNaSessao = $_SESSION['sessionNome'];



// Captura dados enviados pelo método POST da página index.php
//$codigo = $_POST['codigo'];
//$senha = $_POST['senha'];
//$utiliza_sistema = $_POST['utiliza_sistema'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gest&atilde;o de Processos</title>
<link href="estilo_adm.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="corpo">
<div id="topo">
  <h1>Administração do Site</h1>
</div>
<div id="caixa_menu">
<?PHP include "inc_menu.php" ?>
</div>
<div id="caixa_conteudo">
<table width="100%" height="400" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><img src="./imagens/Entrada.jpg" width="297" height="320" /></td>
  </tr>
</table>
</div>
<!-- rodape da página -->
<?PHP include "inc_rodape.php" ?>
</div>
</body>
</html>