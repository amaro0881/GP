<?PHP
include "inc_dbConexao.php";

SESSION_START();

//#######  Verifica se a sessão esta liberada  #######
if ($_SESSION['acesso'] <> "liberado") {
  print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=liberacao.php'>";	
}

//Guarda a data do dia dentro da variável Dia.
$Dia = date("d/m/Y");


//Resgata as informações da entidade logada e passa para suas variaveis.
$IdEntidadeNaSessao = $_SESSION['sessionIdEntidade'];
$CodigoNaSessao = $_SESSION['sessionCodigo'];
$NomeNaSessao = $_SESSION['sessionNome'];


$acao = $_GET['acao'];
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
$sql = "SELECT * FROM processo ";
$sql = $sql . " WHERE id_processo = '" . $id_processo . "' ";
$rs = mysql_query($sql, $conexao) or die(mysql_error());
$reg = mysql_fetch_array($rs);


$id_processo = $reg['id_processo'];
$data_criacao = $reg['data_criacao'];
$status= $reg['status'];
$tipo_processo = $reg['tipo_processo'];
$autor = $reg['autor'];
$responsavel = $reg['responsavel'];
$coresponsavel = $reg['coresponsavel'];
$assunto = $reg['assunto'];
$descricao = $reg['descricao'];






//Início da busca pelos Sistema(s).
if ($_GET['id_processo_sistema'] == "") {
	$idsel = $_POST['id_processo_sistema'];
} else {
	$idsel = $_GET['id_processo_sistema'];
}
$sqlProcessoSistema = "select processo_sistema.id_processo_sistema, processo_sistema.id_processo, processo_sistema.id_sistema, processo_sistema.observacao, sistema.id_sistema, sistema.codigo_sistema, sistema.descricao from processo_sistema INNER JOIN sistema on (processo_sistema.id_sistema = sistema.id_sistema)";
$sqlProcessoSistema = $sqlProcessoSistema . " WHERE id_processo = '" . $id_processo . "' ";
$sqlProcessoSistema = $sqlProcessoSistema . " ORDER BY id_processo_sistema ";

$rsProcessoSistema = mysql_query($sqlProcessoSistema, $conexao) or die(mysql_error());
$total_registrosProcessoSistema = mysql_num_rows($rsProcessoSistema);



//Início dos requerentes.
if ($_GET['id_processo_requerente'] == "") {
	$idsel = $_POST['id_processo_requerente'];
} else {
	$idsel = $_GET['id_processo_requerente'];
}
$sql = "select 	processo_requerente.id_processo_requerente,  processo_requerente.id_processo, processo_requerente.id_requerente, processo_requerente.observacao, entidade.id_entidade, entidade.codigo, entidade.nome from processo_requerente INNER JOIN entidade on (processo_requerente.id_requerente = entidade.id_entidade)";
$sql = $sql . " WHERE id_processo = '" . $id_processo . "' ";
$sql = $sql . " ORDER BY id_processo_requerente ";

$rs = mysql_query($sql, $conexao) or die(mysql_error());
$total_registros = mysql_num_rows($rs);



//Início da busca pelos Andamentos dentro do Processo.
if ($_GET['id_andamento'] == "") {
	$idsel = $_POST['id_andamento'];
} else {
	$idsel = $_GET['id_andamento'];
}
$sqlAndamento = "SELECT * FROM andamento";
$sqlAndamento = $sqlAndamento . " WHERE id_processo = '" . $id_processo . "' ";
$sqlAndamento = $sqlAndamento . " ORDER BY id_andamento ";

$rsAndamento = mysql_query($sqlAndamento, $conexao) or die(mysql_error());
$total_registrosAndamento = mysql_num_rows($rsAndamento);

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


<script language="javascript">
function valida_form() {

//Valida se existe data de criação no processo
if (document.form_cad.data_criacao.value == ""){
	(document.form_cad.data_criacao.value = "<?php  print $Dia  ?>");
}

//Valida se existe tipo de processo no processo
if (document.form_cad.tipo_processo.value == "0")
{alert("Por favor, informe o tipo do processo.");
form_cad.tipo_processo.focus();
return false;
}

//Valida se existe responsavel no processo
if (document.form_cad.responsavel.value == "0")
{alert("Por favor, informe o responsável por este processo.");
form_cad.responsavel.focus();
return false;
}

//Valida se existe assunto no processo
if (document.form_cad.assunto.value == "")
{alert("Por favor, informe o assunto do processo.");
form_cad.assunto.focus();
return false;
}

//Valida se existe descrição no processo
if (document.form_cad.descricao.value == "")
{alert("Por favor, informe a descrição do processo.");
form_cad.descricao.focus();
return false;
}

//Retorna verdadeiro indicando que não tem alerta a ser exibido e grava o processo.
return true;
}



