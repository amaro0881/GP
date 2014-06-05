<?PHP
include "inc_dbConexao.php";

SESSION_START();

//#######  Verifica se a sess�o esta liberada  #######
if ($_SESSION['acesso'] <> "liberado") {
  print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=liberacao.php'>";	
}



if ($_GET['id_sistema'] == "") {
	$idsel = $_POST['id_sistema'];
} else {
	$idsel = $_GET['id_sistema'];
}
$sql = "SELECT * FROM sistema";
$sql = $sql . " ORDER BY id_sistema ";
$rs = mysql_query($sql, $conexao);
$total_registros = mysql_num_rows($rs);
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
  <h1>Administra��o do Site</h1>
  <p align="center">Listagem dos Sistemas</p>
</div>

<div id="caixa_menu">
	<?PHP include "inc_menu.php" ?>
</div>

<div id="caixa_conteudo">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="80%"><h1 class="c_cinza">Manuten��o Cadastral <img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> <span class="c_preto">Tipos de Processos</span></h1></td>

<!-- Incluir registroas -->
<!-- Executa o cadastro dos Sistemas com a��o de inser��o (ins) -->
<td width="20%"><h1 align="right"><a href="cad_sistema.php?acao=ins&amp;titulo=Inclus�o de registro"><img src="./imagens/btn_inserir.gif" alt="Inserir novo registro" border="0" /></a></h1></td>
</tr>
</table>

<P>Total de registros no cadastro: <span class="c_preto"><?PHP print $total_registros; ?></span></P>
<table width="100%" cellspacing="0">
<tr id="titulo_tabela">
<td width="24%" class="tabela_titulo">C&oacute;digo</td>
<td width="60%" class="tabela_titulo">Descri&ccedil;&atilde;o</td>
<td colspan="3" class="tabela_titulo"><div align="center">A��es</div></td>	
</tr>

<?PHP
// Exibe os registros na tabela
while ($reg = mysql_fetch_array($rs)) {
$id_sistema = $reg["id_sistema"];
$codigo_sistema = $reg["codigo_sistema"];
$descricao = $reg["descricao"];
$observacao = $reg["observacao"];
//Destaca a linha do �ltimo registro selecionado (fundo azul claro)
if ($idsel == $id_sistema) {
$fundo = "registro_sel";
} else {
$fundo = "registro";	
}
?>
<tr>
<!-- Exibe os campos do registro -->
<td class="<?PHP print $fundo; ?>"><?PHP print $codigo_sistema; ?></td>
<td class="<?PHP print $fundo; ?>"><?PHP print $descricao; ?></td>
<!-- Excluir registros -->
<!-- Executa o cadastro dos Sistemas com a��o de exclus�o (exc) -->
<td width="5%" class="<?PHP print $fundo; ?>"><a href="cad_sistema.php?acao=exc&id_sistema=<?PHP print $id_sistema; ?>&titulo=Exclus�o de registro"><img src="./imagens/btn_cancelar_reg.gif" alt="Cancelar esse registro" border="0" /></a></td>	

<!-- Alterar registros -->
<!-- Executa o cadastro dos Sistemas com a��o de altera��o (alt) -->
<td width="5%" class="<?PHP print $fundo; ?>"><a href="cad_sistema.php?acao=alt&id_sistema=<?PHP print $id_sistema; ?>&titulo=Altera��o de registro"><img src="./imagens/btn_alterar_reg.gif" alt="Alterar esse registro" border="0" /></a></td>	

<!-- Visualizar registros -->
<!-- Executa o cadastro dos Sistemas com a��o de visualiza��o (ver) -->
<td width="6%" class="<?PHP print $fundo; ?>"><a href="cad_sistema.php?acao=ver&id_sistema=<?PHP print $id_sistema; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_ver_detalhes.gif" alt="Ver detalhes desse registro" border="0" /></a></td>			
</tr>
<?PHP } ?>
</table>
</div>
<!-- rodape da p�gina -->
<?PHP include "inc_rodape.php" ?>
</div>
</body>
</html>
<?PHP
// Libera os recursos usados pela conex�o atual
mysql_free_result($rs);
mysql_close ($conexao);
?>