<?PHP
$conexao = mysql_connect("mysql.tsvip.com.br","tsvip01","arms081987") or die ('A query falhou, motivo: ' . mysql_error() . "<br />\n$sql");
$db = mysql_select_db("tsvip01", $conexao);
?>