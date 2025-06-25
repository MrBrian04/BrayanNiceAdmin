<?php

class Conexion{

    static public function conectar(){
<<<<<<< HEAD
        $link = new PDO("mysql:host=localhost:3307;dbname=nicelate_db","root","1234");
=======
        $link = new PDO("mysql:host=localhost:3306;dbname=nicelate_db","root","4706");
>>>>>>> f580668ffe5ac07f48f5dd66b35311be415f1902
        $link->exec("set names utf8");
        return $link;

    }
}