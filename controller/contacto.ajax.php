<?php

require_once "../model/contacto_modelo.php"; // corregido de "model" a "modelo"
require_once "./envioMensaje.controlador.php"; // corregido de "controlador" a "controlador.php"
require_once $_SERVER['DOCUMENT_ROOT'] . '/load_env.php';

class AjaxContacto
{

    public function ajaxRegistrarInformacionUsuario()
    {
        cargarEnv($_SERVER['DOCUMENT_ROOT'] . '/.env');
        // Luego puedes usar las variables de entorno
        $secretKey = getenv('RECAPTCHA_SECRET_KEY');

        $ip = $_SERVER['REMOTE_ADDR'];

        // Validar Captcha
        $captcha = $_POST['g-recaptcha-response'];
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
    public function ajaxRegistroEmpresarioSis()
    {
        try {

            $nombreapellido = trim($_POST["nombre"]);
            $telefono = trim($_POST["telefono"]);
            $correo = trim($_POST["correo"]);
            $ciudad = trim($_POST["ciudad"]);
            $cargo = trim($_POST["cargo"]);
            $tipo = trim($_POST["tipo"]);

            if (empty($nombreapellido) || empty($telefono) || empty($ciudad) || empty($cargo)) {
                throw new Exception("Por favor, complete todos los campos.");
            }

            $telefonoRegex = '/^\d{10,13}$/';
            if (!preg_match($telefonoRegex, $telefono)) {
                throw new Exception("Por favor ingrese un número de teléfono válido.");
            }


            $hora = new DateTime("now", new DateTimeZone('America/Guayaquil'));
            $fechahora = $hora->format('Y-m-d H:i:s');
            $datos =  array(
                "nombre" => $nombreapellido,
                "telefono" => $telefono,
                "correo" => $correo,
                "ciudad" => $ciudad,
                "fecha" => $fechahora,
                "cargo" => $cargo,
                "estado" => "REGISTRADO",
                "tipo" => $tipo,
                "jsonCuest" => null,
            );

            $validacion = ModeloContacto::validarEmpresarioRepetido($datos);
            if ($validacion["status"] == "ERROR") {
                throw new Exception($validacion["message"]);
            }

            $respuesta = ModeloContacto::mdlGuardarEmpresarioAdminElectronico($datos);
            if ($respuesta["status"] == "ERROR") {
                throw new Exception($respuesta["message"]);
            }

            header("Content-Type: application/json");
            echo json_encode(array(
                "status" => $respuesta["status"],
                "message" => $respuesta["message"],
            ));
        } catch (Exception $e) {
            $respuesta = array("status" => "ERROR", "message" => $e->getMessage());
            header("Content-Type: application/json");
            echo json_encode($respuesta);
        }
    }

    public function ajaxRegistroEmpresario()
    {
        try {

            $nombreapellido = trim($_POST["nombre"]);
            $telefono = trim($_POST["telefono"]);
            $cargo = trim($_POST["cargo"]);
            $jsonCuest = $_POST["jsonCuest"];
            $correo = trim($_POST["correo"]);
            $ciudad = trim($_POST["ciudad"]);
            $tipo = trim($_POST["tipo"]);

            if (empty($nombreapellido) || empty($telefono) || empty($cargo) || empty($ciudad)) {
                throw new Exception("Por favor, complete todos los campos.");
            }

            $telefonoRegex = '/^\d{10,13}$/'; // Se asume que el teléfono es de 10 dígitos
            if (!preg_match($telefonoRegex, $telefono)) {
                throw new Exception("Por favor ingrese un número de teléfono válido.");
            }

            $hora = new DateTime("now", new DateTimeZone('America/Guayaquil'));
            $fechahora = $hora->format('Y-m-d H:i:s');
            $datos =  array(
                "nombre" => $nombreapellido,
                "telefono" => $telefono,
                "cargo" => $cargo,
                "fecha" => $fechahora,
                "estado" => "REGISTRADO",
                "tipo" => $tipo,
                "correo" => $correo,
                "ciudad" => $ciudad,
                "jsonCuest" => $jsonCuest,
            );

            $validacion = ModeloContacto::validarEmpresarioRepetido($datos);
            if ($validacion["status"] == "ERROR") {
                throw new Exception($validacion["message"]);
            }

            $respuesta = ModeloContacto::mdlGuardarEmpresarioAdminElectronico($datos);
            if ($respuesta["status"] == "ERROR") {
                throw new Exception($respuesta["message"]);
            }

            header("Content-Type: application/json");

            echo json_encode(array(
                "status" => $respuesta["status"],
                "message" => $respuesta["message"],
            ));
        } catch (Exception $e) {
            $respuesta = array("status" => "ERROR", "message" => $e->getMessage());
            header("Content-Type: application/json");
            echo json_encode($respuesta);
        }
    }
}

/* -------------------------------------------------------------------------- */
/*                            DETECTAR POST DE REGISTRO                       */
/* -------------------------------------------------------------------------- */
if (isset($_POST["generarRegistro"])) {
    $ajax = new AjaxContacto();
    $ajax->ajaxRegistrarInformacionUsuario();
}

if (isset($_POST["generarRegistroEmpresario"])) {
    $ajax = new AjaxContacto();
    $ajax->ajaxRegistroEmpresario();
    return;
}

if (isset($_POST["generarRegistroEmpresarioSis"])) {

    $ajax = new AjaxContacto();
    $ajax->ajaxRegistroEmpresarioSis();
    return;
}
