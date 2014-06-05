<?PHP
include "inc_dbConexao.php";

SESSION_START();

//#######  Verifica se a sessão esta liberada  #######
if ($_SESSION['acesso'] <> "liberado") {
  print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=liberacao.php'>";	
}



$acao = $_GET['acao'];
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
$sql = "SELECT * FROM entidade ";
$sql = $sql . " WHERE id_entidade = '" . $id_entidade . "' ";
$rs = mysql_query($sql, $conexao);
$reg = mysql_fetch_array($rs);


$id_entidade = $reg['id_entidade'];
$codigo = $reg['codigo'];
$autor = $reg['autor'];
$responsavel = $reg['responsavel'];
$coresponsavel = $reg['coresponsavel'];
$requerente = $reg['requerente'];
$nome = $reg['nome'];
$endereco = $reg['endereco'];
$numero = $reg['numero'];
$complemento = $reg['complemento'];
$bairro = $reg['bairro'];
$cidade = $reg['cidade'];
$uf = $reg['uf'];
$cpf_cnpj = $reg['cpf_cnpj'];
$observacao = $reg['observacao'];
$data_cadastro = $reg['data_cadastro'];
$data_alteracao = $reg['data_alteracao'];
$utiliza_sistema = $reg['utiliza_sistema'];
$senha = $reg['senha'];


if ($autor == 1){
					$checked_autor="checked=\"checked\"";
				} else {
					$checked_autor = ""; 
}
if ($responsavel == 1){
					$checked_responsavel="checked=\"checked\"";
				} else {
					$checked_responsavel = ""; 
}
if ($coresponsavel == 1){
					$checked_coresponsavel="checked=\"checked\"";
				} else {
					$checked_coresponsavel = ""; 
}
if ($requerente == 1){
					$checked_requerente="checked=\"checked\"";
				} else {
					$checked_requerente = ""; 
}
if ($utiliza_sistema == 1){
					$checked_utiliza_sistema="checked=\"checked\"";
				} else {
					$checked_utiliza_sistema = ""; 
}




//print $checked;

//Início da busca pelo Contato dentro da entidade.
if ($_GET['id_entidade_contato'] == "") {
	$idsel = $_POST['id_entidade_contato'];
} else {
	$idsel = $_GET['id_entidade_contato'];
}
$sql = "SELECT * FROM entidade_contato";
$sql = $sql . " WHERE id_entidade = '" . $id_entidade . "' ";
$sql = $sql . " ORDER BY id_entidade_contato ";

$rs = mysql_query($sql, $conexao);
$total_registros = mysql_num_rows($rs);

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>



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
if (document.form_cad.codigo.value == "")
{alert("Por favor, informe o código.");
form_cad.codigo.focus();
return false;
}

//Valida se existe data de cadastro da Entidade
if (document.form_cad.data_cadastro.value == ""){
	(document.form_cad.data_cadastro.value = "<?php  print $Dia  ?>");
}

return true;
}
</script>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gest&atilde;o de Processos</title>
<link href="estilo_adm.css" rel="stylesheet" type="text/css" />
</head>
<body>

<script type="text/javascript" src="tooltip.js"></script>

<form name="form_cad" method="post" action="cad_entidade1.php" onsubmit="return valida_form(this);">	
<div id="corpo">
<div id="topo">
  <h1>Administração do Site</h1>
  <p align="center">Cadastro de Entidade</p>

  </div>

<div id="caixa_menu">
<?PHP include "inc_menu.php" ?>
</div>

