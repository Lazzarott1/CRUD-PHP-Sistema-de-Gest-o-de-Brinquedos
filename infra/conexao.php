<?php

mysqli_report(MYSQLI_REPORT_OFF);

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "gestao_brinquedos_lazza";

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro na conexão com o banco: " . $conexao->connect_error);
};

$conexao->set_charset("utf8mb4");