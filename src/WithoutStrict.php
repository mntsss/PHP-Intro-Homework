<?php

namespace NFQ;
use SebastianBergmann\Timer\Timer;
use \ParagonIE\EasyRSA\KeyPair;

class WithoutStrict{

    protected $size;

    public function __construct($size)
    {
        $this->size = $size;

        Timer::start();

        $keys = $this->generateKeys($size);

        $time = Timer::stop();
        echo 'Time: '.$time;
        var_dump($keys);
    }

    private function generateKeys($size){

        $keyPair = KeyPair::generateKeyPair($size);
        $privateKey = $keyPair->getPrivateKey();
        $publicKey = $keyPair->getPublicKey();

        return ['private' => $privateKey, 'public' => $publicKey];
    }
}