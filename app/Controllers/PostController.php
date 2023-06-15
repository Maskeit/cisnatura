<?php

    namespace Controllers;

    use Models\cita;
    use Models\user;
    use Controllers\auth\LoginController as LoginController;

class PostController {

    public $fecha;
    public $hora;
    public $cliente;
    public $tipoConsulta;
    public $telefonoCliente;

    private $userId;
    private $title;
    private $body;


    public function __construct(){
        $this->fecha = $_POST['fecha_cita'] ?? '';
        $this->hora = $_POST['hora_cita'] ?? '';
        $this->cliente = $_POST['nombre_cliente'] ?? '';
        $this->tipoConsulta = $_POST['tipo_cita'] ?? '';
        $this->telefonoCliente = $_POST['telefono_cliente'] ?? '';

        $ua = new LoginController();
        $ua->sessionValidate();
        $this->userId = $ua->id;
    }

    public function nuevaCita($datos){
        $citas = new cita();
        $citas->valores = [
            $datos['fecha_cita'],
            $datos['hora_cita'],
            $datos['nombre_cliente'],
            $datos['tipo_cita'],
            $datos['telefono_cliente']
        ];
        $registro = $citas->create();
        return;
        die;
    }

    // public function getCitas($limit=""){
    //     $citas = new cita();
    //     $resultC = $citas->select(['fecha_cita','hora_cita','nombre_cliente','tipo_cita', 'telefono_cliente'])
    //                     ->orderBy([['fecha_cita','DESC']])
    //                     ->limit($limit)
    //                     ->get();
    //     return $resultC;
    // }

    public function getMyCitas(){
        $citas = new cita();
        $result = $citas->get();
        return $result;               
    }

    public function getHorarios($fec){
        $cita = new cita();
        $result = $cita->where([['fecha_cita',$fec]])
                        ->get();
        return $result;
    }
    
    public function toggleCitaActive($pid) {
        $cita = new cita();
        $result = $cita->where([['id', $pid]])->update([['active', 'not active']]); // Cambia '1' por el valor adecuado para completado
    } 
    
    public function deleteCita($pid) {
        $cita = new cita();
        $result = $cita->delete($pid);
        return $result;
    }
    
}