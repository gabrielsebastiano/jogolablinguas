<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jogo da Memoria - LabLinguas</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <a class="navbar-brand" href="#"><img src="img/logo.png" style="height: 50px;align-content: center;"></a>
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Jogos</a>
                    <a class="nav-link" href="#">Sobre</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <a class="nav-link btn btn-success my-4 my-sm-2" href="restrito.php">Área restrita</a>

            </ul>
        </div>
    </nav>
    <?php
    if ($_REQUEST) {
            if (@$_REQUEST['msg'] == md5('logout')) {
                ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Você encerrou a seção!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>


    <!-- Tab panes -->
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card bg-light">
                    <div class="card-header">
                        Jogos disponiveis<button class="btn btn-secondary btn-sm ml-2"><i class="fa fa-question-circle"></i> Ajuda</button>
                    </div>
                    <div class="card-body">
                        <?php
                        require_once './ConexaoMysql.php';
                        $conexao = new ConexaoMysql();
                        $conexao->Conecta();
                        $sql = "SELECT idJogo, usuario.idUsuario, usuario.nome as nomeUsuario,DATE_FORMAT((DATE(jogo.dataCriacao)), '%d/%m/%Y') as dataAtualizada, tituloJogo FROM `jogo` INNER JOIN usuario ON jogo.idUsuario = usuario.idUsuario";
                        $resultado = $conexao->Consulta($sql);
                        ?>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Nome jogo</th>
                                    <th scope="col">Criador</th>
                                    <th scope="col">Turma</th>
                                    <th scope="col">Data de Criação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($conexao->total != 0) {
                                    foreach ($resultado as $usuario) {
                                        $idUser = $usuario['idUsuario'];
                                        ?>
                                        <tr>
                                            <td style="text-align:center;vertical-align:middle;">
                                                <a href="#" onclick="open('jogo/index.php?id=<?php $idUser; ?>', '', 'status=no,Width=750,Height=800');"><img src="img/jogo.png" style="height: 40px;"></a>
                                            </td>
                                            <td>
                                                <a><?php $usuario['tituloJogo']; ?></a>
                                            </td>
                                            <td><?php $usuario['nomeUsuario']; ?></td>
                                            <td><?php // echo 'oi'; //$usuario['turma']; 
                                                        ?></td>
                                            <td><?php $usuario['dataAtualizada']; ?></td>

                                        </tr>
                                <?php
                                    }
                                }

                                $conexao->Desconecta();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#myAlert').on('closed.bs.alert', function() {
            // do something…
        })
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>