</script>





</head>
<body>

<script type="text/javascript" src="tooltip.js"></script>

<form name="form_cad" method="post" action="cad_processo1.php" onsubmit="return valida_form(this);">	
<div id="corpo">
<div id="topo">
  <h1>Administração do Site</h1>
</div>

<div id="caixa_menu">
<?PHP include "inc_menu.php" ?>
</div>

<div id="caixa_conteudo">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="62%"><h1 class="c_cinza">Manutenção Cadastral <img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> Processos <img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> <span class="c_preto"><?PHP print $titulo_pagina; ?></span> </h1>
</td>
<td width="38%"><div align="right">
<?PHP if($acao == "ins" or $acao == "alt") { ?>
	<a href="cad_processo_grid.php?id_processo=<?PHP print $id_processo; ?>"><img src="./imagens/btn_fechar_ss.gif" alt="Fechar" border="0" /></a>
	<input type="image" name="imageField" src="./imagens/btn_salvar.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />
	<input type="hidden" name="id_processo" value="<?PHP print $id_processo; ?>" />	
<?PHP } ?>	
<?PHP if($acao == "exc") { ?>
	<input type="image" name="imageField" src="./imagens/btn_excluir.gif" />
	<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />
	<input type="hidden" name="id_processo" value="<?PHP print $id_processo; ?>" />	
	<a href="cad_processo_grid.php?id_processo=<?PHP print $id_processo; ?>"><img src="./imagens/btn_nao_excluir.gif" alt="Fechar" border="0" /></a>	
<?PHP } ?>
<?PHP if($acao == "ver") { ?>
		<a href="cad_processo_grid.php?id_processo=<?PHP print $id_processo; ?>"><img src="./imagens/btn_fechar.gif" alt="Fechar" border="0" /></a>
<?PHP } ?>
</div></td>
</tr>
</table>

