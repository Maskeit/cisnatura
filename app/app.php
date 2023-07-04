<?php

namespace app;

require_once "autoloader.php";
use Controllers\PostController as PostController;
use Controllers\CarritoController as CarritoController;
use Controllers\auth\LoginController as LoginController;

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

    /*************************CONTROL PARA SUBIR UN PRODUCTO NUEVO O EDITARLO ***************/
    $gp =  in_array('_gp',array_keys(filter_input_array(INPUT_POST))); //gp = guardar producto
    if($gp){
        $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        $post = new PostController();
        $post->createProduct($datos);
        print_r(json_encode($datos));
    }
    /************************EDITAR PRODUCTO ******************/
    $edp =  in_array('_ep',array_keys(filter_input_array(INPUT_POST)));
    if($edp){
        $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        $post = new PostController();
        $post->updateProduct($datos);
        print_r($datos);
    }

}

if(!empty($_GET)){
    //*************LOGOUT */
    $logout = in_array('_logout',array_keys(filter_input_array(INPUT_GET)));
    if($logout){
    $userLogout = new LoginController();
    $userLogout->logout();
    header('Location:/cisnatura/resources/views/home.php');
    }
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
    /****************************ELIMINAR UN PRODUCTO DEL CATALOGO ******** */
    $dp = in_array('_dp', array_keys(filter_input_array(INPUT_GET)));
    if($dp){
        $pid = filter_input(INPUT_GET, '_dp');
        $product = new PostController();
        $result = $product->deleteProduct($pid);
        if ($result) {
            print_r(json_encode(['r' => 'success']));
        } else {
            print_r(json_encode(['r' => 'error']));
        }
    }

    $tac = in_array('_tac', array_keys(filter_input_array(INPUT_GET)));
    if($tac){
        $pid = filter_input(INPUT_GET, '_tac');
        $product = new PostController();
        print_r(json_encode(['r' => $product->toggleProdActive($pid)]));
    }  

    /***************VERIFICAR HORARIOS DISPONIBLES */
    if (isset($_GET['_fecha'])) {
        $fecha = $_GET['_fecha'];
        $cita = new PostController();
        $horariosDisponibles = $cita->getHorarios($fecha);
        print_r(json_encode($horariosDisponibles));
    }

    /*****************TRAER PRODUCTOS AL CATALOGO****************************************** */
    $tp = in_array('_tp', array_keys(filter_input_array(INPUT_GET)));
    if($tp){
        //$pid = filter_input_array(INPUT_GET);
        $product = new PostController();
        print_r(json_encode($product->getProducts()));
    }
    /********muestra el prodcuto seleccionado */
    $vp = in_array('_vp', array_keys(filter_input_array(INPUT_GET)));
    if($vp){
        $pid = filter_input_array(INPUT_GET)['pid'];
        $product = new PostController();
        print_r(json_encode($product->getProduct($pid)));
    }

    /**************trae los productos a editar********* */
    $tpe = in_array('_tpe', array_keys(filter_input_array(INPUT_GET)));
    if($tpe){
        $pid = filter_input_array(INPUT_GET);
        $product = new PostController();
        print_r(json_encode($product->getProducts()));
    }

    //************CARGAR LOS POST MAS RECIENTES *******/
    //********EL DE TINTURAS */

    $lp = in_array('_lp', array_keys(filter_input_array(INPUT_GET)));
    if ($lp) {
        $l = filter_input_array(INPUT_GET)["limit"];
        $lastpost = new PostController();
        $result = $lastpost->getProducts($l);
        echo json_encode($result);
    }

    /******** CONTROL PARA AGREGAR PRODUCTOS A UN CARRITO ********/
    $ap = in_array('_ap', array_keys(filter_input_array(INPUT_GET)));
    if ($ap) {
        $pid = filter_input(INPUT_GET,'pid');
        $uid = filter_input(INPUT_GET,'uid');
        $tt = filter_input(INPUT_GET,'tt');
        $carrito = new CarritoController();
        //imprimir valor del productoexistente
        $productoExistente = $carrito->buscarProductoEnCarrito($pid,$uid);
        $cantidadPr = $carrito->cantProductos($uid);
        var_dump($productoExistente);
        echo '<br>';
        var_dump($cantidadPr);
        echo '<br>';
        $result = $carrito->agregarProducto($pid, $uid, $tt);
        if ($result) {
            print_r(json_encode(['r' => 'success']));
        } else {
            print_r(json_encode(['r' => 'error']));
        }
    }

    /**********Ver cantidad de productos en el carrito *****/
    $np = in_array('_np', array_keys(filter_input_array(INPUT_GET)));
    if ($np) {
        $uid = filter_input_array(INPUT_GET)['_np'];
        $carrito = new CarritoController();
        print_r($carrito->cantProductos($uid));
    }
    /**********Ver los productos del carrito *****/
    $np = in_array('_vcar', array_keys(filter_input_array(INPUT_GET)));
    if ($np) {
        $uid = filter_input_array(INPUT_GET)['_vcar'];
        $carrito = new CarritoController();
        print_r($carrito->allCar($uid));
    }
    /********** Quitar un producto del carrito ********* */
    $carid = in_array('_pci', array_keys(filter_input_array(INPUT_GET)));
    if($carid){
        $pci = filter_input(INPUT_GET,'_pci');
        $carrito = new CarritoController();
        $result = $carrito->deleteProductCar($pci);
        if ($result) {
            print_r(json_encode(['r' => 'success']));
        } else {
            print_r(json_encode(['r' => 'error']));
        }
    }
}