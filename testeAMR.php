<?PHP
include "inc_dbConexao.php";

SESSION_START();

//#######  Verifica se a sessão esta liberada  #######
if ($_SESSION['acesso'] <> "liberado") {
  print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=liberacao.php'>";	
}



//*** Início da consulta por Tipo de Processo ***
$sqlTipoProcesso = "SELECT tipo_processo, id_processo, data_criacao, status, assunto FROM processo GROUP BY Processo.Tipo_Processo, id_processo ORDER BY Processo.Tipo_Processo";
$rsTipoProcesso = mysql_query($sqlTipoProcesso, $conexao);
$total_registrosTipoProcesso = mysql_num_rows($rsTipoProcesso);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gest&atilde;o de Processos</title>

<table width="100%" cellspacing="0" id="table_example">
<tr id="titulo_tabela">
<td width="10%" class="tabela_titulo">Data de Criacao</td>
<td width="11%" class="tabela_titulo">Processo</td>
<td width="54%" align="right" class="tabela_titulo"><div align="left">Assunto</div></td>
<td colspan="3" class="tabela_titulo"><div align="center">Ações</div></td>	
</tr>


<?PHP
while ($regTipoProcesso = mysql_fetch_array($rsTipoProcesso)) {
$id_processo 	= $regTipoProcesso["id_processo"];
$data_criacao 	= $regTipoProcesso["data_criacao"];
$status 		= $regTipoProcesso["status"];
$assunto 		= $regTipoProcesso["assunto"];

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

<P>Total de registros: <span class="c_preto"><?PHP print $total_registrosTipoProcesso; ?></span></P>
<P>&nbsp;</P>