<div id="caixa_conteudo">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="62%"><h1 class="c_cinza">Manutenção Cadastral <img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> Entidade <img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> <span class="c_preto"><?PHP print $titulo_pagina; ?></span> </h1>
</td>
<td width="38%"><div align="right">
<?PHP if($acao == "ins" or $acao == "alt") { ?>
	<a href="cad_entidade_grid.php?id_entidade=<?PHP print $id_entidade; ?>"><img src="./imagens/btn_fechar_ss.gif" alt="Fechar" border="0" /></a>
	<input type="image" name="imageField" src="./imagens/btn_salvar.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />
	<input type="hidden" name="id_entidade" value="<?PHP print $id_entidade; ?>" />	
<?PHP } ?>	
<?PHP if($acao == "exc") { ?>
	<input type="image" name="imageField" src="./imagens/btn_excluir.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />
	<input type="hidden" name="id_entidade" value="<?PHP print $id_entidade; ?>" />	
	<a href="cad_entidade_grid.php?id_entidade=<?PHP print $id_entidade; ?>"><img src="./imagens/btn_nao_excluir.gif" alt="Fechar" border="0" /></a>	
<?PHP } ?>
<?PHP if($acao == "ver") { ?>
		<a href="cad_entidade_grid.php?id_entidade=<?PHP print $id_entidade; ?>"><img src="./imagens/btn_fechar.gif" alt="Fechar" border="0" /></a>
<?PHP } ?>
</div></td>
</tr>
</table>

<div id="caixa_cad">
<p>
  <label>C&oacute;digo/Login:</label><input name="codigo" type="text" class="<?PHP print $estilo_caixa; ?>" size="20" maxlength="30" value="<?PHP print $codigo; ?>" <?PHP print $editar; ?> />
</p>
<p>
  <label>Autor:</label>

  <input name="autor" type="checkbox" class="<?PHP print $estilo_caixa; ?>" size="2" maxlength="1" value="1" <?php print $checked_autor;  ?> <?PHP print $editar; ?> />




</p>
<p>
  <label>Respons&aacute;vel:</label>
  <input name="responsavel" type="checkbox" class="<?PHP print $estilo_caixa; ?>" size="2" maxlength="1" value="1" <?php print $checked_responsavel;  ?> <?PHP print $editar; ?> />
</p>
<p>
  <label>Co-Respons&aacute;vel:</label>
  <input name="coresponsavel" type="checkbox" class="<?PHP print $estilo_caixa; ?>" size="2" maxlength="1" value="1" <?php print $checked_coresponsavel;  ?> <?PHP print $editar; ?> />
</p>
<p>
  <label>Requerente:</label>
  <input name="requerente" type="checkbox" class="<?PHP print $estilo_caixa; ?>" size="2" maxlength="1" value="1" <?php print $checked_requerente;  ?> <?PHP print $editar; ?> />
</p>
<p>
  <label>Nome:</label>
  <input name="nome" type="text" class="<?PHP print $estilo_caixa; ?>" size="70" maxlength="200" value="<?PHP print $nome; ?>" <?PHP print $editar; ?> /></p>
<p>
  <label>Endere&ccedil;o:</label>
  <input name="endereco" type="text" class="<?PHP print $estilo_caixa; ?>" size="70" maxlength="200" value="<?PHP print $endereco; ?>" <?PHP print $editar; ?> />
</p>
<p>
  <label>N&uacute;mero:</label>
  <input name="numero" type="text" class="<?PHP print $estilo_caixa; ?>" size="20" maxlength="15" value="<?PHP print $numero; ?>" <?PHP print $editar; ?> />
</p>
<p>
  <label>Complemento:</label>
  <input name="complemento" type="text" class="<?PHP print $estilo_caixa; ?>" size="40" maxlength="50" value="<?PHP print $complemento; ?>" <?PHP print $editar; ?> />
</p>
<p>
  <label>Bairro:</label>
  <input name="bairro" type="text" class="<?PHP print $estilo_caixa; ?>" size="40" maxlength="100" value="<?PHP print $bairro; ?>" <?PHP print $editar; ?> />
</p>
<p>
  <label>Cidade:</label>
  <input name="cidade" type="text" class="<?PHP print $estilo_caixa; ?>" size="40" maxlength="100" value="<?PHP print $cidade; ?>" <?PHP print $editar; ?> />
</p>
<p>
  <label>UF:</label>
  <input name="uf" type="text" class="<?PHP print $estilo_caixa; ?>" size="7" maxlength="2" value="<?PHP print $uf; ?>" <?PHP print $editar; ?> />
</p>
<p>
  <label>CPF / CNPJ:</label><input name="cpf_cnpj" type="text" class="<?PHP print $estilo_caixa; ?>" size="30" maxlength="20" value="<?PHP print $cpf_cnpj; ?>" <?PHP print $editar; ?> /></p>
