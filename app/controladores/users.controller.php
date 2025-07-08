<?php

require_once "app/modelos/users.model.php";

class UserController{
    public static function ctrUserSave(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $userName = trim($_POST["userName"]);
            $userEmail = filter_var($_POST["userEmail"],FILTER_VALIDATE_EMAIL);
            $userPassword = $_POST["userPassword"];

            $passwordHash = password_hash($userPassword,PASSWORD_DEFAULT);

            $data = [
                "user_name" => $userName,
                "user_email" => $userEmail,
                "user_password" => $passwordHash
            ];

            $response = UserModel::mdlUserSave($data);

                $_SESSION["message"] = $response === "ok" ? "Usuario guardar correctamente" : "Error al guardar el usuario";
                $_SESSION["message_type"] = $response === "ok" ? "success" : "error";

                header("Location: index.php?route=users");
                exit;


        }
    }
    public static function ctrGetAllUsers(){
        return UserModel::mdlGetAllUsers();
    }

    public static function ctrUserUpdate(){

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $userId = $_POST["userId"];
            $userName = trim($_POST["userName"]);
            $userEmail = filter_var($_POST["userEmail"],FILTER_VALIDATE_EMAIL);
            $userPassword = $_POST["userPassword"];


            $data = [
                "user_id" => $userId,
                "user_name" => $userName,
                "user_email" =>$userEmail                
            ];

            //Si ingreso una nueva contraseña, la encriptamos

            if(!empty($userPassword)){
                $passwordHash =password_hash($userPassword, PASSWORD_DEFAULT);
                $data["user_password"] = $passwordHash;
            }

            $response = UserModel::mdlUserUpdate($data);


                $_SESSION["message"] = $response === "ok" ? "Usuario actualizado correctamente" : "Error al actualizar el usuario";
                $_SESSION["message_type"] = $response === "ok" ? "success" : "error";

                header("Location: index.php?route=users");
                exit;

        }
    }

    public static function ctrUserDelete($id){
        $response = UserModel::mdlUserDelete($id);//resibe el ok o el error de la consulta del modelo

        session_start();
        if ($response=== "ok"){
            $_SESSION["message"] = "Usuario eliminado correctamente";
            $_SESSION["message_type"] = "success";

        }else{
            $_SESSION["message"] = "Error al eliminar usuario";
            $_SESSION["message_type"] = "error";
        }
        header("Location: index.php?route=users");
        exit;

    }






}
