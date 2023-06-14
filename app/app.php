<?php

namespace app;

require_once "autoloader.php";
use Controllers\PostController as PostController;

if(!empty($_POST)){
    //*************LOGIN */
    $login = in_array('_login',array_keys(filter_input_array(INPUT_POST)));
    if($login){
        $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        $userLogin = new LoginController();
        print_r($userLogin->userAuth($datos));
        
    }

    //************REGISTRO DE CUENTA */
    $register = in_array('_register',array_keys(filter_input_array(INPUT_POST)));
    if($register){
        $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        $userRegister = new LoginController();
        print_r($userRegister->userRegister($datos));   
    }

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
    // $lc = in_array('_lc', array_keys(filter_input_array(INPUT_GET)));
    // if($lc){
    //     $limit = filter_input(INPUT_GET, 'limit', FILTER_SANITIZE_NUMBER_INT);
    //     $lastcita = new PostController();
    //     print_r($lastcita->getCitas($limit));
    // }

    //**********************CARGAR MIS citas en la tabla ******************/
    $mc = in_array('_mc',array_keys(filter_input_array(INPUT_GET)));
    if($mc){
        $uid = filter_input_array(INPUT_GET);
        $cita = new PostController();
        print_r($cita->getMyCitas());
    }
    //**********************Cambiar status de la cita a completado ******************/
    $tpa = isset($_GET['_tcc']);
    if ($tpa) {
        $pid = $_GET['_tcc'];
        $cita = new PostController();
        $result = $cita->toggleCitaActive($pid);
    }
    

    /****************************ELIMINAR O BORRAR LA CITA DE LA BD */
    $dc = in_array('_dc', array_keys(filter_input_array(INPUT_GET)));
    if($dc){
        $pid = filter_input(INPUT_GET, '_dc');
        $cita = new PostController();
        $result = $cita->deleteCita($pid);
        if ($result) {
            print_r(json_encode(['r' => 'success']));
        } else {
            print_r(json_encode(['r' => 'error']));
        }
    }
}