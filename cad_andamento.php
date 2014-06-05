<?PHP
include "inc_dbConexao.php";

SESSION_START();

//#######  Verifica se a sessão esta liberada  #######
if ($_SESSION['acesso'] <> "liberado") {
  print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=liberacao.php'>";	
}



$acao = $_GET['acao'];
$id_andamento = $_GET['id_andamento'];

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
$sql = "SELECT * FROM andamento ";
$sql = $sql . " WHERE id_andamento = '" . $id_andamento . "' ";
$rs = mysql_query($sql, $conexao);
$reg = mysql_fetch_array($rs);
$id_andamento = $reg['id_andamento'];

//$id_processo = $reg['id_processo'];


$data_andamento = $reg['data_andamento'];
$andamento = $reg['andamento'];
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
<?php //FIM DA IMPLEMENTAÇÃO DO CALENDARIO  ?>



<?php
//Guarda a data do dia dentro da variável Dia.
$Dia = date("d/m/Y");
?>

<script language="javascript">
function valida_form() {

//Valida se existe data de cadastro do Andamento
if (document.form_cad.data_andamento.value == ""){
	(document.form_cad.data_andamento.value = "<?php  print $Dia  ?>");
}

if (document.form_cad.andamento.value == "")
{alert("Por favor, informe o andamento do processo.");
form_cad.andamento.focus();
return false;
}

return true;
}
</script>


</head>
<body>
<form name="form_cad" method="post" action="cad_andamento1.php" onsubmit="return valida_form(this);">	
<div id="corpo">
<div id="topo">
  <h1>Administração do Site</h1>
  <p align="center">Cadastro de Andamento de Processo</p>
  </div>

<div id="caixa_menu">
<?PHP include "inc_menu.php" ?>
</div>

<div id="caixa_conteudo">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="62%"><h1 class="c_cinza">Manutenção Cadastral <img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> Andamento da Ação <img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> <span class="c_preto"><?PHP print $titulo_pagina; ?></span> </h1>
</td>
<td width="38%"><div align="right">
<?PHP if($acao == "ins") { ?>

	<a href="cad_processo.php?acao=ver&id_processo=<?PHP print $id_processo; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_fechar_ss.gif" alt="Fechar" border="0" /></a>
	<input type="image" name="imageField" src="./imagens/btn_salvar.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />

	<?PHP // ############# PASSA O id_processo POR GET ############### ?>
	<input type="hidden" name="id_processo" value="<?PHP print $id_processo; ?>" />
	<input type="hidden" name="id_andamento" value="<?PHP print $id_andamento; ?>" />	
	
<?PHP } ?>


<?PHP if($acao == "alt") { ?>
<?PHP $id_processo = $reg['id_processo']; ?>
	<a href="cad_processo.php?acao=ver&id_processo=<?PHP print $id_processo; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_fechar_ss.gif" alt="Fechar" border="0" /></a>
	<input type="image" name="imageField" src="./imagens/btn_salvar.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />

	<?PHP // ############# PASSA O id_processo POR GET ############### ?>
	<input type="hidden" name="id_processo" value="<?PHP print $id_processo; ?>" />
	<input type="hidden" name="id_andamento" value="<?PHP print $id_andamento; ?>" />	
	
<?PHP } ?>



	
<?PHP if($acao == "exc") { ?>
	<?PHP $id_processo = $reg['id_processo']; ?>
	<input type="image" name="imageField" src="./imagens/btn_excluir.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />
	<input type="hidden" name="id_andamento" value="<?PHP print $id_andamento; ?>" />	
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

<p>
  <label>Data:</label><input name="data_andamento" id="dataAgenda" type="text" class="<?PHP print $estilo_caixa; ?>" size="15" maxlength="10" value="<?PHP print $data_andamento; ?>" <?PHP print $editar; ?> /></p>
<p><label>Andamento:</label><input name="andamento" type="text" class="<?PHP print $estilo_caixa; ?>" size="70" maxlength="500" value="<?PHP print $andamento; ?>" <?PHP print $editar; ?> /></p>

<p>
<label>Observa&ccedil;&atilde;o:</label>
<textarea name="observacao"  cols="43" rows="3" maxlength="50000" <?PHP print $editar; ?>/><?PHP print $observacao; ?></textarea>
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
