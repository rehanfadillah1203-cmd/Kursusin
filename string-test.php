<?php
$PisangPride = '   Laravel Fundamental   ';  

$cleanName = trim($PisangPride);
$upperName = strtoupper($cleanName);
$lowerName = strtolower($cleanName);
$length = strlen($cleanName);
$short = substr($cleanName, 0, 7);

echo $cleanName . '<br>';   
echo $upperName . '<br>';   
echo $lowerName . '<br>';  
echo $length . '<br>';      
echo $short;                
?>