<div id="caixa_cad">
<table width="556" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="157"><p>N&ordm; Processo</p>
      <p><font size="+2"><?PHP print $id_processo; ?></font></p></td>
    <td width="170"><p>Data de Cria&ccedil;&atilde;o</p>
      <p>
        <input name="data_criacao" id="dataAgenda" type="text" class="<?PHP print $estilo_caixa; ?>" size="20" maxlength="30" value="<?PHP print $data_criacao; ?>" <?PHP print $editar; ?> />
      </p></td>
    <td width="239"><p>Status</p>
      <p>
        <select name="status" style="WIDTH: 75%">
                <?PHP
		// Carrega o Status = 1;
		$StatusProcesso = "<option value='7'>Aberto</option><br /> ";
		$sql_status = "SELECT id_processo_status, status  FROM processo_status";
		$rs_status = mysql_query($sql_status, $conexao);
		while ($reg_status = mysql_fetch_array($rs_status)) {
			if ($status == $reg_status['id_processo_status']) {
				$StatusProcesso = $StatusProcesso . "<option value='" . $reg_status['id_processo_status'] . "' selected='selected'>" . $reg_status['status'] . "</option><br /> ";
			} else {
				$StatusProcesso = $StatusProcesso . "<option value='" . $reg_status['id_processo_status'] . "'>" . $reg_status['status'] . "</option><br /> ";
			}
		}
		print $StatusProcesso;
		// Fim do Carregamento o Status ?>
              </select>
      </p></td>
  </tr>
  <tr>
    <td colspan="3">
      <table width="569" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="281"><p>Tipo Processo</p>
            <p>
              <select name="tipo_processo">
                <?PHP
		// Carrega o tipo de processo;
		$tipo = "<option value='0'>--&nbsp;&nbsp;&nbsp; Selecione um Tipo de Processo &nbsp;&nbsp;&nbsp;&nbsp;--</option><br /> ";
		$sql_tipo_processo = "SELECT id_tipo_processo, codigo_tipo_processo  FROM tipo_processo";
		$rs_tipo_processo = mysql_query($sql_tipo_processo, $conexao);
		while ($reg_tipo_processo = mysql_fetch_array($rs_tipo_processo)) {
			if ($tipo_processo == $reg_tipo_processo['id_tipo_processo']) {
				$tipo = $tipo . "<option value='" . $reg_tipo_processo['id_tipo_processo'] . "' selected='selected'>" . $reg_tipo_processo['codigo_tipo_processo'] . "</option><br /> ";
			} else {
				$tipo = $tipo . "<option value='" . $reg_tipo_processo['id_tipo_processo'] . "'>" . $reg_tipo_processo['codigo_tipo_processo'] . "</option><br /> ";
			}
		}
		print $tipo;
		// Fim do Carregamento do tipo de processo ?>
              </select>
            </p></td>
            
            
          <td width="281"><p>Autor:</p>
            <p>
              <select name="autor" style="WIDTH: 80%">
                <?PHP
		// Carrega as Entidades com a op&ccedil;&atilde;o Autor = 1;
		$EntidadeAutor = "<option  value=' $IdEntidadeNaSessao '> $NomeNaSessao </option><br /> ";
		$sql_Autor = "SELECT id_entidade, nome  FROM entidade where autor=1 ";
		$rs_Autor = mysql_query($sql_Autor, $conexao);
		while ($reg_Autor = mysql_fetch_array($rs_Autor)) {
			if ($autor == $reg_Autor['id_entidade']) {
				$EntidadeAutor = $EntidadeAutor . "<option value='" . $reg_Autor['id_entidade'] . "' selected='selected'>" . $reg_Autor['nome'] . "</option><br /> ";
			} else {
				$EntidadeAutor = $EntidadeAutor . "<option value='" . $reg_Autor['id_entidade'] . "'>" . $reg_Autor['nome'] . "</option><br /> ";
			}
		}
		print $EntidadeAutor;
		// Fim do Carregamento das Entidades tipo Autor ?>
              </select>
            </p></td>
        </tr>
        <tr>
          <td><p>Respons&aacute;vel:</p>
            <p>
              <select name="responsavel">
                <?PHP
		// Carrega as Entidades com o Responsável = 1;
		$EntidadeResponsavel = "<option value='0'>--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Selecione um Responsável &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--</option><br /> ";
		$sql_Responsavel = "SELECT id_entidade, nome  FROM entidade where responsavel=1 ";
		$rs_Responsavel = mysql_query($sql_Responsavel, $conexao);
		while ($reg_Responsavel = mysql_fetch_array($rs_Responsavel)) {
			if ($responsavel == $reg_Responsavel['id_entidade']) {
				$EntidadeResponsavel = $EntidadeResponsavel . "<option value='" . $reg_Responsavel['id_entidade'] . "' selected='selected'>" . $reg_Responsavel['nome'] . "</option><br /> ";
			} else {
				$EntidadeResponsavel = $EntidadeResponsavel . "<option value='" . $reg_Responsavel['id_entidade'] . "'>" . $reg_Responsavel['nome'] . "</option><br /> ";
			}
		}
		print $EntidadeResponsavel;
		// Fim do Carregamento das Entidades tipo Responsável?>
              </select>
            </p></td>
          <td><p>Co-Respons&aacute;vel</p>
            <p>
              <select name="coresponsavel">
                <?PHP
		// Carrega as Entidades com o Co-Respons&aacute;vel = 1;
		$EntidadeCoresponsavel = "<option value='0'>--&nbsp; Selecione um Co-Respons&aacute;vel &nbsp;--</option><br /> ";
		$sql_Coresponsavel = "SELECT id_entidade, nome  FROM entidade where coresponsavel=1 ";
		$rs_Coresponsavel = mysql_query($sql_Coresponsavel, $conexao);
		while ($reg_Coresponsavel = mysql_fetch_array($rs_Coresponsavel)) {
			if ($coresponsavel == $reg_Coresponsavel['id_entidade']) {
				$EntidadeCoresponsavel = $EntidadeCoresponsavel . "<option value='" . $reg_Coresponsavel['id_entidade'] . "' selected='selected'>" . $reg_Coresponsavel['nome'] . "</option><br /> ";
			} else {
				$EntidadeCoresponsavel = $EntidadeCoresponsavel . "<option value='" . $reg_Coresponsavel['id_entidade'] . "'>" . $reg_Coresponsavel['nome'] . "</option><br /> ";
			}
		}
		print $EntidadeCoresponsavel;
		// Fim do Carregamento das Entidades tipo Co-Respons&aacute;vel?>
              </select>
            </p></td>
        </tr>
      </table>      </td>
    </tr>
  <tr>
    <td colspan="3"><p>Assunto:</p>
      <p>
        <input name="assunto" type="text" class="<?PHP print $estilo_caixa; ?>" size="95" maxlength="200" value="<?PHP print $assunto; ?>" <?PHP print $editar; ?> />
      </p></td>
    </tr>
  <tr>
    <td colspan="3"><p>Descri&ccedil;&atilde;o:</p>
      <p>
        <textarea name="descricao"  cols="60" rows="10" maxlength="500" <?PHP print $editar; ?>/><?PHP print $descricao; ?></textarea>
      </p>
      <p>&nbsp;</p></td>
    </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>







