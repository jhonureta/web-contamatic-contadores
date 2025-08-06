<?php

require_once __DIR__ . "/controller/template.controller.php";

// Si no hay parámetro de URL, carga la plantilla por defecto
$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();
