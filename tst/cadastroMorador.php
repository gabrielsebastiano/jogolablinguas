<!DOCTYPE html>
<?php
require_once 'autentica.php';
require_once 'ConexaoMysql.php';
?>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="img/logo.png">

        <title>SGCEU</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

        <!-- Page level plugin CSS-->
        <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin.css" rel="stylesheet">

    </head>

    <body id="page-top">


        <?php include 'menu.php'; ?>


        <div id="content-wrapper">

            <div class="container-fluid">

                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Inicio</a>
                    </li>                    <li class="breadcrumb-item active">Cadastro Morador</li>

                </ol><div class="container-fluid">
                    <?php
                    if ($_REQUEST) {
                        if (@$_REQUEST['msg'] == md5('cadastro')) {
                            echo '<div class="row"><div class="container"><div class="alert alert-success col-md-5" role="alert">
                    Morador cadastrado com sucesso.<a href="#" class="alert-link">Clique para consultar os agendamentos</a>. 
                  </div></div></div>';
                        }
                        if (@$_REQUEST['msg'] == md5('capacidmax')) {

                            echo '<div class="row"><div class="container"><div class="alert alert-danger col-md-5" role="alert">
                             O apartamento infomado já está com a capacidade máxima.
                  </div></div></div>';
                        }
                    }
                    ?>
                    <br>
                    <form class="was-validated" name="Cadastro" method="POST" action="indexModel.php" autocomplete="off" onsubmit="return checkall();">
                        <h3>Dados de Identificação</h3>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nome:  </label>
                                <input type="text" class="form-control" required name="nomeAluno">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nome social:  </label>
                                <input type="text" class="form-control" name="nomeSocial">
                                <small class="form-text text-muted">
                                    Opicional
                                </small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label>RG: </label>

                                <input type="number" class="form-control" required name="rgAluno">
                                <small class="form-text text-muted">
                                    Somento números
                                </small>
                            </div>
                            <div class="form-group col-md-2">
                                <label>CPF: </label>
                                <input type="number" class="form-control" required name="cpfAluno">
                                <small class="form-text text-muted">
                                    Somento números
                                </small>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Selecione a curso: </label>
                                <select class="form-control" required name="idCurso">
                                    <?php
                                    echo '<option> -- Selecione --</option>';

                                    $conexao = new ConexaoMysql();
                                    $conexao->Conecta();
                                    $sql = "SELECT * FROM cursos";
                                    $resultado = $conexao->Consulta($sql);

                                    if ($conexao->total != 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                            echo '<option value="' . $row["idCurso"] . '">' . $row["curso"] . '</option>';
                                        }
                                    } else {
                                        echo '<option>Nenhum curso cadastrado.</option>';
                                    }
                                    $conexao->Desconecta();
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Matricula:  </label>
                                <br>
                                <span id="name_status"></span>

                                <input type="number" class="form-control" required name="matricula" id="UserName" onkeyup="checkname();">
                            </div>
                        </div>
                        <h3>Contatos</h3>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>E-mail: </label>
                                <input type="email" class="form-control" required name="emailAluno">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Telefone para contato: </label>
                                <input type="text" class="form-control" required name="contatoAluno">
                                <small class="form-text text-muted">
                                    (00) 00000-0000
                                </small>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Telefone de emergencia: </label>
                                <input type="text" class="form-control" name="contatoEmergencia1">
                                <small class="form-text text-muted">
                                    (00) 00000-0000/ Opicional
                                </small>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Telefone de emergencia: </label>
                                <input type="text" class="form-control"  name="contatoEmergencia2">
                                <small class="form-text text-muted">
                                    (00) 00000-0000/ Opicional
                                </small>
                            </div>
                        </div>
                        <h3>Dados da Casa</h3>
                        <hr><div class="form-row">
                            <!--<div class="form-group col-md-3">
                                <label>Semestre: </label>
                                <select class="form-control" required name="semestre">
                                    <option value=""> -- Selecione --</option>
                                    <option value="1º Semestre <?php //echo date("Y"); ?> ">1º Semestre <?php// echo date("Y"); ?> </option>
                                    <option value="2º Semestre <?php //echo date("Y"); ?> ">2º Semestre <?php //echo date("Y"); ?></option>
                                </select>
                            </div>-->
                            <div class="form-group col-3">
                                <label>Data de entrada: </label>
                                <input type="date" class="form-control" required name="dataEntrada">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Selecione a apto: </label>

                                <select class="form-control" required name="idApto" id="UserApto">
                                    <?php
                                    echo '<option value="vazio"> -- Selecione --</option>';
                                    $conexao = new ConexaoMysql();
                                    $conexao->Conecta();
                                    //   $sql = "SELECT idApto ,numApto, tipoapartamento.tipo tipo FROM apartamentos INNER JOIN tipoapartamento ON tipoapartamento.idTipo = apartamentos.idTipo";
                                    $sql = "SELECT idApto ,numApto FROM apartamentos";
                                    $resultado = $conexao->Consulta($sql);
                                    if ($conexao->total != 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                            echo '<option  value="' . $row["idApto"] . '">' . $row["numApto"] . '</option>';
                                        }
                                    } else {
                                        echo '<option>Nenhum apartamento cadastrado.</option>';
                                    }
                                    $conexao->Desconecta();
                                    ?>
                                </select>
                                <br>
                                <button class="btn btn-secondary" type="button" onclick="checkapto();" >Verificar</button>
                                <br>
                                <p id="apto_status"></p>    
                            </div>

                        </div>
                        <h3>Dados PRAE</h3>
                        <hr>                       
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Benefício Socioeconômico:   </label>
                                <select class="form-control" required name="idBse">
                                    <?php
                                    $conexao = new ConexaoMysql();
                                    $conexao->Conecta();
                                    $sql = "SELECT * FROM bse";
                                    $resultado = $conexao->Consulta($sql);
                                    if ($conexao->total != 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                            echo '<option value="' . $row["idBse"] . '">' . $row["situacao"] . '</option>';
                                        }
                                    } else {
                                        echo '<option>Nenhuma situação encontrada</option>';
                                    }
                                    $conexao->Desconecta();
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="container">
                                <br><input name="cadastrarMorador" type="submit" class="align-items-center btn btn-primary" value="Cadastro" >
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>

            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Diretoria CEU II <?php echo date("Y"); ?></span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script type="text/javascript">

        function checkname()
        {
            var name = document.getElementById("UserName").value;

            if (name.length > 3)
            {
                $.ajax({
                    type: 'post',
                    url: 'checkdata.php',
                    data: {
                        user_name: name,
                    },
                    success: function (response) {
                        $('#name_status').html(response);
                        if (response == "OK")
                        {
                            return true;
                        } else
                        {
                            return false;
                        }
                    }
                });
            } else
            {
                $('#name_status').html("");
                return false;
            }

        }
        function checkapto()
        {
            var name = document.getElementById("UserApto").value;

            $.ajax({
                type: 'post',
                url: 'checkdata.php',
                data: {
                    user_apto: name,
                },
                success: function (response) {
                    $('#apto_status').html(response);
                    if (response == "OK")
                    {
                        return true;
                    } else
                    {
                        return false;
                    }
                }
            });


        }


        function checkall()
        {
            var namehtml = document.getElementById("name_status").innerText;
            //alert(namehtml);
            var aptohtml = document.getElementById("apto_status").innerText;
            //alert(namehtml);

            if (namehtml == "OK")
            {
                return true;
            } else
            {
                return false;
            }
            if (aptohtml == "OK")
            {
                return true;
            } else
            {
                return false;
            }
        }

    </script>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>