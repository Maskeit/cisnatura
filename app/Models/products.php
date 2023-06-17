<?php

namespace Models;

use Models\DB;

class products extends DB {
    public $table;
    function __construct(){
        parent::__construct();
        $this->table = $this->db_connect();
    }

    protected $campos = ['type','extracto','product_name','description','thumb','price'];

    public $valores = [];

}