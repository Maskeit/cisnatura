<?php

    namespace Controllers;

    use Models\cita;

class PostController {

    public $fecha;
    public $hora;
    public $cliente;
    public $tipoConsulta;
    public $telefonoCliente;

    public function __construct(){
        $this->fecha = $_POST['fecha_cita'] ?? '';
        $this->hora = $_POST['hora_cita'] ?? '';
        $this->cliente = $_POST['nombre_cliente'] ?? '';
        $this->tipoConsulta = $_POST['tipo_cita'] ?? '';
        $this->telefonoCliente = $_POST['telefono_cliente'] ?? '';
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

    public function getCitas($limit=""){
        $citas = new cita();
        $resultC = $citas->select(['fecha_cita','hora_cita','nombre_cliente','tipo_cita', 'telefono_cliente'])
                        ->orderBy([['fecha_cita','DESC']])
                        ->limit($limit)
                        ->get();
        return $resultC;
    }
        
}