<?php

require_once "repository.php";
require_once "validator.php";

function saisirWallet(): array {
    $wallet = [
        'client' => '',
        'telephone' => '',
        'code' => 0,
        'solde' => 0
    ];

do {
    $wallet['client'] = readline("Veuillez saisir votre nom : ");
    if (valideChamps($wallet['client'])) {
        echo "Veuillez remplir le champ \n";
        continue;
    }
    break;
} while (true);

do {
    $wallet['telephone'] = readline("Veuillez saisir le numéro : ");
    if (valideChamps($wallet['telephone'])) {
        echo "Veuillez remplir le champ \n";
        continue;
    }
    break;
} while (true);

do {
    $codeInput = readline("Veuillez saisir un code : ");
    if (valideChamps($codeInput)) {
        echo "Veuillez remplir le champ \n";
        continue;
    }
    $wallet['code'] = (int) $codeInput;
    break;
} while (true);

do {
    $soldeInput = readline("Veuillez saisir votre solde : ");
    if (valideChamps($soldeInput)) {
        echo "Veuillez remplir le champ \n";
        continue;
    }
    $wallet['solde'] = (int) $soldeInput;
    break;
} while (true);

    return $wallet;
}

function newWallet(array $wallets): array {
    $newWallet = saisirWallet();
    return creerWallet($wallets, $newWallet);
}
?>

