<?PHP
include "inc_dbConexao.php";

SESSION_START();

//#######  Verifica se a sessão esta liberada  #######
if ($_SESSION['acesso'] <> "liberado") {
  print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=liberacao.php'>";	
}



$acao = $_GET['acao'];
$id_processo_sistema = $_GET['id_processo_sistema'];

$id_processo = $_GET['id_processo'];


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
$sql = "SELECT * FROM processo_sistema";
$sql = $sql . " WHERE id_processo_sistema = '" . $id_processo_sistema . "' ";
$rs = mysql_query($sql, $conexao);
$reg = mysql_fetch_array($rs);
$id_processo_sistema = $reg['id_processo_sistema'];

//$id_processo = $reg['id_processo'];


$id_sistema = $reg['id_sistema'];
$observacao = $reg['observacao'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gest&atilde;o de Processos</title>
<link href="estilo_adm.css" rel="stylesheet" type="text/css" />



<?PHP //INICIO DA IMPLEMENTAÇÃO DO CALENDARIO  ?>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.click-calendario-1.0-min.js"></script>
<script type="text/javascript" src="exemplo-calendario.js"></script>
<link href="jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>


<script type="text/javascript">	
$('#dataAgenda').focus(function(){
		$(this).calendario({
		target:'#dataAgenda'		});	});
</script>
<?PHP //FIM DA IMPLEMENTAÇÃO DO CALENDARIO  ?>




</head>
<body>
<form name="form_cad" method="post" action="cad_processo_sistema1.php">	
<div id="corpo">
<div id="topo">
  <h1>Administração do Site</h1>
  <p align="center">Cadastro do Sistema do Processo</p>
</div>

<div id="caixa_menu">
<?PHP include "inc_menu.php" ?>
</div>

<div id="caixa_conteudo">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="62%"><h1 class="c_cinza">Manutenção Cadastral <img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> Sistema do Processo <img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> <span class="c_preto"><?PHP print $titulo_pagina; ?></span> </h1>
</td>
<td width="38%"><div align="right">
<?PHP if($acao == "ins") { ?>

	<a href="cad_processo.php?acao=ver&id_processo=<?PHP print $id_processo; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_fechar_ss.gif" alt="Fechar" border="0" /></a>
	<input type="image" name="imageField" src="./imagens/btn_salvar.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />

	<?PHP // ############# PASSA O id_processo POR GET ############### ?>
	<input type="hidden" name="id_processo" value="<?PHP print $id_processo; ?>" />
	<input type="hidden" name="id_processo_sistema" value="<?PHP print $id_processo_sistema; ?>" />	
	
<?PHP } ?>


<?PHP if($acao == "alt") { ?>
<?PHP $id_processo = $reg['id_processo']; ?>
	<a href="cad_processo.php?acao=ver&id_processo=<?PHP print $id_processo; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_fechar_ss.gif" alt="Fechar" border="0" /></a>
	<input type="image" name="imageField" src="./imagens/btn_salvar.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />

	<?PHP // ############# PASSA O id_processo POR GET ############### ?>
	<input type="hidden" name="id_processo" value="<?PHP print $id_processo; ?>" />
	<input type="hidden" name="id_processo_sistema" value="<?PHP print $id_processo_sistema; ?>" />	
	
<?PHP } ?>



	
<?PHP if($acao == "exc") { ?>
	<?PHP $id_processo = $reg['id_processo']; ?>
	<input type="image" name="imageField" src="./imagens/btn_excluir.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />
	<input type="hidden" name="id_processo_sistema" value="<?PHP print $id_processo_sistema; ?>" />	
    <input type="hidden" name="id_processo" value="<?PHP print $id_processo; ?>" />	
	<a href="cad_processo.php?acao=ver&id_processo=<?PHP print $id_processo; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_nao_excluir.gif" alt="Fechar" border="0" /></a>	
<?PHP } ?>
<?PHP if($acao == "ver") { ?>
	<?PHP $id_processo = $reg['id_processo']; ?>
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />
	<input type="hidden" name="id_processo" value="<?PHP print $id_processo; ?>" />
    

		<a href="cad_processo.php?acao=ver&id_processo=<?PHP print $id_processo; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_fechar.gif" alt="Fechar" border="0" /></a>
<?PHP } ?>
</div></td>
</tr>
</table>

<div id="caixa_cad">

  <label>Sistema:</label>
  <select name="id_sistema">
    <?PHP
		// Carrega o sistema;
		$ProcessoSistema = "<option value='0'>--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Selecione um Sistema &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--</option><br /> ";
		$sql_ProcessoSistema = "SELECT id_sistema, codigo_sistema  FROM sistema ";
		$rs_ProcessoSistema = mysql_query($sql_ProcessoSistema, $conexao);
		while ($reg_ProcessoSistema = mysql_fetch_array($rs_ProcessoSistema)) {
			if ($id_sistema == $reg_ProcessoSistema['id_sistema']) {
				$ProcessoSistema = $ProcessoSistema . "<option value='" . $reg_ProcessoSistema['id_sistema'] . "' selected='selected'>" . $reg_ProcessoSistema['codigo_sistema'] . "</option><br /> ";
			} else {
				$ProcessoSistema = $ProcessoSistema . "<option value='" . $reg_ProcessoSistema['id_sistema'] . "'>" . $reg_ProcessoSistema['codigo_sistema'] . "</option><br /> ";
			}
		}
		print $ProcessoSistema;
		// Fim do Carregamento das Entidades tipo Respons&aacute;vel?>
  </select>
  </p>

<p>
<label>Observa&ccedil;&atilde;o:</label>
<textarea name="observacao"  cols="43" rows="3" maxlength="500" <?PHP print $editar; ?>/><?PHP print $observacao; ?></textarea>
</p>

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
