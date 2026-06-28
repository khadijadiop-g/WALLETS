<?php

require_once "repository.php";

function nomValide($nom): bool {
    return trim((string) $nom) !== '';
}
  


function telValide(string $numero): bool {
    return preg_match('/^(77|78|76|70|75)\d{7}$/', $numero) === 1;
}


function codeValide($code): bool {
    return preg_match('/^\d{4}$/', (string) $code) === 1;
}



function soldeValide($solde): bool {
    return is_numeric($solde) && (int) $solde >= 0;
}


function telExiste(string $numero): bool {
    global $wallets;

    return in_array($numero, array_column($wallets, 'telephone'), true);
}

function codeUtilise($code): bool {
    global $wallets;

    return in_array((string) $code, array_map(fn($wallet) => (string) $wallet['code'], $wallets), true);
}
?>

