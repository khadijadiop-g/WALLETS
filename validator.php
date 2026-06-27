<?php

function saisieControle(int $saisi, int $min, int $max){
	if($saisi < $min || $saisi > $max){
		echo "Choix invalide, veuillez réessayer\n";
		return false;
	}
	return true;
}

function valideChamps($saisi): bool {
    return trim((string) $saisi) === '';
}




?>
