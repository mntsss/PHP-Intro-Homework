<?php
declare(strict_types=1);
namespace NFQ;

use SebastianBergmann\Timer\Timer;
use \ParagonIE\EasyRSA\KeyPair;
use \ParagonIE\EasyRSA\EasyRSA;

class WithStrict{
  private $privateKey;
  private $publicKey;
  private $message;
  private $encryptedMessage;


  public function __call(string $name, array $args):void{
    Timer::start();
    call_user_func_array(array($this, $name), $args);
    $time = Timer::stop();
    echo "Method $name took $time sec. to complete.\n";
  }

  public function __get(string $name) {
      if (!property_exists($this, $name))
          echo "Property does not exist.";
      $accessor = "get" . ucfirst($name);
      if(method_exists($this, $accessor) && is_callable(array($this, $accessor)))
        return $this->$accessor();
  }

  private function generateKeys(int $size = 2048):void{

      $keyPair = KeyPair::generateKeyPair($size);
      $this->privateKey = $keyPair->getPrivateKey();
      $this->publicKey = $keyPair->getPublicKey();
  }

  private function encryptMessage(string $message = null):void{
    if(isset($message))
      $this->message = $message;
    $this->encryptedMessage = EasyRSA::encrypt($this->message, $this->publicKey);
  }

  private function decryptMessage(string $message = null):void{
    if(isset($message))
      $this->encryptedMessage = $message;
    $this->message = EasyRSA::decrypt($this->encryptedMessage, $this->privateKey);
  }

  private function signMessage(string $message = null):bool{
      if(isset($message))
          $this->message = $message;
      $signature = EasyRSA::sign($this->message, $this->privateKey);
      return true;
  }

  // getters

  public function getMessage():?string{
    return $this->message;
  }

  public function getKeys():array{
    return ['public' => $this->publicKey, 'private' => $this->privateKey];
  }

  public function getEncryptedMessage():?string{
    return $this->encryptedMessage;
  }
}
