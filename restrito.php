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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="img/logo.png" style="height: 50px;align-content: center;"></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Jogos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sobre</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <?php
                        if ($_REQUEST) {
                            if (@$_REQUEST['msg'] == md5('expirou')) {
                                ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Usuário ou senha incorreta!</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                                if (@$_REQUEST['msg'] == md5('desativado')) {
                                    ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Usuário desativado!</strong>
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
                        <form method="POST">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Usuário</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="user" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="senha" required>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Cadastro
                                </button>
                            </div>
                            <?php
                            if (@$_POST) {

                                $usr = $_POST['user'];
                                $senha = $_POST['senha'];

                                require_once './ConexaoMysql.php';
                                $conexao = new ConexaoMysql();
                                $conexao->Conecta();
                                $sql = 'SELECT * FROM usuario;';
                                $resultado = $conexao->Consulta($sql);

                                while ($row = $resultado->fetch_assoc()) {

                                    if ($usr == $row['login'] && md5($senha) == $row['senha']) {
                                        //se o user marcar lembrar...
                                        /* if (isset($_POST['lembrar'])) {
                                                    if ($_POST['lembrar'] == 'sim') {
                                                        setcookie('meuEmail', $email, time() + 7200);
                                                    }
                                                } else {
                                                    //se existir o cookie email....
                                                    if (isset($_COOKIE['meuEmail'])) {
                                                        //seta o valor dele para vazio
                                                        setcookie('meuEmail', '', -1);
                                                        //destroi o dito cujo.
                                                        unset($_COOKIE['meuEmail']);
                                                    }
                                                }*/
                                        //delimita o tempo de vida da sessão
                                        // session_cache_expire(600);
                                        //avisa o server que irei utilizar sessões
                                        //ativa as sessoes do servidor
                                        @session_start();
                                        //em uma sessão posso armazenar:
                                        //variáveis
                                        $_SESSION['email'] = $usr;
                                        $_SESSION['adicionaMenu'] = 'Logado';
                                        $_SESSION['id'] = $row['idUsuario'];
                                        $_SESSION['nome'] = $row['nome'];
                                        $_SESSION['adm'] = $row['adm'];
                                        //redireciona para a página
                                        if ($row['adm'] != NULL) {
                                            header('location:indexProfessor.php');
                                        }
                                        if ($row['adm'] == NULL) {
                                            header('location:indexAluno.php');
                                        }
                                    } //else {
                                        //$msg = md5('expirou');
                                        //header('location:restrito.php?msg=' . $msg);
                                    //}
                                }
                                $conexao->Desconecta(); //fim if....
                            }

                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="indexModel.php" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Nome</label>
                                <input type="nome" class="form-control" name="nome" id="email" placeholder="Nome" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="turma">Turma</label>
                                <input type="turma" class="form-control" name="turma" id="turma" placeholder="Turma" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="usuario">Matricula</label>
                                <input type="usuario" class="form-control" name="usuario" id="UserName" onkeyup="checkname();" placeholder="Matricula" required>
                                <p id="name_status"></p>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Senha</label>
                                <input type="password" class="form-control" name="senha" id="inputPassword4" placeholder="Senha" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="sel1">Tipo</label>
                                <select class="form-control" id="sel1" name="tipo">
                                    <option value="1">Aluno</option>
                                    <option value="2">Professor</option>
                                </select>
                            </div>

                        </div>

                        <input type="submit" class="btn btn-primary" value="Enviar" name="usuarioCadastro">
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        function checkname() {
            var name = document.getElementById("UserName").value;

            if (name.length > 3) {
                $.ajax({
                    type: 'post',
                    url: 'checkdata.php',
                    data: {
                        user_name: name,
                    },
                    success: function(response) {
                        $('#name_status').html(response);
                        if (response == "OK") {
                            return true;
                        } else {
                            return false;
                        }
                    }
                });
            } else {
                $('#name_status').html("");
                return false;
            }

        }

        function checkall() {
            var namehtml = document.getElementById("name_status").innerText;
            //alert(namehtml);
            if (namehtml == "OK") {
                return true;
            } else {
                return false;
            }

        }
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>