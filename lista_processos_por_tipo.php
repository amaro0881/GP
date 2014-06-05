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


$id_entidade = $_REQUEST['id'];

//*** Início da consulta por Tipo de Processo ***
$sqlTipoProcesso = "SELECT processo.tipo_processo, processo.id_processo, processo.data_criacao, processo.status, processo.assunto, tipo_processo.codigo_tipo_processo, tipo_processo.descricao FROM processo INNER JOIN tipo_processo on (tipo_processo.id_tipo_processo = processo.tipo_processo) ";
$sqlTipoProcesso .= "WHERE responsavel = $IdEntidadeNaSessao OR coresponsavel = $IdEntidadeNaSessao OR autor = $IdEntidadeNaSessao ";
$sqlTipoProcesso .= "GROUP BY Processo.Tipo_Processo, id_processo ";
$sqlTipoProcesso .= "ORDER BY Processo.Tipo_Processo";

$rsTipoProcesso = mysql_query($sqlTipoProcesso, $conexao);
$total_registrosTipoProcesso = mysql_num_rows($rsTipoProcesso);


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gest&atilde;o de Processos</title>

<link href="estilo_adm.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="tooltip.js"></script>


		<script type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript" src="jquery.quicksearch.js"></script>
		<script type="text/javascript">
			$(function () {
				/*
				Example 1
				*/
				$('input#id_search').quicksearch('table tbody tr');
				
				/*
				Example 2 
				*/
				$('input#id_search2').quicksearch('table#table_example2 tbody tr', {
					'delay': 300,
					'selector': 'th',
					'stripeRows': ['odd', 'even'],
					'loader': 'span.loading',
					'bind': 'keyup click',
					'show': function () {
						this.style.color = '';
					},
					'hide': function () {
						this.style.color = '#ccc';
					},
					'prepareQuery': function (val) {
						return new RegExp(val, "i");
					},
					'testQuery': function (query, txt, _row) {
						return query.test(txt);
					}
				});
				
				/*
				Example 3
				*/
				var qs = $('input#id_search_list').quicksearch('ul#list_example li');
				
				$.ajax({
					'url': 'example.json',
					'type': 'GET',
					'dataType': 'json',
					'success': function (data) {
						for (i in data['list_items']) {
							$('ul#list_example').append('<li>' + data['list_items'][i] + '</li>');
						}
						qs.cache();
					}
				});
				
				$('input#add_to_list').click(function () {
					$('ul#list_example').append('<li>Added on click</li>');
					qs.cache();
				});
				
			});
		</script>

</head>
<body>



<div id="corpo">
<div id="topo">
  <h1>Administração do Site</h1>
  <p align="center">Listagem de Processos por Tipo de Processo</p>
</div>

<div id="caixa_menu">
	<?PHP include "inc_menu.php" ?>
</div>

<div id="caixa_conteudo">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="80%"><h1 class="c_cinza">Manutenção Cadastral <img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> <span class="c_preto">Processos</span> </h1></td>

<!-- Incluir registroas -->
<!-- Executa o cadastro de Processos com ação de inserção (ins) -->
<td width="20%"><h1 align="right"><a href="cad_processo.php?acao=ins&amp;titulo=Inclusão de registro"><img src="./imagens/btn_inserir.gif" alt="Inserir novo registro" border="0" /></a></h1></td>
</tr>
</table>

<P>Total de registros no cadastro: <span class="c_preto"><?PHP print $total_registros; ?></span></P>
<P>&nbsp;</P>
	<fieldset>
				<p>Buscar Processo: 
				  <input type="text" size="70" name="search" value="" id="id_search" placeholder="Search" autofocus />
                </p>
	</fieldset>
<P>&nbsp;</P>


<table width="100%" cellspacing="0" id="table_example">
<tr id="titulo_tabela">
<td width="10%" class="tabela_titulo">Data de Criacao</td>
<td width="11%" class="tabela_titulo">Processo</td>
<td width="54%" align="right" class="tabela_titulo"><div align="left">Assunto</div></td>
<td colspan="3" class="tabela_titulo"><div align="center">Ações</div></td>	
</tr>


<?php
$Ultimo_Tipo = "Tipo Processo";


