<?php
$idJogo = @$_REQUEST['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Jogo da Memoria - LabLinguas</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div id="loading" style="display: block">
        <div class="container">
            <img src="http://media.giphy.com/media/FwviSlrsfa4aA/giphy.gif" style="width:150px;height:150px;text-align: center;" />

        </div>
    </div>
    <div id="conteudo" style="display: none">

        <?php if (isset($idJogo)) { ?>
            <section class="memory-game">

                <!--A-->
                <?php
                    require_once '../ConexaoMysql.php';
                    $conexao = new ConexaoMysql();
                    $conexao->Conecta();
                    $sql = "SELECT A1,A2 FROM `jogo` WHERE idJogo = $idJogo";

                    $resultado = $conexao->Consulta($sql);
                    ?>
                <?php
                    if ($conexao->total != 0) {
                        foreach ($resultado as $usuario) {
                            ?>
                        <div class="memory-card" data-framework="A">
                            <div class="front-face">
                                <h1 class="h1"> <?php echo $usuario['A1']; ?></h1>
                            </div>
                            <img class="back-face" src="img/logo.png" alt="JS Badge" />
                        </div>
                        <div class="memory-card" data-framework="A">
                            <img class="front-face" src="../upload/<?php echo $usuario['A2']; ?>" alt="A2" />
                            <img class="back-face" src="img/logo.png" alt="JS Badge" />
                        </div>
                <?php
                        }
                    }

                    $conexao->Desconecta();
                    ?>

                <!--B -->
                <?php
                    require_once '../ConexaoMysql.php';
                    $conexao = new ConexaoMysql();
                    $conexao->Conecta();
                    $sql = "SELECT B1,B2 FROM `jogo` WHERE idJogo = $idJogo";
                    $resultado = $conexao->Consulta($sql);
                    ?>
                <?php
                    if ($conexao->total != 0) {
                        foreach ($resultado as $usuario) {
                            ?>
                        <div class="memory-card" data-framework="B">
                            <div class="front-face">
                                <h1 class="h1"> <?php echo $usuario['B1']; ?></h1>
                            </div>
                            <img class="back-face" src="img/logo.png" alt="JS Badge" />
                        </div>
                        <div class="memory-card" data-framework="B">
                            <img class="front-face" src="../upload/<?php echo $usuario['B2']; ?>" alt="B2" />
                            <img class="back-face" src="img/logo.png" alt="JS Badge" />
                        </div>
                <?php
                        }
                    }

                    $conexao->Desconecta();
                    ?>
                <!--C  -->
                <?php
                    require_once '../ConexaoMysql.php';
                    $conexao = new ConexaoMysql();
                    $conexao->Conecta();
                    $sql = "SELECT C1,C2 FROM `jogo` WHERE idJogo = $idJogo";
                    $resultado = $conexao->Consulta($sql);
                    ?>
                <?php
                    if ($conexao->total != 0) {
                        foreach ($resultado as $usuario) {
                            ?>
                        <div class="memory-card" data-framework="C">
                            <div class="front-face">
                                <h1 class="h1"> <?php echo $usuario['C1']; ?></h1>
                            </div>
                            <img class="back-face" src="img/logo.png" alt="JS Badge" />
                        </div>
                        <div class="memory-card" data-framework="C">
                            <img class="front-face" src="../upload/<?php echo $usuario['C2']; ?>" alt="C2" />
                            <img class="back-face" src="img/logo.png" alt="JS Badge" />
                        </div>
                <?php
                        }
                    }

                    $conexao->Desconecta();
                    ?>
                <!--D-->
                <?php
                    require_once '../ConexaoMysql.php';
                    $conexao = new ConexaoMysql();
                    $conexao->Conecta();
                    $sql = "SELECT D1,D2 FROM `jogo` WHERE idJogo = $idJogo";
                    $resultado = $conexao->Consulta($sql);
                    ?>
                <?php
                    if ($conexao->total != 0) {
                        foreach ($resultado as $usuario) {
                            ?>
                        <div class="memory-card" data-framework="D">
                            <div class="front-face">
                                <h1 class="h1"> <?php echo $usuario['D1']; ?></h1>
                            </div>
                            <img class="back-face" src="img/logo.png" alt="JS Badge" />
                        </div>
                        <div class="memory-card" data-framework="D">
                            <img class="front-face" src="../upload/<?php echo $usuario['D2']; ?>" alt="D2" />
                            <img class="back-face" src="img/logo.png" alt="JS Badge" />
                        </div>
                <?php
                        }
                    }

                    $conexao->Desconecta();
                    ?>
                <!--E  -->
                <?php
                    require_once '../ConexaoMysql.php';
                    $conexao = new ConexaoMysql();
                    $conexao->Conecta();
                    $sql = "SELECT E1,E2 FROM `jogo` WHERE idJogo = $idJogo";
                    $resultado = $conexao->Consulta($sql);
                    ?>
                <?php
                    if ($conexao->total != 0) {
                        foreach ($resultado as $usuario) {
                            ?>
                        <div class="memory-card" data-framework="E">
                            <div class="front-face">
                                <h1 class="h1"> <?php echo $usuario['E1']; ?></h1>
                            </div>
                            <img class="back-face" src="img/logo.png" alt="JS Badge" />
                        </div>
                        <div class="memory-card" data-framework="E">
                            <img class="front-face" src="../upload/<?php echo $usuario['E2']; ?>" alt="E2" />
                            <img class="back-face" src="img/logo.png" alt="JS Badge" />
                        </div>
                <?php
                        }
                    }

                    $conexao->Desconecta();
                    ?>
                <!--F-->
                <?php
                    require_once '../ConexaoMysql.php';
                    $conexao = new ConexaoMysql();
                    $conexao->Conecta();
                    $sql = "SELECT F1,F2 FROM `jogo` WHERE idJogo = $idJogo";
                    $resultado = $conexao->Consulta($sql);
                    ?>
                <?php
                    if ($conexao->total != 0) {
                        foreach ($resultado as $usuario) {
                            ?>
                        <div class="memory-card" data-framework="F">
                            <div class="front-face">
                                <h1 class="h1"> <?php echo $usuario['F1']; ?></h1>
                            </div>
                            <img class="back-face" src="img/logo.png" alt="JS Badge" />
                        </div>
                        <div class="memory-card" data-framework="F">
                            <img class="front-face" src="../upload/<?php echo $usuario['F2']; ?>" alt="F2" />
                            <img class="back-face" src="img/logo.png" alt="JS Badge" />
                        </div>
                <?php
                        }
                    }

                    $conexao->Desconecta();
                    ?>
            </section>
        <?php } else {
            header('Location: ../index.php');
        } ?>
    </div>
    <script src="scripts.js"></script>


</body>

</html>