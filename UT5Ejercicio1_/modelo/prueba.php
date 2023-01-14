<?php


$hash_lolo = password_hash('lolo', PASSWORD_DEFAULT);
echo $hash_lolo;
echo '- lolo , ';
$hash_ana = password_hash('lolo', PASSWORD_DEFAULT);
echo $hash_ana;
echo '- ana , ';
$hash_isa = password_hash('isa', PASSWORD_DEFAULT);
echo $hash_isa;
echo '- isa , ';
$hash_pascual = password_hash('123', PASSWORD_DEFAULT);
echo $hash_pascual;
echo '- pascual, ';
$hash_pedro = password_hash('pedro', PASSWORD_DEFAULT);
echo $hash_pedro;
echo '- pedro';


