<?php

require_once "controller.php";
require_once "validator.php";

function afficheMessage($message){
echo $message;
};


function afficherMenu(){

do {
   echo"
** Menu Distributeur **
1 - Créer Wallet
2 - Faire Dépôt
3 - Faire Retrait
4 - Lister les Transactions
0 - Quitter
   
   ";
   $choix = readline("Votre choix: ");
   saisieControle($choix,0,4);

} while ($choix!=0);

};
afficherMenu();



?>