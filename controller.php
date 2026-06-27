<?php

function saisirWallet(): array {
    $wallet = [
        'client' => '',
        'telephone' => '',
        'code' => 0,
        'solde' => 0
    ];

    $wallet['client'] = readline("Veuillez saisir Votre nom :");
    $wallet['telephone'] = readline("Veuillez saisir votre numero de telephone :");
    $wallet['code'] = (int) readline("Veuillez saisir un code :");
    $wallet['solde'] = (int) readline("Veuillez saisir votre solde :");

    return $wallet;
}

?>