<? //Inicio dos Sistemas ?>


<p>&nbsp;</p>
<table width="100%" cellspacing="0">
<tr id="titulo_tabela">
<td width="14%" class="tabela_titulo">Sistema</td>
<td width="63%" align="right" class="tabela_titulo"><div align="left">Observa&ccedil;&atilde;o</div></td>
<td colspan="3" class="tabela_titulo"><div align="center">Ações</div></td>	
</tr>

<?PHP
// Exibe os registros na tabela
while ($reg = mysql_fetch_array($rsProcessoSistema)) {
$id_processo_sistema = $reg["id_processo_sistema"];
$id_sistema = $reg["id_sistema"];
$observacao = $reg["observacao"];
$codigo_sistema = $reg["codigo_sistema"];

//Destaca a linha do último registro selecionado (fundo azul claro)
if ($idsel == $id_processo_sistema) {
$fundo = "registro_sel";
} else {
$fundo = "registro";	
}
?>

<tr>
<!-- Exibe os campos do registro -->
<td class="<?PHP print $fundo; ?>"><?PHP print $codigo_sistema; ?></td>
<td class="<?PHP print $fundo; ?>"><?PHP print $observacao; ?></td>

<!-- Excluir registros -->
<!-- Executa o cadastro de Imóvel com ação de exclusão (exc) -->
<td width="8%" class="<?PHP print $fundo; ?>"><a href="cad_processo_sistema.php?acao=exc&id_processo_sistema=<?PHP print $id_processo_sistema; ?>&titulo=Exclusão de registro"><img src="./imagens/btn_cancelar_reg.gif" alt="Cancelar esse registro" border="0" onMouseOver="toolTip('Excluir o andamento <?PHP print $id_processo_sistema; ?>')" onMouseOut="toolTip()" /></a></td>	

<!-- Alterar registros -->
<!-- Executa o cadastro de Imóvel com ação de alteração (alt) -->
<td width="7%" class="<?PHP print $fundo; ?>"><a href="cad_processo_sistema.php?acao=alt&id_processo_sistema=<?PHP print $id_processo_sistema; ?>&titulo=Alteração de registro"><img src="./imagens/btn_alterar_reg.gif" alt="Alterar esse registro" border="0" onMouseOver="toolTip('Alterar o andamento <?PHP print $id_processo_sistema; ?>')" onMouseOut="toolTip()" /></a></td>	

<!-- Visualizar registros -->
<!-- Executa o cadastro de Imóvel com ação de visualização (ver) -->
<td width="8%" class="<?PHP print $fundo; ?>"><a href="cad_processo_sistema.php?acao=ver&id_processo_sistema=<?PHP print $id_processo_sistema; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_ver_detalhes.gif" alt="Ver detalhes desse registro" border="0" onMouseOver="toolTip('Visualizar o imóvel <?PHP print $id_processo_sistema; ?>')" onMouseOut="toolTip()" /></a></td>			
</tr>
<?PHP } ?>
</table>



<? //FIM dos Sistemas ?>







<p>&nbsp;</p>
<table width="100%" cellspacing="0">
<tr id="titulo_tabela">
<td width="14%" class="tabela_titulo">Requerente</td>
<td width="63%" align="right" class="tabela_titulo"><div align="left">Observa&ccedil;&atilde;o</div></td>
<td colspan="3" class="tabela_titulo"><div align="center">Ações</div></td>	
</tr>

