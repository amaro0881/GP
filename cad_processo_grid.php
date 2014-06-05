<?PHP
include "inc_dbConexao.php";

SESSION_START();

//#######  Verifica se a sessão esta liberada  #######
if ($_SESSION['acesso'] <> "liberado") {
  print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=liberacao.php'>";	
}



if ($_GET['id_processo'] == "") {
	$idsel = $_POST['id_processo'];
} else {
	$idsel = $_GET['id_processo'];
}
$sql = "SELECT * FROM processo";
$sql = $sql . " ORDER BY id_processo ";
$rs = mysql_query($sql, $conexao);
$total_registros = mysql_num_rows($rs);
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
  <p align="center">Listagem dos Processos</p>
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

<?PHP
// Exibe os registros na tabela
while ($reg = mysql_fetch_array($rs)) {
$id_processo = $reg["id_processo"];
$data_criacao = $reg["data_criacao"];
$status = $reg["status"];
$assunto = $reg["assunto"];
//Destaca a linha do último registro selecionado (fundo azul claro)
if ($idsel == $id_processo) {
$fundo = "registro_sel";
} else {
$fundo = "registro";	
}
?>
<tr>
<!-- Exibe os campos do registro -->
<td class="<?PHP print $fundo; ?>"><?PHP print $data_criacao; ?></td>
<td class="<?PHP print $fundo; ?>"><?PHP print $id_processo; ?></td>
<td align="right" class="<?PHP print $fundo; ?>"><div align="left"><?PHP print $assunto; ?></div></td>

<!-- Excluir registros -->
<!-- Executa o cadastro de ENTIDADE com ação de exclusão (exc) -->
<td width="6%" class="<?PHP print $fundo; ?>"><div align="right"><a href="cad_processo.php?acao=exc&id_processo=<?PHP print $id_processo; ?>&titulo=Exclusão de registro"><img src="./imagens/btn_cancelar_reg.gif" alt="Cancelar esse registro" border="0" onMouseOver="toolTip('Excluir o Processo <?PHP print $status; ?>')" onMouseOut="toolTip()" /></a></div></td>	

<!-- Alterar registros -->
<!-- Executa o cadastro de ENTIDADE com ação de alteração (alt) -->
<td width="5%" class="<?PHP print $fundo; ?>"><div align="right"><a href="cad_processo.php?acao=alt&id_processo=<?PHP print $id_processo; ?>&titulo=Alteração de registro"><img src="./imagens/btn_alterar_reg.gif" alt="Alterar esse registro" border="0" onMouseOver="toolTip('Alterar informações do Processo <?PHP print $status; ?>')" onMouseOut="toolTip()" /></a></div></td>	

<!-- Visualizar registros -->
<!-- Executa o cadastro de ENTIDADE com ação de visualização (ver) -->
<td width="14%" class="<?PHP print $fundo; ?>"><div align="right"><a href="cad_processo.php?acao=ver&id_processo=<?PHP print $id_processo; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_ver_detalhes.gif" alt="Ver detalhes desse registro" border="0" onMouseOver="toolTip('Visualizar informações do Processo <?PHP print $status; ?>')" onMouseOut="toolTip()" /></a>&nbsp;&nbsp;


  
    <a href="cad_processo_requerente.php?acao=ins&id_processo=<?PHP print $id_processo; ?>&titulo=Inclusão de registro"> <img src="./imagens/ico_requerente.png" alt="Cadastrar Requerente" border="0" onMouseOver="toolTip('Inserir Requerente no Processo <?PHP print $id_processo; ?>')" onMouseOut="toolTip()" /></a>&nbsp;&nbsp;
    
      
    <a href="cad_processo_sistema.php?acao=ins&id_processo=<?PHP print $id_processo; ?>&titulo=Inclusão de registro"> <img src="./imagens/ico_sistema.png" alt="Cadastrar Sistema" border="0" onMouseOver="toolTip('Inserir Sistema no Processo <?PHP print $id_processo; ?>')" onMouseOut="toolTip()" /></a>&nbsp;&nbsp;
    
    <a href="cad_andamento.php?acao=ins&id_processo=<?PHP print $id_processo; ?>&titulo=Inclusão de registro"> <img src="./imagens/ico_andamento.png" alt="Cadastrar Contato" border="0" onMouseOver="toolTip('Inserir Andamento no Processo <?PHP print $id_processo; ?>')" onMouseOut="toolTip()" /></a></div></td>			
</tr>
<?PHP } ?>
</table>
</div>
<!-- rodape da página -->
<?PHP include "inc_rodape.php" ?>
</div>
</body>
</html>
<?PHP
// Libera os recursos usados pela conexão atual
mysql_free_result($rs);
mysql_close ($conexao);
?>