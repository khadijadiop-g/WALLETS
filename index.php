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
    $wallets = newWallet($wallets);
    echo "Wallet créé avec succès.\n";
    break;

case '2':
    echo "Fonction dépôt non implémentée pour le moment.\n";
    break;

case '3':
    echo "Fonction retrait non implémentée pour le moment.\n";
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