<?PHP
// Exibe os registros na tabela
while ($reg = mysql_fetch_array($rs)) {
$id_processo_requerente = $reg["id_processo_requerente"];
$id_requerente = $reg["id_requerente"];
$observacao = $reg["observacao"];
$CodigoEntidade = $reg["codigo"];


//Destaca a linha do último registro selecionado (fundo azul claro)
if ($idsel == $id_processo_requerente) {
$fundo = "registro_sel";
} else {
$fundo = "registro";	
}
?>
<tr>
<!-- Exibe os campos do registro -->
<td class="<?PHP print $fundo; ?>"><?PHP print $CodigoEntidade; ?></td>
<td class="<?PHP print $fundo; ?>"><?PHP print $observacao; ?></td>

<!-- Excluir registros -->
<!-- Executa o cadastro de Imóvel com ação de exclusão (exc) -->
<td width="8%" class="<?PHP print $fundo; ?>"><a href="cad_processo_requerente.php?acao=exc&id_processo_requerente=<?PHP print $id_processo_requerente; ?>&titulo=Exclusão de registro"><img src="./imagens/btn_cancelar_reg.gif" alt="Cancelar esse registro" border="0" onMouseOver="toolTip('Excluir o requerente <?PHP print $id_processo_requerente; ?>')" onMouseOut="toolTip()" /></a></td>	

<!-- Alterar registros -->
<!-- Executa o cadastro de Imóvel com ação de alteração (alt) -->
<td width="7%" class="<?PHP print $fundo; ?>"><a href="cad_processo_requerente.php?acao=alt&id_processo_requerente=<?PHP print $id_processo_requerente; ?>&titulo=Alteração de registro"><img src="./imagens/btn_alterar_reg.gif" alt="Alterar esse registro" border="0" onMouseOver="toolTip('Alterar o requerente <?PHP print $id_processo_requerente; ?>')" onMouseOut="toolTip()" /></a></td>	

<!-- Visualizar registros -->
<!-- Executa o cadastro de Imóvel com ação de visualização (ver) -->
<td width="8%" class="<?PHP print $fundo; ?>"><a href="cad_processo_requerente.php?acao=ver&id_processo_requerente=<?PHP print $id_processo_requerente; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_ver_detalhes.gif" alt="Ver detalhes desse registro" border="0" onMouseOver="toolTip('Visualizar o requerente <?PHP print $id_processo_requerente; ?>')" onMouseOut="toolTip()" /></a></td>			
</tr>
<?PHP } ?>
</table>





































<? //Inicio dos Requerentes ?>


<p>&nbsp;</p>
<table width="100%" cellspacing="0">
<tr id="titulo_tabela">
<td width="14%" class="tabela_titulo">Data</td>
<td width="30%" class="tabela_titulo">Andamento</td>
<td width="33%" align="right" class="tabela_titulo"><div align="left">Observa&ccedil;&atilde;o</div></td>
<td colspan="3" class="tabela_titulo"><div align="center">Ações</div></td>	
</tr>

<?PHP
// Exibe os registros na tabela
while ($reg = mysql_fetch_array($rsAndamento)) {
$id_andamento = $reg["id_andamento"];
$data_andamento = $reg["data_andamento"];
$andamento = $reg["andamento"];
$observacao = $reg["observacao"];
//Destaca a linha do último registro selecionado (fundo azul claro)
if ($idsel == $id_andamento) {
$fundo = "registro_sel";
} else {
$fundo = "registro";	
}
?>
<tr>
<!-- Exibe os campos do registro -->
<td class="<?PHP print $fundo; ?>"><?PHP print $data_andamento; ?></td>
<td class="<?PHP print $fundo; ?>"><?PHP print $andamento; ?></td>
<td class="<?PHP print $fundo; ?>"><?PHP print $observacao; ?></td>

<!-- Excluir registros -->
<!-- Executa o cadastro de Imóvel com ação de exclusão (exc) -->
<td width="8%" class="<?PHP print $fundo; ?>"><a href="cad_andamento.php?acao=exc&id_andamento=<?PHP print $id_andamento; ?>&titulo=Exclusão de registro"><img src="./imagens/btn_cancelar_reg.gif" alt="Cancelar esse registro" border="0" onMouseOver="toolTip('Excluir o andamento <?PHP print $andamento; ?>')" onMouseOut="toolTip()" /></a></td>	

<!-- Alterar registros -->
<!-- Executa o cadastro de Imóvel com ação de alteração (alt) -->
<td width="7%" class="<?PHP print $fundo; ?>"><a href="cad_andamento.php?acao=alt&id_andamento=<?PHP print $id_andamento; ?>&titulo=Alteração de registro"><img src="./imagens/btn_alterar_reg.gif" alt="Alterar esse registro" border="0" onMouseOver="toolTip('Alterar o andamento <?PHP print $andamento; ?>')" onMouseOut="toolTip()" /></a></td>	

<!-- Visualizar registros -->
<!-- Executa o cadastro de Imóvel com ação de visualização (ver) -->
<td width="8%" class="<?PHP print $fundo; ?>"><a href="cad_andamento.php?acao=ver&id_andamento=<?PHP print $id_andamento; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_ver_detalhes.gif" alt="Ver detalhes desse registro" border="0" onMouseOver="toolTip('Visualizar o imóvel <?PHP print $andamento; ?>')" onMouseOut="toolTip()" /></a></td>			
</tr>
<?PHP } ?>
</table>



<? //FIM dos Requerentes ?>


























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
