<?php

class Conexion{

    /**
     * ADMIN ELECTRONICO
     */

    static public function conectar(){
        
		$link = new PDO("mysql:host=localhost:3306;dbname=contamatic_admin_electronico",
        "root",
        "");

        $link->exec("set names utf8");

        return $link;
    }


    /**
     * FACTUMATIC
     */

    static public function conectarFactumatic(){
        
        $link = new PDO("mysql:host=localhost:3306;dbname=contamatic_facturacion_electronica",
        "root",
        "");

        $link->exec("set names utf8");

        return $link;
    }


}