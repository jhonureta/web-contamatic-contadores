<?php

class Conexion{

    /**
     * ADMIN ELECTRONICO
     */

    static public function conectar(){
        
		$link = new PDO("mysql:host=192.168.1.35:3306:3306;dbname=contamatic_admin_electronico",
        "root",
        "");

        $link->exec("set names utf8");

        return $link;
    }


    /**
     * FACTUMATIC
     */

    static public function conectarFactumatic(){
        
        $link = new PDO("mysql:host=192.168.1.35:3306:3306;dbname=contamatic_facturacion_electronica",
        "root",
        "");

        $link->exec("set names utf8");

        return $link;
    }


}