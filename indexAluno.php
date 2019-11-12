<!DOCTYPE html>
<?php
require_once 'autentica.php';
require_once 'ConexaoMysql.php';
?>
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

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>

    <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><img src="img/logo.png" style="height: 30px;align-content: center;"></a>
                </div>

                <ul class="nav navbar-nav navbar-right">

                    <li> <?php
                        if (@$_SESSION) {

                            echo 'Bem vindo(a): ' . @$_SESSION['nome'] . '&nbsp';
                        }
                        ?><a href="logout.php"><i class="fa fa-sign-out-alt"></i>
                            Sair</a></li>

                </ul>
            </div>
        </nav>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">Criar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Meus Jogos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu2">Ajuda</a>
            </li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane container fade" id="menu1">
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card bg-light">
                                <div class="card-header">
                                    Criar jogos<button class="btn btn-secondary btn-sm ml-2"><i class="fa fa-question-circle"></i> Ajuda</button>
                                </div>
                                <div class="card-body">
                                    <form name="enviar" enctype="multipart/form-data" method="post" action="testeup.php">
                                        <!-- A -->
                                        <div class="form-group">
                                            <label>Titulo Jogo</label>
                                            <input type="text" class="form-control" name="titulo" placeholder="Nome do arquivo ex(Batata)">
                                            <small id="emailHelp" class="form-text text-muted">Coloque um titulo que faça sentido com
                                                o jogo que você está criando.
                                            </small>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Texto A</label>
                                            <input type="text" class="form-control" name="a" placeholder="Nome do arquivo ex(Batata)">
                                            <small id="emailHelp" class="form-text text-muted">Coloque um nome que faça sentido com
                                                a imagem que você está inserindo.
                                            </small>
                                        </div>

                                        <!-- ENVIO DO ARQUIVO -->

                                        <div class="form-group">
                                            <label>Imagem A</label>
                                            <input type="file" class="form-control-file" name="imgA">
                                        </div>
                                        <!--/ A -->
                                        <!-- B -->
                                        <div class="form-group">
                                            <label>Texto B</label>
                                            <input type="text" class="form-control" name="b" placeholder="Nome do arquivo ex(Batata)">
                                            <small id="emailHelp" class="form-text text-muted">Coloque um nome que faça sentido com
                                                a imagem que você está inserindo.
                                            </small>
                                        </div>

                                        <!-- ENVIO DO ARQUIVO -->

                                        <div class="form-group">
                                            <label>Imagem B</label>
                                            <input type="file" class="form-control-file" name="imgB">
                                        </div>
                                        <!--/ B -->

                                        <!-- C -->
                                        <div class="form-group">
                                            <label>Texto C</label>
                                            <input type="text" class="form-control" name="c" placeholder="Nome do arquivo ex(Batata)">
                                            <small id="emailHelp" class="form-text text-muted">Coloque um nome que faça sentido com
                                                a imagem que você está inserindo.
                                            </small>
                                        </div>

                                        <!-- ENVIO DO ARQUIVO -->

                                        <div class="form-group">
                                            <label>Imagem C</label>
                                            <input type="file" class="form-control-file" name="imgC">
                                        </div>
                                        <!--/ C -->
                                        <!-- D -->
                                        <div class="form-group">
                                            <label>Texto D</label>
                                            <input type="text" class="form-control" name="d" placeholder="Nome do arquivo ex(Batata)">
                                            <small id="emailHelp" class="form-text text-muted">Coloque um nome que faça sentido com
                                                a imagem que você está inserindo.
                                            </small>
                                        </div>

                                        <!-- ENVIO DO ARQUIVO -->

                                        <div class="form-group">
                                            <label>Imagem D</label>
                                            <input type="file" class="form-control-file" name="imgD">
                                        </div>
                                        <!--/ D-->
                                        <!-- E -->
                                        <div class="form-group">
                                            <label>Texto E</label>
                                            <input type="text" class="form-control" name="e" placeholder="Nome do arquivo ex(Batata)">
                                            <small id="emailHelp" class="form-text text-muted">Coloque um nome que faça sentido com
                                                a imagem que você está inserindo.
                                            </small>
                                        </div>

                                        <!-- ENVIO DO ARQUIVO -->

                                        <div class="form-group">
                                            <label>Imagem E</label>
                                            <input type="file" class="form-control-file" name="imgE">
                                        </div>
                                        <!--/ E -->
                                        <!-- F -->
                                        <div class="form-group">
                                            <label>Texto F</label>
                                            <input type="text" class="form-control" name="f" placeholder="Nome do arquivo ex(Batata)">
                                            <small id="emailHelp" class="form-text text-muted">Coloque um nome que faça sentido com
                                                a imagem que você está inserindo.
                                            </small>
                                        </div>

                                        <!-- ENVIO DO ARQUIVO -->

                                        <div class="form-group">
                                            <label>Imagem F</label>
                                            <input type="file" class="form-control-file" name="imgF">
                                        </div>

                                        <!--/ F -->
                                        <input type="submit" class="btn btn-primary" name="enviar" value="Enviar">

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane container active" id="home">
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card bg-light">
                                <div class="card-header">
                                    Meus jogos
                                </div>
                                <div class="card-body">
                                    <?php
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
                                                <th scope="col">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($conexao->total != 0) {
                                                foreach ($resultado as $usuario) {
                                                    $idUser = $usuario['idJogo'];
                                                    ?>
                                                    <tr>
                                                        <td style="text-align:center;vertical-align:middle;">
                                                            <a href="#" onclick="open('jogo/index.php?id=<?php echo $idUser; ?>', '', 'status=no,Width=750,Height=800');"><img src="img/jogo.png" style="height: 40px;"></a>
                                                        </td>
                                                        <td>
                                                            <a><?php echo $usuario['tituloJogo']; ?></a>
                                                        </td>
                                                        <td><?php echo $usuario['nomeUsuario']; ?></td>
                                                        <td><?php echo 'oi'; //$usuario['turma']; 
                                                    ?></td>
                                                        <td><?php echo $usuario['dataAtualizada']; ?></td>
                                                        <td>
                                                            <div class="text-center"> 
                                                                <form name="excluir" method="POST" action="indexModel.php">
                                                                    <button type="submit" class="btn btn-xs btn-danger" name="jogoDelete" type="hidden" class="form-control" value="<?php echo $idUser; ?>">Apagar</button>
                                                                </form>
                                                            </div>
                                                        </td>
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
            </div>


            <div class="tab-pane container fade" id="menu2">Sobre o jogo??</div>
        </div>

    </body>

</html>

