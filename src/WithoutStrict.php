<?php

namespace NFQ;

use SebastianBergmann\Timer\Timer;
use \ParagonIE\EasyRSA\KeyPair;
use \ParagonIE\EasyRSA\EasyRSA;

class WithoutStrict{

    private $privateKey;
    private $publicKey;
    private $message;
    private $encryptedMessage;

    public function __call($name, $args){
      Timer::start();
      call_user_func_array(array($this, $name), $args);
      $time = Timer::stop();
      echo "Method $name took $time sec. to complete.\n";
    }

    public function __get($name) {
        if (!property_exists($this, $name))
            echo "Property does not exist.";
        $accessor = "get" . ucfirst($name);
        if(method_exists($this, $accessor) && is_callable(array($this, $accessor)))
          return $this->$accessor();
    }

    private function generateKeys($size = 2048){

        $keyPair = KeyPair::generateKeyPair($size);
        $this->privateKey = $keyPair->getPrivateKey();
        $this->publicKey = $keyPair->getPublicKey();
    }

    private function encryptMessage($message = null){
      if(isset($message))
        $this->message = $message;
      $this->encryptedMessage = EasyRSA::encrypt($this->message, $this->publicKey);
    }

    private function decryptMessage($message = null){
      if(isset($message))
        $this->encryptedMessage = $message;
      $this->message = EasyRSA::decrypt($this->encryptedMessage, $this->privateKey);
    }

    // getters

    public function getMessage(){
      return $this->message;
    }

    public function getKeys(){
      return ['public' => $this->publicKey, 'private' => $this->privateKey];
    }

    public function getEncryptedMessage(){
      return $this->encryptedMessage;
    }
}
