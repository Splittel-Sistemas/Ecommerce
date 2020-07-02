<?php
class Captcha{
    public function getCaptcha($SecretKey){
        $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LduuqgZAAAAAKYODCU7COuHGl87b7RyO_qGy9nx&response={$SecretKey}");
        $retorno = json_decode($respuesta);
        return $retorno;
    }
}