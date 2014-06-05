<?PHP
include "inc_dbConexao.php";

SESSION_START();

//#######  Verifica se a sessão esta liberada  #######
if ($_SESSION['acesso'] <> "liberado") {
  print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=liberacao.php'>";	
}

//#####################################################
//############# CRIAR PRAZO E TOLERANCIA ##############
//#####################################################

$acao = $_GET['acao'];
$id_tipo_processo = $_GET['id_tipo_processo'];
$titulo_pagina = $_GET['titulo'];
if ($acao == "ver") {
	// modo de edição das caixas de texto do formulário
	$editar = "readonly='true'";
	$editar_combo = "disabled='disabled'";
	$estilo_caixa = "caixa_texto_des";
} else {
	$editar = "";
	$editar_combo = "";	
	$estilo_caixa = "caixa_texto";
}
// Recupera registro 
$sql = "SELECT * FROM tipo_processo ";
$sql = $sql . " WHERE id_tipo_processo = '" . $id_tipo_processo . "' ";
$rs = mysql_query($sql, $conexao);
$reg = mysql_fetch_array($rs);
$id_tipo_processo = $reg['id_tipo_processo'];
$codigo_tipo_processo = $reg['codigo_tipo_processo'];
$descricao = $reg['descricao'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gest&atilde;o de Processos</title>
<link href="estilo_adm.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form name="form_cad" method="post" action="cad_tipo_processo1.php">	
<div id="corpo">
<div id="topo">
  <h1>Administração do Site</h1>
  <p align="center">Cadastro do Tipo de Processo</p>
</div>

<div id="caixa_menu">
<?PHP include "inc_menu.php" ?>
</div>

<div id="caixa_conteudo">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="62%"><h1 class="c_cinza">Manutenção Cadastral <img src="./imagens/marcador_setaDir.gif" align="absmiddle" />Tipos de A&ccedil;&otilde;es<img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> <span class="c_preto"><?PHP print $titulo_pagina; ?></span> </h1>
</td>
<td width="38%"><div align="right">
<?PHP if($acao == "ins" or $acao == "alt") { ?>
	<a href="cad_tipo_processo_grid.php?id_tipo_processo=<?PHP print $id_tipo_processo; ?>"><img src="./imagens/btn_fechar_ss.gif" alt="Fechar" border="0" /></a>
	<input type="image" name="imageField" src="./imagens/btn_salvar.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />
	<input type="hidden" name="id_tipo_processo" value="<?PHP print $id_tipo_processo; ?>" />	
<?PHP } ?>	
<?PHP if($acao == "exc") { ?>
	<input type="image" name="imageField" src="./imagens/btn_excluir.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />
	<input type="hidden" name="id_tipo_processo" value="<?PHP print $id_tipo_processo; ?>" />	
	<a href="cad_tipo_processo_grid.php?id_tipo_processo=<?PHP print $id_tipo_processo; ?>"><img src="./imagens/btn_nao_excluir.gif" alt="Fechar" border="0" /></a>	
<?PHP } ?>
<?PHP if($acao == "ver") { ?>
		<a href="cad_tipo_processo_grid.php?id_tipo_processo=<?PHP print $id_tipo_processo; ?>"><img src="./imagens/btn_fechar.gif" alt="Fechar" border="0" /></a>
<?PHP } ?>
</div></td>
</tr>
</table>

<div id="caixa_cad">
<p>
  <label>C&oacute;digo:</label><input name="codigo_tipo_processo" type="text" class="<?PHP print $estilo_caixa; ?>" size="30" maxlength="30" value="<?PHP print $codigo_tipo_processo; ?>" <?PHP print $editar; ?> /></p>
<p>
  <label>Descri&ccedil;&atilde;o:</label><input name="descricao" type="text" class="<?PHP print $estilo_caixa; ?>" size="70" maxlength="100" value="<?PHP print $descricao; ?>" <?PHP print $editar; ?> /></p>
</div>

</div>
<!-- rodape da página -->
<?PHP include "inc_rodape.php" ?>
</div>
</form>
</body>
</html>
<?PHP
// Libera os recursos usados pela conexão atual
mysql_free_result($rs);
mysql_close ($conexao);
?>