while ($regTipoProcesso = mysql_fetch_array($rsTipoProcesso)) {
$id_processo 			= $regTipoProcesso["id_processo"];
$data_criacao 			= $regTipoProcesso["data_criacao"];
$status 				= $regTipoProcesso["status"];
$assunto 				= $regTipoProcesso["assunto"];
$Tipo_Processo  		= $regTipoProcesso["tipo_processo"];
$Codigo_Tipo_Processo 	= $regTipoProcesso["codigo_tipo_processo"];
$Descricao 	= $regTipoProcesso["descricao"];

//Destaca a linha do último registro selecionado (fundo azul claro)
if ($idsel == $id_processo) {
$fundo = "registro_sel";
} else {
$fundo = "registro";	
}
?>


<?php if ($Tipo_Processo <> $Ultimo_Tipo) 
  echo "<tr><td valign= 'top' colspan='3' class='titulo'>Tipo do Processo:  $Tipo_Processo - $Codigo_Tipo_Processo</td></tr>";
  $Ultimo_Tipo = $Tipo_Processo;
?>
<tr>




<!-- Exibe os campos do registro -->
<td class="<?php print $fundo; ?>"><?php print $data_criacao; ?></td>
<td class="<?php print $fundo; ?>"><?php print $id_processo; ?></td>
<td align="right" class="<?php print $fundo; ?>"><div align="left"><?php print $assunto; ?></div></td>

<!-- Excluir registros -->
<!-- Executa o cadastro de ENTIDADE com ação de exclusão (exc) -->
<td width="6%" class="<?php print $fundo; ?>"><div align="right"><a href="cad_processo.php?acao=exc&id_processo=<?php print $id_processo; ?>&titulo=Exclusão de registro"><img src="./imagens/btn_cancelar_reg.gif" alt="Cancelar esse registro" border="0" onMouseOver="toolTip('Excluir o Processo <?php print $status; ?>')" onMouseOut="toolTip()" /></a></div></td>	

<!-- Alterar registros -->
<!-- Executa o cadastro de ENTIDADE com ação de alteração (alt) -->
<td width="5%" class="<?php print $fundo; ?>"><div align="right"><a href="cad_processo.php?acao=alt&id_processo=<?php print $id_processo; ?>&titulo=Alteração de registro"><img src="./imagens/btn_alterar_reg.gif" alt="Alterar esse registro" border="0" onMouseOver="toolTip('Alterar informações do Processo <?php print $status; ?>')" onMouseOut="toolTip()" /></a></div></td>	

<!-- Visualizar registros -->
<!-- Executa o cadastro de ENTIDADE com ação de visualização (ver) -->
<td width="14%" class="<?php print $fundo; ?>"><div align="right"><a href="cad_processo.php?acao=ver&id_processo=<?php print $id_processo; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_ver_detalhes.gif" alt="Ver detalhes desse registro" border="0" onMouseOver="toolTip('Visualizar informações do Processo <?php print $status; ?>')" onMouseOut="toolTip()" /></a>&nbsp;&nbsp;

    <a href="cad_processo_requerente.php?acao=ins&id_processo=<?php print $id_processo; ?>&titulo=Inclusão de registro"> <img src="./imagens/ico_requerente.png" alt="Cadastrar Requerente" border="0" onMouseOver="toolTip('Inserir Requerente no Processo <?php print $id_processo; ?>')" onMouseOut="toolTip()" /></a>&nbsp;&nbsp;
    <a href="cad_processo_sistema.php?acao=ins&id_processo=<?php print $id_processo; ?>&titulo=Inclusão de registro"> <img src="./imagens/ico_sistema.png" alt="Cadastrar Sistema" border="0" onMouseOver="toolTip('Inserir Sistema no Processo <?php print $id_processo; ?>')" onMouseOut="toolTip()" /></a>&nbsp;&nbsp;
    <a href="cad_andamento.php?acao=ins&id_processo=<?php print $id_processo; ?>&titulo=Inclusão de registro"> <img src="./imagens/ico_andamento.png" alt="Cadastrar Contato" border="0" onMouseOver="toolTip('Inserir Andamento no Processo <?php print $id_processo; ?>')" onMouseOut="toolTip()" /></a></div></td>			

	</tr>
<?php } ?>

<P>Total de registros: <span class="c_preto"><?php print $total_registrosTipoProcesso; ?></span></P>
<P>&nbsp;</P>
