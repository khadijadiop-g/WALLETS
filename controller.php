<?php

require_once "services.php";

function remplir(): array {
    return [
        'client' => readline("Veuillez saisir votre nom : "),
        'telephone' => readline("Veuillez saisir le numéro : "),
        'code' => readline("Veuillez saisir un code (4 chiffres) : "),
        'solde' => readline("Veuillez saisir votre solde : ")
    ];
}

function creer(): void {
    $wallet = remplir();
    enregistrerWallet($wallet);
}

function traiter(bool $isDepot): void {
    $transaction = [
        'telephone' => readline("Veuillez saisir le téléphone : "),
        'montant' => (int) readline("Veuillez saisir le montant de la transaction : ")
    ];

    faireOperation($transaction, $isDepot);
}


function voirTrans(): void {
    afficherTrans();
}

function voirWallets(): void {
    afficherWallets();
}
?>



