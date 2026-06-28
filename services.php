<?php

require_once "repository.php";
require_once "validator.php";

function enregistrerWallet(array $newWallet): void {
    while (!nomValide($newWallet['client'])) {
        echo "Votre nom ne doit pas être vide.\n";
        $newWallet['client'] = readline("Ressaisir un nom : ");
    }


    while (!telValide($newWallet['telephone'])) {
        echo "Votre numéro est invalide. Il doit commencer par 77, 78, 76, 70 ou 75 et comporter 9 chiffres.\n";
        $newWallet['telephone'] = readline("Ressaisir un numéro : ");
    }


    while (telExiste($newWallet['telephone'])) {
        echo "Ce numéro existe déjà.\n";
        $newWallet['telephone'] = readline("Ressaisir le numéro : ");
    }


    while (!codeValide($newWallet['code'])) {
        echo "Code invalide. Le code doit comporter 4 chiffres.\n";
        $newWallet['code'] = readline("Ressaisir le code : ");
    }


    while (codeUtilise($newWallet['code'])) {
        echo "Ce code est déjà utilisé.\n";
        $newWallet['code'] = readline("Ressaisir le code : ");
    }


    while (!soldeValide($newWallet['solde'])) {
        echo "Solde invalide. Le solde doit être un nombre positif ou zéro.\n";
        $newWallet['solde'] = readline("Ressaisir le solde : ");
    }

    
    $newWallet['solde'] = (int) $newWallet['solde'];
    ajoutWallet($newWallet);
}

function frais(int $montant): int {
    if ($montant <= 10000) {
        return 200;
    }

    if ($montant <= 100000) {
        return 500;
    }

    $result = (int) ($montant * 0.01);
    return $result > 5000 ? 5000 : $result;
}

function preparerTrans(array $newTrans, bool $isDepot): ?array {
    do {
        $index = trouverParTel($newTrans['telephone']);
        if ($index === -1) {
            echo "Numéro non existant, veuillez resaisir.\n";
            $newTrans['telephone'] = readline("Ressaisir le téléphone : ");
        }
    } while ($index === -1);

    if (!$isDepot) {
        $solde = $GLOBALS['wallets'][$index]['solde'];

        if ($solde <= 0) {
            echo "Votre solde est nul, vous ne pouvez pas faire de retrait.\n";
            return null;
        }

        do {
            $montantFrais = frais($newTrans['montant']);
            $total = $newTrans['montant'] + $montantFrais;

            if ($newTrans['montant'] <= 0 || $total > $solde) {
                echo "Montant invalide ou solde insuffisant.\n";
                echo "Frais : {$montantFrais} CFA\n";
                $newTrans['montant'] = (int) readline("Ressaisir le montant : ");
            }
        } while ($newTrans['montant'] <= 0 || ($newTrans['montant'] + frais($newTrans['montant'])) > $solde);
    }

    $newTrans['indexClient'] = $index;
    $newTrans['frais'] = 0;
    $newTrans['type'] = $isDepot ? 'Dépôt' : 'Retrait';

    return $newTrans;
}

function faireOperation(array $newTrans, bool $isDepot): void {
    $transaction = preparerTrans($newTrans, $isDepot);
    if ($transaction === null) {
        return;
    }

    if ($isDepot) {
        majSolde($transaction['indexClient'], $transaction['montant'], true);
    } else {
        $montantFrais = frais($transaction['montant']);
        $transaction['frais'] = $montantFrais;
        majSolde($transaction['indexClient'], $transaction['montant'] + $montantFrais, false);
        echo "Frais appliqués : {$montantFrais} CFA\n";
    }

    ajoutTrans($transaction);
}

function afficherWallets(): void {
    listerWallets();
}

function afficherTrans(): void {
    listerTransactions();
}
?>