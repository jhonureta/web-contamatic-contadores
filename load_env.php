<?php
function cargarEnv($ruta)
{
    if (!file_exists($ruta)) return;

    $lineas = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lineas as $linea) {
        $linea = trim($linea);
        if ($linea === '' || $linea[0] === '#') continue;

        list($clave, $valor) = explode('=', $linea, 2);

        $clave = trim($clave);
        $valor = trim($valor, " \t\n\r\0\x0B\"'");

        putenv("$clave=$valor");
        $_ENV[$clave] = $valor;
        $_SERVER[$clave] = $valor;
    }
}