<?php
require_once "app/modelos/role.model.php";

class RoleController{
    public static function ctrRoleSave(){
        if($_SERVER["REQUEST_METHOD"]=== "POST") {

            $rolName = trim($_POST["roleName"]);
            $rolDescription = trim($_POST["roleDescription"]);

            $data = [
                "rol_name" => $rolName,
                "rol_description" => $rolDescription,
            ];

            $response = RoleModel::mdlRoleSave($data);

            // Usar el sistema de mensajes con SweetAlert2
            $_SESSION["message"] = $response === "ok" ? "Rol registrado correctamente" : "Error al registrar rol";
            $_SESSION["message_type"] = $response === "ok" ? "success" : "error";
            header("Location: index.php?route=roles");
            exit;
        }
    }

    public static function ctrGetAllRoles(){
        return RoleModel::mdlGetAllRole();
    }
    public function ctrRoleAssign() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userId = $_POST["user"];
            $roleId = $_POST["role"];

            if (!$userId || !$roleId) {
                $_SESSION["message"] = "Debe seleccionar usuario y rol";
                $_SESSION["message_type"] = "error";
                header("Location: index.php?route=roles");
                exit;
            }

            $res = RoleModel::mdlAssignRoleToUser($userId, $roleId);

            if ($res === "ok") {
                $_SESSION["message"] = "Rol asignado correctamente";
                $_SESSION["message_type"] = "success";
            } elseif ($res === "exists") {
                $_SESSION["message"] = "El usuario ya tiene asignado ese rol";
                $_SESSION["message_type"] = "warning";
            } else {
                $_SESSION["message"] = "Error al asignar rol";
                $_SESSION["message_type"] = "error";
            }
            header("Location: index.php?route=roles");
            exit;
        }
    }

    public static function ctrRoleUpdate() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $roleId = $_POST["roleId"];
            $roleName = trim($_POST["roleName"]);
            $roleDescription = trim($_POST["roleDescription"]);

            // Validaciones
            if (empty($roleName)) {
                $_SESSION["message"] = "El nombre del rol es obligatorio.";
                $_SESSION["message_type"] = "error";
                header("Location: index.php?route=roles");
                exit;
            }
            if (strlen($roleName) < 3) {
                $_SESSION["message"] = "El nombre del rol debe tener al menos 3 caracteres.";
                $_SESSION["message_type"] = "error";
                header("Location: index.php?route=roles");
                exit;
            }
            if (empty($roleDescription)) {
                $_SESSION["message"] = "La descripción es obligatoria.";
                $_SESSION["message_type"] = "error";
                header("Location: index.php?route=roles");
                exit;
            }

            $data = [
                "role_id" => $roleId,
                "role_name" => $roleName,
                "role_description" => $roleDescription
            ];

            $response = RoleModel::mdlRoleUpdate($data);

            $_SESSION["message"] = $response === "ok" ? "Rol actualizado correctamente" : "Error al actualizar el rol";
            $_SESSION["message_type"] = $response === "ok" ? "success" : "error";
            header("Location: index.php?route=roles");
            exit;
        }
    }

    public static function ctrRoleDelete() {
        $response = RoleModel::mdlRoleDelete($_GET["id"]);

        if ($response === "ok") {
            $_SESSION["message"] = "Rol eliminado correctamente";
            $_SESSION["message_type"] = "success";
        } else {
            $_SESSION["message"] = "Error al eliminar el rol";
            $_SESSION["message_type"] = "error";
        }
        header("Location: index.php?route=roles");
        exit;
    }
}