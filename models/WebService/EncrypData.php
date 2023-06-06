<?php  
   class EncrypData_
   {
       private string $Key;
       private string $Salt;
   
       public function __construct($key)
       {
           $this->Key = $this->CreateKey($key);
           $this->Salt = $this->CreateSalt($key);
       }
   
       public function cadenaDecrypt($value): string
       {
           $hash = hash_pbkdf2("sha1", $this->Key, mb_convert_encoding($this->Salt, 'UTF-16LE'), 1000, 32, true);
   
           $key = substr($hash, 0, 24);
           $iv = substr($hash, 24, 8);
           return iconv('UTF-16', 'UTF-8', openssl_decrypt($value, 'des-ede3-cbc', $key, 0, $iv));
       }
   
       public function cadenaEncrypt($value): string
       {
           $hash = hash_pbkdf2("sha1", $this->Key, mb_convert_encoding($this->Salt, 'UTF-16LE'), 1000, 32, true);
   
           $key = substr($hash, 0, 24);
           $iv = substr($hash, 24, 8);
           return openssl_encrypt(iconv('UTF-8', 'UTF-16', $value), 'des-ede3-cbc', $key, 0, $iv);
       }
   
       private function CreateKey($KeyBase): string
       {
           return $KeyBase . "56" . strrev($KeyBase) . "A9HHh";
       }
   
       private function CreateSalt($KeyBase): string
       {
           return $KeyBase . "12" . strrev($KeyBase) . "4576sdv";
       }
   }
   