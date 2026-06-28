<?php

require_once "controller.php";
require_once "validator.php";
require_once "repository.php";

$wallets = [];

do {
   echo"
** Menu Distributeur **
1 - Créer Wallet
2 - Faire Dépôt
3 - Faire Retrait
4 - Lister les Transactions
0 - Quitter
   
   ";
   $choix = trim(readline("Votre choix: "));

switch($choix){


case '1':
    newWallet();
    echo "Wallet créé avec succès.\n";
    break;

case '2':
    faireTransactionController(true);
    break;

case '3':
    faireTransactionController(false);
    break;

case '4':
    listerTransactions();
    break;

case '5':
    listerWallets();
    break;

case '0':
    echo "Au revoir !\n";
    break;

default:
    echo "Choix invalide, veuillez réessayer\n";
    break;

}

} while ($choix !== '0');


?>