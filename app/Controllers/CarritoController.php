<?php

    namespace Controllers;

    use Models\carrito;
    use Models\products;
    use Controllers\auth\LoginController as LoginController;
class CarritoController {

    private $userId;
    public $productId;

    public function __construct(){

        $ua = new LoginController();
        $ua->sessionValidate();
        $this->userId = $ua->id;
    }

    /**
     * empiezan los metodos para
     * agregar productos al carrito
     */
    public function buscarProductoEnCarrito($pid, $uid) {
        $carrito = new carrito();
        $result = $carrito->where([['userId', $uid], ['productId', $pid]])
                          ->get();
        return $result;
    }
    
    public function agregarProducto($pid, $uid, $tt) {
        // Verificar si el producto ya está en el carrito del usuario
        $productoExistente = $this->buscarProductoEnCarrito($pid, $uid);
        $cantidad = $this->cantProductos($uid);
        $carrito = new carrito();
        if (empty($productoExistente))  {
            $carrito->valores = [$uid, $pid, $tt];        
            $result = $carrito->create();
        } else if(!empty($productoExistente)) {
            $result = $carrito->where([['userId', $uid], ['productId', $pid]])
                              ->update([['cantidad', 'cantidad + 1']]);
        }
        return $result;
    }
        
    public function cantProductos($uid){
        $carrito = new carrito();
        $result = $carrito->count()//tt
                          ->where([['userId',$this->userId]])                          
                          ->get();
        return $result;
    }
    // public function allCar($uid = "") {
    //     $carrito = new carrito();
    //     $result = $carrito->select(['a.id',
    //                                 'a.product_name',
    //                                 'a.description',
    //                                 'a.price',
    //                                 'b.cantidad'])
    //         ->join('carrito b', 'a.id = b.productId ')
    //         ->where($uid != "" ? [['b.userId', $uid]] : [])
    //         ->orderBy([['fecha', 'DESC']])
    //         ->get();
    //     return $result;
    // }

    //alternativa chafa
    public function allCar($uid=""){
        $carrito = new carrito();    
        $conexion = $carrito->db_connect();
        if($conexion == null){
            echo "Hubo un error al conectar a la base de datos <br>";
        } else {
            $sql = "SELECT b.id, a.product_name, a.thumb, a.extracto, a.price, b.cantidad
                    FROM products a
                    INNER JOIN carrito b ON b.productId = a.id WHERE b.userId = $uid";
            
            $resultado = mysqli_query($conexion, $sql);
            
            // Procesar los datos y retornarlos en un formato adecuado
            $filas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
            
            // Liberar el resultado y cerrar la conexión
            mysqli_free_result($resultado);
            mysqli_close($conexion);
            
            return json_encode($filas);
        }
    }

    public function deleteProductCar($pci){
        $carrito = new carrito();
        $result = $carrito->delete($pci);
        return $result;
    }
}