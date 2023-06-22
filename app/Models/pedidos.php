<?php

namespace Models;

use Models\DB;

class pedidos extends DB {
    public $table;  
    function __construct(){
        parent::__construct();
        $this->table = $this->db_connect();
    }

    protected $campos = ['userId','productsId','cantidad'];

    public $valores = [];

}