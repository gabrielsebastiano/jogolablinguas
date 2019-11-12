<?php
include ('../config.php');
$nome_arquivo = $_POST['nome_arquivo'];
header("Content-type: application/vnd.ms-excel");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=$nome_arquivo.xls");
header("Pragma: no-cache");
?>
<table>
    <tr>
        <td>Nome</td>
        <td>Qtd de estrelas</td>
    </tr>
    <?php
    $conexao = mysqli_connect("$database", "$userbd", "$dbsenha", "$dbname");
    $query = $conexao->query("SELECT nome, estrelas FROM alunos");
    while ($reg = $query->fetch_array()) {
        echo "<tr><td>" . $reg['nome'] . "</td><td>" . $reg['estrelas'] . "</td></tr>";
    }
    ?>   
</table>