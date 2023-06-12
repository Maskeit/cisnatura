<?php

    namespace Controllers\auth;

    use Models\user;

    class LoginController {
        public $sv; //Sesión válida
        public $name;
        public $id;
        public $tipo;
        public function __construct(){
            $this->sv = false;
        }

        public function userRegister($datos){
            $user = new user();
            $user->valores = [
                                $datos['name'],
                                $datos['email'],
                                $datos['username'],
                                sha1($datos['passwd'])
                            ];
            $result = $user->create();
            return $result;
            die;
        }

        public function userAuth($datos){
            $user = new user();

            $result = $user->where([["username",$datos["username"]],
                                    ["passwd",sha1($datos["passwd"])]])->get();
            if(count(json_decode($result)) > 0){
                //Se registra la sesión
                return $this->sessionRegister($result);
                 
            }else{
                $this->sessionDestroy();
                echo json_encode(["r" => false ]);
            }
        }
        
        private function sessionRegister($r){
            $datos = json_decode($r);
            session_start();
            $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['username'] = $datos[0]->username;
            $_SESSION['passwd'] = $datos[0]->passwd;
            $_SESSION['tipo'] = $datos[0]->tipo;
            session_write_close();
            return json_encode(["r" => true]);

        } 

        public function sessionValidate(){
            $user = new user();
            session_start();
            if(session_status() == PHP_SESSION_ACTIVE && count($_SESSION) > 0){
                $datos = $_SESSION;
                $result = $user->where([["username",$datos["username"]],
                    ["passwd",$datos["passwd"]]])->get();
                if(count(json_decode($result)) > 0 && $datos['IP'] == $_SERVER['REMOTE_ADDR']){
                    session_write_close();
                    $this->sv = true;
                    $this->name = json_decode($result)[0]->name;
                    $this->id = json_decode($result)[0]->id;
                    $this->tipo = json_decode($result)[0]->tipo;
                    return $result;
                }
            }else{
                session_write_close();
                $this->sessionDestroy();
                return null;
            }
        
        }

        private function sessionDestroy(){
            session_start();
            $_SESSION = [];
            session_destroy();
            session_write_close();
            $this->sv = false;
            $this->name = "";
            $this->id = "";
            $this->tipo = "";
            return;
        }
        public function logout(){
            $this->sessionDestroy();
            return;
        }
}

