<?php

function creerWallet(array $wallets, array $newWallet): array {
	$wallets[] = $newWallet;
	return $wallets;
}

?>
