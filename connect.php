<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
        $host = 'www.burrp.nl';
        $user = 'paulhfu203_burrp';
        $password = 'pollie55';
        $database = 'paulhfu203_barapp';
        $poort=3306;
        
//        $host = 'localhost';
//        $user = 'root';
//        $password = 'pollie';
//        $database = 'test';
//        $poort=3306;
$db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
//$_SERVER['PHP_AUTH_DIGEST']=empty($_SERVER['PHP_AUTH_DIGEST']);



