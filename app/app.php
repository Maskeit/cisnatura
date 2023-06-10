<?php

namespace app;

require_once "autoloader.php";
use Controllers\PostController as PostController;

if(!empty($_POST)){

    /**FORMULARIO DE REGISTRO DE CITA */
    $cita = in_array('_cita',array_keys(filter_input_array(INPUT_POST)));
    if($cita){
        $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        $datosCita = new PostController();
        print_r($datosCita->nuevaCita($datos));
    }
}

if(!empty($_GET)){
    //******************CARGAR LA ultima consulta */
    $lc = in_array('_lc', array_keys(filter_input_array(INPUT_GET)));
    if($lc){
        $limit = filter_input(INPUT_GET, 'limit', FILTER_SANITIZE_NUMBER_INT);
        $lastcita = new PostController();
        print_r($lastcita->getCitas($limit));
    }
}