<?php
// test-translate.php
require 'azure-translator.php';

$orig = "Hola mundo!";
$tran = azureTranslate($orig, 'en', 'es');

echo "<p>Original: {$orig}</p>";
echo "<p>Traducido: {$tran}</p>";
