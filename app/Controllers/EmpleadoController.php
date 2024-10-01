<?php
namespace App\Controllers;

use App\Services\EmpleadoService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Responce;

class EmpleadoController {
    private $empleadoService;
    public function __construct(EmpleadoService $empleadoService){
        $this->$empleadoService = $empleadoService;
    }

    public function getAll(){
        $empleados = $this->$empleadoService->getAll();
        return new Response(json_encode($empleados),200,['Content-Type'=>'application/json']);
    }

    public function getById($id){
        $empleado = $this->$empleadoService->getById($id);
        if ($empleado){
            return new Response(json_encode($empleado),200,['Content-Type'=>'application/json']);
        }
        else {
            return new Response(json_encode(['error'=>'Empleado not found']),404);
        }
    }

    public function getByUser($usuario){
        $empleado = $this->$empleadoService->getByUser($usuario);
        if ($empleado){
            return new Response(json_encode($empleado),200,['Content-Type'=>'application/json']);
        }
        else {
            return new Response(json_encode(['error'=>'Empleado not found']),404);
        }
    }

    public function createEmpleado(Request $request){
        $data = json_decode($request->getContent(),true); // true es para validaciones
        $empleado = $this->$empleadoService->createEmpleado($data);
        if (!$empleado['error']){
            return new Response(json_encode(['message'=>'Empleado has been registered']),201);
        }
        else {
            return new Response(json_encode(['error'=>$empleado['message']]),404);
        }
    }

    public function updateEmpleado($id, Request $request){
        $data = json_decode($request->getContent(),true); // true es para validaciones
        $this->$empleadoService->updateEmpleado($id, $data);
        return new Response(json_encode(['message'=>'Empleado has been updated']),201);
    }

    public function deleteEmpleado($id){
        $this->$empleadoService->deleteEmpleado($id);
        return new Response(json_encode(['message'=>'Empleado has been erased']),201);
    }
}
?>