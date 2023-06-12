<?php

namespace Models;

use Models\DB;

class user extends DB {
    public $table;
    function __construct(){
        parent::__construct();
        $this->table = $this->db_connect();
    }

    protected $campos = ['name','email','username','passwd'];

    public $valores = [];

}