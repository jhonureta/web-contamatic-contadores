<?php

require_once "../model/contacto_modelo.php"; // corregido de "model" a "modelo"
require_once "./envioMensaje.controlador.php"; // corregido de "controlador" a "controlador.php"

class AjaxContacto {

    public function ajaxRegistrarInformacionUsuario() {

        $ip = $_SERVER['REMOTE_ADDR'];

        // Validar Captcha
        $captcha = $_POST['g-recaptcha-response'];
        $secretKey = "6Lex3ZUlAAAAAEfCuqYfchyXEKbYfyjONf7zaT8G"; //
        $respCaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha&remoteip=$ip");
        $atributo = json_decode($respCaptcha, true);

        if (!$atributo["success"]) {
            echo json_encode(array("estado" => false, "mensaje" => "Verifica el captcha"), JSON_UNESCAPED_UNICODE);
            return;
        }

        // Recibir datos del formulario (usar isset para evitar Notice)
        $correo      = isset($_POST["correo"]) ? trim($_POST["correo"]) : '';
        $usuario     = isset($_POST["usuario"]) ? trim($_POST["usuario"]) : '';
        $clave       = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : '';
        $experiencia = isset($_POST["experiencia"]) ? trim($_POST["experiencia"]) : null;
        $nombres     = isset($_POST["nombres_apellidos"]) ? trim($_POST["nombres_apellidos"]) : '';
        $cedula      = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : '';
        $direccion   = isset($_POST["direccion"]) ? trim($_POST["direccion"]) : null;
        $telefono    = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : null;

        // Validar duplicado
        $validar = array(
            "correo" => $correo,
            "alias"  => $usuario // corregido para que coincida con el bindParam del modelo
        );
        $respuesta = ModeloContacto::validarUsuarioRepetido($validar);
        if (!$respuesta["estado"]) {
            echo json_encode($respuesta);
            return;
        }

        // Armar array para insertar en la base principal
        $datos = array(
            "IDE_USUEMP"      => $cedula,
            "NOM_USUEMP"      => $nombres,
            "DIR_USUEMP"      => $direccion,
            "EMA_USUEMP"      => $correo,
            "ALI_USUEMP"      => $usuario,
            "PASS_USUEMP"     => $clave,
            "FOTO_USUEMP"     => "",
            "ROL_USUEMP"      => "Vendedor",
            "EST_USUEMP"      => 0,
            "PLAN_USUEMP"     => "normal",
            "CANTPLAN_USUEMP" => null,
            "ADMINCRE_USUEMP" => 1,
            "TELF_USUEMP"     => $telefono,
            "ORIGEN_USUEMP"   => 1,
            "EST_TERMINOS"    => 0,
            "COUNT_SMS"       => 0,
            "EXP_USUEMP"      => $experiencia,
            "VENDEDOR"        => 1,
            "AFFILIATED"      => null,
            "MANUAL_REG"      => 0
        );

        // Guardar en la base principal
        $registro = ModeloContacto::mdlAgregarUsuario($datos);
        if (!$registro["estado"]) {
            echo json_encode(array(
                "estado" => false,
                "mensaje" => "Error al registrar. Intenta nuevamente."
            ));
            return;
        }

        // Guardar también en la base contamatic_facturacion_electronica
        $datosContamatic = array(
            "COD_USUEMP"      => $registro["id"],
            "IDE_USUEMP"      => $cedula, // ahora coincide con la base principal
            "NOM_USUEMP"      => $nombres,
            "DIR_USUEMP"      => $direccion,
            "EMA_USUEMP"      => $correo,
            "PASS_USUEMP"     => substr($clave, 0, 50),
            "ALI_USUEMP"      => $usuario,
            "FOTO_USUEMP"     => "default.jpg",
            "ROL_USUEMP"      => "admin",
            "EST_USUEMP"      => 1,       // activo
            "PLAN_USUEMP"     => "normal",
            "CANTPLAN_USUEMP" => 0,
            "ADMINCRE_USUEMP" => 1,
            "TELF_USUEMP"     => $telefono,
            "COUNT_SMS"       => 0
        );

        $registroContamatic = ModeloContacto::mdlAgregarUsuarioContamatic($datosContamatic);
        if (!$registroContamatic["estado"]) {
            // Si falla en Contamatic, solo lo reportamos
              echo json_encode(array(
                "estado" => false,
                "mensaje" => "Error al registrar. Intenta nuevamente."
            ));
            return;
        }

        // Enviar correo (si está configurado)
        $correoData = array(
            "nombre"         => $nombres,
            "identificacion" => $cedula,
            "correo"         => $correo,
            "nick"           => $usuario,
            "clave"          => $clave
        );
        ModeloContacto::enviarCorreoElectronico($correoData);

        echo json_encode(array(
            "estado" => true,
            "mensaje" => "Registro exitoso. Tu código único es: " . $usuario
        ), JSON_UNESCAPED_UNICODE);


    }
}

/* -------------------------------------------------------------------------- */
/*                            DETECTAR POST DE REGISTRO                       */
/* -------------------------------------------------------------------------- */
if(isset($_POST["correo"])){
    $ajax = new AjaxContacto();
    $ajax->ajaxRegistrarInformacionUsuario();
}
