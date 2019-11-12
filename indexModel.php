<?php

require_once './ConexaoMysql.php';
require_once './exclui.php';

if (@$_POST['usuarioCadastro']) {

    $nome = $_POST['nome'];
    $turma = $_POST['turma'];
    $usuarioPost = $_POST['usuario'];
    $senhaPost = $_POST['senha'];
    $tipo = $_POST['tipo'];

    $senhaNova = md5($senhaPost);
    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    $sql = "INSERT INTO usuario (nome,turma,login,senha,dataCriacao,status,tipo) VALUES ('$nome','$turma','$usuarioPost','$senhaNova',CURDATE( ),0,$tipo);";
    $conexao->Executa($sql);
    $conexao->Desconecta();

    header('location:index.php?msg=' . $msg);
}
if (@$_POST['usuarioUpdate']) {
    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    echo $sql = "UPDATE usuario SET status = 1 WHERE idUsuario =" . $_POST['usuarioUpdate'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('cadastro');
    header('location:indexProfessor.php?msg=' . $msg);
}

if (@$_POST['usuarioDelete']) {
    $conexao = new ConexaoMysql();
    $conexao->Conecta();
    echo $sql = "UPDATE usuario SET status = 3 WHERE idUsuario =" . $_POST['usuarioDelete'];
    $conexao->Executa($sql);
    $conexao->Desconecta();
    $msg = md5('cadastro');
    header('location:indexProfessor.php?msg=' . $msg);
}

if (@$_POST['jogoDelete']) {
    $idJogo = $_POST['jogoDelete'];
    $conexao = new ConexaoMysql();
    $conexao->Conecta();

    $sql = "SELECT * FROM jogo WHERE idJogo = $idJogo";
    $resultado = $conexao->Consulta($sql);

    if ($conexao->total != 0) {
        foreach ($resultado as $usuario) {
            $a = exclui($usuario['A2']);
            $b = exclui($usuario['B2']);
            $c = exclui($usuario['C2']);
            $d = exclui($usuario['D2']);
            $e = exclui($usuario['E2']);
            $f = exclui($usuario['F2']);
        }
    }
    $sql2 = "DELETE FROM jogo WHERE idJogo = $idJogo";
    $conexao->Executa($sql2);
    $conexao->Desconecta();
    $msg = md5('cadastro');
    header('location:indexProfessor.php?msg=' . $msg);
}
