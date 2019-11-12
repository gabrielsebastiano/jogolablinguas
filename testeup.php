<?php
//require_once 'autentica.php';
require_once 'ConexaoMysql.php';
function upload($nomeArquivo, $tamanhoArquivo, $nomeTemporario)
{
    // DEFINIÇÕES
    // Numero de campos de upload
    // Tamanho máximo do arquivo (em bytes)
    $tamanhoMaximo = 10000000000000;
    // Extensões aceitas
    $extensoes = array(".jpg", ".png", ".jpeg");
    // Caminho para onde o arquivo será enviado
    $caminho = "upload/";
    // Substituir arquivo já existente (true = sim; false = nao)
    //$substituir = false;

    if (!empty($nomeArquivo)) {

        $erro = false;

        // Verifica se o tamanho do arquivo é maior que o permitido
        if ($tamanhoArquivo > $tamanhoMaximo) {
            $erro = "O arquivo " . $nomeArquivo . " não deve ultrapassar " . $tamanhoMaximo . " bytes";
        }
        // Verifica se a extensão está entre as aceitas
        if (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
            $erro = "A extensão do arquivo <b>" . $nomeArquivo . "</b> não é válida";
        }
        // Verifica se o arquivo existe e se é para substituir
        //elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
        //   $erro = "O arquivo <b>" . $nomeArquivo . "</b> já existe";
        //}

        // Se não houver erro
        if (!$erro) {

            date_default_timezone_set("Brazil/East"); //Definindo timezone padrão

            $nomeS_E = strtolower(str_replace(" ", "_", $nomeArquivo)); //retira os espaços do nome que foi enviado via post S_E = SEM ESPAÇO e coloca minuscula

            $ext = strtolower(substr($nomeArquivo, -4)); //Pegando extensão do arquivo
            $h = "3"; //HORAS DO FUSO ((BRASÍLIA = -3) COLOCA-SE SEM O SINAL -).
            $hm = $h * 60;
            $ms = $hm * 60;
            //COLOCA-SE O SINAL DO FUSO ((BRASÍLIA = -3) SINAL -) ANTES DO ($ms). DATA
            $gmdata = gmdate("Y.m.d", time() - ($ms));
            //COLOCA-SE O SINAL DO FUSO ((BRASÍLIA = -3) SINAL -) ANTES DO ($ms). HORA
            $gmhora = gmdate("H.i.s", time() - ($ms));
            $nomeNovo = $nomeS_E . "_" . $gmdata . "-" . $gmhora . $ext; //Definindo um novo nome para o arquivo (nome enviado/data/hora/extenção)
            // Move o arquivo para o caminho definido
            move_uploaded_file($nomeTemporario, ($caminho . $nomeNovo));
            // Mensagem de sucesso
            echo "O arquivo <b>" . $nomeNovo . "</b> foi enviado com sucesso. <br />";
        }
        // Se houver erro
        else {
            // Mensagem de erro
            echo $erro . "<br />";
        }
    }
    return $nomeNovo;
}

if ($_POST['enviar']) {
    echo "OI";
    $imagemA = upload($_FILES["imgA"]["name"], $_FILES["imgA"]["size"], $_FILES["imgA"]["tmp_name"]);
    $imagemB = upload($_FILES["imgB"]["name"], $_FILES["imgB"]["size"], $_FILES["imgB"]["tmp_name"]);
    $imagemC = upload($_FILES["imgC"]["name"], $_FILES["imgC"]["size"], $_FILES["imgC"]["tmp_name"]);
    $imagemD = upload($_FILES["imgD"]["name"], $_FILES["imgD"]["size"], $_FILES["imgD"]["tmp_name"]);
    $imagemE = upload($_FILES["imgE"]["name"], $_FILES["imgE"]["size"], $_FILES["imgE"]["tmp_name"]);
    $imagemF = upload($_FILES["imgF"]["name"], $_FILES["imgF"]["size"], $_FILES["imgF"]["tmp_name"]);


    $nomeA = $_POST['a'];
    $nomeB = $_POST['b'];
    $nomeC = $_POST['c'];
    $nomeD = $_POST['d'];
    $nomeE = $_POST['e'];
    $nomeF = $_POST['f'];

    //$idUsuario = $_SESSION['id'];
    $tituloJogo = $_POST['titulo'];
    $idUsuario = 34;
    //DatA
    $h = "3"; //HORAS DO FUSO ((BRASÍLIA = -3) COLOCA-SE SEM O SINAL -).
    $hm = $h * 60;
    $ms = $hm * 60;
    //COLOCA-SE O SINAL DO FUSO ((BRASÍLIA = -3) SINAL -) ANTES DO ($ms). DATA
    $gmdata = gmdate("Y-m-d", time() - ($ms));
    //COLOCA-SE O SINAL DO FUSO ((BRASÍLIA = -3) SINAL -) ANTES DO ($ms). HORA
    $gmhora = gmdate("g:i:s", time() - ($ms));
    $dataCriacao = $gmdata;

    $conexao = new ConexaoMysql();
    $conexao->Conecta();

    $sql = "INSERT INTO `jogo`(`A1`, `A2`,`B1`, `B2`,`C1`, `C2`,`D1`, `D2`,`E1`, `E2`,`F1`, `F2`,idUsuario,tituloJogo,dataCriacao) VALUES ('$nomeA', '$imagemA','$nomeB', '$imagemB','$nomeC', '$imagemC','$nomeD', '$imagemD','$nomeE', '$imagemE','$nomeF', '$imagemF',$idUsuario,'$tituloJogo','$dataCriacao')";

    $conexao->Executa($sql);
    $conexao->Desconecta();

    header('location:indexProfessor.php?msg=' . $msg);
}
