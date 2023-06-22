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

    public function agregarProducto($pid, $uid) {
        // Verificar si el producto ya está en el carrito del usuario
        $productoEnCarrito = $this->buscarProductoEnCarrito($pid, $uid);
      
        if ($productoEnCarrito) {
          // Si el producto ya está en el carrito, incrementar la cantidad
          $productoEnCarrito->incrementarCantidad();
        } else {
          // Si el producto no está en el carrito, agregarlo
          $this->agregarProductoAlCarrito($pid, $uid);
        }
      
        // Enviar una respuesta adecuada al cliente, como un JSON con los detalles del producto agregado
        echo json_encode(["success" => true, "message" => "Producto agregado al carrito"]);
    }
      
    public function buscarProductoEnCarrito($pid, $uid) {
    $carrito = new carrito();
    $result = $carrito->where([['productId', $pid], ['userId', $uid]])
                      ->get();
    
        if (count(json_decode($result)) > 0) {
            return $result[0];
        }
    
        return null;
    }
      
    public function agregarProductoAlCarrito($pid, $uid) {
        $carrito = new carrito();
        $carrito->valores=[$pid['productId'],$uid['userId'], 1];
        $carrito->create();
        return;
    }
      
}
