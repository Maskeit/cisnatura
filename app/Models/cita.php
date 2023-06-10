<?php

namespace Models;

use Models\DB;

class cita extends DB {
    public $table;  
    function __construct(){
        parent::__construct();
        $this->table = $this->db_connect();
    }

    protected $campos = ['fecha_cita','hora_cita','nombre_cliente','tipo_cita', 'telefono_cliente'];

    public $valores = [];

}