<p>
  <label>Observa&ccedil;&atilde;o:</label>
<textarea name="observacao"  cols="43" rows="3" maxlength="500" <?PHP print $editar; ?>/><?PHP print $observacao; ?></textarea>
</p>
<p>
  <label>Data de Cadastro:</label>
  <input name="data_cadastro" id="dataAgenda" type="text" class="<?PHP print $estilo_caixa; ?>"  size="20" maxlength="10" value="<?PHP print $data_cadastro; ?>" <?PHP print $editar; ?> />
</p>
<p>
  <label>Utiliza o Sistema:</label>
  <input name="utiliza_sistema" type="checkbox" class="<?PHP print $estilo_caixa; ?>" size="2" maxlength="1" value="1" <?php print $checked_utiliza_sistema;  ?> <?PHP print $editar; ?> />
  <p>
  <label>Senha:</label>
  <input name="senha" type="password" class="<?PHP print $estilo_caixa; ?>" size="30" maxlength="20" value="<?PHP print $senha; ?>" <?PHP print $editar; ?> /></p>

<p>&nbsp;</p>
<table width="100%" cellspacing="0">
<tr id="titulo_tabela">
<td width="26%" class="tabela_titulo">Nome</td>
<td width="17%" class="tabela_titulo">Telefone</td>
<td width="34%" align="right" class="tabela_titulo"><div align="left">E-mail</div></td>
<td colspan="3" class="tabela_titulo"><div align="center">Ações</div></td>	
</tr>

<?PHP
// Exibe os registros na tabela
while ($reg = mysql_fetch_array($rs)) {
$id_entidade_contato = $reg["id_entidade_contato"];
$nome = $reg["nome"];
$telefone = $reg["telefone"];
$email = $reg["email"];
//Destaca a linha do último registro selecionado (fundo azul claro)
if ($idsel == $id_entidade_contato) {
$fundo = "registro_sel";
} else {
$fundo = "registro";	
}
?>
<tr>
<!-- Exibe os campos do registro -->
<td class="<?PHP print $fundo; ?>"><?PHP print $nome; ?></td>
<td class="<?PHP print $fundo; ?>"><?PHP print $telefone; ?></td>
<td class="<?PHP print $fundo; ?>"><?PHP print $email; ?></td>

<!-- Excluir registros -->
<!-- Executa o cadastro de Contato da Entidade com ação de exclusão (exc) -->
<td width="8%" class="<?PHP print $fundo; ?>"><a href="cad_entidade_contato.php?acao=exc&id_entidade_contato=<?PHP print $id_entidade_contato; ?>&titulo=Exclusão de registro"><img src="./imagens/btn_cancelar_reg.gif" alt="Cancelar esse registro" border="0" onMouseOver="toolTip('Excluir o contato <?PHP print $nome; ?>')" onMouseOut="toolTip()" /></a></td>	

<!-- Alterar registros -->
<!-- Executa o cadastro de Contato da Entidade com ação de alteração (alt) -->
<td width="7%" class="<?PHP print $fundo; ?>"><a href="cad_entidade_contato.php?acao=alt&id_entidade_contato=<?PHP print $id_entidade_contato; ?>&titulo=Alteração de registro"><img src="./imagens/btn_alterar_reg.gif" alt="Alterar esse registro" border="0" onMouseOver="toolTip('Alterar o contato <?PHP print $nome; ?>')" onMouseOut="toolTip()" /></a></td>	

<!-- Visualizar registros -->
<!-- Executa o cadastro de Contato da Entidade com ação de visualização (ver) -->
<td width="8%" class="<?PHP print $fundo; ?>"><a href="cad_entidade_contato.php?acao=ver&id_entidade_contato=<?PHP print $id_entidade_contato; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_ver_detalhes.gif" alt="Ver detalhes desse registro" border="0" onMouseOver="toolTip('Visualizar o contato <?PHP print $nome; ?>')" onMouseOut="toolTip()" /></a></td>			
</tr>
<?PHP } ?>
</table>











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
