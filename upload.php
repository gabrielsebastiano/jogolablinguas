<?php
//require_once './autentica.php';
require_once './ConexaoMysql.php';
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Jogos Info</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>

    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><img src="img/logo.png" style="height: 30px;align-content: center;"></a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="upload.php">Início</a></li>
                    <li><a href="index.php">Jogos disponíveis</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>

                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header branco"><?php
                        if ($_SESSION) {
                            echo 'Seja bem vindo(a): ' . @$_SESSION['nome'];
                        }
                        ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Inserir Arquivos
                            </div>


                            <div class="panel-body">
                                <form action="#" method="POST" enctype="multipart/form-data">
                                    <!-- A -->
                                    <div class="form-group">
                                        <label>Texto A</label>
                                        <input type="text" class="form-control" name="a" placeholder="Nome do arquivo ex(Meu malvado favorito)">
                                        <small id="emailHelp" class="form-text text-muted">Coloque um nome que faça sentido com
                                            o conteúdo no qual você está inserindo.
                                        </small>
                                    </div>

                                    <!-- ENVIO DO ARQUIVO -->

                                    <div class="form-group">
                                        <label>Imagem A</label>
                                        <input accept="image/jpeg,image/png,image/jpg" type="file" class="form-control-file" name="imgA">
                                    </div>
                                    <!--/ A -->
                                    <!-- B -->
                                    <div class="form-group">
                                        <label>Texto B</label>
                                        <input type="text" class="form-control" name="b" placeholder="Nome do arquivo ex(Meu malvado favorito)">
                                        <small id="emailHelp" class="form-text text-muted">Coloque um nome que faça sentido com
                                            o conteúdo no qual você está inserindo.
                                        </small>
                                    </div>

                                    <!-- ENVIO DO ARQUIVO -->

                                    <div class="form-group">
                                        <label>Imagem B</label>
                                        <input type="file" class="form-control-file" name="imgA">
                                    </div>
                                    <!--/ B -->

                                    <input type="submit" class="btn btn-primary" value="Enviar">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    </body>

</html>

<?php
// DEFINIÇÕES
// Numero de campos de upload
$numeroCampos = 5;
// Tamanho máximo do arquivo (em bytes)
$tamanhoMaximo = 1000000;
// Extensões aceitas
$extensoes = array(".jpg", ".png", ".jpeg");
// Caminho para onde o arquivo será enviado
$caminho = "upload/";
// Substituir arquivo já existente (true = sim; false = nao)
$substituir = false;

for ($i = 0; $i < $numeroCampos; $i++) {

    // Informações do arquivo enviado
    @$nomeArquivo = $_FILES["fileUpload"]["name"][$i];
    @$tamanhoArquivo = $_FILES["fileUpload"]["size"][$i];
    @$nomeTemporario = $_FILES["fileUpload"]["tmp_name"][$i];

    // Verifica se o arquivo foi colocado no campo
    if (!empty($nomeArquivo)) {

        $erro = false;

        // Verifica se o tamanho do arquivo é maior que o permitido
        if ($tamanhoArquivo > $tamanhoMaximo) {
            $erro = "O arquivo " . $nomeArquivo . " não deve ultrapassar " . $tamanhoMaximo . " bytes";
        }
        // Verifica se a extensão está entre as aceitas
        elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
            $erro = "A extensão do arquivo <b>" . $nomeArquivo . "</b> não é válida";
        }
        // Verifica se o arquivo existe e se é para substituir
        elseif (file_exists($caminho . $nomeArquivo) and ! $substituir) {
            $erro = "O arquivo <b>" . $nomeArquivo . "</b> já existe";
        }

        // Se não houver erro
        if (!$erro) {

            date_default_timezone_set("Brazil/East"); //Definindo timezone padrão

            $nomeS_E = strtolower(str_replace(" ", "_", $nomeArquivo)); //retira os espaços do nome que foi enviado via post S_E = SEM ESPAÇO e coloca minuscula

            $ext = strtolower(substr($nomeArquivo, -4)); //Pegando extensão do arquivo

            $nomeNovo = $nomeS_E . "_" . date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo (nome enviado/data/hora/extenção)
            // Move o arquivo para o caminho definido
            var_dump(move_uploaded_file($nomeTemporario, ($caminho . $nomeNovo)));
            // Mensagem de sucesso
            echo "O arquivo <b>" . $nomeArquivo . "</b> foi enviado com sucesso. <br />";
            $conexao = new ConexaoMysql();
            $conexao->Conecta();

            $sql = "INSERT INTO `jogo`(`A1`, `A2`) VALUES ("A1", $_FILES["fileUpload"]["name"][0], "A2", $_FILES["fileUpload"]['name"][1])";
        }
        // Se houver erro
        else {
            // Mensagem de erro
            echo $erro . "<br />";
        }
    }
}


// fecha else
/*
  $nomeArquivo = $_POST["nome'];
  $tipo = $_POST['tipo'];
  $seeds = $_POST['seeds'];

  date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
  $nomeS_E = strtolower(str_replace(" ", "_", $nomeArquivo)); //retira os espaços do nome que foi enviado via post S_E = SEM ESPAÇO e coloca minuscula

  $ext = strtolower(substr($_FILES['fileUpload']['name'], -4)); //Pegando extensão do arquivo

  $nomeNovo = $nomeS_E . "_" . date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo (nome enviado/data/hora/extenção)

  $dataHora = date("Y.m.d-H.i.s"); //SETA A DATA

  $dir = 'upload/'; //Diretório para uploads

  $tamanho = $_FILES['fileUpload']['size']; //tamanho

  $tamanhoNovo = $tamanho * 0.000001; //de kbtes para mb

  move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir . $nomeNovo); //Fazer upload do arquivo (AQUI ENVIA PARA PASTA)

  $conexao = new ConexaoMysql();
  $conexao->Conecta();

  $sql = "INSERT INTO torrent (nomeArquivo,tamanho,dataInsercao,tipo,seeds,nomeEnviado) VALUES ('$nomeNovo',$tamanhoNovo,'$dataHora',$tipo,$seeds,'$nomeArquivo')";

  if ($conexao->Executa($sql)) {
  echo ('<script>window.alert("Arquivo enviado com sucesso!");window.location="index.php";</script>');
  } else {
  echo 'ERRO AO INSERIR';
  }
 */
?>