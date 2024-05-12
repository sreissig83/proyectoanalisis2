<?php
     class Conexion{
        public static function conectar(){
            define('servidor','localhost');
            define('nombredb','meson_db');
            define('usuario','root');
            define('password','');

            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            try{
                $conexion = new PDO("mysql:host=".servidor."; dbname=".nombredb, usuario, password, $opciones);
                return $conexion;
            }catch (Exception $e){
                die("El error de conexion es: ". $e->getMessage());

            }
        }
     }
?>