<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['email'])) {
    $_SESSION['adicionaMenu'] = 'deslogado';
}
?>
<html lang="PT-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Torrents Info</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- MetisMenu CSS -->
    <link href="css/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><img src="img/logo.png" style="height: 25px;align-content: center;"></a>
            </div>
            <?php
            if (@$_SESSION['adicionaMenu'] == 'deslogado') {
                echo '<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-info" role="alert">
                    <a href="login.php">Clique aqui</a> e contribua com nosso site!
                </div>
            </div>
        </div>
    </div> 
            ';
            } elseif (@$_SESSION['adicionaMenu'] == 'Logado') {

                echo '<ul class="nav navbar-nav">
            <li class="active"><a href="upload.php">Upload</a></li>
        </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
            </ul>  
        ';
            }
            ?>
        </div>
    </nav>



    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Jogos</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Tabela de Jogos
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
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
                                    <th scope="col">Nome jogo</th>
                                    <th scope="col">Criador</th>
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
                                            <td>
                                                <a href="#" onclick="open('jogo/index.php?id=<?php echo $idUser; ?>','','status=no,Width=750,Height=800');"><?php echo $usuario['tituloJogo']; ?></a>
                                            </td>
                                            <td><?php echo $usuario['nomeUsuario']; ?></td>
                                            <td><?php echo $usuario['dataAtualizada']; ?></td>

                                        </tr>
                                <?php
                                    }
                                }

                                $conexao->Desconecta();
                                ?>

                            </tbody>
                        </table>

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- jQuery -->
    <script src="css/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="css/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="css/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="css/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="css/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="css/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="css/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>