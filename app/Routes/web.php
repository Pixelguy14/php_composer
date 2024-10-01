<?php
use App\Controllers\EmpleadoController;
use Symfony\Component\HttpFoundation\Request;

$empleadoController = new EmpleadoController($empleadoService);

$router->get('/empleados',function(Request $request) use ($empleadoController){
    return $empleadoController->getAll();
});

$router->get('/empleados/{id}',function($id) use ($empleadoController){
    return $empleadoController->getById();
});

$router->post('/empleados',function(Request $request) use ($empleadoController){
    return $empleadoController->createEmpleado($request);
});

$router->put('/empleados/{id}',function($id,Request $request) use ($empleadoController){
    return $empleadoController->updateEmpleado($id,$request);
});

$router->delete('/empleados/{id}',function($id) use ($empleadoController){
    return $empleadoController->deleteEmpleado($id);
});
?>