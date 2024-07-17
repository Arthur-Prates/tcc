<?php

session_start();
header('Content-Type: application/json');

// Verifica se o carrinho existe na sessão, caso contrário inicializa um carrinho vazio

$_SESSION['cart'] = [
    [
        'name' => 'Abacate',
        'quantity' => 1,
        'price' => 100
    ],
    [
        'name' => 'Caqui',
        'quantity' => 5,
        'price' => 560
    ]
];


// Dados do carrinho
$cart = $_SESSION['cart'];

echo json_encode([
    'items' => $cart,
]);

