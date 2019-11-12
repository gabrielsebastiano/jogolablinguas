<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Gerente de Agendamento</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="css/sb-admin.css" rel="stylesheet">
    </head>
    <body class="bg-dark">
        <div class="container">
            <div class="mx-auto mt-5 text-center">
                <img src="img/logo.png" height="150px" alt="Logo Lanvanderia"/>
            </div>
        </div>
        <div class="container">
            <div class="card card-login mx-auto mt-5">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form method="POST" role="form">
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="text" class="form-control" id="user" placeholder="Enter email" name="user">
                                <label for="user">Usuário</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="password" class="form-control" id="senha" placeholder="Enter password" name="senha">
                                <label for="senha">Senha</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                    <br>
                    <?php
                    if (@$_POST) {
                        $usr = $_POST['user'];
                        $senha = $_POST['senha'];
                        require_once 'ConexaoMysql.php';
                        $conexao = new ConexaoMysql();
                        $conexao->Conecta();
                        $sql = 'SELECT * FROM usuarios;';
                        $resultado = $conexao->Consulta($sql);
                        while ($row = $resultado->fetch_assoc()) {
                            if ($usr == $row['usuario'] && md5($senha) == $row['senha']) {
                                //delimita o tempo de vida da sessão
                                //  session_cache_expire(600);
                                //avisa o server que irei utilizar sessões
                                //ativa as sessoes do servidor
                                @session_start();
                                //em uma sessão posso armazenar:
                                //variáveis
                                $_SESSION['usuario'] = $usr;
                                $_SESSION['idUsuario'] = $row['idUsuario'];
                                $_SESSION['nome'] = $row['nome'];
                                $_SESSION['idTipo'] = $row['idTipo'];

                                //redireciona para a página
                                function getUserIpAddr() {
                                    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                        //ip from share internet
                                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                                    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                        //ip pass from proxy
                                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                    } else {
                                        $ip = $_SERVER['REMOTE_ADDR'];
                                    }
                                    return $ip;
                                }

                                date_default_timezone_set('America/Sao_Paulo');
                                $date = date('Y-m-d H:i');
                                require_once 'ConexaoMysql.php';
                                $conexao = new ConexaoMysql();
                                $conexao->Conecta();
                                echo $sql = "INSERT INTO acessoHistorico(nomeBolsista, ip, dataHora) VALUES ('" . $_SESSION['nome'] . "','" . getUserIpAddr() . "','" . $date . "');";
                                $conexao->Executa($sql);
                                header('location:index.php');
                            }
                        }

                        $conexao->Desconecta(); //fim if....
                    }

                    if ($_REQUEST) {

                        if (@$_REQUEST['msg'] == md5('expirou')) {

                            echo '<div class="alert alert-info">

                    <strong>Você encerrou a sessão! Informe o Usuário e senha novamente.</strong> 

                    </div>';
                        }

                        if (@$_REQUEST['msg'] == md5('admin')) {

                            echo '<div class="alert alert-info">

                    <strong>Você não é admin! <br>Tente com outro usuário!</strong> 

                    </div>';
                        }

                        if (@$_REQUEST['msg'] == md5('logout')) {

                            echo '<div class="alert alert-info">

                    <strong>Tchau!!</strong> 

                    </div>';
                        }
                    }
                    ?>

                    <div class="text-center">

                        <a class="d-block small mt-3" href="malito:ufsm.diretoriaceu2@gmail.com">Em caso de troca ou esqueceu a senha envie um e-mail para ufsm.diretoriaceu2@gmail.com</a>

                    </div>

                </div>

            </div>

        </div>

        <br><br><br><br><br><br>



        <!-- Bootstrap core JavaScript-->

        <script src="vendor/jquery/jquery.min.js"></script>

        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



        <!-- Core plugin JavaScript-->

        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>



    </body>



</html>

