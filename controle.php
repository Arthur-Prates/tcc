<?php

include_once("./config/constantes.php");
include_once("./config/conexao.php");
include_once("./func/funcoes.php");
$controle = filter_input(INPUT_POST, 'controle', FILTER_SANITIZE_STRING);

if (!empty($controle) && isset($controle)) {
    switch ($controle) {
        case '#':
            include_once('#.php');
            break;

    }

} else {
    ?>
    <div style="display: flex;justify-content: center;align-items: center; min-height: 95vh !important;">
        <h1>Página Vazia, Retorne. </h1><sup>Error 404</sup>
        <img src="img/vazio.gif" alt="ERROR 404">
    </div>
    <?php
}
