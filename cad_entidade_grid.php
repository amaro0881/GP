<?PHP
include "inc_dbConexao.php";

SESSION_START();

//#######  Verifica se a sessão esta liberada  #######
if ($_SESSION['acesso'] <> "liberado") {
  print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=liberacao.php'>";	
}



if ($_GET['id_entidade'] == "") {
	$idsel = $_POST['id_entidade'];
} else {
	$idsel = $_GET['id_entidade'];
}
$sql = "SELECT * FROM entidade";
$sql = $sql . " ORDER BY id_entidade ";
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
  <p align="center">Listagem das Entidades</p>
  </div>

<div id="caixa_menu">
	<?PHP include "inc_menu.php" ?>
</div>

<div id="caixa_conteudo">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="80%"><h1 class="c_cinza">Manutenção Cadastral <img src="./imagens/marcador_setaDir.gif" align="absmiddle" /> <span class="c_preto">Entidades</span> </h1></td>

<!-- Incluir registroas -->
<!-- Executa o cadastro de entidadeS com ação de inserção (ins) -->
<td width="20%"><h1 align="right"><a href="cad_entidade.php?acao=ins&amp;titulo=Inclusão de registro"><img src="./imagens/btn_inserir.gif" alt="Inserir novo registro" border="0" /></a></h1></td>
</tr>
</table>

<P>Total de registros no cadastro: <span class="c_preto"><?PHP print $total_registros; ?></span></P>
<P>&nbsp;</P>
	<fieldset>
				<p>Buscar Entidade: 
				  <input type="text" size="70" name="search" value="" id="id_search" placeholder="Search" autofocus />
                </p>
	</fieldset>
<P>&nbsp;</P>
<table width="100%" cellspacing="0" id="table_example">
<tr id="titulo_tabela">
<td width="12%" class="tabela_titulo">C&oacute;digo</td>
<td width="50%" class="tabela_titulo">Nome</td>
<td width="17%" align="right" class="tabela_titulo"><div align="center">CPF / CNPJ</div></td>
<td colspan="3" class="tabela_titulo"><div align="center">Ações</div></td>	
</tr>

<?PHP
// Exibe os registros na tabela
while ($reg = mysql_fetch_array($rs)) {
$id_entidade = $reg["id_entidade"];
$codigo = $reg["codigo"];
$nome = $reg["nome"];
$cpf_cnpj = $reg["cpf_cnpj"];
//Destaca a linha do último registro selecionado (fundo azul claro)
if ($idsel == $id_entidade) {
$fundo = "registro_sel";
} else {
$fundo = "registro";	
}
?>
<tr>
<!-- Exibe os campos do registro -->
<td class="<?PHP print $fundo; ?>"><?PHP print $codigo; ?></td>
<td class="<?PHP print $fundo; ?>"><?PHP print $nome; ?></td>
<td align="right" class="<?PHP print $fundo; ?>"><div align="center"><?PHP print $cpf_cnpj; ?></div></td>

<!-- Excluir registros -->
<!-- Executa o cadastro de ENTIDADE com ação de exclusão (exc) -->
<td width="7%" class="<?PHP print $fundo; ?>"><div align="right"><a href="cad_entidade.php?acao=exc&id_entidade=<?PHP print $id_entidade; ?>&titulo=Exclusão de registro"><img src="./imagens/btn_cancelar_reg.gif" alt="Cancelar esse registro" border="0" onMouseOver="toolTip('Excluir a entidade <?PHP print $nome; ?>')" onMouseOut="toolTip()" /></a></div></td>	

<!-- Alterar registros -->
<!-- Executa o cadastro de ENTIDADE com ação de alteração (alt) -->
<td width="6%" class="<?PHP print $fundo; ?>"><div align="right"><a href="cad_entidade.php?acao=alt&id_entidade=<?PHP print $id_entidade; ?>&titulo=Alteração de registro"><img src="./imagens/btn_alterar_reg.gif" alt="Alterar esse registro" border="0" onMouseOver="toolTip('Alterar informações da entidade <?PHP print $nome; ?>')" onMouseOut="toolTip()" /></a></div></td>	

<!-- Visualizar registros -->
<!-- Executa o cadastro de ENTIDADE com ação de visualização (ver) -->
<td width="8%" class="<?PHP print $fundo; ?>"><div align="right"><a href="cad_entidade.php?acao=ver&id_entidade=<?PHP print $id_entidade; ?>&titulo=Detalhes do registro"><img src="./imagens/btn_ver_detalhes.gif" alt="Ver detalhes desse registro" border="0" onMouseOver="toolTip('Visualizar informações da entidade <?PHP print $nome; ?>')" onMouseOut="toolTip()" /></a>&nbsp;&nbsp;
  
    <a href="cad_entidade_contato.php?acao=ins&id_entidade=<?PHP print $id_entidade; ?>&titulo=Inclusão de registro"> <img src="./imagens/ico_telefone.png" alt="Cadastrar Contato" border="0" onMouseOver="toolTip('Inserir contato na entidade <?PHP print $nome; ?>')" onMouseOut="toolTip()" /></a></div></td>			
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