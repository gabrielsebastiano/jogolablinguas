<!DOCTYPE html>

<html lang="pt-br">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Jovem & Tecnologia</title>
        <!-- Bootstrap Core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand text-center" href="index.php"><img style="height: 30px;" src="../Logo J_T pequeno.png" alt=""></a>

                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">

                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="">
                            <i class="fa fa-user fa-fw"></i> 
                        </a>
                       
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                          
                            <li>
                                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
                            </li>
                            <li>
                                <a href="tabelaUsuarios.php"><i class="fa fa-table fa-fw"></i> Tabela Usuários</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
               
                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Inserir Alunos
                            </div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <form method="POST" action="index.php">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control"  name="nome" placeholder="Username">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" name="email" placeholder="E-mail">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            <input type="text" class="form-control" name="senha" placeholder="Senha">
                                        </div>
                                        <br>
                                        <p>Selecione a quantidade de estrela?</p>
                                        <select name="estrelaI"class="form-control">
                                            <?php
                                            for ($i = 1; $i <= 20; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <br>
                                        <input type="submit" name="salvar" class="btn btn-default"></input>
                                    </form>
                                    <?php
                                    // Se o usu�rio clicou no bot�o cadastrar efetua as a��es

                                    if (@$_POST['salvar']) {
                                        $nome = $_POST['nome'];
                                        echo $nome;
                                        $email = $_POST['email'];
                                        $senha = $_POST['senha'];
                                       
                                        /* @var $query type */
                                        $query2 = $conexao->query("INSERT INTO alunos(nome,email,senha) VALUES ('$nome','$email','$senha')");

                                        echo '<div class = "alert alert-success alert-dismissable">
                                        <button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;
                                        </button>
                                        Usuario Cadastrado com sucesso</a>.
                                        </div>';
                                    }
                                    ?>

                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Atribuir estrelas
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Selecione o Aluno</label>
                                    <form method="POST" action="">
                                        <select name="aluno" class="form-control">
                                            <?php
                                            $conexao = mysqli_connect("$database", "$userbd", "$dbsenha", "$dbname");
                                            $query = $conexao->query("SELECT ID , nome, estrelas FROM alunos");
                                            while ($reg = $query->fetch_array()) {
                                                $usuario = $reg["nome"];
                                                echo '<option value="' . $reg["ID"] . '">' . $reg["nome"] . '(' . $reg["estrelas"] . ')</option>';
                                            }
                                            ?>    
                                        </select>
                                        <br>
                                        <p>Selecione a quantidade de estrela?</p>
                                        <select name="estrela"class="form-control">
                                            <?php
                                            for ($i = 1; $i <= 105; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <br>
                                        <button type="submit" class="btn btn-default">Enviar</button>
                                    </form>
                                    <?php
                                    if ($_POST) {
                                        $id = $_POST['aluno'];
                                        $qtd = $_POST['estrela'];
                                        $query = $conexao->query('UPDATE alunos SET estrelas = ' . $qtd . ' WHERE ID = ' . $id);
                                        ?>

                                        <script language="javascript">
                                            window.location.href = "index.php";
                                        </script>
                                        <?php
                                    }
                                    ?>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                 <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Inserir Administrador
                            </div>
                            <div class="panel-body">
                                <div class="form-group">

                                    <form method="POST" action="index.php">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control"  name="nome" placeholder="Username">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" name="email" placeholder="E-mail">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            <input type="text" class="form-control" name="senha" placeholder="Senha">
                                        </div>
                                        <br>
                                       
                                        <input type="submit" name="salvar" class="btn btn-default"></input>
                                    </form>
                                    <?php
                                    // Se o usu�rio clicou no bot�o cadastrar efetua as a��es

                                    if (@$_POST['salvar']) {
                                        $nome = $_POST['nome'];
                                        $email = $_POST['email'];
                                        $senha = $_POST['senha'];
                                        
                                        /* @var $query type */
                                        $query2 = $conexao->query("INSERT INTO alunos(nome,email,senha,estrelas) VALUES ('$nome','$email','$senha')");

                                        echo '<div class = "alert alert-success alert-dismissable">
                                        <button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;
                                        </button>
                                        Usuario Cadastrado com sucesso</a>.
                                        </div>';
                                    }
                                    ?>

                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="../vendor/raphael/raphael.min.js"></script>
        <script src="../vendor/morrisjs/morris.min.js"></script>
        <script src="../data/morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>

    </body>
</html>
