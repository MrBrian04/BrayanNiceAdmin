<?php

class ControladorLogin{

    static public function crtIngresoUsuario(){

        if(isset($_POST["email"])){

            $table = "users";
            $email = "user_email";
            $value = $_POST["email"];

            $response = LoginModel::mdlInsertUser($table, $email, );


        }


    }

}