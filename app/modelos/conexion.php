<?php

class Conexion{

    static public function conectar(){
        $link = new PDO("mysql:host=localhost:3307;dbname=nicelate_db","root","1234");
        $link->exec("set names utf8");
        return $link;

    }
}