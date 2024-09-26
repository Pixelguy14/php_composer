<?php
namespace App\Services;

use App\Repositories\EmpleadoRepository;

class EmpleadoService {
    private $empleadoRepository;
    public function __construct(EmpleadoRepository $empleadoRepository){
        $this->empleadoRepository = $empleadoRepository;
    }

    public function getAll(){
        return $this->empleadoRepository->getAll();
    }
    public function getById($id){
        return $this->empleadoRepository->getById($id);
    }
    public function getByUser($usuario){
        return $this->empleadoRepository->getByUser($usuario);
    }
    public function createEmpleado($data){
        $exist = $this->empleadoRepository->buscarporUsuarioNombre($data['usuario'],$data['nombre'],$data['apaterno'],$data['amaterno']);
        if($exist){
            return ['error' => true, 'mensaje' => 'Ya existe nombre o usuario']; #respuesta de la API
        }
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->empleadoRepository->createEmpleado($data);
        return ['success' => true];
    }
    public function updateEmpleado($id,$data){
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->empleadoRepository->updateEmpleado($id,$data);
        return ['success' => true];
    }
    public function deleteEmpleado($id){
        $this->empleadoRepository->deleteEmpleado($id);
        return ['success' => true];
    }
    /*public function buscarPorUsuarioNombre($usuario, $nombre, $apaterno, $amaterno){
        return $this->empleadoRepository->buscarPorUsuarioNombre($usuario, $nombre, $apaterno, $amaterno);
    }*/
    
}

?>