<?php
require_once "../extensiones/PHPMailer/Exception.php";
require_once "../extensiones/PHPMailer/PHPMailer.php";
require_once "../extensiones/PHPMailer/SMTP.php";
require_once "conexion.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ModeloContacto {

    /* ==============================================
    ENVIAR CORREO
    ============================================== */
    static public function enviarCorreoElectronico($datos){
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "mail.contamatic.ec";
            $mail->Port = 465;
            $mail->Username = "facturacion-contamatic@contamatic.ec";
            $mail->Password = "1Xe8FwlBGJ{r";
            $mail->setFrom("facturacion-contamatic@contamatic.ec", "Contamatic");
            $mail->addAddress($datos["correo"], $datos["nombre"]);
            $mail->isHTML(true);
            $mail->Subject = "Correo de confirmaci贸n";

            $mail->Body = '
                <html>
                <body>
                    <h1>Bienvenido, ' . htmlspecialchars($datos["nombre"]) . '</h1>
                    <p><b>C贸digo:</b> ' . htmlspecialchars($datos["identificacion"]) . '</p>
                    <p><b>Usuario:</b> ' . htmlspecialchars($datos["nick"]) . '</p>
                    <p><b>Contrase帽a:</b> ' . htmlspecialchars($datos["clave"]) . '</p>
                    <p><a href="https://admin-electronico.contamatic.ec/factumatic/">Accede al sistema</a></p>
                </body>
                </html>';

            $mail->send();

            return [
                "estado" => true,
                "mensaje" => "Correo enviado correctamente a " . $datos["correo"]
            ];

        } catch (Exception $e) {
            return [
                "estado" => false,
                "mensaje" => "Error al enviar correo",
                "error" => $e->getMessage()
            ];
        }
    }

    /* ==============================================
    VALIDAR SI USUARIO YA EXISTE
    ============================================== */
    static public function validarUsuarioRepetido($datos){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE EMA_USUEMP = :correo OR ALI_USUEMP = :alias");
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":alias", $datos["alias"], PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return [
                "estado" => false,
                "mensaje" => "El usuario o correo ya est谩 registrado."
            ];
        }

        return [
            "estado" => true,
            "mensaje" => ""
        ];
    }

    /* ==============================================
    INSERTAR USUARIO NUEVO EN BASE PRINCIPAL
    ============================================== */
    static public function mdlAgregarUsuario($datos){
        try {
            $conexion = Conexion::conectar();
            $stmt = $conexion->prepare("INSERT INTO usuarios (
                IDE_USUEMP, NOM_USUEMP, DIR_USUEMP, EMA_USUEMP, ALI_USUEMP,
                PASS_USUEMP, FOTO_USUEMP, ROL_USUEMP, EST_USUEMP,
                PLAN_USUEMP, CANTPLAN_USUEMP, ADMINCRE_USUEMP, TELF_USUEMP,
                ORIGEN_USUEMP, EST_TERMINOS, COUNT_SMS, EXP_USUEMP,
                VENDEDOR, AFFILIATED, MANUAL_REG,PASS_REFUSER
            ) VALUES (
                :id, :nombre, :direccion, :correo, :alias,
                :clave, :foto, :rol, :estado,
                :plan, :cantplan, :admin, :telefono,
                :origen, :terminos, :sms, :experiencia,
                :vendedor, :afiliado, :manual, :claveBase64
            )");
            $password = md5($datos["PASS_USUEMP"]);
            $passwordBase64 = base64_encode($datos["PASS_USUEMP"]);
            
            $stmt->bindParam(":id", $datos["IDE_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["NOM_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos["DIR_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $datos["EMA_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":alias", $datos["ALI_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":clave", $password, PDO::PARAM_STR);
            $stmt->bindParam(":claveBase64", $passwordBase64, PDO::PARAM_STR);
            $stmt->bindParam(":foto", $datos["FOTO_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":rol", $datos["ROL_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos["EST_USUEMP"], PDO::PARAM_INT);
            $stmt->bindParam(":plan", $datos["PLAN_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":cantplan", $datos["CANTPLAN_USUEMP"], PDO::PARAM_INT);
            $stmt->bindParam(":admin", $datos["ADMINCRE_USUEMP"], PDO::PARAM_INT);
            $stmt->bindParam(":telefono", $datos["TELF_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":origen", $datos["ORIGEN_USUEMP"], PDO::PARAM_INT);
            $stmt->bindParam(":terminos", $datos["EST_TERMINOS"], PDO::PARAM_INT);
            $stmt->bindParam(":sms", $datos["COUNT_SMS"], PDO::PARAM_INT);
            $stmt->bindParam(":experiencia", $datos["EXP_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":vendedor", $datos["VENDEDOR"], PDO::PARAM_INT);
            $stmt->bindParam(":afiliado", $datos["AFFILIATED"], PDO::PARAM_STR);
            $stmt->bindParam(":manual", $datos["MANUAL_REG"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return [
                    "estado" => true,
                    "id" => $conexion->lastInsertId()
                ];
            } else {
                return [
                    "estado" => false,
                    "mensaje" => "Error al registrar",
                    "error" => $stmt->errorInfo(),
                    "datos" => $datos
                ];
            }

        } catch (Exception $e) {
            return [
                "estado" => false,
                "mensaje" => "Error inesperado",
                "error" => $e->getMessage()
            ];
        }
    }

    /* ==============================================
    INSERTAR USUARIO EN BASE CONTAMATIC_FACTURACION_ELECTRONICA
    ============================================== */
    static public function mdlAgregarUsuarioContamatic($datos){
        try {
            $conectarFactumatic = Conexion::conectarFactumatic();

            $datos["FOTO_USUEMP"] = !empty($datos["FOTO_USUEMP"]) ? $datos["FOTO_USUEMP"] : "default.jpg";
            $datos["ROL_USUEMP"]  = !empty($datos["ROL_USUEMP"]) ? $datos["ROL_USUEMP"] : "admin";
            $datos["EST_USUEMP"]  = isset($datos["EST_USUEMP"]) ? (int)$datos["EST_USUEMP"] : 1;
            $datos["PLAN_USUEMP"] = !empty($datos["PLAN_USUEMP"]) ? substr($datos["PLAN_USUEMP"],0,20) : "normal";
            $datos["COUNT_SMS"]   = isset($datos["COUNT_SMS"]) ? (int)$datos["COUNT_SMS"] : 0;
            $datos["PASS_USUEMP"] = substr($datos["PASS_USUEMP"],0,50);
            $datos["CANTPLAN_USUEMP"] = isset($datos["CANTPLAN_USUEMP"]) ? (int)$datos["CANTPLAN_USUEMP"] : 0;
            $datos["TELF_USUEMP"] = !empty($datos["TELF_USUEMP"]) ? $datos["TELF_USUEMP"] : null;

            $stmt = $conectarFactumatic->prepare("
                INSERT INTO admin (
                    COD_USUEMP, IDE_USUEMP, NOM_USUEMP, DIR_USUEMP, EMA_USUEMP, PASS_USUEMP,
                    ALI_USUEMP, FOTO_USUEMP, ROL_USUEMP, EST_USUEMP, PLAN_USUEMP,
                    CANTPLAN_USUEMP, ADMINCRE_USUEMP, TELF_USUEMP, COUNT_SMS
                ) VALUES (
                    :codigo, :id, :nombre, :direccion, :correo, :clave,
                    :alias, :foto, :rol, :estado, :plan,
                    :cantplan, :admin, :telefono, :sms
                )
            ");
            $stmt->bindParam(":codigo", $datos["COD_USUEMP"], PDO::PARAM_INT);
            $stmt->bindParam(":id", $datos["IDE_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["NOM_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos["DIR_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $datos["EMA_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":clave", $datos["PASS_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":alias", $datos["ALI_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":foto", $datos["FOTO_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":rol", $datos["ROL_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos["EST_USUEMP"], PDO::PARAM_INT);
            $stmt->bindParam(":plan", $datos["PLAN_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":cantplan", $datos["CANTPLAN_USUEMP"], PDO::PARAM_INT);
            $stmt->bindParam(":admin", $datos["ADMINCRE_USUEMP"], PDO::PARAM_INT);
            $stmt->bindParam(":telefono", $datos["TELF_USUEMP"], PDO::PARAM_STR);
            $stmt->bindParam(":sms", $datos["COUNT_SMS"], PDO::PARAM_INT);

            if($stmt->execute()){
                return ["estado" => true];
            } else {
                return [
                    "estado" => false,
                    "error"  => $stmt->errorInfo(),
                    "datos"  => $datos
                ];
            }

        } catch (Exception $e){
            return [
                "estado" => false,
                "error"  => $e->getMessage(),
                "datos"  => $datos
            ];
        }
    }

}
