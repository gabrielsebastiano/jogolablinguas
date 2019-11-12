<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Torrents Info</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="css/estiloTelaIniCad.css" rel="stylesheet" type="text/css"/>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    </head>
    <body class="colorido">
        <div class="container">
            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Entrar
                            <div style="float:right;"><a href="index.php"><i class='fas fa-home' style="font-size: 19px;color:white;"></i></a></div>
                        </div>
                    </div>
                    <div style="padding-top:30px" class="panel-body">
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <form id="loginform" class="form-horizontal" role="form" method="POST">
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" placeholder="Usuário" required="" name="user" value="">
                            </div>
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Senha" required="" name="senha" value="">
                            </div>
                            <div class="input-group">
                                <div class="checkbox">
                                    <label>
                                        <input id="login-remember" type="checkbox" name="remember" value="1"> Lembrar E-mail
                                    </label>
                                </div>
                            </div>
                            <div style="margin-top:10px" class="form-group">
                                <div class="col-sm-12 controls">
                                    <input class="btn btn-success" name="login" type="submit" value="Logar">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div class="alert alert-info" role="alert">
                                        Para sua segurança antes de contribuir realize login!
                                    </div>
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                        Você não possui uma conta?
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Cadastre-se
                                        </a>
                                    </div>
                                </div>
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
                                        if (isset($_POST['lembrar'])) {
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
                                        }
                                        //delimita o tempo de vida da sessão
                                        session_cache_expire(600);
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
                                            header('location:admin/');
                                        } else {
                                            header('location:upload.php');
                                        }
                                    }
                                }
                                $conexao->Desconecta(); //fim if....
                            }
                            if ($_REQUEST) {
                                if (@$_REQUEST['msg'] == md5('expirou')) {
                                    echo '<div class="alert alert-info">
                                <strong>expirou!!</strong> 
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
                        </form>
                    </div>
                </div>
            </div>
            <div id="signupbox" style="display:none; margin-top:50px"
                 class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Cadastre-se
                            <div style="float:right;"><a id="signinlink" href="#"
                                                         onclick="$('#signupbox').hide(); $('#loginbox').show()"><i
                                        class='fas fa-sign-in-alt' style="font-size: 19px;color:white;"></i></a></div>

                        </div>
                    </div>
                    <div class="panel-body">
                        <form id="signupform" class="form-horizontal" role="form" method="POST" action="indexModel.php">

                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Erro:</p>
                                <span></span>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-3 control-label">Nome</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="nome" placeholder="Nome" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="col-md-3 control-label">Usuário</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="usuario" placeholder="Usuário" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="col-md-3 control-label">Data de Nascimento</label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" name="data" placeholder="Data de Nascimento"
                                           required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-3 control-label">Senha</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="senha" placeholder="Senha" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- Button -->
                                <div class="col-md-offset-3 col-md-9">
                                    <input class="btn btn-success" type="submit" name="usuarioCadastro" value="Cadastrar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>