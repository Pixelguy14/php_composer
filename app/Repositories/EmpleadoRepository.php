<?php
namespace App\Repositories;

use App\Interfaces\EmpleadoInterface;
use PDO;

class EmpleadoRepository implements EmpleadoInterface{
    private $db;

    public function __construct(DPO $db){
        $this->db = $db;
    }

    public function getAll(){
        $select = $this->$db->query("SELECT * FROM empleados");
        return $select->fetchAll(PDO::FETCH_ASSOC); # indica que se regresa en forma de arreglo
    }

    public function getById($id) {
        $selectId = $this->$db->prepare("SELECT * FROM empleados where id = ?");
        $selectId->execute([$id]); # avoid sql inyection
        return $selectId->fetch(PDO::FETCH_ASSOC); # indica que se regresa en forma de arreglo
    }

    public function getByUser($usuario) {
        $selectUser = $this->$db->prepare("SELECT * FROM empleados where usuario = ?");
        $selectUser->execute([$usuario]); # avoid sql inyection
        return $selectUser->fetch(PDO::FETCH_ASSOC); # indica que se regresa en forma de arreglo
    }

    public function createEmpleado($data) {
        $insert = $this->$db->prepare("INSERT INTO empleados (nombre, apaterno, amaterno, direccion, telefono, ciudad, estado, usuario, password, rol) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $insert->execute([$data['nombre'],$data['apaterno'],$data['amaterno'],$data['direccion'],$data['telefono'],$data['ciudad'],$data['estado'],$data['usuario'],$data['password'],$data['rol']]);
    }

    public function updateEmpleado($id,$data) {
        $update = $this->$db->prepare("UPDATE empleados SET nombre = ?, apaterno = ?, amaterno = ?, direccion = ?, telefono = ?, ciudad = ?, estado = ?, password = ?, rol = ? WHERE id = ?");
        $update->execute([$data['nombre'],$data['apaterno'],$data['amaterno'],$data['direccion'],$data['telefono'],$data['ciudad'],$data['estado'],$data['usuario'],$data['password'],$data['rol'], $id]);
    }

    public function deleteEmpleado($id) {
        $delete = $this->$db->prepare("DELETE FROM empleados WHERE id = ?");
        $delete->execute([$id]);
    }

    public function buscarPorUsuarioNombre($usuario, $nombre, $apaterno, $amaterno){
        $select = $this->$db->prepare("SELECT * FROM empleados WHERE usuario = ? OR (nombre = ? AND apaterno = ? AND amaterno = ?");
        $select->execute([$usuario, $nombre, $apaterno, $amaterno]);
        return $select->fetch(PDO::FETCH_ASSOC); # indica que se regresa en forma de arreglo
    }
}
?>