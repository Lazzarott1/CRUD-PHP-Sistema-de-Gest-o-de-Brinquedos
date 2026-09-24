<?php

function validarBrinquedo($nome_brinquedo, $categoria, $faixa_etaria, $preco, $quantidade_estoque)
{
    $erros = [];

    if ($nome_brinquedo === '' || mb_strlen($nome_brinquedo) > 100) {
        $erros[] = "O nome é obrigatório e deve ter no máximo 100 caracteres.";
    }

    if ($categoria === '' || mb_strlen($categoria) > 50) {
        $erros[] = "A categoria é obrigatória e deve ter no máximo 50 caracteres.";
    }

    if ($faixa_etaria === '' || mb_strlen($faixa_etaria) > 30) {
        $erros[] = "A faixa etária é obrigatória e deve ter no máximo 30 caracteres.";
    }

    if (!is_numeric($preco) || $preco <= 0) {
        $erros[] = "O preço deve ser um número maior que zero.";
    }

    if (filter_var($quantidade_estoque, FILTER_VALIDATE_INT) === false || $quantidade_estoque < 0) {
        $erros[] = "A quantidade em estoque deve ser um número inteiro maior ou igual a zero.";
    }

    return $erros;
}