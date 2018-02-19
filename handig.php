<?php
session_start();
define('REALM', 'Restricted Area');

 function validatePassword($hashed_password, $password, $is_hashed = false)
    {
        if ($is_hashed === false)
        {
            $salt = substr($hashed_password, 0, 64);
            $hash = substr($hashed_password, 64, 64);
            $password_hash = hash('sha256', $salt . $password);
            return $password_hash === $hash;
        }
        return $password === $hashed_password;
    }

     function hashPassword($password)
    {
        $salt = bin2hex(random_bytes ( 32));
        $hash = hash('sha256', $salt . $password);

        return $salt . $hash;
    }

function alert($message) {
    echo '<script type="text/javascript">alert("' . "$message" . '")</script>';
}

function brk() {
    return "<br/>";
}

function recht_op($rechten, $recht) {
    return ($recht & $rechten) != 0;
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

