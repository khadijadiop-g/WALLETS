<?php

$wallets = [
    ['client' => 'Baila Wane', 'telephone' => '771001010', 'code' => '1234', 'solde' => 0],
    ['client' => 'Hawa Baila Wane', 'telephone' => '774799479', 'code' => '0000', 'solde' => 100000]
];

$transactions = [
    ['montant' => 1000, 'indexClient' => 0, 'frais' => 0, 'type' => 'Dépôt'],
    ['montant' => 5000, 'indexClient' => 0, 'frais' => 0, 'type' => 'Retrait']
];

function ajoutWallet(array $newWallet): void {
    global $wallets;
    $wallets[] = $newWallet;
}

function ajoutTrans(array $newTrans): void {
    global $transactions;
    $transactions[] = $newTrans;
}

function listerWallets(): void {
    global $wallets;

    array_walk($wallets, function ($wallet, $index): void {
        echo "[{$index}] Titulaire : {$wallet['client']} | Téléphone : {$wallet['telephone']} | Solde : {$wallet['solde']}\n";
    });
}

function listerTransactions(): void {
    global $wallets, $transactions;

    array_walk($transactions, function ($transaction) use ($wallets): void {
        $indexClient = $transaction['indexClient'];
        $client = $wallets[$indexClient] ?? null;
        $nomClient = $client['client'] ?? 'Inconnu';
        echo "Type : {$transaction['type']} | Titulaire : {$nomClient} | Montant : {$transaction['montant']} | Frais : {$transaction['frais']}\n";
    });
}

function trouverParTel(string $telephone): int {
    global $wallets;

    $index = array_search(array_column($wallets, 'telephone'), $telephone, true);
    return $index === false ? -1 : (int) $index;
}

function trouverParCode(string $code): int {
    global $wallets;

    $index = array_search(array_column($wallets, 'code'), $code, true);
    return $index === false ? -1 : (int) $index;
}

function majSolde(int $index, int $montant, bool $addition): void {
    global $wallets;

    if (!isset($wallets[$index])) {
        return;
    }

    if ($addition) {
        $wallets[$index]['solde'] += $montant;
    } else {
        $wallets[$index]['solde'] -= $montant;
    }
}

?>

