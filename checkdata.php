<!DOCTYPE html>
<?php
//require_once 'autentica.php';
require_once './ConexaoMysql.php';

$conexao = new ConexaoMysql();
$conexao->Conecta();

if (isset($_POST['user_name'])) {
    $name = $_POST['user_name'];

    $sql = "SELECT COUNT(*) FROM usuario WHERE login = '$name'";
    $checkdata = $conexao->Consulta($sql);
    $row = $checkdata->fetch_row();
    if ($row[0] > 0) {
        echo "Matricula já cadastrada";
    } else {
        echo "OK";
    }
    exit();
}