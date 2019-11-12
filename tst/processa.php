<?php
require_once 'autentica.php';
include_once("ConexaoMysql.php");

if (@$_POST['idAtualizatipoApto']) {
    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $id = $_POST['idAtualizatipoApto'];
    $nome = $_POST['curso'];
    $url = $_POST['url'];

    $sql = "UPDATE tipoapartamento SET tipo = '$nome' where idTipo = $id;";
    $conexao->Executa($sql);
}



if (@$_POST['idAtualizatipoUsuario']) {
    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $id = $_POST['idAtualizatipoUsuario'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    $url = $_POST['url'];
    //echo 'tipo';

    $sql = "UPDATE tipousuario SET tipo = '$tipo',descricao = '$descricao' where idTipo = $id;";
    $conexao->Executa($sql);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
    </head>

    <body> <?php
        if ($conexao->total != 0) {
            echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
				<script type=\"text/javascript\">
					alert(\"Alterado com Sucesso.\");
				</script>
			";
        } else {
            echo "
				<script type=\"text/javascript\">
					alert(\"não foi alterado com Sucesso.\");
				</script>
			";
        }
        ?>
    </body>

</html>
<?php $conexao->Desconecta(); ?>