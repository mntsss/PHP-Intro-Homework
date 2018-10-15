<?php

require __DIR__ . '/vendor/autoload.php';

use NFQ\WithoutStrict;
use NFQ\WithStrict;

// Without strict & type hints
echo "Without strict & type hinting".PHP_EOL;
$instNotStrict = new WithoutStrict();

//generating given bit size public & private keys
$instNotStrict->generateKeys(4096);

// encrypting a message, if no params given - takes message from object's private property
$instNotStrict->encryptMessage("Hello world!");
echo "Encrypted message:".PHP_EOL;
echo $instNotStrict->encryptedMessage.PHP_EOL;

// decrypts a message from object's encryptedMessage property value
$instNotStrict->decryptMessage();
echo "Decrypted message:".PHP_EOL.$instNotStrict->message.PHP_EOL;


//With strict & type hinting
echo "With strict & type hinting".PHP_EOL;
$instStrict = new WithStrict();
$instStrict->generateKeys(4096);
$instStrict->encryptMessage("Hello strict world!");
echo "Encrypted message:".PHP_EOL;
echo $instStrict->encryptedMessage.PHP_EOL;
$instStrict->decryptMessage();
echo "Decrypted message:".PHP_EOL.$instStrict->message.PHP_EOL;



