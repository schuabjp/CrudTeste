<?php
//faz a conexão com o banco de dados
$nomeServidor = "localhost";
$nomeUsuario = "root";
$senha = "";

try {
    $conexao = new PDO("mysql:host=$nomeServidor; dbname=TesteInstar", $nomeUsuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar: $e->getMessage()";
}
