<?php

namespace Models;

use Models\DB;

class carrito extends DB {
    public $table;  
    function __construct(){
        parent::__construct();
        $this->table = $this->db_connect();
    }

    protected $campos = ['userId', 'productId', 'cantidad']; //los campos de la tabla del carrito del cliente.

    public $valores = [];

}