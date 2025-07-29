<?php

require_once "conexion.php";

class RoleModel{
    public static function mdlRoleSave($data){
        $stmt = Conexion::conectar()->prepare("INSERT INTO roles (role_name, role_description) VALUES (:role, :description)");
        $stmt->bindParam(":role", $data["rol_name"], PDO::PARAM_STR);
        $stmt->bindParam(":description", $data["rol_description"], PDO::PARAM_STR);

        return $stmt->execute() ? "ok" : "error";
    }

    public static function mdlGetAllRole(){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM roles");
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlAssignRoleToUser($userId, $roleId) {
        // Verificar si ya existe la relación
        $check = Conexion::conectar()->prepare("SELECT 1 FROM user_role WHERE fk_id_user = :user AND fk_id_role = :role");
        $check->bindParam(":user", $userId, PDO::PARAM_INT);
        $check->bindParam(":role", $roleId, PDO::PARAM_INT);
        $check->execute();

        if ($check->fetch()) {
            return "exists"; // Ya existe la relación
        }

        $stmt = Conexion::conectar()->prepare("INSERT INTO user_role (fk_id_user, fk_id_role) VALUES (:user, :role)");
        $stmt->bindParam(":user", $userId, PDO::PARAM_INT);
        $stmt->bindParam(":role", $roleId, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function mdlRoleUpdate($data) {
        $stmt = Conexion::conectar()->prepare("UPDATE roles SET role_name = :name, role_description = :description WHERE pk_id_role = :id");
        $stmt->bindParam(":name", $data["role_name"], PDO::PARAM_STR);
        $stmt->bindParam(":description", $data["role_description"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $data["role_id"], PDO::PARAM_INT);
        return $stmt->execute() ? "ok" : "error";
    }

    public static function mdlRoleDelete($id) {
        $db = Conexion::conectar();
        $sql = "DELETE FROM roles WHERE pk_id_role = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute() ? "ok" : "error";
    }

}