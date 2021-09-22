<?php
class criptografarSenha
{
    public function criptografar($senha)
    {
        $opt = [
            'cost' => 8,
            'salt' => 'math3uS8v1n1c10Sh7nlv5'
        ];
        
        $hash = password_hash(md5(sha1(strrev($senha))),  PASSWORD_BCRYPT, $opt);
        return $hash; //md5(sha1(base64_encode($senha)))
    }
}
