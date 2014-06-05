<?PHP
include "inc_dbConexao.php";

SESSION_START();

//#######  Verifica se a sessão esta liberada  #######
if ($_SESSION['acesso'] <> "liberado") {
  print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=liberacao.php'>";	
}



$acao = $_GET['acao'];
$id_entidade_contato = $_GET['id_entidade_contato'];

$id_entidade = $_GET['id_entidade'];


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
$sql = "SELECT * FROM entidade_contato ";
$sql = $sql . " WHERE id_entidade_contato = '" . $id_entidade_contato . "' ";
$rs = mysql_query($sql, $conexao);
$reg = mysql_fetch_array($rs);
$id_entidade_contato = $reg['id_entidade_contato'];

//$id_entidade = $reg['id_entidade'];


$nome = $reg['nome'];
$telefone = $reg['telefone'];
$email = $reg['email'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gest&atilde;o de Processos</title>
<link href="estilo_adm.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form name="form_cad" method="post" action="cad_entidade_contato1.php">	
<div id="corpo">
<div id="topo">
  <h1>Administração do Site</h1>
  <p align="center">Cadastro de Contato da Entidade</p>

</div>

<div id="caixa_menu">
<?PHP include "inc_menu.php" ?>
</div>

<div id="caixa_conteudo">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="62%"><h1 class="c_cinza">Manutenção Cadastral <img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> Contato da Entidade <img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> <span class="c_preto"><?PHP print $titulo_pagina; ?></span> </h1>
</td>
<td width="38%"><div align="right">
<?PHP if($acao == "ins") { ?>

	<a href="cad_entidade.php?acao=ver&id_entidade=<?PHP print $id_entidade; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_fechar_ss.gif" alt="Fechar" border="0" /></a>
	<input type="image" name="imageField" src="./imagens/btn_salvar.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />

	<?PHP // ############# PASSA O ID_ENTIDADE POR GET ############### ?>
	<input type="hidden" name="id_entidade" value="<?PHP print $id_entidade; ?>" />
	<input type="hidden" name="id_entidade_contato" value="<?PHP print $id_entidade_contato; ?>" />	
	
<?PHP } ?>


<?PHP if($acao == "alt") { ?>
<?PHP $id_entidade = $reg['id_entidade']; ?>
	<a href="cad_entidade.php?acao=ver&id_entidade=<?PHP print $id_entidade; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_fechar_ss.gif" alt="Fechar" border="0" /></a>
	<input type="image" name="imageField" src="./imagens/btn_salvar.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />

	<?PHP // ############# PASSA O ID_ENTIDADE POR GET ############### ?>
	<input type="hidden" name="id_entidade" value="<?PHP print $id_entidade; ?>" />
	<input type="hidden" name="id_entidade_contato" value="<?PHP print $id_entidade_contato; ?>" />	
	
<?PHP } ?>



	
<?PHP if($acao == "exc") { ?>
	<?PHP $id_entidade = $reg['id_entidade']; ?>
	<input type="image" name="imageField" src="./imagens/btn_excluir.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />
	<input type="hidden" name="id_entidade_contato" value="<?PHP print $id_entidade_contato; ?>" />	
    <input type="hidden" name="id_entidade" value="<?PHP print $id_entidade; ?>" />	
	<a href="cad_entidade.php?acao=ver&id_entidade=<?PHP print $id_entidade; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_nao_excluir.gif" alt="Fechar" border="0" /></a>	
<?PHP } ?>
<?PHP if($acao == "ver") { ?>
	<?PHP $id_entidade = $reg['id_entidade']; ?>
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />
	<input type="hidden" name="id_entidade" value="<?PHP print $id_entidade; ?>" />
    

		<a href="cad_entidade.php?acao=ver&id_entidade=<?PHP print $id_entidade; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_fechar.gif" alt="Fechar" border="0" /></a>
<?PHP } ?>
</div></td>
</tr>
</table>

<div id="caixa_cad">

<p><label>Nome:</label><input name="nome" type="text" class="<?PHP print $estilo_caixa; ?>" size="70" maxlength="200" value="<?PHP print $nome; ?>" <?PHP print $editar; ?> /></p>
<p><label>Telefone:</label><input name="telefone" type="text" class="<?PHP print $estilo_caixa; ?>" size="20" maxlength="20" value="<?PHP print $telefone; ?>" <?PHP print $editar; ?> /></p>
<p><label>E-mail:</label><input name="email" type="text" class="<?PHP print $estilo_caixa; ?>"  size="70" maxlength="50" value="<?PHP print $email; ?>" <?PHP print $editar; ?> /></p>
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
