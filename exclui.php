<?php

// Script para deletar arquivos
// permissao 777
// unlink -> função do php para deletar arquivo 
function exclui($arquivoF)
{
    $arquivo = "upload/$arquivoF";
    if ($arquivo) {
        if (file_exists($arquivo)) {
            unlink($arquivo);
            echo ("<font color=\"green\">" . $arquivo . " deletado com sucesso!!");
        } else {
            echo ("<font color=\"red\">" . $arquivo . " não existe!</font>");
        }
    } else {
        echo "Especifique o nome do arquivo.";
    }
}