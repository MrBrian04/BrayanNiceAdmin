<?php

if (session_status() !== PHP_SESSION_ACTIVE){
    session_start(); 
}

require_once "app/controladores/plantilla.controlador.php";
require_once "app/controladores/login.controller.php";
require_once "app/modelos/login.model.php";

if(
    $_SERVER["REQUEST_METHOD"]=="POST" &&
    isset($_GET["route"], $_GET["action"]) &&
    $_GET["route"] === "login" &&
    $_GET["action"] === "verify"
    ){
        $loginController = new LoginController();
        $loginController->ctrVerifyUser();

}

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();