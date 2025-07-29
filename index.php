<?php

if (session_status() !== PHP_SESSION_ACTIVE){
    session_start(); 
}

require_once "app/controladores/plantilla.controlador.php";
require_once "app/controladores/login.controller.php";
require_once "app/modelos/login.model.php";
require_once "app/controladores/users.controller.php";
require_once "app/modelos/users.model.php";
require_once "app/modelos/conexion.php";
require_once "app/controladores/role.controller.php";
require_once "app/modelos/role.model.php";


//iniciar sesion
if(
    $_SERVER["REQUEST_METHOD"]==="POST" &&
    isset($_GET["route"], $_GET["action"]) &&
    $_GET["route"] === "login" &&
    $_GET["action"] === "verify"
    ){
        $loginController = new LoginController();
        $loginController->ctrVerifyUser();
        exit;

}

//registrar usuarios
if(
    $_SERVER["REQUEST_METHOD"]==="POST" &&
    isset($_GET["route"], $_GET["action"]) &&
    $_GET["route"] === "users" &&
    $_GET["action"] === "save"
    ){
        $userController = new UserController();
        $userController->ctrUserSave();
        exit;

}

//registrar rol
if(
    $_SERVER["REQUEST_METHOD"]==="POST" &&
    isset($_GET["route"], $_GET["action"]) &&
    $_GET["route"] === "role" &&
    $_GET["action"] === "save"
    ){
        $roleController = new RoleController();
        $roleController->ctrRoleSave();
        exit;

}

//registrar rol al usuario
if(
    $_SERVER["REQUEST_METHOD"]==="POST" &&
    isset($_GET["route"], $_GET["action"]) &&
    $_GET["route"] === "roleUser" &&
    $_GET["action"] === "assign"
    ){
        $roleAssingController = new RoleController();
        $roleAssingController->ctrRoleAssign();
        exit;

}

// Actualizar usuarios
if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_GET["route"], $_GET["action"]) &&
    $_GET["route"] === "users" &&
    $_GET["action"] === "update"
    ){
    $userController = new UserController();
    $userController->ctrUserUpdate();
    exit;
}

// Eliminar usuarios
if (
    $_SERVER["REQUEST_METHOD"] === "GET" &&
    isset($_GET["route"], $_GET["action"],$_GET["id"]) &&
    $_GET["route"] === "users" &&
    $_GET["action"] === "delete" 
    ){
    $userController = new UserController();
    $userController->ctrUserDelete((int)$_GET["id"]);
    exit;
}

// Actualizar roles
if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_GET["route"], $_GET["action"]) &&
    $_GET["route"] === "roles" &&
    $_GET["action"] === "update"
){
    $roleController = new RoleController();
    $roleController->ctrRoleUpdate();
    exit;
}

// Eliminar roles
if (
    $_SERVER["REQUEST_METHOD"] === "GET" &&
    isset($_GET["route"], $_GET["action"], $_GET["id"]) &&
    $_GET["route"] === "roles" &&
    $_GET["action"] === "delete"
){
    $roleController = new RoleController();
    $roleController->ctrRoleDelete();
    exit;
}

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();